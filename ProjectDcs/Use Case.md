# Use Cases - ksf_HRM

## UC-001: Add New Employee
**Actor**: HR Manager

**Flow**:
1. Navigate to HR > Employees > New
2. Search existing contact OR create new
3. Enter employee information:
   - Employee number (auto-generate option)
   - Job title, department
   - Hire date, compensation
4. Save employee
5. Add banking information
6. Complete tax setup

**Alternate Flow**:
- Link to existing contact creates employee relationship

## UC-002: Update Employee Status
**Actor**: HR Manager

**Flow**:
1. Search/find employee
2. Edit status (active → terminated)
3. Enter termination date and reason
4. Status history automatically recorded

## UC-003: Record Certification
**Actor**: HR Manager, Employee

**Flow**:
1. Navigate to employee certifications
2. Add new certification:
   - Name, dates, document
   - Optional: mark as required
3. System sends reminder before expiry

## UC-004: Employee Timesheet Integration
**Actor**: System

**Flow**:
1. Timesheet references employee_id
2. Employee rate pulled from HR record
3. Time activity coded, multiplied by rate
4. Liability entry generated for payroll

## UC-005: Benefits Enrollment
**Actor**: HR Manager, Employee

**Flow**:
1. Annual enrollment period opens
2. Employee adds dependants
3. Employee selects coverage elections
4. HR approves and records

## UC-006: Emergency Contact Update
**Actor**: Employee, HR

**Flow**:
1. Employee updates emergency contact via self-service
2. Or HR updates in employee record
3. Changes logged for audit
