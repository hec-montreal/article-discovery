<?php
/**
 * @file
 * Formats the record for output.
 *
 * @param $record
 *   The record object.
 *
 * @param $data
 *   $data is an associative array of extra data regarding the record.
 *
 * @param $selected
 *   a hash of selected objects.
 *
 * @param $limits
 *   Parameterized limits on the article discovery engine.
 *
 * @param $link
 *   The rendered html for the article link.
 *
 */

$has_more_info = ((drupal_strlen($record->Abstract[0]) > 0 ) ||
(count($record->SubjectTerms) > 0 ) ||
(count($record->Genre) > 0 ) ||
(count($record->Location) > 0));
 ?>
<div class="article-discovery-record article-discovery-row-<?php print htmlentities($data['position'], ENT_QUOTES, 'UTF-8'); if ($data['position']%2==1) print ' alt'; ?>">
  <div class="article-discovery-record-buffer">
    <div class="article-discovery-record-data">
      <div class="article-discovery-record-line-1">
        <h2>
          <?php print $record->Title[0]; ?>
        </h2>
<?php print $link; ?>
      </div>
      <div class="article-discovery-record-line-2">
<?php if (isset($record->Author_xml) && count($record->Author_xml)):
  foreach ($record->Author_xml as &$a) {
    $a = l($a->fullname, 'articles/search', array('html' => TRUE, 'query' => array('author' => preg_replace('/[^>]*>/', '', $a->fullname))));
  }
?>
    by <?php print implode(', ', $record->Author_xml);  ?>
<?php elseif (isset($record->Author) && count($record->Author)):
  foreach ($record->Author as &$a) {
    $a = l($a, 'articles/search', array('html' => TRUE, 'query' => array('author' => preg_replace('/<[^>]*>/', '', $a))));
  }
?>
    by <?php print implode(', ', $record->Author_xml);  ?>
<?php endif; ?>
      </div>
      <div class="article-discovery-record-line-3">
<?php if (count($record->PublicationTitle) || (isset($record->Volume) && count($record->Volume)) || (isset($record->Issue) && count($record->Issue))) : ?>
<?php if (count($record->PublicationTitle)) : ?>
        <span class="article-discovery-record-publication-title"><?php print $record->PublicationTitle[0]; ?></span><?php endif; ?><?php
  $aux = array();
  if (isset($record->Volume) && count($record->Volume)) {
    $aux[] = t('Vol.') ." ". $record->Volume[0];
  }
  if (isset($record->Issue) && count($record->Issue)) {
    $aux[] = t('Issue') ." ". $record->Issue[0];
  }
?><?php if (count($aux)) : ?> <span class="article-discovery-record-publication-volume-issue"><?php print implode(', ', $aux); ?></span><?php endif; ?>
.
<?php endif; ?>
<?php
if (isset($record->PublicationDate) && is_array($record->PublicationDate)) :
  print t('Date:') ." ". theme('article_discovery_date', $record->PublicationDate);
endif; ?>
<?php if (count($record->StartPage) && count($record->EndPage)) {
  $plural = 's';
  if ($record->StartPage[0] == $record->EndPage[0]) {
    $plural = '';
  }
  printf(' Page%s: %s-%s.', $plural,  $record->StartPage[0], $record->EndPage[0]);
}
elseif (count($record->PageNote) && $record->PageNote[0] != $record->StartPage[0]) {
  $plural = 's';
  if (strpos($record->PageNote[0], '-') === FALSE) {
    $plural = '';
  }
  printf(' Page%s: %s.', $plural, $record->PageNote[0]);
}
elseif (drupal_strlen($record->StartPage[0])) {
  printf(' Start Page: %s.', $record->StartPage[0]);
} ?>
      </div>
      <div class="article-discovery-record-line-4">
<?php if (count($record->ContentType)): ?>
	<?php print t('Format:') ." ". implode(', ', array_map('t', $record->ContentType)); ?>
<?php endif; ?>
</div>
      <div class="article-discovery-record-line-5 <?php
if (count($record->Snippet) && drupal_strlen($record->Snippet[0]))
  print "article-discovery-record-vertical-space";
?>">
<?php if (count($record->Snippet) && drupal_strlen($record->Snippet[0])): ?>
&ldquo;<?php print $record->Snippet[0]; ?>&rdquo;
<?php endif; ?>
<?php if ($has_more_info) : ?>
          <a class="article-discovery-more-info-more article-discovery-more-info-<?php print $data['position']; ?>" href="javascript:void($('.article-discovery-more-info-<?php print $data['position']; ?>').toggle());"><?php print t('more...')?></a>
<?php endif; ?>
      </div>
      <div class="article-discovery-record-line-6">
        <div class="js-hide article-discovery-more-info article-discovery-more-info-<?php print $data['position']; ?> article-discovery-record-vertical-space">
<?php $more_contents = array(); ?>
<?php if (drupal_strlen($record->Abstract[0]) > 0 ): ?>
          <div class="article-discovery-record-abstract">
            <h5><?php print t('Abstract'); ?></h5>
            <div><?php print $record->Abstract[0]; ?></div>
            <div><?php print $record->Copyright[0]; ?></div>
          </div>
<?php $more_contents[] = t('Abstract'); ?>
<?php endif;
  if (count($record->SubjectTerms) > 0): ?>
          <div class="article-discovery-record-subject">
            <h5><?php print t('Subject'); ?></h5>
            <div><?php print join(', ', array_map('t', array_unique($record->SubjectTerms))); ?></div>
          </div>
<?php $more_contents[] = t('Subject'); ?>
<?php endif;
  if (count($record->Genre) > 0): ?>
          <div class="article-discovery-record-genre">
            <h5><?php print t('Genre'); ?></h5>
            <div><?php print join(', ', array_map('t', array_unique($record->Genre))); ?></div>
          </div>
<?php $more_contents[] = t('Genre'); ?>
<?php endif;
  if (count($record->Location) > 0): ?>
          <div class="article-discovery-record-location">
            <h5><?php print t('Location'); ?></h5>
            <div><?php print join(', ', array_unique($record->Location)); ?></div>
          </div>
<?php $more_contents[] = t('Location'); ?>
<?php endif; ?>
          <div class="article-discovery-more-info-less">
          <a href="javascript:void($('.article-discovery-more-info-<?php print $data['position']; ?>').toggle());"><?php print t('less...');?></a>
          </div>
        </div>
      </div>
      <div class="article-discovery-record-line-7">&nbsp;</div>
    </div>
  </div>
</div>
