<?php
/**
 * @package     Auctions
 * @subpackage  com_auctions
 *
 * @author      Charles Guedes <charles.fernandes@capgemini.com>
 * @copyright   Copyright (C) 2018 Capgemini do Brasil. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

// Create shortcuts to some parameters.
$params = $this->item->params;
$user   = JFactory::getUser();

// Load the tooltip behavior script.
JHtml::_('behavior.caption');

$image    = $this->item->image ? JUri::root() . '/images/auctions/previews/' . $this->item->image : 'com_auctions/no-image.png';
$filepath = 'uploads/edicts/' . $this->item->file;

?>
<?php //echo '<pre>'; var_dump($this->item); ?>
<div class="property-item<?php echo $this->pageclass_sfx; ?>">
   	<?php if ($this->params->get('show_title', 1)): ?>
   	<div class="page-header">
      	<h2>
			<?php echo $this->escape($this->item->title); ?>
      	</h2>
   	</div>
   <?php endif; ?>

	<div class="row edital-imoveis">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-5">
					<div class="card card-download">
						<figure class="card-img-top card-download-imagem">
							 <?php $image = $this->item->image ? JUri::root() . 'images/auctions/thumbnails/' . $this->item->image : 'com_biddings/no-image.png'; ?>
							<?php echo JHtml::_('image', $image, $this->item->title, array('class' => 'img-rounded img-rounded img-edital'), true); ?>
						</figure>
						<div class="card-body">
							<?php if (JFile::exists(JPATH_ROOT . '/' . $filepath)): ?>
								<a href="<?php echo JUri::root() . $filepath; ?>" target="_blank" role="button" class="btn-outline-default">
								<i class="ico-download"></i>
								<span class="btn-outline-texto">BAIXE O EDITAL</span>
								</a>
							<?php endif; ?>
						</div>
					</div>
						
				</div>		
				<div class="col-md-7">
					<div class="item-date card-download-date">
						<span class="bloco-data bloco-border">
							<i class="material-icons date-icon">today</i> 
							<span class="bloco-data-descricao">
								<?php //echo JText::_('COM_DIRECTSALES_DATE_START'); ?> 
								<span class="bloco-data-texto">DATA DO 1º LEILÃO</span>
								<?php //echo dataExtenso(date("d de F", strtotime($this->item->date_start))); ?>
								<?php echo JHtml::_("date", strtotime($this->item->date_one), "d F"); ?>
							</span>
						</span>	
						<span class="bloco-data">
							<!-- <i class="material-icons date-icon">today</i>  -->
							<span class="bloco-data-descricao">
								<?php //echo JText::_('COM_DIRECTSALES_DATE_END'); ?> 
								<span class="bloco-data-texto">DATA DO 2º LEILÃO</span>
								<?php //echo dataExtenso(date("d de F", strtotime($this->item->date_end))); ?>
								<?php echo JHtml::_("date", strtotime($this->item->date_two), "d F"); ?>
							</span>	
						</span>
					</div>
					<br>
					<div class="item-date card-download-date">
						<span class="bloco-data">
							<i class="material-icons date-icon">gavel</i>
							<span class="bloco-data-descricao">
								<span class="bloco-data-texto"><?php echo JText::_('COM_AUCTIONS_AUCTIONEER_DATA'); ?></span>
								<span class="dados-leiloeiro">
									<?php echo JText::_('COM_AUCTIONS_AUCTIONEER_NAME'); ?> <?php echo $this->item->auctioneer_name; ?><br>
									<span class="bloco-data-texto"><?php echo JText::_('COM_AUCTIONS_AUCTIONEER_PHONE'); ?> <?php echo $this->item->auctioneer_phone; ?></span>
										 
									 <span class="bloco-data-texto"><?php echo JText::_('COM_AUCTIONS_AUCTIONEER_SITE'); ?> <?php echo $this->item->auctioneer_site; ?></span>
									
								 </span>
							</span>
						</span>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="item-description descricao-simples">
						<?php echo $this->item->description; ?>
					</div>
				</div>
			</div>
			<?php if ($this->publications): ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel-group accordion-default" id="accordion">
						<?php foreach ($this->publications as $i => $publication): ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" class="collapsed">
											<i class="material-icons accordion-default-icone">add</i> 
											<span><?php echo $this->escape($publication->title); ?></span>
										</a>
									</h4>
								</div>
								<div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
									<div class="panel-body accordion-default-body">
										<?php echo $publication->description; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>		
			<?php endif; ?>
			<?php echo $this->item->event->afterDisplayContent; ?>
		</div>
		<div class="col-md-4">
			<div class="interna-direita">
				<?php 
					// Monta posição virtual para escrever módulos
					$document = JFactory::getDocument();
					$renderer = $document->loadRenderer('modules');
					$position = "contexto-leilao";
					$options = array('style' => 'container');
					echo $renderer->render($position, $options, null);
				?>
			</div>	
		</div>
		
		<input type="hidden" id="numero" value="<?php echo $this->item->number; ?>">
		<input type="hidden" id="ano" value="<?php echo $this->item->year; ?>">
	</div>
</div>