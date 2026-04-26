<?php

declare(strict_types=1);

namespace Ksf\HRM\Api\Soap;

use Ksf\HRM\Repository\EmployeeRepository;
use Ksf\HRM\Entity\Employee;

class EmployeeSoapService
{
    private EmployeeRepository $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getEmployee(int $id): ?array
    {
        $employee = $this->repository->findById($id);
        
        if (!$employee) {
            return null;
        }

        return $this->toArray($employee);
    }

    public function getEmployeeByEmail(string $email): ?array
    {
        $employee = $this->repository->findByEmail($email);
        
        if (!$employee) {
            return null;
        }

        return $this->toArray($employee);
    }

    public function getEmployeeByNumber(string $employeeNumber): ?array
    {
        $employee = $this->repository->findByEmployeeNumber($employeeNumber);
        
        if (!$employee) {
            return null;
        }

        return $this->toArray($employee);
    }

    public function listEmployees(?string $status = null): array
    {
        $filters = [];
        if ($status) {
            $filters['status'] = $status;
        }

        $employees = $this->repository->findAll($filters);

        return array_map([$this, 'toArray'], $employees);
    }

    public function createEmployee(array $data): array
    {
        $employee = new Employee();
        $employee->setEmployeeNumber($data['employee_number'] ?? null);
        $employee->setFirstName($data['first_name'] ?? '');
        $employee->setLastName($data['last_name'] ?? '');
        $employee->setEmail($data['email'] ?? null);
        $employee->setPhone($data['phone'] ?? null);
        $employee->setDepartment($data['department'] ?? null);
        $employee->setJobTitle($data['job_title'] ?? null);
        $employee->setStatus($data['status'] ?? Employee::STATUS_ACTIVE);

        if (isset($data['hire_date'])) {
            $employee->setHireDate(new \DateTime($data['hire_date']));
        }

        $saved = $this->repository->save($employee);

        return $this->toArray($saved);
    }

    public function updateEmployee(int $id, array $data): ?array
    {
        $employee = $this->repository->findById($id);

        if (!$employee) {
            return null;
        }

        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            if (method_exists($employee, $method)) {
                $employee->$method($value);
            }
        }

        $this->repository->save($employee);

        return $this->toArray($employee);
    }

    public function deleteEmployee(int $id): bool
    {
        return $this->repository->delete($id);
    }

    private function toArray(Employee $employee): array
    {
        return [
            'id' => $employee->getId(),
            'employee_number' => $employee->getEmployeeNumber(),
            'first_name' => $employee->getFirstName(),
            'last_name' => $employee->getLastName(),
            'full_name' => $employee->getFullName(),
            'email' => $employee->getEmail(),
            'phone' => $employee->getPhone(),
            'department' => $employee->getDepartment(),
            'job_title' => $employee->getJobTitle(),
            'status' => $employee->getStatus(),
            'is_active' => $employee->isActive(),
            'hire_date' => $employee->getHireDate()?->format('Y-m-d'),
            'termination_date' => $employee->getTerminationDate()?->format('Y-m-d'),
            'manager_id' => $employee->getManagerId(),
            'career_manager_id' => $employee->getCareerManagerId(),
            'operations_manager_id' => $employee->getOperationsManagerId(),
            'team_id' => $employee->getTeamId(),
        ];
    }
}