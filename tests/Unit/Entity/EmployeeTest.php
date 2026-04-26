<?php

declare(strict_types=1);

namespace Ksf\HRM\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksf\HRM\Entity\Employee;

class EmployeeTest extends TestCase
{
    private Employee $employee;

    protected function setUp(): void
    {
        $this->employee = new Employee();
    }

    public function testCanCreateEmployee(): void
    {
        $this->assertInstanceOf(Employee::class, $this->employee);
    }

    public function testCanSetAndGetId(): void
    {
        $this->employee->setId(1);
        $this->assertEquals(1, $this->employee->getId());
    }

    public function testCanSetAndGetEmployeeNumber(): void
    {
        $this->employee->setEmployeeNumber('EMP001');
        $this->assertEquals('EMP001', $this->employee->getEmployeeNumber());
    }

    public function testCanSetAndGetFirstName(): void
    {
        $this->employee->setFirstName('John');
        $this->assertEquals('John', $this->employee->getFirstName());
    }

    public function testCanSetAndGetLastName(): void
    {
        $this->employee->setLastName('Doe');
        $this->assertEquals('Doe', $this->employee->getLastName());
    }

    public function testCanSetAndGetEmail(): void
    {
        $this->employee->setEmail('john.doe@example.com');
        $this->assertEquals('john.doe@example.com', $this->employee->getEmail());
    }

    public function testCanSetAndGetStatus(): void
    {
        $this->employee->setStatus(Employee::STATUS_ACTIVE);
        $this->assertEquals(Employee::STATUS_ACTIVE, $this->employee->getStatus());
    }

    public function testCanSetAndGetHireDate(): void
    {
        $hireDate = new \DateTime('2024-01-15');
        $this->employee->setHireDate($hireDate);
        $this->assertEquals($hireDate, $this->employee->getHireDate());
    }

    public function testCanCheckIsActive(): void
    {
        $this->employee->setStatus(Employee::STATUS_ACTIVE);
        $this->assertTrue($this->employee->isActive());

        $this->employee->setStatus(Employee::STATUS_TERMINATED);
        $this->assertFalse($this->employee->isActive());
    }

    public function testCanSetAndGetDepartment(): void
    {
        $this->employee->setDepartment('Engineering');
        $this->assertEquals('Engineering', $this->employee->getDepartment());
    }

    public function testCanSetAndGetJobTitle(): void
    {
        $this->employee->setJobTitle('Software Developer');
        $this->assertEquals('Software Developer', $this->employee->getJobTitle());
    }

    public function testFullNameCombinesFirstAndLast(): void
    {
        $this->employee->setFirstName('John');
        $this->employee->setLastName('Doe');
        $this->assertEquals('John Doe', $this->employee->getFullName());
    }
}