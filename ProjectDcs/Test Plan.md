# Test Plan - ksf_HRM

## Unit Tests

### Employee Creation
- [ ] Create employee with new contact
- [ ] Create employee with existing contact
- [ ] Auto-generate employee number
- [ ] Validate required fields

### Employee Status
- [ ] Status change creates history record
- [ ] Termination date required for terminated status

### Banking
- [ ] Add multiple bank accounts
- [ ] Split percentage validation (sums to 100%)
- [ ] Transit number format validation

### Tax
- [ ] TD1 date tracking
- [ ] Credit calculations

### Dependants
- [ ] Add/remove dependants
- [ ] Benefits eligibility flag

### Certifications
- [ ] Expiry date triggers reminder
- [ ] Document upload

## Integration Tests

### With ksf_Contacts
- [ ] Employee shows as contact with Employee type
- [ ] Contact updates reflect in employee

### With ksf_Timesheets
- [ ] Employee rate pulls correctly
- [ ] Activity codes generate liability

### With ksf_Calendar
- [ ] Training appears in calendar
- [ ] Calendar event links to employee

## UAT Scenarios
(See GitHub Issues with [UAT] tag)
