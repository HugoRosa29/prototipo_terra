<?php
/**
 * @package     Faqs
 * @subpackage  com_faqs
 *
 * Perguntas Frequentes (capa) — redesign "Eixos e Curvas".
 * Busca em pílula + categorias em cards plot-frame com as perguntas
 * mais acessadas de cada uma. Mantém a consulta ao modelo de Questions
 * do override anterior.
 *
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Get the configuration object.
$config = JFactory::getConfig();
?>

<div class="faq-pagina<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading', 1)): ?>
		<div class="page-header">
			<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
		</div>
	<?php endif; ?>

	<form class="faq-busca" action="<?php echo JRoute::_('index.php'); ?>" method="post" role="search">
		<div class="busca-barra">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
			<label class="sr-only" for="search-searchword"><?php echo JText::_('COM_FAQS_SEARCH_KEYWORD'); ?></label>
			<input type="search" id="search-searchword" name="searchword" value=""
				placeholder="<?php echo JText::_('COM_FAQS_SEARCH_KEYWORD'); ?>" autocomplete="off">
			<button class="btn btn-primary" type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
		</div>
		<input type="hidden" name="areas[0]" value="questions" />
		<input type="hidden" name="limit" value="<?php echo $config->get('list_limit'); ?>" />
		<input type="hidden" name="searchphrase" value="all" />
		<input type="hidden" name="ordering" value="newest" />
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
	</form>

	<div class="faq-grid">
		<?php foreach ($this->categories as $item): ?>
			<section class="faq-cat plot-frame">
				<h3><?php echo $this->escape($item->title); ?></h3>
				<ul>
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
						<li><a href="<?php echo $question->link; ?>" title="<?php echo $this->escape($question->question); ?>"><?php echo $this->escape($question->question); ?></a></li>
					<?php endforeach; ?>
				</ul>
				<a href="<?php echo JRoute::_(FaqsHelperRoute::getCategoryRoute($item->id)); ?>" class="dev-link">
					<?php echo JText::_('COM_FAQS_SEE_MORE'); ?>
					<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</section>
		<?php endforeach; ?>
	</div>
</div>
