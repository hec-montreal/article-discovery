<?php
/**
 * @file
 * Handles the rendering of a "Back to search results"  type of link.
 *
 * @param $data
 *   Associative array: $data['search']['uri']  provides the root uri,
 *   $data['search']['query']  provides the variables for the query string
 */

$data = $variables['data'];

?>
<div class="article-discovery-details-navigation">
<?php if (
  isset($data) &&
  isset($data['search']) &&
  isset($data['search']['uri']) &&
  isset($data['search']['query'])
) : ?>
  <div><a href="<?php print $data['search']['uri'] . '?' . http_build_query($data['search']['query']); ?> "><?php print t('Back to article discovery results'); ?><span></a></div>
<?php endif; ?>
</div>

