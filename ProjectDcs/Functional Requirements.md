# Functional Requirements - ksf_HRM

## Feature 1: Employee Record Management

### FR-001: Create Employee
- User can create employee from existing contact or new
- Employee inherits all contact fields
- Additional employee-specific fields:
  - Employee ID (auto-generated or manual)
  - Job title
  - Department
  - Job category (hourly/salary/contract)
  - Hire date
  - Employment status
  - Work schedule

### FR-002: Employee Status Tracking
- Status values: Active, On Leave, Terminated, suspended
- Track status change history and reason codes

### FR-003: Employee as Contact
- Same person can be customer AND employee
- Contact type field supports: Customer, Supplier, Employee (bitmask)
- Switching types doesn't lose data

## Feature 2: Banking & Tax Information

### FR-010: Direct Deposit Records
- Bank name, transit number, account number
- Multiple accounts allowed (splits e.g., 80% savings, 20% checking)
- Account validation (checksum verification)

### FR-011: Tax Information
- T4 relevant fields
- Tax credits, deductions
- Previous year T4 summary
- TD1 declaration

## Feature 3: Emergency & Family

### FR-020: Emergency Contacts
- Name, relationship, phone, email
- Priority order (primary, secondary)

### FR-021: Family / Dependants
- Name, DOB, relationship
- Benefits eligible (yes/no)
- Coverage elections

## Feature 4: Compliance

### FR-030: Certifications
- Certification name
- Issue date, expiry date
- Renewal reminders
- Upload certificate image/PDF

### FR-031: Training Records
- Training course name
- Date completed
- Certificate issued
- Required vs optional

## Feature 5: Integration

### FR-040: Link to Projects
- Employee can be assigned to projects
- Track project-specific rates

### FR-041: Link to Calendar
- Calendar events for employee (training, reviews)
- Time entries appear on timesheet
