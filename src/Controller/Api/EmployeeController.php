<?php

declare(strict_types=1);

namespace Ksf\HRM\Controller\Api;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Ksf\HRM\Repository\EmployeeRepository;
use Ksf\HRM\Entity\Employee;

class EmployeeController
{
    private EmployeeRepository $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listEmployees(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = $request->getQueryParams();
        
        $filters = [];
        if (isset($params['status'])) {
            $filters['status'] = $params['status'];
        }
        if (isset($params['department'])) {
            $filters['department'] = $params['department'];
        }

        $employees = $this->repository->findAll($filters);

        $data = array_map(fn(Employee $e) => [
            'id' => $e->getId(),
            'employee_number' => $e->getEmployeeNumber(),
            'first_name' => $e->getFirstName(),
            'last_name' => $e->getLastName(),
            'email' => $e->getEmail(),
            'department' => $e->getDepartment(),
            'job_title' => $e->getJobTitle(),
            'status' => $e->getStatus(),
            'hire_date' => $e->getHireDate()?->format('Y-m-d'),
        ], $employees);

        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => $data,
            'total' => count($data),
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getEmployee(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = (int)$args['id'];
        $employee = $this->repository->findById($id);

        if (!$employee) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'error' => 'Employee not found',
            ]));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => [
                'id' => $employee->getId(),
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
            ],
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function createEmployee(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'error' => 'Invalid JSON',
            ]));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

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

        if (isset($data['manager_id'])) {
            $employee->setManagerId((int)$data['manager_id']);
        }

        if (isset($data['career_manager_id'])) {
            $employee->setCareerManagerId((int)$data['career_manager_id']);
        }

        if (isset($data['operations_manager_id'])) {
            $employee->setOperationsManagerId((int)$data['operations_manager_id']);
        }

        if (isset($data['team_id'])) {
            $employee->setTeamId((int)$data['team_id']);
        }

        $saved = $this->repository->save($employee);

        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => ['id' => $saved->getId()],
        ]));

        return $response->withStatus(201)->withHeader('Content-Type', 'application/json');
    }

    public function updateEmployee(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = (int)$args['id'];
        $employee = $this->repository->findById($id);

        if (!$employee) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'error' => 'Employee not found',
            ]));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $data = json_decode($request->getBody()->getContents(), true);

        if (isset($data['employee_number'])) {
            $employee->setEmployeeNumber($data['employee_number']);
        }
        if (isset($data['first_name'])) {
            $employee->setFirstName($data['first_name']);
        }
        if (isset($data['last_name'])) {
            $employee->setLastName($data['last_name']);
        }
        if (isset($data['email'])) {
            $employee->setEmail($data['email']);
        }
        if (isset($data['phone'])) {
            $employee->setPhone($data['phone']);
        }
        if (isset($data['department'])) {
            $employee->setDepartment($data['department']);
        }
        if (isset($data['job_title'])) {
            $employee->setJobTitle($data['job_title']);
        }
        if (isset($data['status'])) {
            $employee->setStatus($data['status']);
        }
        if (isset($data['hire_date'])) {
            $employee->setHireDate(new \DateTime($data['hire_date']));
        }
        if (isset($data['termination_date'])) {
            $employee->setTerminationDate(new \DateTime($data['termination_date']));
        }
        if (isset($data['manager_id'])) {
            $employee->setManagerId((int)$data['manager_id']);
        }
        if (isset($data['career_manager_id'])) {
            $employee->setCareerManagerId((int)$data['career_manager_id']);
        }
        if (isset($data['operations_manager_id'])) {
            $employee->setOperationsManagerId((int)$data['operations_manager_id']);
        }
        if (isset($data['team_id'])) {
            $employee->setTeamId((int)$data['team_id']);
        }

        $this->repository->save($employee);

        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => ['id' => $employee->getId()],
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function deleteEmployee(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = (int)$args['id'];
        
        if (!$this->repository->findById($id)) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'error' => 'Employee not found',
            ]));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $this->repository->delete($id);

        $response->getBody()->write(json_encode([
            'success' => true,
            'message' => 'Employee deleted',
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }
}