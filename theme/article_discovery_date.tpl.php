<?php
/**
 * @file
 * Formats $date for consistent date output.
 *
 * @param $date
 *   Can be a string or an array containing a single string.
 *
 * The output is preferred as MM/DD/YYYY
 */
$date = $variables['date'];

if (!is_null($date)) {
  $output = array();
  if (is_array($date)) {
    sort($date);
    $date = $date[0];
  }


  // zonecours: Special case, sometimes $date = [YYYY] or cYYYY
  $firstChar = drupal_substr($date, 0, 1);

  if($firstChar === '[') {
    $date = drupal_substr($date, 1, 4);
  } else if ($firstChar === 'c') {
    $date = drupal_substr($date, 1);
  }

  // zonecours: Special case (yyyy-Month)
  if(preg_match("/\d{4}-\D+/", $date, $prgo)) {
    $date = drupal_substr($date, 0, 4);
  }


  if (drupal_strlen($date) == 4) {
    $year = $date;
    $output[] = $year;
  }
  elseif (drupal_strlen($date) == 6) {
    //does this ever happen?  And is it YYYYMM or MMYYYY  IDK. Assume YYYYMM.
    $year = drupal_substr($date, 0, 4);
    $month = drupal_substr($date, 4, 2);
    if ($month != '00') {
      $output[] = $month;
    }
    $output[] = $year;
  }
  elseif (drupal_strlen($date) == 8) {
    //Pretty sure this is YYYYMMDD
    $year = drupal_substr($date, 0, 4);
    $month = drupal_substr($date, 4, 2);
    $day = drupal_substr($date, 6, 2);
    if ($month != '00') {
      $output[] = $month;
    }
    if ($day != '00') {
      $output[] = $day;
    }
    $output[] = $year;
  }
  elseif (preg_match('/(\d\d\d\d)-(\d\d)-(\d\d)/', $date, $matches)) {
    if ($matches[2] != '00') {
      $output[] = $matches[2];
    }
    if ($matches[3] != '00') {
      $output[] = $matches[3];
    }
    $output[] = $matches[1];
  }
  elseif (preg_match('/(\d\d\d\d)-(\d\d)/', $date, $matches)) {
    if ($matches[2] != '00') {
      $output[] = $matches[2];
    }
    $output[] = $matches[1];
  }
  elseif (preg_match('/(\d\d\d\d)/', $date, $matches)) {
    $output[] = $matches[1];
  }
  print implode('/', $output);
}
