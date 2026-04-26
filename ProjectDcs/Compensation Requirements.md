# Business Requirements - ksf_Compensation

## Project Overview
Comprehensive compensation management - grades, pay, benefits, and payroll liability tracking.

## Problem Statement
- Need grades with pay ranges
- Need to track employee salary vs grade midpoint
- Need benefits tracking (not inventory items)
- Need to generate payroll liabilities
- Need leave/total compensation integration

## Core Concepts

### Grades (Salary Bands)
```php
Grade: S1 (Step 1)
- min: 50000
- max: 80000  
- 100%: 65000 (midpoint)
```
- Multiple grades with min/max/100%

### Employee Compensation Record
- Grade assigned (e.g., S1)
- Percent of grade (e.g., 95% = 61750)
- Config option: Record just % OR record actual pay

### Employee Types
- **Annual**: Salary paid evenly
- **Wage**: Hourly rate
- **Commission**: Base + Commission

### Hours Configuration
| Setting | Value |
|---------|-------|
| year_hours | 2080 (for 40hr week) |
| month_hours | 173.33 |
| week_hours | 40 |
| day_hours | 8 |

### Overtime Configuration
- what_constitutes_ot: hours > 8/day OR hours > 40/week
- ot_pay_out: yes/no
- ot_banked: yes/no
- ot_bank_multiplier: 1.0 or 1.5

### Bonuses (Allowances)
- experience_bonus: $X/year for Y years experience
- role_bonus: $X/year after Z months in role
- credential_bonus: $X/year for specific credentials

## GL Recording Logic

### Standard (Monthly) Employee
```
Monthly Salary: $5000
Timesheet: 160 hours G01
GL: salary expense $5000
```
- Regardless of hours worked, pays fixed amount

### Variance Tracking
- If worked < expected: Record variance adjustment
- If worked > expected with manager approval: OT bank

### Hourly Employee
```
Rate: $25/hr
Timesheet: 162 hours G01, 2 hours O01
GL: salary expense (162 × $25) + (2 × $37.50)
```

### Pay Components
- G01: Regular Time (1.0x)
- O01: Overtime (1.5x)
- V01: Vacation (from bank)
- S01: Sick (from bank)

## Benefits Configuration

### Benefits Types (not stock_master items)
| Benefit | Provider | Code | Rate | Employee Pays |
|---------|----------|------|------|--------------|
| Pension | Manulife | PEN | 5% | 3% |
| EI | Service Canada | EI | 1.4% | 1.4% |
| CPP | Service Canada | CPP | 3.4% | 3.4% |
| RRSP Matching | Sun Life | RRSP | 50% up to 5% | 0% |
| Health | Manulife | HLTH | $50/mo | $0 |
| Dental | Manulife | DENT | $25/mo | $0 |

### GL Mapping
- Benefits expense (employer portion)
- Benefits liability (employee portion withheld)

### Accrual Calculation
- Monthly: (annual_value / 12)
- Accrual GL entry each period

## Leave Integration

### Leave Banks
- Vacation accrual rate
- Sick accrual rate

### Leave Request Flow
1. Employee requests leave
2. System checks bank balance
3. Configurable: Warn or Block if insufficient
4. Approved → Time record + bank adjustment

### Borrow Against Future
- Config: Allow borrowing (yes/no)
- Max negative balance

### Stat Holiday Handling (Canada)
- Config per province
- Regular / OT / Banked

## Code Chaining Rules
```
Example: 
- G01 (Regular) qualifies for RRSP matching
- O01 (OT) does NOT qualify for RRSP matching
- S01, V01 (from bank) do NOT qualify
```

## Job Offer / Contract Summary
- Base compensation
- Grade and %
- Normal hours
- Benefits summary (employer cost)
- Bonus eligibility
- Total compensation value

## Admin Screen
- Grade management (CRUD)
- Benefits management (CRUD)
- Overtime rules
- Stat holiday rules
- Code chaining rules

## Integration Points
- ksf_HRM: Employee record + grade
- ksf_Timesheets: Hours → Pay calculation
- ksf_Leave: Bank balances, approval checks
- ksf_FA: GL entries for payroll liabilities