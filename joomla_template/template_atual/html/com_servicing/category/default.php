<?php
/**
 * @package     Servicing
 * @subpackage  com_servicing
 *
 * @author      Bruno Batista <bruno.batista@ctis.com.br>
 * @copyright   Copyright (C) 2013 CTIS IT Services. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Include the component helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>
<div class="servicing service-list<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')): ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>

	<div class="page-header">
		<h1>
			<?php echo $this->category->title; ?>
		</h1>
	</div>

	<?php $groups = array_chunk($this->items, 3); ?>
	<?php foreach ($groups as $group): ?>
		<div class="row">
			<?php foreach ($group as $item): ?>
				<div class="col-lg-4">
					<article class="service-item">
						<div class="circle">
							<i class="<?php echo $item->params->get('icon', 'icon-file'); ?> icon-3x"></i>
						</div>
						<h4><a href="<?php echo JRoute::_(ServicingHelperRoute::getServiceRoute($item->slug, $item->catslug)); ?>"><?php echo $this->escape($item->name); ?></a></h4>
						<p><?php echo strip_tags($item->summary); ?></p>
					</article>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>

	<?php if ($this->params->get('show_pagination', 1)): ?>
		<div class="pagination">
			<?php if ($this->params->def('show_pagination_results', 1)): ?>
				<p class="counter">
					<?php echo $this->pagination->getPagesCounter(); ?>
				</p>
			<?php endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
</div>
