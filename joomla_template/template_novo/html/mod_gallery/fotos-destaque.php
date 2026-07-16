<?php
/**
 * @package     Gallery
 * @subpackage  mod_gallery
 *
 * @author      Bruno Batista <bruno.batista@ctis.com.br>
 * @copyright   Copyright (C) 2013 AtomTech IT Services. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Load dependent classes.
require_once JPATH_SITE . '/components/com_gallery/helpers/route.php';

// Create a unique id to grouping images.
$id = uniqid();
?>
<div class="<?php echo $moduleclass_sfx; ?>">
	<div class="row">
		<?php if ($list): ?>
			<?php foreach ($list as $item): ?>
				<div class="foto">
					<a href="<?php echo $item->image; ?>" rel="prettyPhoto['<?php echo $id; ?>']" title="<?php echo $item->description; ?>">
						<img src="<?php echo $item->thumbnail; ?>" alt="<?php echo $item->title; ?>" >
					</a>
				</div>
				<div class="item-foto">
					<div class="hora-foto">
						<?php //var_dump($item) ?>
						<span><?php //echo date('H:i', strtotime($item->created)); ?> </span>
						<span><?php //echo date('d/m', strtotime($item->created)); ?> </span>
					</div>
					<div class="texto-foto">
						<?php //echo $item->title; ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p><?php echo JText::_('MOD_GALLERY_NO_PICTURES'); ?></p>
		<?php endif ?>
	</div>
</div>
<div class="mais-fotos area-btn-mais-fotos">
	<a class="btn btn-outline-dark" href="<?php echo JRoute::_(GalleryHelperRoute::getAlbumsRoute()); ?>"><i class="icon-plus"></i> <?php echo JText::_('MOD_GALLERY_MORE_PICTURES'); ?></a>
</div>