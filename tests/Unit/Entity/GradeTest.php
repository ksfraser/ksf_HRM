<?php

declare(strict_types=1);

namespace Ksfraser\HRM\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksfraser\HRM\Entity\Grade;

class GradeTest extends TestCase
{
    public function testCanCreateGrade(): void
    {
        $grade = new Grade();
        $this->assertInstanceOf(Grade::class, $grade);
    }

    public function testCanSetAndGetId(): void
    {
        $grade = new Grade();
        $grade->setId(1);
        $this->assertEquals(1, $grade->getId());
    }

    public function testCanSetAndGetCode(): void
    {
        $grade = new Grade();
        $grade->setCode('S1');
        $this->assertEquals('S1', $grade->getCode());
    }

    public function testCanSetAndGetName(): void
    {
        $grade = new Grade();
        $grade->setName('Step 1');
        $this->assertEquals('Step 1', $grade->getName());
    }

    public function testCanSetAndGetMinSalary(): void
    {
        $grade = new Grade();
        $grade->setMinSalary(50000.00);
        $this->assertEquals(50000.00, $grade->getMinSalary());
    }

    public function testCanSetAndGetMaxSalary(): void
    {
        $grade = new Grade();
        $grade->setMaxSalary(80000.00);
        $this->assertEquals(80000.00, $grade->getMaxSalary());
    }

    public function testCanCalculateMidpoint(): void
    {
        $grade = new Grade();
        $grade->setMinSalary(50000.00);
        $grade->setMaxSalary(80000.00);
        $this->assertEquals(65000.00, $grade->getMidpoint());
    }

    public function testCanSetAndGetHourlyRates(): void
    {
        $grade = new Grade();
        $grade->setMinHourly(24.04);
        $grade->setMaxHourly(38.46);
        $this->assertEquals(24.04, $grade->getMinHourly());
        $this->assertEquals(38.46, $grade->getMaxHourly());
    }
}