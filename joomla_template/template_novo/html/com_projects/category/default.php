<?php
/**
 * @package     Projects
 * @subpackage  com_projects
 *
 * @author      Bruno Batista <bruno.batista@ctis.com.br>
 * @copyright   Copyright (C) 2013 CTIS IT Services. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Include the component helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Load the popover bootstrap script.
JHtml::_('bootstrap.popover', '.project a', array('placement' => 'top'));
?>
<div class="project-list<?php echo $this->pageclass_sfx; ?>">
	<div class="page-header">
		<h2>
			<?php if ($this->params->get('show_page_heading')): ?>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			<?php endif; ?>
			<?php if ($this->params->get('show_page_heading') && $this->category->title): ?>/<?php endif ?>
			<?php echo $this->category->title; ?>
		</h2>
	</div>

	<?php $groups = array_chunk($this->items, 6); ?>
	<?php foreach ($groups as $group): ?>
		<div class="row">
			<?php foreach ($group as $item): ?>
				<div class="col-md-4">
					<div class="project">
						<figure>
							<?php if ($item->summary): ?>
								<a href="<?php echo JRoute::_(ProjectsHelperRoute::getProjectRoute($item->slug, $item->catslug)); ?>" data-title="<?php echo htmlspecialchars($item->name); ?>" data-content="<?php echo htmlspecialchars($item->summary); ?>">
							<?php else: ?>
								<a href="<?php echo JRoute::_(ProjectsHelperRoute::getProjectRoute($item->slug, $item->catslug)); ?>">
							<?php endif; ?>
								<?php $image = $item->image ? JUri::root() . '/images/projects/thumbnails/' . $item->image : 'com_projects/no-image.png'; ?>
								<?php echo JHtml::_('image', $image, $item->name, null, true); ?>
							</a>
						</figure>
						<article>
							<h5>
								<a href="<?php echo JRoute::_(ProjectsHelperRoute::getProjectRoute($item->slug, $item->catslug)); ?>"><?php echo htmlspecialchars($item->name); ?></a>
							</h5>
						</article>
					</div>
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
