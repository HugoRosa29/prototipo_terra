<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_banners
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('BannerHelper', JPATH_ROOT . '/components/com_banners/helpers/banner.php');
?>
<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_banners
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('BannerHelper', JPATH_ROOT . '/components/com_banners/helpers/banner.php');
?>
<?php //echo $moduleclass_sfx; ?>
<div class="super-destaque">
    <div class="container">
		<?php foreach ($list as $item) : ?>
			<?php $link = JRoute::_('index.php?option=com_banners&task=click&id=' . $item->id); ?>
	        <div class="pelicula"></div>
	        <div class="chamada-super-destaque">
		        <?php if ($item->type == 1) : ?>
					<?php // Text based banners ?>
					<?php echo str_replace(array('{CLICKURL}', '{NAME}'), array($link, $item->name), $item->custombannercode); ?>
				<?php else : ?>
					<?php if ($item->clickurl) : ?>
						<?php // Wrap the banner in a link ?>
						<?php $target = $params->get('target', 1); ?>
						<?php if ($target == 1) : ?>
							<?php // Open in a new window ?>
							<a class="mb-2" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer"
								title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?>">
								<?php echo $item->name; ?>

							</a>
							<?php echo $item->description; ?>
						<?php elseif ($target == 2) : ?>
							<?php // Open in a popup window ?>
							<a
								href="<?php echo $link; ?>" onclick="window.open(this.href, '',
									'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550');
									return false"
								title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?>">
								<?php echo $item->description; ?>
							</a>
						<?php else : ?>
							<?php // Open in parent window ?>
							<a
								href="<?php echo $link; ?>"
								title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?>">
								<?php echo $item->description; ?>
							</a>
						<?php endif; ?>
					<?php else: ?>
						<?php echo $item->description; ?>		
					<?php endif; ?>
				<?php endif; ?>
				<?php // Open in a new window ?>
	        </div>
    	<?php endforeach; ?>
    </div>
    <span class="midia">
    	<?php foreach ($list as $item) : ?>
        	<?php $imageurl = $item->params->get('imageurl'); ?>
			<?php $width = $item->params->get('width'); ?>
			<?php $height = $item->params->get('height'); ?>
        	<?php if (BannerHelper::isImage($imageurl)) : ?>
	        	<?php // Image based banner ?>
				<?php $baseurl = strpos($imageurl, 'http') === 0 ? '' : JUri::base(); ?>

				<?php //var_dump($item); ?>
	        	<img
					src="<?php echo $baseurl . $imageurl; ?>"
					alt="<?php echo !empty($alt)?$alt:'';?>"
					<?php if (!empty($width)) echo ' width="' . $width . '"';?>
					<?php if (!empty($height)) echo ' height="' . $height . '"';?>
				/>
			<?php endif ?>
   		<?php endforeach; ?>
  </span>
</div>