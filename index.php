<?php

function nextPaymentDate( $database_retrieved_date, $adding_months, $precision ){

  // ------------------------------------------------------------------------

  // Retrieve the seconds number from the given previous date.
  $database_retrieved_seconds = date("s", strtotime($database_retrieved_date));

  // Retrieve the minutes number from the given previous date.
  $database_retrieved_minutes = date("i", strtotime($database_retrieved_date));

  // Retrieve the hours number from the given previous date.
  $database_retrieved_hours = date("H", strtotime($database_retrieved_date));

  // Retrieve the day number from the given previous date.
  $database_retrieved_day = date("d", strtotime($database_retrieved_date));

  // Retrieve the month number from the given previous date.
  $database_retrieved_month = date("m", strtotime($database_retrieved_date));

  // Retrieve the year number from the given previous date.
  $database_retrieved_year = date("Y", strtotime($database_retrieved_date));

  // ------------------------------------------------------------------------

  // Get the next month number.
  $database_generated_next_month = null;

  // Get the next year number.
  $database_generated_next_year = null;

  if(($database_retrieved_month + $adding_months) > 12){

      $database_generated_next_month = fmod(($database_retrieved_month + $adding_months), 12);
      $database_generated_next_year = $database_retrieved_year + 1;
  }else{

      $database_generated_next_month = $database_retrieved_month + $adding_months;
      $database_generated_next_year = $database_retrieved_year;
  }

  // Add seconds, minutes and hours if $precision = 1.
  if($precision){

    // checkdate(month, day, year).
    if(checkdate($database_generated_next_month, $database_retrieved_day, $database_generated_next_year)){

      // Generated next month (can be errors in the days)
      $database_generated_next_date = date("Y-m-d H:i:s", strtotime($database_generated_next_year."-".$database_generated_next_month."-".$database_retrieved_day." ".$database_retrieved_hours.":".$database_retrieved_minutes.":".$database_retrieved_seconds));

    }else{

        $last_date_of_next_generated_month = date("t", strtotime($database_generated_next_year."-".$database_generated_next_month."-1"));

      // Generated next month (can be errors in the days)
      $database_generated_next_date = date("Y-m-d H:i:s", strtotime($database_generated_next_year."-".$database_generated_next_month."-".$last_date_of_next_generated_month." ".$database_retrieved_hours.":".$database_retrieved_minutes.":".$database_retrieved_seconds));
    }
  }else{

    // checkdate(month, day, year).
    if(checkdate($database_generated_next_month, $database_retrieved_day, $database_generated_next_year)){

      // Generated next month (can be errors in the days)
      $database_generated_next_date = date("Y-m-d H:i:s", strtotime($database_generated_next_year."-".$database_generated_next_month."-".$database_retrieved_day." ".$database_retrieved_hours.":".$database_retrieved_minutes.":".$database_retrieved_seconds));

    }else{

        $last_date_of_next_generated_month = date("t", strtotime($database_generated_next_year."-".$database_generated_next_month."-1"));

      // Generated next month (can be errors in the days)
      $database_generated_next_date = date("Y-m-d H:i:s", strtotime($database_generated_next_year."-".$database_generated_next_month."-".$last_date_of_next_generated_month." 00:00:00"));
    }

  }
  
  return $database_generated_next_date;

}

// ----------------------------------------------------------------------------------------------------------------------------------------------------------

// Number of month adding.
$adding_months = 2;

$precision = 0;

// Previous month.
$database_retrieved_date = "2023-8-31 14:38:25";

// Today value.
$today = date("Y-m-d h:i:sa", strtotime("2023-9-30"));


$next_payment_date = nextPaymentDate( $database_retrieved_date, $adding_months, $precision );

echo $next_payment_date;

