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

<!-- tamanho e largura do video -->
<?php
$video_width 	= $params->get('video_width');
$video_height 	= $params->get('video_height');

?>
<div class="videos">
	<div class="box-video">

		<?php $total_itens = $params->get('n_destaque',0); ?>
		<?php $count = 1; ?>
		<?php

		foreach ($list as $item) : ?>	

		<?php //if ($item->featured == 1 ) : ?>	
			    <!-- Video -->
			    
			    <?php //echo $item->video; ?>
			    <?php if ($params->get('item_title')) : ?>
					<!-- <<?php echo $item_heading; ?> class="newsflash-title<?php echo $params->get('moduleclass_sfx'); ?>"> -->
					<?php if ($params->get('link_titles') && $item->link != '') : ?>
						<a href="<?php echo $item->link;?>">
							<?php echo $item->title;?></a>
					<?php else : ?>
						<?php echo $item->title; ?>
					<?php endif; ?>
					</<?php echo $item_heading; ?>>
				<?php endif; ?>
			    <!-- Final Video -->
<?php echo $item->introtext; ?>

		<?php //endif; ?>
		<?php if ($count == $total_itens) break;?>
		<?php $count++; ?>
		<?php endforeach ?>

	</div>
	<!-- <div class="leia-mais veja-mais-geral"><a href="<?php echo $params->get('url_link')?>"><?php echo $params->get('name_link')?></a></div> -->
</div>

