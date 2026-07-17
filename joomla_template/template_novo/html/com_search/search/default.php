<?php
/**
 * Resultados de busca (com_search) — redesign "Eixos e Curvas".
 * Barra de busca em pílula (mesma linguagem do overlay do cabeçalho),
 * opções de correspondência/ordenação em selects estilizados e
 * contagem de resultados em rótulo mono.
 */

// no direct access
defined('_JEXEC') or die;
require __DIR__ . '/_helper.php';
$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();
?>
<div class="busca-interna">

	<h2>
		<?php if ($this->escape($this->params->get('page_heading'))): ?>
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		<?php else: ?>
			<?php echo $this->escape($this->params->get('page_title')); ?>
		<?php endif; ?>
	</h2>

	<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search'); ?>" method="post">
		<div class="busca-barra">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
			<label class="sr-only" for="search-searchword">Estou pesquisando</label>
			<input type="search" name="searchword" id="search-searchword"
				maxlength="<?php echo $upper_limit; ?>"
				value="<?php echo $this->escape($this->origkeyword); ?>"
				placeholder="Buscar editais, serviços, notícias…" autocomplete="off">
			<button type="submit" class="btn btn-primary"><?php echo JText::_('COM_SEARCH_SEARCH'); ?></button>
		</div>

		<div class="busca-opcoes">
			<label>
				<span class="k">Correspondência</span>
				<?php TemplateSearchHelper::displaySearchPhrase(); ?>
			</label>
			<label>
				<span class="k">Ordenar por</span>
				<?php TemplateSearchHelper::displaySearchOrdering(); ?>
			</label>
		</div>
		<input type="hidden" name="task" value="search" />
	</form>

	<?php if (!empty($this->searchword)): ?>
		<p class="busca-contagem coord"><?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', $this->total); ?></p>
	<?php endif; ?>

	<?php if ($this->error == null && count($this->results) > 0):
		echo $this->loadTemplate('results');
	else:
		echo $this->loadTemplate('error');
	endif; ?>

	<?php if ($this->total > 0): ?>
		<div class="pagination">
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
</div>
