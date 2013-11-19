<?php
/**
 * @file
 * Handles the rendering of a single record in a detailed view.
 *
 * @param $record
 *   An object representation of an article discovery record.  Right now this
 *   is essentially exactly what was produced from a Summon query.
 *
 * @param $selected
 *   A hash of selected records.  If this record is selected,
 *   $selected[$record->ID[0]] will evaluate to true.
 *
 * @param $data
 *   $data is an associative array for extra data.
 *
 * @param $linkurl_base
 *   The base url for the link resolver.
 *
 * @param $linkurl_id
 *   The id for the link resolver.
 */
if(isset($record->ID[0]) && $selected[$record->ID[0]]) {
  $checked = ' checked="checked"';
}
else {
  $checked ='';
}
?>
<div class="article-discovery-record article-discovery-row-0">
  <div class="article-discovery-record-buffer">
  <div class="article-discovery-record-data">
    <h2>
      <input type="checkbox" class="article-discovery-select-box" id="select-<?php print htmlentities($record->ID[0], ENT_QUOTES, 'UTF-8'); ?>"<?php print $checked; ?>>
<?php print htmlentities($record->Title[0], ENT_COMPAT, 'UTF-8'); ?></h2>
<?php print theme(
  'article_discovery_link_box',
  _article_discovery_link_box_prepare(
    array(
      'linkurl_base' => $linkurl_base,
      'linkurl_id'   => $linkurl_id,
      'openurl'      => $record->openUrl,
      'fulltext'     => $record->hasFullText,
      'date'         => $record->PublicationDate_xml[0],
      'id'           => $record->ID[0],
      'url'          => $record->url[0],
      'URI'          => $record->URI[0],
      'link'         => $record->link,
      'page'         => '-1',
      'position'     => '-1',
      'query'        => $data['query'],
    )
  )
);  ?>
<?php if (isset($record->Author_xml) && count($record->Author_xml)):
  foreach ($record->Author_xml as &$a) {
    $a = l($a->fullname, 'articles/search', array('html' => TRUE, 'query' => array('author' => preg_replace('/[^>]*>/', '', $a->fullname))));
  }
?>
    <div>by <?php print implode(', ', $record->Author_xml);  ?></div>
<?php elseif (isset($record->Author) && count($record->Author)):
  foreach ($record->Author as &$a) {
    $a = l($a, 'articles/search', array('html' => TRUE, 'query' => array('author' => preg_replace('/<[^>]*>/', '', $a))));
  }
?>
    <div><?php print t('by'); ?> <?php print implode(', ', $record->Author);  ?></div>
<?php endif; ?>
<?php if (isset($record->Availability)): ?>
    <div><?php print t('Availability:'); ?> <?php print t(htmlentities($record->Availability, ENT_COMPAT, 'UTF-8')); ?></div>
<?php endif; ?>
<?php if (isset($record->Abstract)): ?>
    <h5><?php print t('Abstract'); ?></h5>
    <div><?php print t(htmlentities($record->Abstract[0], ENT_COMPAT, 'UTF-8')); ?></div>
<?php endif; ?>
    <div class="article-discovery-advanced-fields">
<?php
  if (isset($record->ISSN) && isset($record->EISSN)) {
    $record->ISSN = array_merge($record->ISSN, $record->EISSN);
  }
  elseif (isset($record->EISSN)) {
    $record->ISSN = $record->EISSN;
  }
  if (isset($record->ISBN) && isset($record->EISBN)) {
    $record->ISBN = array_merge($record->ISBN, $record->EISBN);
  }
  elseif (isset($record->EISBN)) {
    $record->ISBN = $record->EISBN;
  }
  if (isset($record->PublicationDate)) {
    $record->PublicationDate = theme('article_discovery_date', $record->PublicationDate);
  }
  if (count($record->Author) > 1) {
    $fields['Author'] = array('display' => 'Authors', 'html' => TRUE);
  }
  if (count($record->SubjectTerms) > 1) {
    $fields['SubjectTerms'] = array('display' => 'Subjects', 'html' => TRUE);
  }
  if (isset($record->SubjectTerms) && count($record->SubjectTerms)) {
    foreach ($record->SubjectTerms as &$s) {
      $s = l($s, 'articles/search', array('html' => TRUE, 'query' => array('subject' => preg_replace('/<[^>]*>/', '', $s))));
    }
  }
?>
<?php foreach ($fields as $k => $v) { ?>
<?php   if (isset($record->$k)): ?>
      <div class="article-discovery-field">
        <div class="article-discovery-field-buffer">
          <span class="article-discovery-field-label">
            <?php print t($v['display']) ?>:
          </span>
          <span class="article-discovery-field-value">
<?php if (is_array($record->$k)) {
  if (isset($v['html']) && $v['html']) {
    print "<span>". implode(', ', array_map('t', $record->$k)) ."</span>";
  }
  else {
    print "<span>". htmlentities(implode(', ', array_map('t', $record->$k)), ENT_COMPAT, 'UTF-8') ."</span>";
  }
}
else {
  if (isset($v['html']) && $v['html']) {
    print "<span>". t($record->$k) ."</span>";
  }
  else {
    print "<span>". htmlentities(t($record->$k), ENT_COMPAT, 'UTF-8') ."</span>";
  }
} ?>
          </span>
        </div>
      </div>
      <div class="clear-both"></div>
<?php endif; ?>
<?php } ?>
    </div>
      <div class="clear-both"></div>
  </div>
  </div>
</div>
