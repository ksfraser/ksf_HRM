<?php

declare(strict_types=1);

namespace Ksfraser\HRM\Entity;

class Grade
{
    private ?int $id = null;
    private string $code = '';
    private string $name = '';
    private float $minSalary = 0.0;
    private float $maxSalary = 0.0;
    private ?float $minHourly = null;
    private ?float $maxHourly = null;
    private ?string $description = null;
    private bool $active = true;
    private ?string $level = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getMinSalary(): float
    {
        return $this->minSalary;
    }

    public function setMinSalary(float $minSalary): self
    {
        $this->minSalary = $minSalary;
        return $this;
    }

    public function getMaxSalary(): float
    {
        return $this->maxSalary;
    }

    public function setMaxSalary(float $maxSalary): self
    {
        $this->maxSalary = $maxSalary;
        return $this;
    }

    public function getMidpoint(): float
    {
        return ($this->minSalary + $this->maxSalary) / 2;
    }

    public function getMinHourly(): ?float
    {
        return $this->minHourly;
    }

    public function setMinHourly(?float $minHourly): self
    {
        $this->minHourly = $minHourly;
        return $this;
    }

    public function getMaxHourly(): ?float
    {
        return $this->maxHourly;
    }

    public function setMaxHourly(?float $maxHourly): self
    {
        $this->maxHourly = $maxHourly;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
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

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(?string $level): self
    {
        $this->level = $level;
        return $this;
    }

    public function calculateSalaryFromPercent(float $percent): float
    {
        return $this->getMidpoint() * ($percent / 100);
    }

    public function getSalaryAtPercent(float $percent): float
    {
        $range = $this->maxSalary - $this->minSalary;
        return $this->minSalary + ($range * ($percent / 100));
    }
}