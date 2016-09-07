<?php
/**
 * @file
 * Formats the facets for the search.
 *
 * @param $refine
 *
 * @param $limits
 *
 * @param $facets_applied
 *
 * @param $facets_available
 *
 */

  if (!isset($limits['num-terms'])) {
    $limits['num-terms'] = variable_get('article_discovery_initial_facet_terms', 6);
  }
?>
<div class="article-discovery-facets">
  <div class="article-discovery-facets-content">
    <div class="article-discovery-quick-options">
      <div><input type="checkbox" <?php print $refine['scholarly']['checked']; ?> name="scholarly" onclick="document.location.href='<?php print $refine['scholarly']['url']; ?>';"><label for=""><?php print t('Limit to articles from scholarly journals'); ?></label></div>
      <div><input type="checkbox" <?php print $refine['heconly']['checked']; ?> name="heconly" onclick="document.location.href='<?php print $refine['heconly']['url']; ?>';"><label for="">Limiter au catalogue de la bibliothèque</label></div>
      <div><input type="checkbox" <?php print $refine['newspapers']['checked']; ?> name="newspapers" onclick="document.location.href='<?php print $refine['newspapers']['url']; ?>';"><label for=""><?php print t('Exclude newspaper articles'); ?></label></div>
      <div><input type="checkbox" <?php print $refine['fulltext']['checked']; ?> name="fulltext" onclick="document.location.href='<?php print $refine['fulltext']['url']; ?>';"><label for=""><?php print t('Limit to articles with full text online'); ?></label></div>
      <div><input type="checkbox" <?php print $refine['local']['checked']; ?> name="local" onclick="document.location.href='<?php print $refine['local']['url']; ?>';"><label for=""><?php print t('Add results beyond this library\'s holdings'); ?></label></div>
    </div>
    <ul class="article-discovery-facets-applied">
<?php foreach ($facets_applied as $facet) {?>
      <li><a href="<?php print $facet['url'] ?>" ref="<?php print t(htmlentities($facet['action'], ENT_QUOTES, 'UTF-8')); ?>"><?php print htmlentities($facet['display'], ENT_COMPAT, 'UTF-8'); ?></a></li>
<?php } ?>
    </ul>
<div class="article-discovery-facets-available">
<?php $j = 0; ?>
<?php foreach ($facets_available as $facet => $terms) { ?>
<?php   if (count($terms) <= $limits['num-terms']) { ?>
  <dl>
    <dt><?php print t(htmlentities($facet, ENT_COMPAT, 'UTF-8')); ?></dt>
<?php for ($i=0; $i < count($terms); ++$i) { ?>
    <dd><a href="<?php print $terms[$i]['url']; ?>"><?php print t(htmlentities($terms[$i]['display'], ENT_COMPAT, 'UTF-8')); ?></a> (<?php print $terms[$i]['count']; ?>)</dd>
<?php } //For loop ?>
  </dl>
<?php }
      else { ?>
<?php   ++$j; ?>
  <dl>
    <dt><?php print t(htmlentities($facet, ENT_COMPAT, 'UTF-8')); ?></dt>
<?php   for ($i=0; $i < $limits['num-terms'] ; ++$i) { ?>
    <dd><a href="<?php print $terms[$i]['url']; ?>"><?php print t(htmlentities($terms[$i]['display'], ENT_COMPAT, 'UTF-8')); ?></a> (<?php print $terms[$i]['count']; ?>)</dd>
<?php   } //For loop ?>
    <dd class="more-facets-<?php print $j; ?>"><a href="#More Options" onclick="$('.more-facets-<?php print $j; ?>').toggle(); return false;"><?php print t('more...')?></a></dd>
  </dl>
  <dl class="more-facets-<?php print $j; ?> js-hide">
<?php   for (; $i < count($terms); ++$i) { ?>
    <dd><a href="<?php print $terms[$i]['url']; ?>"><?php print t(htmlentities($terms[$i]['display'], ENT_COMPAT, 'UTF-8')); ?></a> (<?php print $terms[$i]['count']; ?>)</dd>
<?php   } //For loop ?>
    <dd><a href="#Less Options" onclick="$('.more-facets-<?php print $j; ?>').toggle(); return false;"><?php print t('less...')?></a></dd>
  </dl>

<?php   } //else ?>
<?php } //foreach loop ?>
    </div>
  </div>
</div>
