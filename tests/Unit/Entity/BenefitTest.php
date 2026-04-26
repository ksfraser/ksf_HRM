<?php

declare(strict_types=1);

namespace Ksf\HRM\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksf\HRM\Entity\Benefit;

class BenefitTest extends TestCase
{
    public function testCanCreateBenefit(): void
    {
        $benefit = new Benefit();
        $this->assertInstanceOf(Benefit::class, $benefit);
    }

    public function testCanSetAndGetId(): void
    {
        $benefit = new Benefit();
        $benefit->setId(1);
        $this->assertEquals(1, $benefit->getId());
    }

    public function testCanSetAndGetName(): void
    {
        $benefit = new Benefit();
        $benefit->setName('Pension');
        $this->assertEquals('Pension', $benefit->getName());
    }

    public function testCanSetAndGetCode(): void
    {
        $benefit = new Benefit();
        $benefit->setCode('PEN');
        $this->assertEquals('PEN', $benefit->getCode());
    }

    public function testCanSetAndGetType(): void
    {
        $benefit = new Benefit();
        $benefit->setType(Benefit::TYPE_PENSION);
        $this->assertEquals(Benefit::TYPE_PENSION, $benefit->getType());
    }

    public function testCanSetEmployerAndEmployeeRates(): void
    {
        $benefit = new Benefit();
        $benefit->setEmployerRate(5.0);
        $benefit->setEmployeeRate(3.0);
        $this->assertEquals(5.0, $benefit->getEmployerRate());
        $this->assertEquals(3.0, $benefit->getEmployeeRate());
    }

    public function testCanSetFixedAmount(): void
    {
        $benefit = new Benefit();
        $benefit->setFixedAmount(50.00);
        $this->assertEquals(50.00, $benefit->getFixedAmount());
    }

    public function testCanCheckIsActive(): void
    {
        $benefit = new Benefit();
        $benefit->setActive(true);
        $this->assertTrue($benefit->isActive());
        
        $benefit->setActive(false);
        $this->assertFalse($benefit->isActive());
    }

    public function testIsPercentageBasedDefaultsToTrue(): void
    {
        $benefit = new Benefit();
        $this->assertTrue($benefit->isPercentageBased());
    }
}