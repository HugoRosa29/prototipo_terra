<?php
/**
 * @package     Directsales
 * @subpackage  mod_directsales
 *
 * @author      Charles Guedes <charlesgcf@gmail.com>
 * @copyright   Copyright (C) 2018 Capgemini do Brasil. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Get module data.
$items = ModDirectsalesHelper::getLatest();
?>
<div class="last-directsales">
	<h3><?php echo JText::_('MOD_DIRECTSALES_HEADING_TITLE') ?></h3>
	<?php echo $params->get('message'); ?>
	<div class="text-center">
		<ul class="list-unstyled">
			<?php foreach ($items as $item): ?>
				<li>
					<a href="<?php echo $item->link; ?>">
						<figure>
							<?php echo JHtml::_('image', JUri::root() . 'images/directsales/thumbnails/' . $item->image, $item->title, null, true); ?>
						</figure>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>