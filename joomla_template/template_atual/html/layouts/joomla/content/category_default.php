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

// Note that this layout opens a div with the page class suffix. If you do not use the category children
// layout you need to close this div either by overriding this file or in your main layout.
$params  = $displayData->params;
$extension = $displayData->get('category')->extension;
$canEdit = $params->get('access-edit');
$className = substr($extension, 4);

// This will work for the core components but not necessarily for other components
// that may have different pluralisation rules.
if (substr($className, -1) == 's')
{
	$className = rtrim($className, 's');
}

$tagsData  = $displayData->get('category')->tags->itemTags;
?>
<div class="<?php echo $className . '-category' . $displayData->pageclass_sfx; ?>">
		<div class="page-header">
			<h1>
				<?php if ($params->get('show_page_heading')): ?>
					<?php echo $displayData->escape($params->get('page_heading')); ?>
					<?php if ($displayData->get('category')->title && $params->get('show_category_title', 1)): ?>
						/ <?php echo JHtml::_('content.prepare', $displayData->get('category')->title, '', $extension . '.category'); ?>
					<?php endif; ?>
				<?php else: ?>
					<?php if ($params->get('show_category_title', 1)): ?>
						<?php echo JHtml::_('content.prepare', $displayData->get('category')->title, '', $extension . '.category'); ?>
					<?php endif; ?>
				<?php endif; ?>
			</h1>
		</div>

	<?php if ($displayData->get('show_tags', 1)): ?>
		<?php echo JLayoutHelper::render('joomla.content.tags', $tagsData); ?>
	<?php endif; ?>

	<?php if ($params->get('show_description', 1) || $params->def('show_description_image', 1)): ?>
		<div class="category-desc">
			<?php if ($params->get('show_description_image') && $displayData->get('category')->getParams()->get('image')): ?>
				<img src="<?php echo $displayData->get('category')->getParams()->get('image'); ?>"/>
			<?php endif; ?>
			<?php if ($params->get('show_description') && $displayData->get('category')->description): ?>
				<?php echo JHtml::_('content.prepare', $displayData->get('category')->description, '', $extension . '.category'); ?>
			<?php endif; ?>
			<div class="clr"></div>
		</div>
	<?php endif; ?>

	<?php echo $displayData->loadTemplate($displayData->subtemplatename); ?>

	<?php if ($displayData->get('children') && $displayData->maxLevel != 0): ?>
		<div class="cat-children">
			<h3>
				<?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?>
			</h3>

			<?php echo $displayData->loadTemplate('children'); ?>
		</div>
	<?php endif; ?>
</div>
