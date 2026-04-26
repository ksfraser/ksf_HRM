<?php

declare(strict_types=1);

namespace Ksf\HRM\Entity;

class CompensationConfig
{
    private int $yearHours = 2080;
    private float $monthHours = 173.33;
    private int $weekHours = 40;
    private int $dayHours = 8;
    private bool $otEnabled = true;
    private string $otRule = 'daily';
    private float $otMultiplier = 1.5;
    private bool $otBankEnabled = false;
    private float $otBankMultiplier = 1.0;
    private string $workWeekStart = 'Monday';
    private string $workWeekEnd = 'Friday';

    public function getYearHours(): int
    {
        return $this->yearHours;
    }

    public function setYearHours(int $yearHours): self
    {
        $this->yearHours = $yearHours;
        return $this;
    }

    public function getMonthHours(): float
    {
        return $this->monthHours;
    }

    public function setMonthHours(float $monthHours): self
    {
        $this->monthHours = $monthHours;
        return $this;
    }

    public function getWeekHours(): int
    {
        return $this->weekHours;
    }

public function setWeekHours(int|float $weekHours): self
    {
        $this->weekHours = (int)$weekHours;
        $this->yearHours = $this->weekHours * 52;
        $this->monthHours = ($this->weekHours * 52) / 12;
        return $this;
    }

    public function setDayHours(int|float $dayHours): self
    {
        $this->dayHours = (int)$dayHours;
        return $this;
    }

    public function getDayHours(): int
    {
        return $this->dayHours;
    }

    public function isOtEnabled(): bool
    {
        return $this->otEnabled;
    }

    public function setOtEnabled(bool $otEnabled): self
    {
        $this->otEnabled = $otEnabled;
        return $this;
    }

    public function getOtRule(): string
    {
        return $this->otRule;
    }

    public function setOtRule(string $otRule): self
    {
        $this->otRule = $otRule;
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

    public function isOtBankEnabled(): bool
    {
        return $this->otBankEnabled;
    }

    public function setOtBankEnabled(bool $otBankEnabled): self
    {
        $this->otBankEnabled = $otBankEnabled;
        return $this;
    }

    public function getOtBankMultiplier(): float
    {
        return $this->otBankMultiplier;
    }

    public function setOtBankMultiplier(float $otBankMultiplier): self
    {
        $this->otBankMultiplier = $otBankMultiplier;
        return $this;
    }

    public function getWorkWeekStart(): string
    {
        return $this->workWeekStart;
    }

    public function setWorkWeekStart(string $workWeekStart): self
    {
        $this->workWeekStart = $workWeekStart;
        return $this;
    }

    public function getWorkWeekEnd(): string
    {
        return $this->workWeekEnd;
    }

    public function setWorkWeekEnd(string $workWeekEnd): self
    {
        $this->workWeekEnd = $workWeekEnd;
        return $this;
    }

    public function calculateYearHours(): int
    {
        return $this->weekHours * 52;
    }

    public function calculateMonthHours(): float
    {
        return ($this->weekHours * 52) / 12;
    }

    public function isOvertime(float $dailyHours, float $weeklyHours): bool
    {
        if ($this->otRule === 'daily' && $dailyHours > $this->dayHours) {
            return true;
        }
        if ($this->otRule === 'weekly' && $weeklyHours > $this->weekHours) {
            return true;
        }
        if ($this->otRule === 'both' && ($dailyHours > $this->dayHours || $weeklyHours > $this->weekHours)) {
            return true;
        }
        return false;
    }

    public function calculateOvertimeHours(float $dailyHours, float $weeklyHours): float
    {
        $otHours = 0.0;

        if ($this->otRule === 'daily' || $this->otRule === 'both') {
            $otHours += max(0, $dailyHours - $this->dayHours);
        }
        if ($this->otRule === 'weekly' || $this->otRule === 'both') {
            $otHours += max(0, $weeklyHours - $this->weekHours);
        }

        return $otHours;
    }
}