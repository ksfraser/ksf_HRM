# Functional Requirements - ksf_HRM

## Document Information
- **Module**: ksf_HRM
- **Version**: 1.0.0
- **Date**: 2026-05-11
- **Status**: Proposed
- **Author**: KSFII Development Team

## 1. Overview

### 1.1 Purpose
ksf_HRM provides employee record management extending contact capabilities with HR-specific fields.

### 1.2 Scope
- Employee records linked to contacts
- Banking and tax information
- Emergency contacts and dependents
- Compensation tracking
- Certifications and training

## 2. Core Entities

### 2.1 Employee

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| id | string | Yes | UUID |
| employee_number | string | Yes | Unique employee ID |
| contact_id | string | No | FK to Contact |
| user_id | string | No | FK to FA User |
| job_title | string | Yes | Position title |
| department | string | Yes | Department name |
| employment_type | string | Yes | full_time/part_time/contract |
| hire_date | Date | Yes | Start date |
| termination_date | Date | No | End date |
| status | string | Yes | active/on_leave/terminated |
| manager_id | string | No | FK to Employee |
| team_id | string | No | FK to Team |
| created_at | DateTime | Yes | Auto |
| updated_at | DateTime | Yes | Auto |

### 2.2 Compensation

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| id | string | Yes | UUID |
| employee_id | string | Yes | FK to Employee |
| grade_id | string | No | FK to SalaryGrade |
| annual_salary | float | No | Annual salary |
| hourly_rate | float | No | Hourly rate |
| effective_date | Date | Yes | Start of compensation |
| end_date | Date | No | End of compensation |
| created_at | DateTime | Yes | Auto |

### 2.3 BankAccount

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| id | string | Yes | UUID |
| employee_id | string | Yes | FK to Employee |
| bank_name | string | Yes | Bank name |
| transit_number | string | Yes | Transit/routing |
| account_number | string | Yes | Account number |
| account_type | string | Yes | checking/savings |
| allocation_percent | float | Yes | For split deposits |
| is_primary | bool | Yes | Default false |

### 2.4 EmergencyContact

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| id | string | Yes | UUID |
| employee_id | string | Yes | FK to Employee |
| name | string | Yes | Contact name |
| relationship | string | Yes | Relationship |
| phone | string | Yes | Phone number |
| email | string | No | Email address |
| is_primary | bool | Yes | Default false |

### 2.5 Certification

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| id | string | Yes | UUID |
| employee_id | string | Yes | FK to Employee |
| name | string | Yes | Certification name |
| issuer | string | No | Issuing organization |
| issue_date | Date | No | Date issued |
| expiry_date | Date | No | Expiration date |
| document | string | No | File path |
| is_required | bool | Yes | Default false |

## 3. Functional Requirements

### FR-HRM-001: Employee CRUD
**Requirement**: System shall create and manage employee records.

**Features**:
- Create employee (new or from existing contact)
- Edit employee details
- Change employment status
- Terminate employee with date/reason
- Employee status history

### FR-HRM-002: Compensation Management
**Requirement**: System shall track employee compensation.

**Features**:
- Store salary and hourly rates
- Salary grades with min/max
- Effective dates for changes
- History of compensation changes
- Validation against grade ranges

### FR-HRM-003: Bank Account Management
**Requirement**: System shall manage direct deposit information.

**Features**:
- Add/edit bank accounts
- Multiple accounts with split percentages
- Transit number validation
- Link to FA bank accounts

### FR-HRM-004: Emergency Contacts
**Requirement**: System shall track emergency contacts.

**Features**:
- Multiple contacts per employee
- Priority order
- Contact details (phone, email)

### FR-HRM-005: Certification Tracking
**Requirement**: System shall track employee certifications.

**Features**:
- Record certifications with dates
- Track expiration
- Send reminders before expiry
- Upload certificate documents
- Mark required vs optional

### FR-HRM-006: Organizational Structure
**Requirement**: System shall support organizational hierarchy.

**Features**:
- Manager relationships
- Team assignments
- Department structure
- Integration with ksf_OrgChart

## 4. Integration Events (PSR-14)

| Event | Trigger |
|-------|---------|
| `employee.created` | New employee |
| `employee.updated` | Employee updated |
| `employee.terminated` | Employment ended |
| `compensation.changed` | Salary change |

## 5. Composer Dependencies

| Package | Version | Purpose |
|---------|---------|---------|
| ksfraser/exceptions | ^1.3 | Exception hierarchy (when available) |
| psr/event-dispatcher | ^2.0 | PSR-14 events |

---

*Document Version: 1.1.0*
*Last Updated: 2026-05-11*