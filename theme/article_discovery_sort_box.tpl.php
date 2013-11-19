<?php
/**
 * @file
 * Outputs a select box inside a div.  Why didn't we use drupal_get_form?  We didn't want actual form tags around the select box.
 *
 * @param $options
 *   Array of options for the select box.
 *
 */

 ?>
<div class="article-discovery-sort-select">
  <?php print t('Sort:'); ?>
 <select onchange="document.location.href=this.options[this.selectedIndex].value">
<?php foreach ($options as $option) { ?>
    <option value="<?php print $option['value']; ?>"<?php if ($option['selected']) print ' selected="selected"'; ?>><?php print $option['display']; ?></option>
<?php } ?>
 </select>
</div>
