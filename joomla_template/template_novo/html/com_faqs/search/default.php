<?php
/**
 * @package     Faqs
 * @subpackage  com_faqs
 *
 * @author      Bruno Batista <bruno.batista@ctis.com.br>
 * @copyright   Copyright (C) 2013 CTIS IT Services. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Get the configuration object.
$config = JFactory::getConfig();
?>

<div class="faq-search<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading', 1)): ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>
	<form action="<?php echo JRoute::_('index.php');?>" method="post" role="form">
		<div class="form-group">
			<div class="input-group">
				<input type="text" id="search-searchword" class="form-control input-lg" name="searchword" value="" placeholder="<?php echo JText::_('COM_FAQS_SEARCH_KEYWORD'); ?>" size="30" />
				<span class="input-group-btn">
					<button class="btn btn-success btn-lg" type="submit"><i class="icon-search"></i> <span><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></span></button>
				</span>
			</div>
		</div>
		<div>
			<input type="hidden" name="areas[0]" value="questions" />
			<input type="hidden" name="limit" value="<?php echo $config->get('list_limit'); ?>" />
			<input type="hidden" name="searchphrase" value="all" />
			<input type="hidden" name="ordering" value="newest" />
			<input type="hidden" name="task" value="search" />
			<input type="hidden" name="option" value="com_search" />
		</div>
	</form>
	<br><br><br>
	<div class="faq-itens">
	<?php $groups = array_chunk($this->categories, 3); ?>
	<?php foreach ($groups as $group): ?>
		<div class="row">
			<?php foreach ($group as $item): ?>
				<div class="col-md-12">
					<div class="page-header">
						<h4><?php echo $this->escape($item->title); ?></h4>
					</div>
					<ul class="list-unstyled">
						<?php
						// Get the application.
						$app = JFactory::getApplication('site');

						// Get an instance of the generic faqs model.
						$model = JModelLegacy::getInstance('Questions', 'FaqsModel', array('ignore_request' => true));
						$model->setState('filter.category_id', $item->id);
						$model->setState('filter.state', 1);
						$model->setState('list.limit', 5);
						$model->setState('list.ordering', 'a.hits');
						$model->setState('list.direction', 'DESC');

						$params = $app->getParams();
						$model->setState('params', $params);

						foreach ($model->getItems() as $question): ?>
							<li><a href="<?php echo $question->link; ?>" title="<?php echo $this->escape($question->question); ?>"> <?php echo $this->escape($question->question); ?></a></li>
						<?php endforeach; ?>
					</ul>
					<a href="<?php echo JRoute::_(FaqsHelperRoute::getCategoryRoute($item->id)); ?>" class="btn btn-link btn-sm pull-right readmore"><?php echo JText::_('COM_FAQS_SEE_MORE'); ?></a>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>
	</div>
</div>
