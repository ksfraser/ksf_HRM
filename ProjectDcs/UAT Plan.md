# UAT Plan - ksf_HRM

## Document Information
- **Module**: ksf_HRM
- **Version**: 1.0.0
- **Date**: 2026-05-11

## 1. UAT Overview

### 1.1 Purpose
Validate HRM functionality: employee management, compensation, banking, certifications.

### 1.2 Modules Integrated
- ksf_Leave
- ksf_Timesheets
- ksf_OrgChart
- ksf_Workflow

## 2. UAT Scenarios

### UAT-HRM-001: Create Employee
**Scenario**: HR creates new employee

**Steps**:
1. Navigate to HR > Employees > New
2. Enter employee details (name, number, job title, department)
3. Select hire date
4. Enter compensation
5. Save
6. Verify employee in list

**Expected Results**:
- [ ] Employee created
- [ ] Employee number auto-generated (if configured)
- [ ] Status = Active
- [ ] Org chart updated

**Status**: ☐ Pass  ☐ Fail  ☐ N/A

---

### UAT-HRM-002: Add Bank Account
**Scenario**: Employee enters direct deposit info

**Steps**:
1. Open employee record
2. Navigate to Banking
3. Add bank account
4. Enter bank name, transit, account number
5. Set allocation percentage
6. Mark as primary
7. Save

**Expected Results**:
- [ ] Account saved
- [ ] Transit number validated
- [ ] Primary flag set
- [ ] Can add multiple accounts

**Status**: ☐ Pass  ☐ Fail  ☐ N/A

---

### UAT-HRM-003: Record Certification
**Scenario**: HR records employee certification

**Steps**:
1. Open employee record
2. Navigate to Certifications
3. Add certification (name, issuer, dates)
4. Mark as required
5. Upload certificate PDF
6. Set reminder (30 days before expiry)
7. Save

**Expected Results**:
- [ ] Certification recorded
- [ ] Document linked
- [ ] Expiry reminder set
- [ ] Shows in compliance list

**Status**: ☐ Pass  ☐ Fail  ☐ N/A

---

### UAT-HRM-004: Terminate Employee
**Scenario**: HR terminates employee

**Steps**:
1. Open employee record
2. Change status to "Terminated"
3. Enter termination date
4. Enter reason
5. Save
6. Verify removed from active lists
7. Verify org chart updated
8. Verify leave balance processed

**Expected Results**:
- [ ] Status = Terminated
- [ ] Termination date recorded
- [ ] Org chart updated
- [ ] Status history logged
- [ ] Outstanding leave calculated

**Status**: ☐ Pass  ☐ Fail  ☐ N/A

---

### UAT-HRM-005: View Reporting Chain
**Scenario**: View employee hierarchy

**Steps**:
1. Open employee record
2. View "Reports To" manager
3. Click through to view full chain to CEO
4. View "Direct Reports" list

**Expected Results**:
- [ ] Manager displayed
- [ ] Full chain navigable
- [ ] Direct reports listed

**Status**: ☐ Pass  ☐ Fail  ☐ N/A

---

## 3. Sign-Off

| Role | Name | Signature | Date |
|------|------|-----------|------|
| Business Owner | | | |
| UAT Lead | | | |
| Technical Lead | | | |

---

*Document Version: 1.0.0*
*Last Updated: 2026-05-11*