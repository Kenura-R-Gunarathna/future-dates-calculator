<?php

function nextPaymentDate( $database_retrieved_date, $adding_years, $adding_months, $adding_dates, $precision ){

  // ------------------------------- Adding the dates before calculation -----------------------------------------

  // Retrieve the day number from the given previous date.
  $database_retrieved_day = date("d", strtotime($database_retrieved_date));

  // Retrieve the month number from the given previous date.
  $database_retrieved_month = date("m", strtotime($database_retrieved_date));

  // Retrieve the year number from the given previous date.
  $database_retrieved_year = date("Y", strtotime($database_retrieved_date));

  // ------------------------------------------------------------------------

  $total_dates = $database_retrieved_day + $adding_dates;

  // Retrieve the H:i:s from the given previous date.
  $database_retrieved_time = date("H:i:s", strtotime($database_retrieved_date));

  $last_date_of_next_generated_month = date("t", strtotime($database_retrieved_date));

  $next_month_dates = fmod($total_dates, $last_date_of_next_generated_month);

  // Replase given date with added dates.
  $database_retrieved_date = date("Y-m-d H:i:s", strtotime($database_retrieved_year."-".$database_retrieved_month."-".$next_month_dates." ".$database_retrieved_time));

  $adding_months =+ intdiv($total_dates, $last_date_of_next_generated_month);

  // -------------------------------- Start calculating months and years ----------------------------------------

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

  // Get the next day number.
  $database_generated_next_day = null;

  // Get the next month number.
  $database_generated_next_month = null;

  // Get the next year number.
  $database_generated_next_year = null;


  if(($database_retrieved_month + $adding_months) > 12){

      $database_generated_next_month = fmod(($database_retrieved_month + $adding_months), 12);
      $database_generated_next_year = $database_retrieved_year + $adding_years + 1;
  }else{

      $database_generated_next_month = $database_retrieved_month + $adding_months;
      $database_generated_next_year = $database_retrieved_year + $adding_years;
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

// Number of years adding.
$adding_years = 0;

// Number of months adding.
$adding_months = 0;

// Number of dates adding.
$adding_dates = 10;

$precision = 0;

// Previous month.
$database_retrieved_date = "2023-8-31 14:38:25";

$next_payment_date = nextPaymentDate( $database_retrieved_date, $adding_years, $adding_months, $adding_dates, $precision );

echo $next_payment_date;

