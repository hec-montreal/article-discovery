<?php
/**
 * @file
 *   Creates the body of an email message for exporting records.
 *
 * @param $message
 *   A message to enclode in the outgoing data.
 *
 * @param $data
 *   An array of records.
 *
 */
?>
<?php if (drupal_strlen($message) > 0): ?>
<?php print $message; ?>


=========================================
<?php endif; ?>
<?php $i = 0; ?>
<?php if (is_array($data)) foreach ($data as $record) { ?>

RECORD <?php print ++$i; ?>

<?php print $record->Title[0]; ?>

http://<?php print $_SERVER['SERVER_NAME']; ?>/articles/details/<?php print $record->ID[0]; ?>

<?php
  if (count($record->Author_xml)): ?>by <?php
    print join(', ', array_map(create_function('$a', 'return @$a->fullname;'), $record->Author_xml));
  elseif
    (count($record->Author)): ?><?php print t('by') . join(', ', $record->Author); ?><?php endif; ?>

<?php if (count($record->Abstract)) print implode("\n", $record->Abstract); ?>

__________________________________________________________

<?php }
