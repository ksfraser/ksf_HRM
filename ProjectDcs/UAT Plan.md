# UAT Plan - ksf_HRM

## Test Environment
- UAT Pod: http://[UAT-IP]:8080
- Database: ksf_hrm (or shared)

## Test Data Needed
- 5 sample employees (various status)
- Bank accounts (2 with split)
- Dependants for some
- Certifications (some expired, some current)

## Test Scenarios

### P1 - Critical
1. Create new employee from scratch
2. Link existing contact to employee
3. Add banking information
4. Terminate employee

### P2 - Important
5. Add dependant with benefits
6. Record certification with expiry
7. Search employee by various criteria
8. Generate employee report

### P3 - Nice to Have
9. Self-service update by employee
10. Certification expiry reminders

## Sign-off Criteria
- All P1 scenarios pass
- All P2 scenarios pass
- No data corruption
