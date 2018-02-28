<?php
/**
 * @file
 * Handles the rendering of a recommendation for a specific search.
 *
 * @param $recommendations
 *   An array of recommendation objects.
 *
 * @param $data
 *   Data for the rendering (right now just $data['ezproxy']).
 */

$recommendations = $variables['recommendations'];
$data = $variables['data'];

?>
<?php if (is_array($recommendations) && count($recommendations)): ?>
<div class="article-discovery-recommendation-list">
  <div class="article-discovery-recommendation-list-buffer">
  <div class="article-discovery-recommendation-content">
    <div class="article-discovery-recommendation-inner">
      <div class="article-discovery-recommendation-text">
		<?php if (count($recommendations) == 1): ?>
		 <?php print t('Recommendation: We found a specialized collection that might help you ...'); ?>
		<?php else: ?>
		 <?php print t('Recommendation: We found some specialized collections that might help you ...'); ?>
		<?php endif; ?>
	  </div>
	<?php foreach ($recommendations as $recommendation) { ?>
	  <div class="article-discovery-recommendation-item">
	  	<a href="<?php print htmlentities($data['ezproxy'] . $recommendation->link, ENT_QUOTES, 'UTF-8'); ?>"><?php print htmlentities($recommendation->title, ENT_COMPAT, 'UTF-8'); ?></a> <?php print htmlentities($recommendation->description, ENT_COMPAT, 'UTF-8'); ?>
	  </div>
	<?php } ?>
      </div>
    </div>
  </div>
</div>
<?php endif;
