<?php
/**
 * @package     Auctions
 * @subpackage  com_auctions
 *
 * Detalhe de leilão — redesign "Eixos e Curvas".
 * Mantém a lógica do override anterior (datas dos dois leilões, dados do
 * leiloeiro, acordeão de publicações e coluna lateral "contexto-leilao");
 * markup no vocabulário do redesign, estilos em interno.css.
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

$image     = $this->item->image ? JUri::root() . 'images/auctions/thumbnails/' . $this->item->image : 'com_auctions/no-image.png';
$filepath  = 'uploads/edicts/' . $this->item->file;
$temEdital = $this->item->file && JFile::exists(JPATH_ROOT . '/' . $filepath);

// Segundo leilão futuro → em andamento
$emAndamento = strtotime(date('Y-m-d')) <= strtotime($this->item->date_two);

$document = JFactory::getDocument();
$renderer = $document->loadRenderer('modules');
?>
<article class="edital-detalhe property-item<?php echo $this->pageclass_sfx; ?>">

	<?php if ($this->params->get('show_title', 1)): ?>
	<header class="page-header edital-detalhe-header">
		<span class="eyebrow">Aquisição · Leilão de imóveis</span>
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
					<span class="code">EDITAL <?php echo (int) $this->item->number; ?>/<?php echo $this->item->year; ?> · LEILÃO</span>

					<div class="data-grid data-grid-2">
						<div>
							<div class="k">Data do 1º leilão</div>
							<div class="v"><?php echo JHtml::_('date', strtotime($this->item->date_one), 'd F'); ?></div>
						</div>
						<div>
							<div class="k">Data do 2º leilão</div>
							<div class="v"><?php echo JHtml::_('date', strtotime($this->item->date_two), 'd F'); ?></div>
						</div>
					</div>

					<div class="leiloeiro">
						<span class="k"><?php echo JText::_('COM_AUCTIONS_AUCTIONEER_DATA'); ?></span>
						<p>
							<?php echo JText::_('COM_AUCTIONS_AUCTIONEER_NAME'); ?> <?php echo $this->item->auctioneer_name; ?><br>
							<?php echo JText::_('COM_AUCTIONS_AUCTIONEER_PHONE'); ?> <?php echo $this->item->auctioneer_phone; ?><br>
							<?php echo JText::_('COM_AUCTIONS_AUCTIONEER_SITE'); ?> <?php echo $this->item->auctioneer_site; ?>
						</p>
					</div>

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

			<?php if (trim(strip_tags($this->item->description))): ?>
			<div class="edital-descricao">
				<?php echo $this->item->description; ?>
			</div>
			<?php endif; ?>

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
				<?php echo $renderer->render('contexto-leilao', array('style' => 'container'), null); ?>
			</div>
		</aside>
	</div>

	<input type="hidden" id="numero" value="<?php echo $this->item->number; ?>">
	<input type="hidden" id="ano" value="<?php echo $this->item->year; ?>">
</article>
