<?php

declare(strict_types=1);

namespace Ksf\HRM\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksf\HRM\Entity\CompensationConfig;

class CompensationConfigTest extends TestCase
{
    public function testCanCreateConfig(): void
    {
        $config = new CompensationConfig();
        $this->assertInstanceOf(CompensationConfig::class, $config);
    }

    public function testDefaultHoursConfiguration(): void
    {
        $config = new CompensationConfig();
        $this->assertEquals(2080, $config->getYearHours());
        $this->assertEquals(173.33, $config->getMonthHours());
        $this->assertEquals(40, $config->getWeekHours());
        $this->assertEquals(8, $config->getDayHours());
    }

    public function testCanSetCustomHours(): void
    {
        $config = new CompensationConfig();
        $config->setWeekHours(37);
        $config->setDayHours(7);
        $this->assertEquals(37, $config->getWeekHours());
        $this->assertEquals(7, $config->getDayHours());
    }

    public function testOvertimeConfiguration(): void
    {
        $config = new CompensationConfig();
        $this->assertTrue($config->isOtEnabled());
        
        $config->setOtEnabled(false);
        $this->assertFalse($config->isOtEnabled());
    }

    public function testCanCalculateHoursFromConfig(): void
    {
        $config = new CompensationConfig();
        $config->setWeekHours(40);
        
        $this->assertEquals(2080, $config->calculateYearHours());
    }
}