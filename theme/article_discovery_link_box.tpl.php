<?php
/**
 * @file
 * Formats the link to the article.  Takes several parameters into account.
 *
 * @param $data
 *   $data is an associative array of extra data regarding the record.
 *   $data['new-window'] => make the link with target="_blank".
 *   $data['text'] => the text for the link.
 *   $data['link'] => the url for the link.
 *   $data['fulltext'] => Does the record claim to be be full text?
 */
 
$data = $variables['data'];

?>
<div class="article-discovery-link">
  <div class="article-discovery-link-inner">
<?php
  print l(
    $data['text'],
    $data['link'],
    array(
      'html' => TRUE,
      'attributes' => $data['attributes'],
    )
  );
$sakai_linkurl_base = $_SESSION['article_discovery']['linkurl_base'];
$sakai_linkurl_id = $_SESSION['article_discovery']['linkurl_id'];

$sakai = $sakai_linkurl_id == 'zonecours.hec.ca' && drupal_strlen($sakai_linkurl_base) > 0;

$sakai_url = $sakai_linkurl_base . $data['openurl'];
$sakai_label = 'Importer dans ZoneCours';
?>
     <?php if ($sakai): ?>
    <div class="article-discovery-sakai-import-link"><?php print l($sakai_label, $sakai_url); ?></div>
    <?php endif; ?>
  </div>
</div>
