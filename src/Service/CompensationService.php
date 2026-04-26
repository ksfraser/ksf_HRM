<?php

declare(strict_types=1);

namespace Ksf\HRM\Service;

use Ksf\HRM\Entity\EmployeeCompensation;
use Ksf\HRM\Entity\Benefit;
use Ksf\HRM\Entity\CompensationConfig;

class CompensationService
{
    private CompensationConfig $config;

    public function __construct(?CompensationConfig $config = null)
    {
        $this->config = $config ?? new CompensationConfig();
    }

    public function calculateGrossPay(EmployeeCompensation $comp, float $hoursWorked, float $otHours = 0): array
    {
        $result = [
            'regular_hours' => $hoursWorked,
            'regular_amount' => 0,
            'ot_hours' => $otHours,
            'ot_amount' => 0,
            'total' => 0,
        ];

        if ($comp->getEmployeeType() === EmployeeCompensation::TYPE_HOURLY) {
            $rate = $comp->getHourlyRate() ?? 0;
            $result['regular_amount'] = $hoursWorked * $rate;
            $result['ot_amount'] = $otHours * $rate * $comp->getOtMultiplier();
            $result['total'] = $result['regular_amount'] + $result['ot_amount'];
        } else {
            $result['regular_amount'] = $comp->getMonthlySalary();
            $result['total'] = $result['regular_amount'];
        }

        return $result;
    }

    public function calculateBenefitsCosts(array $benefits, float $grossPay): array
    {
        $costs = [
            'employer' => 0,
            'employee' => 0,
            'details' => [],
        ];

        foreach ($benefits as $benefit) {
            if (!$benefit instanceof Benefit || !$benefit->isActive()) {
                continue;
            }

            $employerCost = $benefit->calculateEmployerCost($grossPay);
            $employeeCost = $benefit->calculateEmployeeCost($grossPay);

            $costs['employer'] += $employerCost;
            $costs['employee'] += $employeeCost;
            $costs['details'][] = [
                'code' => $benefit->getCode(),
                'name' => $benefit->getName(),
                'employer' => $employerCost,
                'employee' => $employeeCost,
                'gl_expense' => $benefit->getGlCodeExpense(),
                'gl_liability' => $benefit->getGlCodeLiability(),
            ];
        }

        return $costs;
    }

    public function calculatePayrollLiability(EmployeeCompensation $comp, array $benefits, float $hoursWorked, float $otHours = 0): array
    {
        $gross = $this->calculateGrossPay($comp, $hoursWorked, $otHours);
        $benefitCosts = $this->calculateBenefitsCosts($benefits, $gross['total']);

        $entries = [];

        $entries[] = [
            'gl_code' => $comp->getGlCodeSalary(),
            'description' => 'Salary Expense',
            'amount' => $gross['total'],
            'type' => 'expense',
        ];

        if ($otHours > 0) {
            $entries[] = [
                'gl_code' => $comp->getGlCodeOvertime(),
                'description' => 'Overtime Expense',
                'amount' => $gross['ot_amount'],
                'type' => 'expense',
            ];
        }

        foreach ($benefitCosts['details'] as $detail) {
            if ($detail['employer'] > 0) {
                $entries[] = [
                    'gl_code' => $detail['gl_expense'],
                    'description' => $detail['name'] . ' Employer',
                    'amount' => $detail['employer'],
                    'type' => 'expense',
                ];
            }
            if ($detail['employee'] > 0) {
                $entries[] = [
                    'gl_code' => $detail['gl_liability'],
                    'description' => $detail['name'] . ' Withholding',
                    'amount' => $detail['employee'],
                    'type' => 'liability',
                ];
            }
        }

        return [
            'gross_pay' => $gross['total'],
            'employer_benefits' => $benefitCosts['employer'],
            'employee_benefits' => $benefitCosts['employee'],
            'total_liability' => $gross['total'] + $benefitCosts['employer'] + $benefitCosts['employee'],
            'gl_entries' => $entries,
        ];
    }

    public function getConfig(): CompensationConfig
    {
        return $this->config;
    }
}