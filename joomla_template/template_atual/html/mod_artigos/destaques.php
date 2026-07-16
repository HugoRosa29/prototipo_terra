<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<div class="listagem-capa-noticias">
	<ul class="<?php echo $moduleclass_sfx; ?>">
		<?php $active = "active"; ?>
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<?php foreach ($list as $key => $item) : ?>
					<?php if($key <= 2) : ?>
						<?php if ($key == 0) { ?>
	                	<div class="carousel-item <?php echo $active; ?>">
			            <?php }else{ ?>
		                <div class="carousel-item">
			            <?php } ?>
			            	<div class="noticia-item">
				            	<?php if ($item->img == ""){ ?>
				            		<img src="images/sampledata/thumb-noticia.png" width="100%">
				            	<?php } else { ?>
				            		<img src="<?php echo $item->img; ?>" width="100%">
				            	<?php }  ?>
								<div class="carousel-caption d-none d-md-block">
									<h5><a href="<?php echo $item->link; ?>" alt="<?php echo $item->title; ?>"><?php echo $item->title; ?></a></h5>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>

				<div class="carrossel-paginacao">
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>

				<ol class="carousel-indicators">
					<?php             
					$active = "active";
					foreach ($list as $li => $item2) : 
					?>
						<?php if($li <= 2) : ?>
						<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $li; ?>" class="<?php echo $active; ?>">
							<div class="img-thumb-noticias">
								<?php if ($item2->img == ""){ ?>
						           	<img src="images/sampledata/thumb-noticia.png" width="100%">
				            	<?php } else { ?>
									<img src="<?php echo $item2->img; ?>" width="100%">
					            <?php }  ?>
				            </div>
							<h5 class="carrossel-descricao"><?php echo $item2->title; ?></h5>
						</li>
						<?php endif; ?>
					<?php  
					$active = '';       
					endforeach; 
					?>
				</ol>
			</div>

			<div class="lista-noticia">
				<h4 class="titulo-mais-noticias">Mais notícias</h4>
				<?php foreach ($list as $key => $item) : ?>
					<?php if ($key > 2) : ?>
					<div class="row lista-noticia-row item-<?php echo $key; ?>">
						<div class="col-md-auto noticia-data-hora">
							<div class="col">
								<i class="material-icons icones-noticias">date_range</i>
								<span class=""><?php echo date('d/m', strtotime($item->created)); ?></span>
							</div>
	    					<div class="col">
	    						<i class="material-icons icones-noticias">access_alarm</i>
	    						<span class=""><?php echo date('H:i', strtotime($item->created)); ?></span>
	    					</div>
						</div>
						<div class="col-8 lista-noticia-txt" >
							<a href="<?php echo $item->link; ?>" itemprop="url">
								<span itemprop="name"><?php echo $item->title; ?></span>
							</a>
						</div>
					</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
	</ul>
</div> <!-- end .listagem-capa-noticias -->
<?php if ($params->get("show_link")) : ?>
	<div  class="container d-flex justify-content-center">
		<a href="<?php echo $params->get("url_link"); ?>" title="<?php echo $params->get("name_link"); ?>" class="btn btn-outline-dark"><?php echo $params->get("name_link"); ?></a>
	</div>
<?php endif; ?>

