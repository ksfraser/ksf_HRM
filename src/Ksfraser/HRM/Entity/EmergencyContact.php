<?php

declare(strict_types=1);

namespace Ksfraser\HRM\Entity;

class EmergencyContact
{
    public const RELATIONSHIP_SPONSE = 'Spouse';
    public const RELATIONSHIP_PARENT = 'Parent';
    public const RELATIONSHIP_SIBLING = 'Sibling';
    public const RELATIONSHIP_CHILD = 'Child';
    public const RELATIONSHIP_FRIEND = 'Friend';
    public const RELATIONSHIP_OTHER = 'Other';

    /** @var int|null */
    private $id = null;
    /** @var int */
    private $employeeId = 0;
    /** @var string */
    private $name = '';
    /** @var string */
    private $relationship = '';
    /** @var string|null */
    private $phone = null;
    /** @var string|null */
    private $alternatePhone = null;
    /** @var string|null */
    private $email = null;
    /** @var string */
    private $address = '';
    /** @var bool */
    private $isPrimary = false;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getEmployeeId(): int { return $this->employeeId; }
    public function setEmployeeId(int $employeeId): self { $this->employeeId = $employeeId; return $this; }
    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function getRelationship(): string { return $this->relationship; }
    public function setRelationship(string $relationship): self { $this->relationship = $relationship; return $this; }
    public function getPhone(): ?string { return $this->phone; }
    public function setPhone(?string $phone): self { $this->phone = $phone; return $this; }
    public function getAlternatePhone(): ?string { return $this->alternatePhone; }
    public function setAlternatePhone(?string $alternatePhone): self { $this->alternatePhone = $alternatePhone; return $this; }
    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): self { $this->email = $email; return $this; }
    public function getAddress(): string { return $this->address; }
    public function setAddress(string $address): self { $this->address = $address; return $this; }
    public function isPrimary(): bool { return $this->isPrimary; }
    public function setIsPrimary(bool $isPrimary): self { $this->isPrimary = $isPrimary; return $this; }
}