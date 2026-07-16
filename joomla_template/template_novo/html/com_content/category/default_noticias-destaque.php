<?php
/**
 * @package     Cleanportal_2019
 * @subpackage  tpl_cleanportal_2019
 *
 * @author      Charles Guedes <charlesgcf@gmail.com>
 * @copyright   Copyright (C) 2019 Capgemini do Brasil. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

JHtml::_('behavior.framework');

?>
<div class="listagem-capa-noticias">
	<ul class="<?php echo $moduleclass_sfx; ?>">
	<?php $i = 0; ?>
	<?php foreach ($this->get('items') as $key => $item): ?>
		<?php //var_dump(); ?>
		<?php if ($key <= 2 && $this->pagination->limitstart == 0 ): ?>
			<?php
		    	$image = json_decode($item->images);
		    ?>
	        <li class="com-foto item-<?php echo $key;?>">
                <?php if (isset($image->image_intro)): ?>
	            <div class="figura">
	                    <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid)); ?>" target=""><?php echo JHtml::_('image', JUri::root() .  $image->image_intro, null, null, true); ?></a>
	            </div>
                <?php endif; ?>
	            
	            <div class="item-noticia">
	                <div class="hora-noticia"> 
	                    <span><?php echo date('d/m', strtotime($item->created)); ?> </span> 
	                    <span class="hour"><?php echo date('H:i', strtotime($item->created)); ?> </span>
	                </div>

	                <div class="texto-noticia">
	                    <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid)); ?>" itemprop="url">
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
	                    <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid)); ?>" itemprop="url">
	                        <span itemprop="name"><?php echo $item->title; ?></span>
	                    </a>
	                </div>
	            </div>
	        </li>
	    <?php endif; ?>
	<?php endforeach; ?>
	</ul>
</div>

<?php // Code to add a link to submit an article. ?>
<?php if ($this->category->getParams()->get('access-create')) : ?>
	<?php echo JHtml::_('icon.create', $this->category, $this->category->params); ?>
<?php  endif; ?>

<?php // Add pagination links ?>
<?php if (!empty($this->items)) : ?>
	<?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
	<div class="pagination">

		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter pull-right">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php endif; ?>

		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>
</form>
<?php  endif; ?>