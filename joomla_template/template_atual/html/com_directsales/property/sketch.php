<?php
/**
 * @package     Directsales
 * @subpackage  com_directsales
 *
 * @author      Charles Guedes <charles.fernandes@capgemini.com>
 * @copyright   Copyright (C) 2018 Capgemini do Brasil. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Create shortcuts to some parameters.
$params = $this->item->params;

if ($sketchesLink = $params->get('sketches_link'))
{
	// Add JavaScript Frameworks.
	JHtml::_('jquery.framework');

	// Load JavaScript.
	JHtml::script('com_directsales/jquery.iframeheight.min.js', false, true);

	// Get the document object.
	$doc = JFactory::getDocument();

	$doc->addScriptDeclaration(
		'jQuery(document).ready(function($) {
		$(\'#sketchframe\').iframeHeight({
			resizeMaxTry: 2,
			resizeWaitTime: 300,
			minimumHeight: 100,
			defaultHeight: ' . $params->get('height', '300') . ',
			heightOffset: 0,
			exceptPages: "",
			debugMode: false,
			visibilitybeforeload: true,
			blockCrossDomain: true,
			externalHeightName: "bodyHeight",
			onMessageFunctionName: "getHeight",
			domainName: "*",
			watcher: false,
			watcherTime: 400
		});
	});'
	);
}
?>
<div class="property-item<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading', 1)): ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?> /
				<?php echo $this->escape($this->item->title); ?>
			</h1>
		</div>
	<?php endif; ?>

	<?php if ($sketchesLink): ?>
		<iframe
			id="sketchframe"
			name="iframe"
			src="<?php echo $sketchesLink . $this->item->number . $this->item->year; ?>"
			width="<?php echo $this->escape($params->get('width', '100%')); ?>"
			scrolling="<?php echo $this->escape($params->get('scrolling')); ?>"
			frameborder="<?php echo $this->escape($params->get('frameborder', 0)); ?>"
			class="wrapper">
			<?php echo JText::_('COM_WRAPPER_NO_IFRAMES'); ?>
		</iframe>
	<?php else: ?>
		<p><?php echo JText::_('COM_DIRECTSALES_NOT_HAVE_SKETCHES_LINK') ?></p>
	<?php endif; ?>
</div>
