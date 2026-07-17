<?php
/**
 * @package     Biddings
 * @subpackage  com_biddings
 *
 * Detalhe de edital de licitação — redesign "Eixos e Curvas".
 * Mantém a lógica do override anterior (datas de caução/licitação, botões de
 * proposta condicionados à data e aos parâmetros do edital, acordeão de
 * publicações e coluna lateral "contexto-licitacao"); markup no vocabulário
 * do redesign, estilos em interno.css.
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

// Imagem: campo pode ser JSON (galeria) ou nome de arquivo simples
if (json_decode($this->item->image)) {
	$image = JUri::root() . 'images/biddings/thumbnails/' . json_decode($this->item->image)[0];
} elseif ($this->item->image) {
	$image = JUri::root() . 'images/biddings/thumbnails/' . $this->item->image;
} else {
	$image = 'com_biddings/no-image.png';
}

$filepath  = 'uploads/edicts/' . $this->item->file;
$temEdital = $this->item->file && JFile::exists(JPATH_ROOT . '/' . $filepath);

// Licitação futura → edital em andamento
$emAndamento = strtotime(date('Y-m-d')) <= strtotime($this->item->date_bidding);

$comprasOnline = 'https://comprasonline-homol.terracap.df.gov.br';

$document = JFactory::getDocument();
$renderer = $document->loadRenderer('modules');
?>
<article class="edital-detalhe property-item<?php echo $this->pageclass_sfx; ?>">

	<?php if ($this->params->get('show_title', 1)): ?>
	<header class="page-header edital-detalhe-header">
		<span class="eyebrow">Aquisição · Licitação de imóveis</span>
		<h2><?php echo $this->escape($this->item->title); ?></h2>
	</header>
	<?php endif; ?>

	<div class="aba-grid">
		<div>
			<div class="edital-detalhe-grid">
				<figure class="edital-figura plot-frame">
					<?php echo JHtml::_('image', $image, $this->item->title, array('class' => 'img-edital'), true); ?>
					<span class="stamp <?php echo $emAndamento ? 'stamp-verde' : 'stamp-alerta'; ?>">
						<?php echo $emAndamento ? 'EM ANDAMENTO' : 'ENCERRADO'; ?>
					</span>
				</figure>

				<div class="edital-dados">
					<span class="code">EDITAL <?php echo (int) $this->item->number; ?>/<?php echo $this->item->year; ?> · LICITAÇÃO</span>

					<div class="data-grid data-grid-2">
						<div>
							<div class="k"><?php echo JText::_('COM_BIDDINGS_DATE_DEPOSIT'); ?></div>
							<div class="v"><?php echo JHtml::_('date', strtotime($this->item->date_deposit), 'd F Y'); ?></div>
						</div>
						<div>
							<div class="k"><?php echo JText::_('COM_BIDDINGS_DATE_BIDDING'); ?></div>
							<div class="v"><?php echo JHtml::_('date', strtotime($this->item->date_bidding), 'd F Y'); ?></div>
						</div>
					</div>

					<?php if (!empty($this->item->location)): ?>
					<div class="info-location">
						<strong>Localização:</strong> <?php echo $this->item->location; ?>
					</div>
					<?php endif; ?>

					<?php if ($temEdital): ?>
					<div class="info-actions">
						<a href="<?php echo JUri::root() . $filepath; ?>" class="btn btn-line" target="_blank" rel="noopener">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 4v11M7 10l5 5 5-5M5 19h14"/></svg>
							Baixe o edital
						</a>
					</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="edital-acoes">
				<?php if ($emAndamento): ?>
					<?php if ($this->item->show_imoveis_disponiveis != 0 || $this->item->show_imoveis_disponiveis == ''): ?>
						<a target="_blank" rel="noopener" href="<?php echo $comprasOnline; ?>/" class="btn btn-primary">
							<?php echo JText::_('COM_BIDDINGS_IMOVEIS_DISPONIVEIS'); ?>
						</a>
					<?php endif; ?>
					<?php if ($this->item->show_proposta_online != 0 || $this->item->show_proposta_online == ''): ?>
						<?php if ($this->item->id != 237): ?>
							<a target="_blank" rel="noopener" href="<?php echo $comprasOnline; ?>/editais/detalhar/<?php echo (int) $this->item->number; ?>/<?php echo $this->item->year; ?>" class="btn btn-line">
								Preencha proposta online
							</a>
						<?php endif; ?>
					<?php endif; ?>
					<a target="_blank" rel="noopener" href="<?php echo $comprasOnline; ?>/" class="btn btn-line">
						Preencha proposta presencial
					</a>
				<?php endif; ?>
				<a target="_blank" rel="noopener" href="<?php echo $comprasOnline; ?>/bidding/external/index?edict_year=<?php echo $this->item->year; ?>&edict_number=<?php echo (int) $this->item->number; ?>" class="btn btn-line">
					Resultado do edital
				</a>
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
		</div>

		<aside>
			<div class="interna-direita">
				<?php echo $renderer->render('contexto-licitacao', array('style' => 'container'), null); ?>
			</div>
		</aside>
	</div>

	<input type="hidden" id="numero" value="<?php echo $this->item->number; ?>">
	<input type="hidden" id="ano" value="<?php echo $this->item->year; ?>">
</article>
