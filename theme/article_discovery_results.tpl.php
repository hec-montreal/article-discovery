<?php
/**
 * @file
 * This essentially renders a bunch of other themes.  Some may be passed in, some may be called.
 *
 * @param $data
 *
 * @param $limits
 *
 */
$data = $variables['data'];
$limits = $variables['limits'];
$records_per_page = variable_get('article_discovery_articles_per_page', 20);

?>
<?php print theme('article_discovery_header', array('state' => (isset($data['state']) ? $data['state'] : NULL), 'query' => (isset($data['query']) ? $data['query']: NULL))); ?>

<div class="article-discovery-container-wrapper">
<div class="article-discovery-container">
  <div class="article-discovery-container-inner">
  <?php if (isset($data['recommended'])) print $data['recommended']; ?>
    <div class="article-discovery-status-buffer">
<?php if (isset($data['sort'])) print $data['sort']; ?>
<?php if (isset($data['status'])) print $data['status']; ?>
    </div>
    <?php if (isset($data['actions'])) print $data['actions']; ?>
    <div class="article-discovery-results">
<?php
  if (isset($data['records']) && is_array($data['records'])) {
    foreach ($data['records'] as $item) {
      print $item;
    }
  }
?>
    </div>
    <?php
    if (isset($data['actions']) && isset($data['records']) && is_array($data['records']) && count($data['records']) > ($records_per_page/2)) {
      print $data['actions'];
    } ?>
<?php if (isset($data['error']) && is_array($data['error'])): ?>
    <div class="article-discovery-error">
      <div><strong><?php print t('We found this problem with the query you provided.'); ?></strong></div>
<?php foreach ($data['error'] as $error) {   ?>
        <div class="article-discovery-error-code"><?php print t('Code:') ." ". htmlentities($error->code, ENT_COMPAT, 'UTF-8'); ?></div>
        <div class="article-discovery-error-message"><?php print t('Message:') ." ". htmlentities($error->message, ENT_COMPAT, 'UTF-8'); ?></div>
<?php } ?>
    </div>
<?php endif; ?>
<?php if (isset($data['pager'])) print $data['pager'] ; ?>
<p>Article Discovery results powered by Summon<sup>TM</sup> from Serials Solutions, a division of ProQuest.</p>
  </div>
</div>
<div class="clear-both"></div>
</div>
