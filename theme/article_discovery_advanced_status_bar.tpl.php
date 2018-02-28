<?php
/**
 * @file
 * Creates the status-bar for search results (i.e. search found X of Y ...).
 *
 * @param $data
 *   The data for the search ('start', 'limit', 'criteria') ...
 *
 */
$data = $variables['data'];

$have_results = isset($data['start'])
  && drupal_strlen($data['start'])
  && isset($data['limit'])
  && drupal_strlen($data['limit'])
  && isset($data['count'])
  && drupal_strlen($data['count']);

$vars = $_GET;
foreach (array('op', 'form_build_id', 'form_token', 'form_id', 'q') as $field) {
  if (isset($vars[$field])) {
    unset($vars[$field]);
  }
}



$have_criteria = isset($data['criteria'])
  && drupal_strlen($data['criteria']);
?>
<?php if ($have_results && $have_criteria) : ?>
<div class="article-discovery-status-bar">
  <?php print t("Your article discovery search for <strong>@criteria</strong> found <strong>@count</strong> results.  Showing @deb - @fin",
    array(
      '@criteria' => htmlentities($data['criteria'], ENT_COMPAT, 'UTF-8'),
      '@count'    => $data['count'],
      '@deb'      => min(1+(($data['start']-1)*$data['limit']), $data['count']),
      '@fin'      => min($data['start'] * $data['limit'], $data['count'])
    )
  );
  ?>
</div>
<?php elseif ($have_results): ?>
<div class="article-discovery-status-bar">
  <?php print t('Showing @deb - @fin of @count.',
    array(
      '@deb'   => min(1+(($data['start']-1)*$data['limit']), $data['count']),
      '@fin'   => min($data['start'] * $data['limit'], $data['count']),
      '@count' => $data['count']
    )
  );
  ?>
</div>
<?php endif; ?>
<div><?php print l(t('Refine this search'), 'articles/advanced', array('query' => $vars)); ?></div>
