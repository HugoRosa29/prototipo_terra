<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="container">
	<div class="noticias-rodape">
		<h4 class="font-titulo-artigos">NOTÍCIAS</h4>
	    <div class="row">
	    	<?php foreach ($list as $key => $item) : ?>
				<?php $image = json_decode($item->images); ?>
		       <div class="col-sm-4">
		       		<a class="noticias-rodape-img" href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>">
						<img class="rounded" src="<?php echo $image->image_intro ?>" alt="<?php echo $item->title; ?>"/>
					</a>
		       </div>
		       <div class="col-sm-8 noticia-txt">
		       		<a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>">
						<p><?php echo $item->title; ?></p>
						</a>	
						<small><?php echo date('H:i', strtotime($item->created)); ?> - <?php echo date('d/m', strtotime($item->created)); ?></small>
					
		    	</div>
			<?php endforeach; ?>	
	    </div>

		<div class="row">
			<div class="col-sm-4">
				<?php if($params->get('show_button')):?>
					<a href="<?php echo $params->get('link_button');?>" class="btn btn-outline-dark" title="<?php echo $params->get('name_button');?>"><?php echo $params->get('name_button');?></a>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>	