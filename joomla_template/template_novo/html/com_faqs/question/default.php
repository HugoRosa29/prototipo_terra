<?php
/**
 * @package     Faqs
 * @subpackage  com_faqs
 *
 * Detalhe de pergunta (FAQ) — redesign "Eixos e Curvas".
 * A resposta herda a tipografia de artigo (.item-page em interno.css);
 * a pergunta vira o título da página e as tags mantêm o padrão do site.
 *
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
require __DIR__ . '/_helper.php';

// Create shortcuts to some parameters.
$params  = $this->item->params;
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();

JHtml::_('behavior.caption');
?>
<div class="faqs question-item item-page<?php echo $this->pageclass_sfx; ?>">

	<?php if ($this->params->get('show_page_heading', 1)): ?>
		<span class="eyebrow"><?php echo $this->escape($this->params->get('page_heading')); ?></span>
	<?php endif; ?>

	<div class="page-header">
		<h1><?php echo $this->escape($this->item->question); ?></h1>
	</div>

	<?php echo $this->item->text; ?>

	<?php echo $this->item->event->afterDisplayContent; ?>

	<?php if (isset($this->item->metakey) && !empty($this->item->metakey)): ?>
		<div class="lista-tags">
			tags:
			<?php TemplateFaqQuestionHelper::displayMetakeyLinks($this->item->metakey); ?>
		</div>
	<?php endif; ?>
</div>
