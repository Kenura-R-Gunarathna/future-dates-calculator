# Future dates calculator

PHP based month calculator. This will be usefull in salary calculators, to controll cron jobs using php, subscriptions, notifications and emails.

Currently this only supportive for months calculations only.

```
<?php

// Number of months adding.
$adding_months = 2;

// If precision = 1 it will also show the hours:minutes:seconds also.
$precision = 0;

// Previous month.
$database_retrieved_date = "2023-8-31 14:38:25";

$next_payment_date = nextPaymentDate( $database_retrieved_date, $adding_months, $precision );

echo $next_payment_date;
```

Response

```
2023-10-31 14:38:25
```