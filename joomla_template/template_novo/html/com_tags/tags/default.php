<?php
/**
 * @package     Cleanportal_2019
 * @subpackage  tpl_cleanportal_2019
 *
 * @author      Charles Guedes <charlesgcf@gmail.com>
 * @copyright   Copyright (C) 2019 Capgemini do Brasil. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Note that there are certain parts of this layout used only when there is exactly one tag.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

$description = $this->params->get('all_tags_description');
$descriptionImage = $this->params->get('all_tags_description_image');
?>
<div class="tag-category<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('page_heading')): ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>

	<?php if ($this->params->get('all_tags_show_description_image') && !empty($descriptionImage)): ?>
		<div><?php echo '<img src="' . $descriptionImage . '">'; ?></div>
	<?php endif; ?>

	<?php if (!empty($description)): ?>
		<div><?php echo $description; ?></div>
	<?php endif; ?>

	<?php echo $this->loadTemplate('items'); ?>
</div>