<?php

declare(strict_types=1);

namespace Ksf\HRM\Entity;

class EmployeeCompensation
{
    public const TYPE_SALARY = 'Salary';
    public const TYPE_HOURLY = 'Hourly';
    public const TYPE_COMMISSION = 'Commission';

    private ?int $id = null;
    private int $employeeId = 0;
    private ?int $gradeId = null;
    private ?float $percentOfGrade = null;
    private ?float $annualSalary = null;
    private ?float $hourlyRate = null;
    private string $employeeType = self::TYPE_SALARY;
    private ?string $effectiveDate = null;
    private ?string $endDate = null;
    private bool $otEligible = false;
    private float $otMultiplier = 1.5;
    private string $glCodeSalary = 'G01';
    private string $glCodeOvertime = 'O01';
    private ?int $benefitsPackageId = null;
    private ?float $bonusTarget = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    public function setEmployeeId(int $employeeId): self
    {
        $this->employeeId = $employeeId;
        return $this;
    }

    public function getGradeId(): ?int
    {
        return $this->gradeId;
    }

    public function setGradeId(?int $gradeId): self
    {
        $this->gradeId = $gradeId;
        return $this;
    }

    public function getPercentOfGrade(): ?float
    {
        return $this->percentOfGrade;
    }

    public function setPercentOfGrade(?float $percentOfGrade): self
    {
        $this->percentOfGrade = $percentOfGrade;
        return $this;
    }

    public function getAnnualSalary(): ?float
    {
        return $this->annualSalary;
    }

    public function setAnnualSalary(?float $annualSalary): self
    {
        $this->annualSalary = $annualSalary;
        return $this;
    }

    public function getHourlyRate(): ?float
    {
        return $this->hourlyRate;
    }

    public function setHourlyRate(?float $hourlyRate): self
    {
        $this->hourlyRate = $hourlyRate;
        return $this;
    }

    public function getEmployeeType(): string
    {
        return $this->employeeType;
    }

    public function setEmployeeType(string $employeeType): self
    {
        $this->employeeType = $employeeType;
        return $this;
    }

    public function getEffectiveDate(): ?string
    {
        return $this->effectiveDate;
    }

    public function setEffectiveDate(?string $effectiveDate): self
    {
        $this->effectiveDate = $effectiveDate;
        return $this;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function setEndDate(?string $endDate): self
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function isOtEligible(): bool
    {
        return $this->otEligible;
    }

    public function setOtEligible(bool $otEligible): self
    {
        $this->otEligible = $otEligible;
        return $this;
    }

    public function getOtMultiplier(): float
    {
        return $this->otMultiplier;
    }

    public function setOtMultiplier(float $otMultiplier): self
    {
        $this->otMultiplier = $otMultiplier;
        return $this;
    }

    public function getGlCodeSalary(): string
    {
        return $this->glCodeSalary;
    }

    public function setGlCodeSalary(string $glCodeSalary): self
    {
        $this->glCodeSalary = $glCodeSalary;
        return $this;
    }

    public function getGlCodeOvertime(): string
    {
        return $this->glCodeOvertime;
    }

    public function setGlCodeOvertime(string $glCodeOvertime): self
    {
        $this->glCodeOvertime = $glCodeOvertime;
        return $this;
    }

    public function getBenefitsPackageId(): ?int
    {
        return $this->benefitsPackageId;
    }

    public function setBenefitsPackageId(?int $benefitsPackageId): self
    {
        $this->benefitsPackageId = $benefitsPackageId;
        return $this;
    }

    public function getBonusTarget(): ?float
    {
        return $this->bonusTarget;
    }

    public function setBonusTarget(?float $bonusTarget): self
    {
        $this->bonusTarget = $bonusTarget;
        return $this;
    }

    public function getMonthlySalary(): float
    {
        if ($this->annualSalary === null) {
            return 0.0;
        }
        return $this->annualSalary / 12;
    }

    public function getBiweeklySalary(): float
    {
        if ($this->annualSalary === null) {
            return 0.0;
        }
        return $this->annualSalary / 26;
    }

    public function getWeeklySalary(): float
    {
        if ($this->annualSalary === null) {
            return 0.0;
        }
        return $this->annualSalary / 52;
    }

    public function getHourlyEquivalent(): float
    {
        if ($this->annualSalary === null) {
            return $this->hourlyRate ?? 0.0;
        }
        return $this->annualSalary / 2080;
    }

    public function isOvertimeEligible(): bool
    {
        return $this->otEligible;
    }

    public function calculateOvertimePay(float $hours, float $hourlyRate): float
    {
        if (!$this->isOvertimeEligible()) {
            return 0.0;
        }
        return $hours * $hourlyRate * $this->otMultiplier;
    }
}