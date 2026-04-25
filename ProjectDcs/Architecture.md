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
