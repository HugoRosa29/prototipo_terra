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

<div class="listagem-capa-noticias">
<ul class="<?php echo $moduleclass_sfx; ?>">
<?php $i = 0;

?>
<?php foreach ($list as $key => $item) : ?>
    <?php if ($key <= 2 ): 
    	$image = json_decode($item->images);
    ?>
        <li class="com-foto item-<?php echo $key;?>">
            <div class="figura">
                <?php if (isset($item->link)): ?>
                    <a href="<?php echo $item->link; ?>" target=""><?php echo JHtml::_('image', JUri::root() .  $image->image_intro, null, null, true); ?></a>
                <?php else: ?>
                    <?php echo JHtml::_('images', JUri::root() . 'images/slideshow/' . $item->images, null, null, true); ?>
                <?php endif; ?>
            </div>
            
            <div class="item-noticia">
                <div class="hora-noticia"> 
                    <span><?php echo date('d/m', strtotime($item->created)); ?> </span> 
                    <span class="hour"><?php echo date('H:i', strtotime($item->created)); ?> </span>
                </div>

                <div class="texto-noticia">
                    <a href="<?php echo $item->link; ?>" itemprop="url">
                        <span itemprop="name"><?php echo $item->title; ?></span>
                    </a>
                    
                    <div class="descricao-noticia-destaque">
                        <?php echo substr(strip_tags($item->introtext),0,180)."..."; ?>
                    </div>   
                </div>
            </div> <!-- end .item-noticia -->
        </li>
	<?php else: ?>
        <li class="outras clearfix item-<?php echo $key;?>">
            <div class="item-noticia">
                    <div class="hora-noticia"> 
                        <span class="hora-noticia-text"><?php echo date('d/m', strtotime($item->created)); ?> </span> 
                        <span class="data-noticia-text"><?php echo date('H:i', strtotime($item->created)); ?> </span>
                    </div>
                <div class="titulo-listagem">                
                    <a href="<?php echo $item->link; ?>" itemprop="url">
                        <span itemprop="name"><?php echo $item->title; ?></span>
                    </a>
                </div>
            </div>
        </li>
    <?php endif; ?>        
<?php endforeach; ?>
</ul>
</div> <!-- end .listagem-capa-noticias -->


<?php $url = ( $_SERVER['HTTP_HOST']=="localhost:8080" ? 'portal':''); ?>

<div class="text-center mostrar-conteudo">
<a href="index.php?option=com_content&view=category&id=9">Mostrar Mais</a>
</div>