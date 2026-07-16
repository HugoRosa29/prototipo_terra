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

// Get the application.
$app = JFactory::getApplication('site');
?>

<?php if ($this->params->get('show_page_heading')): ?>
<h2>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
</h2>	
<?php endif; ?>

<div id="listagem-compre-imoveis" class="lista-imoveis">
	<div class="row">
	<div class="col-md-4 offset-md-8">
				<form action="<?php echo JUri::getInstance()->toString(); ?>" method="get" class="property-toolbar">
					<div class="lista-imoveis-filtros">
						<span class="lista-imoveis-filtrar">Filtre por anos</span>
						<div class="lista-imoveis-btn">
							<?php foreach ($this->years as $year): ?>
								<input type="submit" class="btn btn-outline-dark btn-filtro-ano <?php echo $this->state->get('filter.year') == $year ? 'ativo' : ''; ?>" name="year" value="<?php echo $this->escape($year); ?>">
							<?php endforeach; ?>

							<?php if(!empty($this->yearsOld)):?>
								<div id="btnYear" class="btn-group dropdown" role="group">
									<button id="btnGroupDrop1" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										MAIS
									</button>
									<div class="dropdown-menu dropdown-year" aria-labelledby="btnGroupDrop1">
										<?php foreach ($this->yearsOld as $year): ?>
											<?php $menus = $app->getMenu(); ?>
											<a href="<?php echo JRoute::_($app->getMenu()->getActive()->link) . '?year=' . $year; ?>" class="dropdown-item<?php echo $this->state->get('filter.year') == $year ? ' active' : ''; ?>"><?php echo $this->escape($year); ?></a>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endif;?>

						</div>
					</div>
				</form>		
			</div>

		<?php foreach ($this->items as $item): ?>
			<?php //echo '<pre>'; var_dump($item); ?>
			<?php if($item->state <> 0):?>
		<div class="col-md-4">
			<div class="lista-imoveis-item">
				<figure>
					<a href="<?php echo JRoute::_(DirectsalesHelperRoute::getPropertyRoute($item->slug)); ?>" class="">
						<?php if ($item->image): ?>
							<?php echo JHtml::_('image', JUri::root() . '/images/directsales/thumbnails/' . $item->image, $item->title, array('class' => 'lista-imoveis-imagem'), true); ?>
						<?php else: ?>
							<?php echo JHtml::_('image', 'com_directsales/no-image.png', $item->title, null, true); ?>
						<?php endif; ?>
					</a>
				</figure>
				<?php //echo '<pre>'; var_dump($item) ;?>
				<div class="status">
					<?php if($item->show_sketch == 0): ?>
						<span class="tipo">CADASTRO</span>
						<?php if($item->statuscad): ?>
						<span class="situacao 
								<?php 
									$statuscad = strtolower($item->statuscad);
									//die($statuscad);
									switch ($statuscad) {
										case 'disponível':
											echo 'aberto';
											break;
										case 'aberto':
											echo 'aberto';
											break;
										case 'encerrado':
											echo 'encerrado';
											break;
										default:
											echo 'em-analise';
											break;
								}?>"><?php echo strtoupper( $statuscad); ?></span>
						<?php else: ?>
							<span class="situacao "></span>
						<?php endif; ?>
						<span class="data"> De <?php echo date("d/m", strtotime($item->date_start)); ?> a <?php echo date("d/m", strtotime($item->date_end)); ?></span>
					<?php else: ?>
						<span class="tipo">PROPOSTA</span>
						<?php if($item->statusprop): ?>
						<span class="situacao 
								<?php 
									$statusprop = strtolower($item->statusprop);
									//die($statusprop);
									switch ($statusprop) {
										case 'disponível':
											echo 'disponivel';
											break;
										case 'aberto':
											echo 'aberto';
											break;
										case 'encerrado':
											echo 'encerrado';
											break;
										default:
											echo 'em-analise';
											break;
								}?>"><?php echo strtoupper( $statusprop); ?></span>
						<?php else: ?>
							<span class="situacao "></span>
						<?php endif; ?>
						
						<span class="data"> De <?php echo date("d/m", strtotime($item->date_start_prop)); ?> a <?php echo date("d/m", strtotime($item->date_end_prop)); ?></span>
					<?php endif; ?>

				</div>
				<?php if ($item->params->get('show_title', 1)): ?>
					<h3 class="lista-imoveis-titulo"><a href="<?php echo JRoute::_(DirectsalesHelperRoute::getPropertyRoute($item->slug)); ?>" class="lista-imoveis-link"><?php echo $item->location; ?></a></h3>
				<?php endif ?>
				<div class="lista-imoveis-info">
					<?php echo $item->title; ?>
				</div>
			</div>
		</div>
				<?php endif;?>
		<?php endforeach; ?>
	</div>
</div>
