<?php
/**
* @package     Biddings
* @subpackage  com_biddings
*
* @author      Bruno Batista <bruno.batista@ctis.com.br>
* @copyright   Copyright (C) 2013 CTIS IT Services. All rights reserved.
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

$image    = $this->item->image ? JUri::root() . '/images/biddings/previews/' . $this->item->image : 'com_biddings/no-image.png';
$filepath = 'uploads/edicts/' . $this->item->file;

?>

<?php //echo '<pre>'; var_dump($this->item->image); ?>
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
							
							<?php if (json_decode($this->item->image)): ?>
                                <?php $image = $this->item->image ? JUri::root() . 'images/biddings/thumbnails/' . json_decode($this->item->image)[0] : 'com_biddings/no-image.png'; ?>
                            <?php elseif ($this->item->image): ?>
                                <?php $image = $this->item->image ? JUri::root() . 'images/biddings/thumbnails/' . $this->item->image : 'com_biddings/no-image.png'; ?>
                            <?php endif ?>
                            <?php echo JHtml::_('image', $image, $this->item->title, "class=\"img-rounded img-rounded img-edital\"", true); ?>

						</figure>
						<div class="card-body">

							<?php $filepath = 'uploads/edicts/' . $this->item->file; ?>
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
								<span class="bloco-data-texto"><?php echo JText::_('COM_BIDDINGS_DATE_DEPOSIT'); ?></span>
								<?php echo JHtml::_("date", strtotime($this->item->date_deposit), 'd F Y'); ?>
							</span>
						</span>	
						<span class="bloco-data">
							<span class="bloco-data-descricao">
								<span class="bloco-data-texto"><?php echo JText::_('COM_BIDDINGS_DATE_BIDDING'); ?></span>
								<?php echo JHtml::_("date", strtotime($this->item->date_bidding), 'd F Y'); ?>
							</span>	
						</span>
					</div>
					<br />
					<br />
					<div class="item-date text-justify">
						<span class="bloco-data bloco-border">
						<?php if(!empty($this->item->location)):  ?>
							<i class="material-icons location_on-icon">location_on</i>
							<span class="bloco-data-descricao">
								<span class="bloco-data-texto"><?php echo $this->item->location; ?></span>
							</span>
						<?php endif;  ?>	
						</span>
					</div>
				</div>
			</div>
			<div class="row mega-btn">
				<?php if( strtotime(date("Y-m-d")) <= strtotime($this->item->date_bidding) )  : //echo '<pre>'; var_dump($this->item); exit;?>
					<?php if($this->item->show_imoveis_disponiveis != 0 || $this->item->show_imoveis_disponiveis == '' ) : ?>
							<div class="col-md-12 mb-4">
								<div class="btn-ver-imoveis-disponives">
									<a target="_blank" href="https://comprasonline.terracap.df.gov.br/" role="button" class="btn-light-default">
										<span class="btn-light-texto"><?php echo JText::_('COM_BIDDINGS_IMOVEIS_DISPONIVEIS'); ?></span>
									</a>
								</div>
							</div>
					<?php endif;?>	
					<?php if($this->item->show_proposta_online != 0 || $this->item->show_proposta_online == '') :?>
						<?php if($this->item->id != 237 ): ?>
								<div class="col-md-4">
									<div class="btn-ver-imoveis">
										<a target="_blank" href="https://comprasonline.terracap.df.gov.br/" role="button" class="btn-light-default">
											<span class="btn-light-texto">Preencha proposta <span>online</span></span>
										</a>
									</div>
								</div>
						<?php endif; ?>
					<?php endif; ?>

					<div class="col-md-4">
						<div class="btn-ficha">
							<a target="_blank" href="https://servicosonline.terracap.df.gov.br/" class="btn-light-default">
								<span class="btn-light-texto">Preencha proposta <span>presencial</span></span>
							</a>
						</div>
					</div>
				<?php endif; ?>
				<div class="col-md-4">
					<div class="btn-ver-resultado">
						<a target="_blank" href="https://comprasonline.terracap.df.gov.br/bidding/external/index?edict_year=<?php echo $this->item->year; ?>&edict_number=<?php echo (int)$this->item->number; ?>" class="btn-light-default">
							<span class="btn-light-texto"><span>Resultado do <br>edital</span></span>
						</a>
					</div>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-md-12">
					<div class="item-description descricao-simples ">
						<?php /* echo $this->item->description;*/ ?>
					</div>
				</div>
			</div> -->
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
	            $position = "contexto-licitacao";
	            $options = array('style' => 'container');
	            echo $renderer->render($position, $options, null);
	            ?>
      		</div>	
		</div>

		
		<input type="hidden" id="numero" value="<?php echo $this->item->number; ?>">
		<input type="hidden" id="ano" value="<?php echo $this->item->year; ?>">
	</div>
</div>
