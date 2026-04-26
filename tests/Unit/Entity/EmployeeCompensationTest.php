<?php

declare(strict_types=1);

namespace Ksf\HRM\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksf\HRM\Entity\EmployeeCompensation;

class EmployeeCompensationTest extends TestCase
{
    public function testCanCreateEmployeeCompensation(): void
    {
        $comp = new EmployeeCompensation();
        $this->assertInstanceOf(EmployeeCompensation::class, $comp);
    }

    public function testCanSetAndGetEmployeeId(): void
    {
        $comp = new EmployeeCompensation();
        $comp->setEmployeeId(1);
        $this->assertEquals(1, $comp->getEmployeeId());
    }

    public function testCanSetAndGetGradeId(): void
    {
        $comp = new EmployeeCompensation();
        $comp->setGradeId(5);
        $this->assertEquals(5, $comp->getGradeId());
    }

    public function testCanSetAndGetPercentOfGrade(): void
    {
        $comp = new EmployeeCompensation();
        $comp->setPercentOfGrade(95.0);
        $this->assertEquals(95.0, $comp->getPercentOfGrade());
    }

    public function testCanSetAndGetAnnualSalary(): void
    {
        $comp = new EmployeeCompensation();
        $comp->setAnnualSalary(65000.00);
        $this->assertEquals(65000.00, $comp->getAnnualSalary());
    }

    public function testCanSetAndGetHourlyRate(): void
    {
        $comp = new EmployeeCompensation();
        $comp->setHourlyRate(25.00);
        $this->assertEquals(25.00, $comp->getHourlyRate());
    }

    public function testCanSetEmployeeType(): void
    {
        $comp = new EmployeeCompensation();
        $comp->setEmployeeType(EmployeeCompensation::TYPE_SALARY);
        $this->assertEquals(EmployeeCompensation::TYPE_SALARY, $comp->getEmployeeType());
        
        $comp->setEmployeeType(EmployeeCompensation::TYPE_HOURLY);
        $this->assertEquals(EmployeeCompensation::TYPE_HOURLY, $comp->getEmployeeType());
    }

    public function testCanCalculateMonthlySalary(): void
    {
        $comp = new EmployeeCompensation();
        $comp->setAnnualSalary(60000.00);
        $this->assertEquals(5000.00, $comp->getMonthlySalary());
    }

    public function testCanCalculateBiweeklySalary(): void
    {
        $comp = new EmployeeCompensation();
        $comp->setAnnualSalary(62400.00);
        $this->assertEquals(2400.00, $comp->getBiweeklySalary());
    }

    public function testIsOvertimeEligibleForHourly(): void
    {
        $comp = new EmployeeCompensation();
        $comp->setEmployeeType(EmployeeCompensation::TYPE_HOURLY);
        $comp->setOtEligible(true);
        $this->assertTrue($comp->isOvertimeEligible());
        
        $comp->setOtEligible(false);
        $this->assertFalse($comp->isOvertimeEligible());
    }
}