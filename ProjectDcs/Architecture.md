# Architecture - ksf_HRM

## Technology Stack
- PHP 8.1+
- MySQL/MariaDB
- Uses ksfraser/Database for DB operations
- Uses ksfraser/ksf_ModulesDAO for data access

## Database Schema

### Table: hr_employees
```sql
- id (PK)
- contact_id (FK to contacts - nullable allows new without contact)
- employee_number VARCHAR(20) UNIQUE
- job_title VARCHAR(100)
- department VARCHAR(50)
- hire_date DATE
- termination_date DATE NULL
- status ENUM('active','on_leave','terminated','suspended')
- work_schedule VARCHAR(20)
- compensation_type ENUM('hourly','salary','contract')
- hourly_rate DECIMAL(10,2)
- salary DECIMAL(12,2)
- created_at, updated_at
```

### Table: hr_employee_bank_accounts
```sql
- id (PK)
- employee_id (FK)
- bank_name VARCHAR(100)
- transit_number VARCHAR(9)
- account_number VARCHAR(50)
- account_type ENUM('checking','savings')
- percentage DECIMAL(5,2)
- is_primary BOOLEAN
```

### Table: hr_employee_tax_info
```sql
- id (PK)
- employee_id (FK)
- td1_filed_date DATE
- federal_credits DECIMAL(10,2)
- provincial_credits DECIMAL(10,2)
- etp_insurable BOOLEAN
- cpp_exempt BOOLEAN
- tax_adjustments DECIMAL(10,2)
```

### Table: hr_emergency_contacts
```sql
- id (PK)
- employee_id (FK)
- name VARCHAR(100)
- relationship VARCHAR(50)
- phone VARCHAR(20)
- email VARCHAR(100)
- priority INT
```

### Table: hr_dependants
```sql
- id (PK)
- employee_id (FK)
- name VARCHAR(100)
- dob DATE
- relationship VARCHAR(50)
- benefits_eligible BOOLEAN
```

### Table: hr_certifications
```sql
- id (PK)
- employee_id (FK)
- certification_name VARCHAR(200)
- issue_date DATE
- expiry_date DATE NULL
- document_path VARCHAR(255)
- required BOOLEAN
```

## Module Structure
```
includes/
  class.Employee.php       - Employee CRUD
  class.EmployeeBank.php   - Banking
  class.EmployeeTax.php    - Tax info
  class.Dependants.php     - Family/dependants
  class.Certifications.php - Compliance
pages/
  employee.php             - Employee list/edit
  employee_new.php        - Create new
  employee_view.php       - View details
```

## Dependencies
- ksfraser/Database
- ksfraser/ksf_ModulesDAO
- ksf_Contacts (future - contact as employee)

## RBAC Integration

### Module Registration

ksf_HRM registers with ksfraser/rbac:
- record_types: 'employee'
- projections: 'public' (name, email, phone, department, job_title), 'full' (all fields including salary, bank info, tax info)
- allow_invite: false
- children: certification, emergency_contact, bank_account (child of employee)

### Entity Projections

| Entity | PUBLIC Fields | FULL Fields |
|--------|---------------|-------------|
| Employee | name, email, phone, department, job_title, hire_date, status | + salary, manager_id, team_id, termination_date |
| BankAccount | - | All fields (bank_name, account_number, etc.) |
| EmergencyContact | name, relationship, phone | All fields |
| Certification | name, issue_date, expiry_date | All fields including document_path |

### Access Model

- **HR Manager**: Full access to all employees, compensation, banking — requires PROJECTION_FULL grant
- **Department Manager**: View employees in their department (PROJECTION_PUBLIC), edit non-sensitive fields
- **Employee**: View own record (PROJECTION_FULL for self via {userId}_individual team), view own certifications
- **Payroll**: View compensation details (PROJECTION_COMPENSATION) for active employees only

### SQL Enforcement

All employee-fetching queries MUST JOIN against 0_rbac_record_access:
```sql
JOIN 0_rbac_record_access ra
  ON ra.record_id   = e.id
 AND ra.record_type = 'employee'
 AND ra.module      = 'hrm'
 AND ra.inactive    = 0
 AND ra.can_view    = 1
JOIN 0_rbac_team_members tm
 ON tm.team_id  = ra.team_id
 AND tm.user_id = :currentUserId
 AND tm.inactive = 0
```

### Persons Registry Integration

HRM employees link to the FA person registry (0_crm_persons/0_crm_contacts) for cross-module identity resolution (calendar invitees, viewable_by filter). ksf_FA_HRM seeds `0_crm_categories` with type='employee'.

### Soft Delete

Employee records use soft delete: `deleted = 1`, `deleted_by`, `deleted_at`. Hard delete is super-admin only.

### Audit

A permission grant on an employee record is written to the RBAC audit log. Sensitive operations (salary change, termination) should additionally emit PSR-14 events.
