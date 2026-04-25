# Business Requirements - ksf_HRM

## Project Overview
ksf_HRM (Human Resource Management) provides employee records management extensible beyond traditional HRM systems.

## Problem Statement
- Employees need to be tracked as contacts (customer, supplier, employee - any combination)
- Banking/tax info needed to pay employees
- Must integrate with Project Management for time tracking
- Must tie into Calendar for events

## Stakeholders
- HR Department
- Managers
- Employees
- Payroll
- Finance

## Scope

### In Scope
1. Employee record as extension of Contact
   - Can be customer, supplier, employee (any combination)
   - Banking information for payroll
   - Tax information (T4, etc.)
   - Emergency contacts
   - Family/dependants for benefits

2. Employment Details
   - Job title/position
   - Department
   - Start date
   - Employment status (active, terminated, leave)
   - Compensation (hourly, salary, contract)

3. Compliance
   - Required certifications
   - Training records
   - Document storage

4. Benefits Enrollment
   - Family members
   - Dependant coverage
   - Benefits elections

### Out of Scope
- Payroll processing (external system)
- Time tracking (ksf_Timesheets)
- Leave management (ksf_Leave)

## Success Metrics
- Single employee record that can serve as contact
- Bank/tax info accessible for payroll export
- Benefits records maintained

## Timeline
Phase 1: Employee records with contacts integration
Phase 2: Banking/tax info
Phase 3: Benefits tracking
