<?php
/**
 * @package     Videos
 * @subpackage  mod_videos
 *
 * @author      Bruno Batista <bruno.batista@ctis.com.br>
 * @copyright   Copyright (C) 2013 AtomTech IT Services. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Load the backend helper.
require_once JPATH_ADMINISTRATOR . '/components/com_videos/helpers/videos.php';

// Load the prettyphoto jquery script.
//JHtml::_('jquery.prettyphoto');

// Create a unique id to grouping videos.
$id = uniqid();
?>
<div class="<?php echo $moduleclass_sfx; ?>">
	<div>
		<?php foreach ($list as $item): ?>
			<div class="conteudo-video">
			<div class="video">
				<?php if ($cParams->get('external')): ?>
					<a class="link-video" href="<?php echo $item->url; ?>" target="_blank">
				<?php else: ?>
					<a class="link-video" href="<?php echo $item->url; ?>" rel="prettyPhoto['<?php echo $id; ?>']">
				<?php endif; ?>
					<img src="<?php echo VideosHelper::getVideoThumbnails($item->url, 'medium'); ?>" alt="<?php echo $item->title; ?>">
				</a>
			</div>
			<?php if ($item_title): ?>
				<div class="item-video">
					<div class="texto-video">
							<<?php echo $item_heading; ?>>
								<?php if ($link_titles): ?>
									<a href="<?php echo $item->link; ?>">
								<?php endif; ?>
									<?php echo htmlspecialchars($item->title); ?>
								<?php if ($link_titles): ?>
									</a>
								<?php endif; ?>
							</<?php echo $item_heading; ?>>
					</div>
					<div class="hora-video">
						<span class="hora-video-text"><?php echo date('H:i', strtotime($item->created)); ?> </span>
						<span class="hora-data-text"><?php echo date('d/m', strtotime($item->created)); ?> </span>
					</div>
				</div> 
			<?php endif; ?>
			</div>
			
		<?php endforeach; ?>
	</div> 
</div>

<div class="container d-flex justify-content-center">
	<a class="btn btn-outline-dark btn-sm" href="<?php echo JRoute::_(VideosHelperRoute::getVideosRoute()); ?>"><?php echo JText::_('MOD_VIDEOS_MORE'); ?></a>
</div>