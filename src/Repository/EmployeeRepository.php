<?php

declare(strict_types=1);

namespace Ksf\HRM\Repository;

use Ksf\HRM\Entity\Employee;
use Ksfraser\Database\DbManager;

class EmployeeRepository
{
    private string $table = 'ksf_hrm_employees';

    public function findById(int $id): ?Employee
    {
        $row = DbManager::fetchOne(
            "SELECT * FROM {$this->table} WHERE id = ?",
            [$id]
        );

        if (!$row) {
            return null;
        }

        return $this->hydrateFromRow($row);
    }

    public function findByEmail(string $email): ?Employee
    {
        $row = DbManager::fetchOne(
            "SELECT * FROM {$this->table} WHERE email = ?",
            [$email]
        );

        if (!$row) {
            return null;
        }

        return $this->hydrateFromRow($row);
    }

    public function findByEmployeeNumber(string $employeeNumber): ?Employee
    {
        $row = DbManager::fetchOne(
            "SELECT * FROM {$this->table} WHERE employee_number = ?",
            [$employeeNumber]
        );

        if (!$row) {
            return null;
        }

        return $this->hydrateFromRow($row);
    }

    public function findAll(array $filters = []): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];

        if (isset($filters['status'])) {
            $sql .= " AND status = ?";
            $params[] = $filters['status'];
        }

        if (isset($filters['department'])) {
            $sql .= " AND department = ?";
            $params[] = $filters['department'];
        }

        if (isset($filters['manager_id'])) {
            $sql .= " AND manager_id = ?";
            $params[] = $filters['manager_id'];
        }

        $sql .= " ORDER BY last_name, first_name";

        $rows = DbManager::fetchAll($sql, $params);

        return array_map([$this, 'hydrateFromRow'], $rows);
    }

    public function findActive(): array
    {
        return $this->findAll(['status' => Employee::STATUS_ACTIVE]);
    }

    public function save(Employee $employee): Employee
    {
        if ($employee->getId() === null) {
            return $this->insert($employee);
        }

        return $this->update($employee);
    }

    private function insert(Employee $employee): Employee
    {
        $sql = "INSERT INTO {$this->table} (
            employee_number, first_name, last_name, email, phone,
            department, job_title, status, hire_date, termination_date,
            manager_id, career_manager_id, operations_manager_id, team_id,
            created_at, updated_at
        ) VALUES (
            :employee_number, :first_name, :last_name, :email, :phone,
            :department, :job_title, :status, :hire_date, :termination_date,
            :manager_id, :career_manager_id, :operations_manager_id, :team_id,
            NOW(), NOW()
        )";

        $params = $this->extractParams($employee);

        DbManager::execute($sql, $params);

        $employee->setId((int)DbManager::fetchValue("SELECT LAST_INSERT_ID()"));

        return $employee;
    }

    private function update(Employee $employee): Employee
    {
        $sql = "UPDATE {$this->table} SET
            employee_number = :employee_number,
            first_name = :first_name,
            last_name = :last_name,
            email = :email,
            phone = :phone,
            department = :department,
            job_title = :job_title,
            status = :status,
            hire_date = :hire_date,
            termination_date = :termination_date,
            manager_id = :manager_id,
            career_manager_id = :career_manager_id,
            operations_manager_id = :operations_manager_id,
            team_id = :team_id,
            updated_at = NOW()
        WHERE id = :id";

        $params = $this->extractParams($employee);
        $params['id'] = $employee->getId();

        DbManager::execute($sql, $params);

        return $employee;
    }

    public function delete(int $id): bool
    {
        return DbManager::execute(
            "DELETE FROM {$this->table} WHERE id = ?",
            [$id]
        ) > 0;
    }

    private function hydrateFromRow(array $row): Employee
    {
        $employee = new Employee();
        $employee->setId((int)$row['id']);
        $employee->setEmployeeNumber($row['employee_number'] ?? null);
        $employee->setFirstName($row['first_name']);
        $employee->setLastName($row['last_name']);
        $employee->setEmail($row['email'] ?? null);
        $employee->setPhone($row['phone'] ?? null);
        $employee->setDepartment($row['department'] ?? null);
        $employee->setJobTitle($row['job_title'] ?? null);
        $employee->setStatus($row['status'] ?? Employee::STATUS_ACTIVE);

        if (!empty($row['hire_date'])) {
            $employee->setHireDate(new \DateTime($row['hire_date']));
        }

        if (!empty($row['termination_date'])) {
            $employee->setTerminationDate(new \DateTime($row['termination_date']));
        }

        $employee->setManagerId($row['manager_id'] ? (int)$row['manager_id'] : null);
        $employee->setCareerManagerId($row['career_manager_id'] ? (int)$row['career_manager_id'] : null);
        $employee->setOperationsManagerId($row['operations_manager_id'] ? (int)$row['operations_manager_id'] : null);
        $employee->setTeamId($row['team_id'] ? (int)$row['team_id'] : null);

        return $employee;
    }

    private function extractParams(Employee $employee): array
    {
        return [
            'employee_number' => $employee->getEmployeeNumber(),
            'first_name' => $employee->getFirstName(),
            'last_name' => $employee->getLastName(),
            'email' => $employee->getEmail(),
            'phone' => $employee->getPhone(),
            'department' => $employee->getDepartment(),
            'job_title' => $employee->getJobTitle(),
            'status' => $employee->getStatus(),
            'hire_date' => $employee->getHireDate()?->format('Y-m-d'),
            'termination_date' => $employee->getTerminationDate()?->format('Y-m-d'),
            'manager_id' => $employee->getManagerId(),
            'career_manager_id' => $employee->getCareerManagerId(),
            'operations_manager_id' => $employee->getOperationsManagerId(),
            'team_id' => $employee->getTeamId(),
        ];
    }
}