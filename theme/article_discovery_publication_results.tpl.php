<?php 
/**
 * @file
 * Formats the link to the article.  Takes several parameters into account.
 *
 * @param $pager
 * @param $publication
 */

$pager       = $variables['pager'];
$publication = $variables['publication'];


print $pager; 
?>
<div class="publications">
<?php foreach ($results as $publication) { 
  if (count($publication['issn'])) {
    $issns = $publication['issn'];
  }
  else {
    $issns = array();
  }
  if (count($publication['eissn'])) {
    $issns = array_unique(array_merge($issns, $publication['eissn']));
  }
  $issns = implode(', ', $issns);

  if (count($publication['discipline'])) {
    $disciplines = implode(', ', $publication['discipline']);
  }
  else {
   $disciplines = '';
  }

  if (count($publication['subject-terms'])) {
    $subjects = implode(', ', $publication['subject-terms']);
  }
  else {
    $subjects = '';
  }
?>
  <div class="publication">
    <div class="title"><?php print check_plain($publication['title'][0]);  ?> <tt>(<?php print check_plain($publication['value']); ?>)</tt></div>
    <div class="article-count"><?php print t('Has') . ' ' . format_plural($publication['count'], t('@count article'), t('@count articles')); ?> <?php print t('matching your query.'); ?></div>
    <div class="coverage"> <?php print t('Coverage:'); ?> <?php print check_plain($publication['start'][0]->year) .' '. t('to') .' '. check_plain($publication['end'][0]->year); ?></div>
<?php if (drupal_strlen($issns)) { ?>
    <div class="issns"><?php print format_plural(count($publication['issn']) + count($publication['eissn']), t('ISSN:'), t('ISSNs:')) .' '. check_plain($issns); ?></div>
<?php } ?>
<?php if (drupal_strlen($disciplines)) { ?>
    <div class="disciplines"><?php print format_plural(count($publication['discipline']), t('Discipline:'), t('Disciplines:')) .' '. check_plain($disciplines); ?></div>
<?php } ?>
<?php if (drupal_strlen($subjects)) { ?>
    <div class="subjects"><?php print format_plural(count($publication['subject-terms']), t('Subject:'), t('Subjects:')) .' '. check_plain($subjects); ?></div>
<?php } ?>
  </div>
  <br />
<?php  } ?>
</div>
