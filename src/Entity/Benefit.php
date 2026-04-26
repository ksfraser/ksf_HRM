<?php

declare(strict_types=1);

namespace Ksf\HRM\Entity;

class Benefit
{
    public const TYPE_PENSION = 'Pension';
    public const TYPE_INSURANCE = 'Insurance';
    public const TYPE_HEALTH = 'Health';
    public const TYPE_DENTAL = 'Dental';
    public const TYPE_LIFE = 'Life';
    public const TYPE_RRSP = 'RRSP';
    public const TYPE_EI = 'EI';
    public const TYPE_CPP = 'CPP';
    public const TYPE_OTHER = 'Other';

    public const CALC_PERIOD_MONTHLY = 'Monthly';
    public const CALC_PERIOD_BIWEEKLY = 'Biweekly';
    public const CALC_PERIOD_WEEKLY = 'Weekly';
    public const CALC_PERIOD_ANNUAL = 'Annual';

    private ?int $id = null;
    private string $name = '';
    private string $code = '';
    private string $type = self::TYPE_OTHER;
    private float $employerRate = 0.0;
    private float $employeeRate = 0.0;
    private ?float $fixedAmount = null;
    private string $calculationPeriod = self::CALC_PERIOD_MONTHLY;
    private bool $isPercentageBased = true;
    private string $glCodeExpense = '';
    private string $glCodeLiability = '';
    private ?string $provider = null;
    private string $description = '';
    private bool $active = true;
    private bool $isMandatory = false;
    private bool $isTaxDeductible = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getEmployerRate(): float
    {
        return $this->employerRate;
    }

    public function setEmployerRate(float $employerRate): self
    {
        $this->employerRate = $employerRate;
        return $this;
    }

    public function getEmployeeRate(): float
    {
        return $this->employeeRate;
    }

    public function setEmployeeRate(float $employeeRate): self
    {
        $this->employeeRate = $employeeRate;
        return $this;
    }

    public function getFixedAmount(): ?float
    {
        return $this->fixedAmount;
    }

    public function setFixedAmount(?float $fixedAmount): self
    {
        $this->fixedAmount = $fixedAmount;
        return $this;
    }

    public function getCalculationPeriod(): string
    {
        return $this->calculationPeriod;
    }

    public function setCalculationPeriod(string $calculationPeriod): self
    {
        $this->calculationPeriod = $calculationPeriod;
        return $this;
    }

    public function isPercentageBased(): bool
    {
        return $this->isPercentageBased;
    }

    public function setIsPercentageBased(bool $isPercentageBased): self
    {
        $this->isPercentageBased = $isPercentageBased;
        return $this;
    }

    public function getGlCodeExpense(): string
    {
        return $this->glCodeExpense;
    }

    public function setGlCodeExpense(string $glCodeExpense): self
    {
        $this->glCodeExpense = $glCodeExpense;
        return $this;
    }

    public function getGlCodeLiability(): string
    {
        return $this->glCodeLiability;
    }

    public function setGlCodeLiability(string $glCodeLiability): self
    {
        $this->glCodeLiability = $glCodeLiability;
        return $this;
    }

    public function getProvider(): ?string
    {
        return $this->provider;
    }

    public function setProvider(?string $provider): self
    {
        $this->provider = $provider;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;
        return $this;
    }

    public function isMandatory(): bool
    {
        return $this->isMandatory;
    }

    public function setIsMandatory(bool $isMandatory): self
    {
        $this->isMandatory = $isMandatory;
        return $this;
    }

    public function isTaxDeductible(): bool
    {
        return $this->isTaxDeductible;
    }

    public function setIsTaxDeductible(bool $isTaxDeductible): self
    {
        $this->isTaxDeductible = $isTaxDeductible;
        return $this;
    }

    public function calculateEmployerCost(float $grossPay): float
    {
        if ($this->isPercentageBased) {
            return $grossPay * ($this->employerRate / 100);
        }
        return $this->fixedAmount ?? 0.0;
    }

    public function calculateEmployeeCost(float $grossPay): float
    {
        if ($this->isPercentageBased) {
            return $grossPay * ($this->employeeRate / 100);
        }
        return $this->fixedAmount ?? 0.0;
    }

    public function calculateTotalCost(float $grossPay): float
    {
        return $this->calculateEmployerCost($grossPay) + $this->calculateEmployeeCost($grossPay);
    }
}