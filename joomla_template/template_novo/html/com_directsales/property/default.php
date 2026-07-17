<?php
/**
 * @package     Directsales
 * @subpackage  com_directsales
 *
 * Detalhe de edital de Venda Direta (Regularização) — redesign "Eixos e Curvas".
 * Mantém a lógica do override anterior (datas de proposta com fallback para as
 * datas de cadastro, botão de proposta para featured, acordeão de publicações);
 * o markup usa o vocabulário do redesign e os estilos ficam em interno.css.
 *
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

// Create shortcuts to some parameters.
$params = $this->item->params;
$user   = JFactory::getUser();

JHtml::_('behavior.caption');

$image    = $this->item->image ? JUri::root() . '/images/directsales/previews/' . $this->item->image : 'com_directsales/no-image.png';
$filepath = 'uploads/edicts/' . $this->item->file;
$temEdital = $this->item->file && JFile::exists(JPATH_ROOT . '/' . $filepath);

// Datas: usa o período de proposta quando definido; senão, o de cadastro
$dataInicial = ($this->item->date_start_prop != '0000-00-00') ? $this->item->date_start_prop : $this->item->date_start;
$dataFinal   = ($this->item->date_end_prop != '0000-00-00') ? $this->item->date_end_prop : $this->item->date_end;

// Carimbo de status pelo período vigente
$hoje      = strtotime(date('Y-m-d'));
$encerrado = ($dataFinal && $dataFinal != '0000-00-00' && $hoje > strtotime($dataFinal));
?>
<article class="edital-detalhe property-item<?php echo $this->pageclass_sfx; ?>">

	<?php if ($this->params->get('show_title', 1)): ?>
	<header class="page-header edital-detalhe-header">
		<span class="eyebrow">Regularização · Venda Direta</span>
		<h2><?php echo $this->escape($this->item->title); ?></h2>
	</header>
	<?php endif; ?>

	<?php if (trim(strip_tags($this->item->description))): ?>
	<div class="edital-descricao">
		<?php echo $this->item->description; ?>
	</div>
	<?php endif; ?>

	<div class="edital-detalhe-grid">
		<figure class="edital-figura plot-frame">
			<?php echo JHtml::_('image', $image, $this->item->title, array('class' => 'img-edital'), true); ?>
			<span class="stamp <?php echo $encerrado ? 'stamp-alerta' : 'stamp-verde'; ?>">
				<?php echo $encerrado ? 'ENCERRADO' : 'ABERTO'; ?>
			</span>
		</figure>

		<div class="edital-dados">
			<span class="code">EDITAL <?php echo (int) $this->item->number; ?>/<?php echo $this->item->year; ?> · VENDA DIRETA</span>

			<div class="data-grid data-grid-2">
				<div>
					<div class="k">Data inicial</div>
					<div class="v"><?php echo JHtml::_('date', strtotime($dataInicial), 'd F'); ?></div>
				</div>
				<div>
					<div class="k">Data final</div>
					<div class="v"><?php echo JHtml::_('date', strtotime($dataFinal), 'd F'); ?></div>
				</div>
			</div>

			<?php if (!empty($this->item->location)): ?>
			<div class="info-location">
				<strong>Localização:</strong> <?php echo $this->item->location; ?>
			</div>
			<?php endif; ?>

			<div class="info-actions">
				<?php if ($temEdital): ?>
				<a href="<?php echo JUri::root() . $filepath; ?>" class="btn btn-line" target="_blank" rel="noopener">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 4v11M7 10l5 5 5-5M5 19h14"/></svg>
					Baixe o edital
				</a>
				<?php endif; ?>
				<?php if ($this->item->featured): ?>
				<a href="https://servicosonline2.terracap.df.gov.br/" class="btn btn-primary" target="_blank" rel="noopener">
					<?php echo JText::_('COM_DIRECTSALES_PURCHASE_OFFER'); ?>
				</a>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if ($this->publications): ?>
	<div class="acordeao-grupo">
		<h3 class="table-heading">Publicações do edital</h3>
		<?php foreach ($this->publications as $i => $publication): ?>
		<details class="acordeao">
			<summary><?php echo $this->escape($publication->title); ?></summary>
			<div class="acordeao-corpo">
				<?php echo $publication->description; ?>
			</div>
		</details>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

	<?php echo $this->item->event->afterDisplayContent; ?>

	<input type="hidden" id="numero" value="<?php echo $this->item->number; ?>">
	<input type="hidden" id="ano" value="<?php echo $this->item->year; ?>">
</article>
