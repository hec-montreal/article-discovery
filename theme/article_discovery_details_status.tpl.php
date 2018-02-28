<?php
/**
 * @file
 * Formats the "Back to search results." link.
 *
 * @param $data
 *   An associative array with information about the previous search.
 *
 */
$data = $variables['data'];
?>
<div class="article-discovery-details-navigation">
<?php
  if (
    isset($data) &&
    isset($data['search']) &&
    isset($data['search']['uri']) &&
    isset($data['search']['query'])): ?>
  <div><a href="<?php print $data['search']['uri'] . '?' . http_build_query($data['search']['query']); ?> "><?php print t('Back to article discovery results'); ?></a></div>
<?php endif; ?>
</div>

