<?php
/**
 * @file
 * Formats date ranges consistently.
 *
 * @param $range
 *   A string containing a date range "Date1:Date2"
 *
 * The output is preferred as MM/DD/YYYY
 */ 
$range = $variables['range'];

list($left, $right) = explode(':', $range);
$months = array(
  '01' => t('January'),
  '02' => t('February'),
  '03' => t('March'),
  '04' => t('April'),
  '05' => t('May'),
  '06' => t('June'),
  '07' => t('July'),
  '08' => t('August'),
  '09' => t('September'),
  '10' => t('October'),
  '11' => t('November'),
  '12' => t('December'),
);

if ($right == '2019') {
  print theme('article_discovery_date', array('date' => $left)) . t('-present');
}
elseif ($left == '*') {
  print t(
    'up to @annee',
    array('@annee' => theme('article_discovery_date', array('date' =>$right)))
  );
}
elseif (preg_match('/(\d\d\d\d)-01-01/', $left, $left_matches) && preg_match('/(\d\d\d\d)-12-31/', $right, $right_matches)) {
  if ($left_matches[1] == $right_matches[1]) {
    print theme('article_discovery_date', array('date' => $left_matches[1]));
  }
  else {
    print theme('article_discovery_date', array('date' => $left_matches[1]));
    print '-';
    print theme('article_discovery_date', array('date' => $right_matches[1]));
  }
}
elseif (preg_match('/(\d\d\d\d)-(\d\d)-01/', $left, $left_matches) && preg_match('/(\d\d\d\d)-(\d\d)-\d\d/', $right, $right_matches)) {
  if ($left_matches[1] == $right_matches[1] && $left_matches[2] == $right_matches[2]) {
    print $months[$left_matches[2]];
  }
  else {
    print theme('article_discovery_date', array('date' => $left));
    print '-';
    print theme('article_discovery_date', array('date' => $right));
  }
}
else {
  print theme('article_discovery_date', array('date' => $left));
  print '-';
  print theme('article_discovery_date', array('date' => $right));
}
