<?php

declare(strict_types=1);

namespace Ksfraser\HRM\Entity;

class Employee
{
    public const STATUS_ACTIVE = 'Active';
    public const STATUS_INACTIVE = 'Inactive';
    public const STATUS_TERMINATED = 'Terminated';
    public const STATUS_SUSPENDED = 'Suspended';

    private ?int $id = null;
    private ?string $employeeNumber = null;
    private string $firstName = '';
    private string $lastName = '';
    private ?string $email = null;
    private ?string $phone = null;
    private ?string $department = null;
    private ?string $jobTitle = null;
    private ?string $status = self::STATUS_ACTIVE;
    private ?\DateTime $hireDate = null;
    private ?\DateTime $terminationDate = null;
    private ?int $managerId = null;
    private ?int $careerManagerId = null;
    private ?int $operationsManagerId = null;
    private ?int $teamId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getEmployeeNumber(): ?string
    {
        return $this->employeeNumber;
    }

    public function setEmployeeNumber(?string $employeeNumber): self
    {
        $this->employeeNumber = $employeeNumber;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getFullName(): string
    {
        return trim($this->firstName . ' ' . $this->lastName);
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): self
    {
        $this->department = $department;
        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(?string $jobTitle): self
    {
        $this->jobTitle = $jobTitle;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function getHireDate(): ?\DateTime
    {
        return $this->hireDate;
    }

    public function setHireDate(?\DateTime $hireDate): self
    {
        $this->hireDate = $hireDate;
        return $this;
    }

    public function getTerminationDate(): ?\DateTime
    {
        return $this->terminationDate;
    }

    public function setTerminationDate(?\DateTime $terminationDate): self
    {
        $this->terminationDate = $terminationDate;
        return $this;
    }

    public function getManagerId(): ?int
    {
        return $this->managerId;
    }

    public function setManagerId(?int $managerId): self
    {
        $this->managerId = $managerId;
        return $this;
    }

    public function getCareerManagerId(): ?int
    {
        return $this->careerManagerId;
    }

    public function setCareerManagerId(?int $careerManagerId): self
    {
        $this->careerManagerId = $careerManagerId;
        return $this;
    }

    public function getOperationsManagerId(): ?int
    {
        return $this->operationsManagerId;
    }

    public function setOperationsManagerId(?int $operationsManagerId): self
    {
        $this->operationsManagerId = $operationsManagerId;
        return $this;
    }

    public function getTeamId(): ?int
    {
        return $this->teamId;
    }

    public function setTeamId(?int $teamId): self
    {
        $this->teamId = $teamId;
        return $this;
    }
}