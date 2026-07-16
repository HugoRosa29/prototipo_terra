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

<section id="<?php echo $moduleclass_sfx; ?>" class="<?php echo $moduleclass_sfx; ?>">
    <div class="container">
    <div class="metas-pne">

			<?php if(empty($list)) : ?>
				<div>
					<span>Não existe nenhuma notícia em destaque.</span>
				</div>
			<?php else : ?>

				  		<?php 
						foreach ($list as $key => $item):
						?>

							<a class="jcepopup" href="<?php echo $item->link ?>?tmpl=componentmetas" title="<?php echo $item->title; ?>" data-mediabox-width="992">
							
								<h4><?php echo substr($item->title, 0, 7) ?></h4>
								<span><?php echo substr($item->title, 8, 300 ) ?></span>
							</a>

						<?php endforeach; ?>
						</ul>  


			<?php endif; ?>

        </div>
    </div>
</section>

