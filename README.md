# Future dates calculator

PHP based month calculator. This will be usefull in salary calculators, to controll cron jobs using php, subscriptions, notifications and emails.

Use both `nextPaymentDay()` function and `nextPaymentDate()` functions seperately. Because it can cause problems with the final date since both methods use different logics.

Where,

1. [`nextPaymentDay()`](#addition-of-dates) - Goes throught each and every month and add the dates according to the maximum dates in each month.

2. [`nextPaymentDate()`](#addition-of-months-and-years) - Simply add the months and years. The output date also will be changed is the given dates like 29, 30, 31 which do exist in some and do not exist in some months. so in those conditions the maximum date of the obtained month will be shown.

## Addition of dates

```
<?php

// Number of dates adding.
$adding_dates = 50;

// If precision = 1 it will also show the hours:minutes:seconds also.
$precision = 0;

// Previous month.
$database_retrieved_date = "2024-2-20 14:38:25";

$next_payment_date = nextPaymentDay( $database_retrieved_date, $adding_dates, $precision );

echo $next_payment_date;
```

## Addition of months and years

```
<?php

// Number of years adding.
$adding_years = 0;

// Number of months adding.
$adding_months = 2;

// If precision = 1 it will also show the hours:minutes:seconds also.
$precision = 0;

// Previous month.
$database_retrieved_date = "2023-8-31 14:38:25";

$next_payment_date = nextPaymentDate( $database_retrieved_date, $adding_years, $adding_months, $precision );

echo $next_payment_date;
```

## Output

<img src="./reference.png" width="100%">

@Thank you, Kenura R.Gunarathna