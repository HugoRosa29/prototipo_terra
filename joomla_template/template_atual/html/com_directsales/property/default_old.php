<?php
/**
 * @package     Directsales
 * @subpackage  com_directsales
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

$image    = $this->item->image ? JUri::root() . '/images/directsales/previews/' . $this->item->image : 'com_directsales/no-image.png';
$filepath = 'uploads/edicts/' . $this->item->file;

/**
 * Função para exibir data por extenso
 * @Param: data
 * @since: 14/06/2017
 * @author: Josinaldo Júnior
 */
function dataExtenso($data){
	
	$data = explode(" ", $data);
	$dia  = $data[0];
	$mes  = $data[1];
	$ano  = $data[2];
	
	switch ($mes){
		case  1: $mes = "janeiro"; 	 break;
		case  2: $mes = "fevereiro"; break;
		case  3: $mes = "março"; 	 break;
		case  4: $mes = "abril"; 	 break;
		case  5: $mes = "maio"; 	 break;
		case  6: $mes = "junho";	 break;
		case  7: $mes = "julho"; 	 break;
		case  8: $mes = "agosto";    break;
		case  9: $mes = "setembro";  break;
		case 10: $mes = "outubro";   break;
		case 11: $mes = "novembro";  break;
		case 12: $mes = "dezembro";  break;
	}
	return ("$dia $mes $ano");
}
?>
<div class="property-item<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_title', 1)): ?>
		<div class="page-header edital-imoveis">
			<h2>
				<?php echo $this->escape($this->params->get('page_heading')); ?> /
				<?php echo $this->escape($this->item->title); ?>
			</h2>
		</div>
	<?php endif; ?>

	<div class="row edital-imoveis">
			<div class="row">
				<div class="col-md-12">
					<div class="item-description descricao-simples">
						<?php echo $this->item->description; ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="card card-download">
						<figure class="card-img-top card-download-imagem">
							<?php echo JHtml::_('image', $image, $this->item->title, array('class' => 'img-rounded img-rounded img-edital'), true); ?>
						</figure>
						<div class="card-body">
							<a href="<?php echo JUri::root() . $filepath; ?>" class="btn-outline-default" target="_blank">
								<i class="ico-download"></i>
								<span class="btn-outline-texto">BAIXE O EDITAL</span>
							</a>
						</div>
					</div>	
				</div>		
				<div class="col-md-7">
					<div class="item-date card-download-date">
						<span class="bloco-data bloco-border">
							<i class="material-icons date-icon">today</i> 
							<span class="bloco-data-descricao">
								<?php //echo JText::_('COM_DIRECTSALES_DATE_START'); ?> 
								<span class="bloco-data-texto">Data inicial</span>
								<?php //echo dataExtenso(date("d de F", strtotime($this->item->date_start))); ?>
								<?php echo JHtml::_("date", strtotime($this->item->date_start), "d F"); ?>
							</span>
						</span>	
						<span class="bloco-data">
							<!-- <i class="material-icons date-icon">today</i>  -->
							<span class="bloco-data-descricao">
								<?php //echo JText::_('COM_DIRECTSALES_DATE_END'); ?> 
								<span class="bloco-data-texto">Data Final</span>
								<?php //echo dataExtenso(date("d de F", strtotime($this->item->date_end))); ?>
								<?php echo JHtml::_("date", strtotime($this->item->date_end), "d F"); ?>
							</span>	
						</span>
					</div>
					<!-- <?php // if (JFile::exists(JPATH_ROOT . '/' . $filepath)): ?>
						<div class="pull-right">
							<?php //if ($this->item->featured): ?>
								<a href="<?php //echo JRoute::_('index.php?Itemid=' . $this->item->offer_link); ?>" class="btn btn-default" target="_blank"><i class="icon-file-text"></i> <?php //echo JText::_('COM_DIRECTSALES_PURCHASE_OFFER'); ?></a>
							<?php// endif; ?>
							<a href="<?php //echo JUri::root() . $filepath; ?>" class="btn btn-success" target="_blank"><i class="icon-download"></i> <?php //echo JText::_('COM_DIRECTSALES_DOWNLOAD'); ?></a>
						</div>
					<?php //endif; ?> -->
					<?php if(!empty($this->item->location)):?>
						<br>
						<div class="descricao">
							<?php echo $this->item->location;?>
						</div>
					<?php endif;?>
					
					<div class="btn-proposta">
						<?php if ($this->item->featured): ?>
							<a href="<?php echo 'index.php?Itemid=' . $this->item->offer_link; ?>" class="btn-light-default" target="_blank"><i class="ico-download"></i><span class="btn-light-texto"> <?php echo JText::_('COM_DIRECTSALES_PURCHASE_OFFER'); ?></span></a>
						<?php endif; ?>
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
</div>


