<?php

declare(strict_types=1);

namespace Ksfraser\HRM\Entity;

class Dependent
{
    public const RELATIONSHIP_SPOUSE = 'Spouse';
    public const RELATIONSHIP_CHILD = 'Child';
    public const RELATIONSHIP_PARENT = 'Parent';
    public const RELATIONSHIP_OTHER = 'Other';

    private ?int $id = null;
    private int $employeeId = 0;
    private string $firstName = '';
    private string $lastName = '';
    private string $relationship = '';
    private ?string $dateOfBirth = null;
    private ?string $sin = null;
    private bool $taxCreditEligible = true;
    private bool $insuranceEligible = false;
    private ?string $effectiveDate = null;
    private ?string $endDate = null;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getEmployeeId(): int { return $this->employeeId; }
    public function setEmployeeId(int $employeeId): self { $this->employeeId = $employeeId; return $this; }
    public function getFirstName(): string { return $this->firstName; }
    public function setFirstName(string $firstName): self { $this->firstName = $firstName; return $this; }
    public function getLastName(): string { return $this->lastName; }
    public function setLastName(string $lastName): self { $this->lastName = $lastName; return $this; }
    public function getFullName(): string { return $this->firstName . ' ' . $this->lastName; }
    public function getRelationship(): string { return $this->relationship; }
    public function setRelationship(string $relationship): self { $this->relationship = $relationship; return $this; }
    public function getDateOfBirth(): ?string { return $this->dateOfBirth; }
    public function setDateOfBirth(?string $dateOfBirth): self { $this->dateOfBirth = $dateOfBirth; return $this; }
    public function getSin(): ?string { return $this->sin; }
    public function setSin(?string $sin): self { $this->sin = $sin; return $this; }
    public function isTaxCreditEligible(): bool { return $this->taxCreditEligible; }
    public function setTaxCreditEligible(bool $taxCreditEligible): self { $this->taxCreditEligible = $taxCreditEligible; return $this; }
    public function isInsuranceEligible(): bool { return $this->insuranceEligible; }
    public function setInsuranceEligible(bool $insuranceEligible): self { $this->insuranceEligible = $insuranceEligible; return $this; }
    public function getEffectiveDate(): ?string { return $this->effectiveDate; }
    public function setEffectiveDate(?string $effectiveDate): self { $this->effectiveDate = $effectiveDate; return $this; }
    public function getEndDate(): ?string { return $this->endDate; }
    public function setEndDate(?string $endDate): self { $this->endDate = $endDate; return $this; }
}