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

---

## UC-007: Employee Onboarding to OrgChart
**Actor**: HR Manager, System

**Trigger**: New employee added (or from ksf_Onboarding)

**Flow**:
1. Employee record created in ksf_HRM
2. System automatically:
   - Add to ksf_OrgChart under manager
   - Create calendar entry for first day
   - Set up email account (via ksf_EmailManager)
   - Add to relevant teams (ksf_Teams)
3. HR assigns onboarding tasks (ksf_Onboarding)
4. Employee appears in org chart with role

---

## UC-008: Training Completion Tracking
**Actor**: HR Manager, Manager, Employee

**Trigger**: Training session completed (ksf_Training)

**Flow**:
1. Manager assigns training course to employee
2. Employee completes training (ksf_Training)
3. System emits `training.completed` event
4. ksf_HRM updates employee record:
   - Training history updated
   - Certification recorded if applicable
   - Next training due date set
5. Manager sees training compliance status
6. If certification expiring soon → reminder sent

---

## UC-009: Performance Review Initiation
**Actor**: HR Manager, Manager

**Trigger**: Annual review period or manual initiation

**Flow**:
1. HR initiates review cycle in ksf_Performance
2. System pulls employee data from ksf_HRM:
   - Current position, tenure
   - Training history
   - Previous reviews
   - Goals from last period
3. Managers assigned to direct reports
4. Self-review requested from employees
5. 360 feedback collected (ksf_Workflow)
6. HR aggregates and schedules review meetings
7. Review completed → goals updated for next period

---

## UC-010: Leave Balance Calculation
**Actor**: System, HR

**Trigger**: Leave request, annual reset, monthly accrual

**Flow**:
1. System queries ksf_Leave for employee leave records
2. Calculates:
   - Annual entitlement (from HR policy)
   - Used this year
   - Pending requests
   - Available balance
3. HR sees employee's leave balance
4. When leave taken:
   - ksf_Leave deducts from balance
   - ksf_Timesheets updates hours
   - ksf_Calendar marks employee as OOO

---

## UC-011: Employee Self-Service Profile Update
**Actor**: Employee

**Preconditions**: Employee has system login

**Flow**:
1. Employee logs into self-service portal
2. Can update:
   - Personal contact info
   - Emergency contacts
   - Bank account (requires verification)
   - Photo
3. Changes flagged for HR approval if sensitive fields
4. Approved changes update ksf_HRM record
5. Audit log records who changed what

---

## UC-012: Employee Separation/Offboarding
**Actor**: HR Manager, IT, Manager

**Trigger**: Termination request or resignation

**Flow**:
1. Manager initiates separation
2. HR reviews:
   - Outstanding leave balance
   - Expenses owed
   - Equipment assigned
   - Project assignments (ksf_ProjectManagement)
3. Workflow triggers (ksf_Workflow):
   - Manager approval
   - HR clearance
   - IT account deactivation
   - Facilities equipment return
4. System updates:
   - Employee status → 'Terminated'
   - Remove from org chart (ksf_OrgChart)
   - Archive from active lists
5. Final payroll processing (ksf_Timesheets)
6. Records retained per policy

*Document Version: 1.1.0*
*Last Updated: 2026-05-11*
