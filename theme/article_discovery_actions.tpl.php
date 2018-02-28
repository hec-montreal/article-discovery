<?php
/**
 * @file
 * Handles the display of an action bar for interacting with selected articles.
 *
 * This uses javascript to swap between an interactive and non-interactive
 * version of the action bar.
 *
 * @param $selected
 *   The number of selected items at the time of page-load.
 * @param $state
 *   Some state information for the rendering.
 */
 
 $selected = $variables['selected'];
 $selected_count = count($selected);
 $state    = $variables['state'];
?>
<div class="article-discovery-action-bar">
  <div>
  <span class="article-discovery-action-selected-actions<?php if ($selected_count != 0) print " js-hide"; ?>">
    <span class="article-discovery-selected-items"><?php print t('Selected items'); ?> (<span class="article-discovery-selected-count"><?php print count($selected); ?></span>):</span>
    <span class="article-discovery-select-list"><?php print t('List'); ?></span> |
    <span><?php print t('Email'); ?></span> |
    <span><?php print t('Export as RIS'); ?> </span> |
<?php if (isset($state['refworks']) && $state['refworks']): ?>
    <span><?php print t('Export to Refworks'); ?></span> |
<?php endif; ?>
    <span><?php print t('Clear'); ?></span>
  </span>
  <span class="article-discovery-action-selected-actions<?php if ($selected_count == 0) print " js-hide"; ?>">
    <span class="article-discovery-selected-items"><?php print t('Selected items'); ?> (<span class="article-discovery-selected-count"><?php print count($selected); ?></span>):</span>
    <span class="article-discovery-select-list"><a href="selection"><?php print t('List'); ?></a></span> |
    <span id="article-discovery-select-email"><a href="export/email?destination=<?php print htmlentities(rawurlencode(drupal_substr(request_uri(), 1)), ENT_QUOTES, 'UTF-8'); ?>" title="<?php print t('Email selected items'); ?>"><?php print t('Email'); ?></a></span> |
    <span id="article-discovery-select-export"><a href="export/ris" title="<?php print t('Export selected items as RIS'); ?>"><?php print t('Export as RIS'); ?></a></span> |
<?php if (isset($state['refworks']) && $state['refworks']): ?>
    <span id="article-discovery-select-export"><a href="export/refworks" title="<?php print t('Export selected items to Refworks'); ?>" target="_blank"><?php print t('Export to Refworks'); ?></a></span> |
<?php endif; ?>
    <span id="article-discovery-select-clear"><a href="#clear-selection" onclick="return false;"><?php print t('Clear'); ?></a></span>
  </span>
  </div>
  <div>
<?php if (!(isset($state['details']) && $state['details'])): ?>
  <span class="article-discovery-action-select-all article-discovery-record-selection"><span id="article-discovery-select-all"><input type="checkbox" id="select-all-checkbox" name="select-all-checkbox"/></span> <label for="select-all-checkbox"><?php print t('Select All on This Page'); ?></label></span>
<?php endif; ?>
  </div>
</div>
