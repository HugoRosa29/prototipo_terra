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

<section id="<?php echo $moduleclass_sfx; ?>" class="<?php echo $moduleclass_sfx; ?> cor3">
    <div class="container">
        <div class="row">

			<?php if(empty($list)) : ?>
				<div>
					<span>Não existe nenhuma notícia em destaque.</span>
				</div>
			<?php else : ?>

					<?php 
					//echo '<pre>';
					//var_dump($list);
					foreach ($list as $key => $item):
					$json_imagem = json_decode($item->images);
					?>
						<?php //if($item->img && $i != 1 && $item->featured == '1') : ?>
						<?php if($item->img && $key == 0) : ?>
							<!-- DESTAQUE COM FOTO-->
						  	<div class="col-md-7">
						  		<div class="destaque-principal">
								    <!-- IMAGEM -->
									<?php if($json_imagem->image_intro): ?>
										<img src="<?php echo $json_imagem->image_intro; ?>" alt="<?php echo $json_imagem->image_intro_alt; ?>">
									<?php else: ?>
										<?php echo $item->img; ?>
									<?php endif; ?>
									 <div class="titulo">
				                        <a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>"><?php echo $item->title; ?></a>
				                    </div>										
							    </div>  
						  	</div>
						  	<!-- FIM Destaque com Foto-->
					  	<?php endif; ?>
			  		<?php endforeach; ?>

					<div class="col-md-5">
						<ul class="desatques-secundarios">
						<!-- DESTAQUES SECUNDARIOS-->
				  		<?php 
						foreach ($list as $key => $item):
						?>
							<?php if($key != 0) : ?>
								<li>
									<a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>"><?php echo $item->title; ?></a>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
						</ul>  

					</div> <!-- Fim DESTAQUES SECUNDARIOS -->
					
					<?php if ($params->get("show_link")) : ?>
 						<div class="leia-mais pull-right"><a href="<?php echo $params->get("url_link"); ?>" title="<?php echo $params->get("name_link"); ?>"><?php echo $params->get("name_link"); ?></a></div>
					<?php endif; ?>

			<?php endif; ?>

        </div>
    </div>
</section>

