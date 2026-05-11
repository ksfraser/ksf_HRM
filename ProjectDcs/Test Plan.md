# Test Plan - ksf_HRM

## Document Information
- **Module**: ksf_HRM
- **Version**: 1.0.0
- **Date**: 2026-05-11
- **Test Framework**: PHPUnit 10.x

## 1. Test Strategy

### 1.1 Coverage Target
- 100% line/branch coverage on production code
- Exception classes excluded

### 1.2 Test Categories
- **Unit Tests**: Entities, Services
- **Integration Tests**: With mocked repositories

## 2. Test Structure

```
ksf_HRM/tests/
├── bootstrap.php
└── Unit/
    ├── Entity/
    │   ├── EmployeeTest.php
    │   ├── CompensationTest.php
    │   ├── BankAccountTest.php
    │   ├── EmergencyContactTest.php
    │   └── CertificationTest.php
    ├── Service/
    │   └── EmployeeServiceTest.php
    └── Repository/
        └── EmployeeRepositoryTest.php
```

## 3. Test Cases

### 3.1 EmployeeTest

| Test | Description | Expected |
|------|-------------|----------|
| testCreateEmployee | Valid employee created | ID set, status = active |
| testSetEmploymentStatus | Change status | Status updated, history logged |
| testSetManager | Set manager relationship | Manager ID set |
| testTerminateEmployee | Terminate with date/reason | Status = terminated, termination_date set |
| testGetReportingChain | Get all managers up chain | Array of managers |
| testToArray | Serialize to array | All fields present |

### 3.2 CompensationTest

| Test | Description | Expected |
|------|-------------|----------|
| testCreateCompensation | Valid compensation created | ID set, dates valid |
| testEffectiveDateValidation | End before start | ValidationException |
| testGetCurrentCompensation | Get active comp | Most recent with no end_date |
| testCompensationHistory | Get all comp records | Array sorted by date desc |

### 3.3 BankAccountTest

| Test | Description | Expected |
|------|-------------|----------|
| testCreateBankAccount | Valid account created | ID set |
| testTransitNumberValidation | Invalid transit | ValidationException |
| testSplitAllocation | Multiple accounts, 100% | Total = 100% |
| testPrimaryAccount | Set primary | Previous primary unset |

### 3.4 CertificationTest

| Test | Description | Expected |
|------|-------------|----------|
| testCreateCertification | Valid cert created | ID set |
| testExpiryCheck | Cert expired | isExpired() = true |
| testReminderDue | Expiring in 30 days | isReminderDue() = true |
| testRequiredFlag | Required vs optional | Boolean flag |

### 3.5 EmployeeServiceTest

| Test | Description | Expected |
|------|-------------|----------|
| testCreateEmployee | Service creates employee | Entity created, event emitted |
| testUpdateEmployee | Update existing | Entity updated, event emitted |
| testTerminateEmployee | Terminate employee | Status changed, event emitted |
| testGetByDepartment | Filter by department | Matching employees |
| testGetReportingChain | Get org hierarchy | Array of employees |

## 4. Mock Strategy

| Interface | Mock Type |
|-----------|-----------|
| EmployeeRepositoryInterface | Mock |
| EventDispatcherInterface | Mock |
| LoggerInterface | Mock |

## 5. Quality Gates

- [ ] All unit tests pass
- [ ] Code coverage ≥ 80%
- [ ] phpstan level 8 passes
- [ ] phpcs passes PSR-12

---

*Document Version: 1.0.0*
*Last Updated: 2026-05-11*