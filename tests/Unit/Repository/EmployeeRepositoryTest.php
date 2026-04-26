<?php

declare(strict_types=1);

namespace Ksf\HRM\Tests\Unit\Repository;

use PHPUnit\Framework\TestCase;
use Ksf\HRM\Repository\EmployeeRepository;
use Ksf\HRM\Entity\Employee;

class EmployeeRepositoryTest extends TestCase
{
    public function testCanCreateRepository(): void
    {
        $repo = new EmployeeRepository();
        $this->assertInstanceOf(EmployeeRepository::class, $repo);
    }

    public function testRepositoryHasTableProperty(): void
    {
        $repo = new EmployeeRepository();
        $reflection = new \ReflectionClass($repo);
        $property = $reflection->getProperty('table');
        $property->setAccessible(true);
        
        $this->assertEquals('ksf_hrm_employees', $property->getValue($repo));
    }
}