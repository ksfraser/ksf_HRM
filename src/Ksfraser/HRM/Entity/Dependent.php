<?php

declare(strict_types=1);

namespace Ksfraser\HRM\Entity;

class Dependent
{
    public const RELATIONSHIP_SPOUSE = 'Spouse';
    public const RELATIONSHIP_CHILD = 'Child';
    public const RELATIONSHIP_PARENT = 'Parent';
    public const RELATIONSHIP_OTHER = 'Other';

    /** @var int|null */
    private $id = null;
    /** @var int */
    private $employeeId = 0;
    /** @var string */
    private $firstName = '';
    /** @var string */
    private $lastName = '';
    /** @var string */
    private $relationship = '';
    /** @var string|null */
    private $dateOfBirth = null;
    /** @var string|null */
    private $sin = null;
    /** @var bool */
    private $taxCreditEligible = true;
    /** @var bool */
    private $insuranceEligible = false;
    /** @var string|null */
    private $effectiveDate = null;
    /** @var string|null */
    private $endDate = null;

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