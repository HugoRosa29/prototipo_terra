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

if ($this->wrapper->url)
{
	// Add JavaScript Frameworks.
	JHtml::_('jquery.framework');

	// Load JavaScript.
	JHtml::script('com_wrapper/jquery.iframeheight.min.js', false, true);

	// Get the document object.
	$doc = JFactory::getDocument();

	$doc->addScriptDeclaration(
		'jQuery(document).ready(function($) {
		$(\'#blockrandom\').iframeHeight({
			resizeMaxTry: 2,
			resizeWaitTime: 300,
			minimumHeight: 100,
			defaultHeight: 300,
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

// Add JavaScript Frameworks.
JHtml::_('jquery.framework');

// Load JavaScript.
JHtml::script('plg_system_captionate/jquery.captionate.min.js', false, true);
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('main img').captionate();
	});
</script>
<div class="contentpane<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('page_heading', 1)): ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_title')); ?>
			</h1>
		</div>
	<?php endif; ?>

	<?php if ($this->wrapper->url): ?>
		<iframe
			id="blockrandom"
			name="iframe"
			src="<?php echo $this->escape($this->wrapper->url); ?>"
			width="<?php echo $this->escape($this->params->get('width')); ?>"
			height="<?php echo $this->escape($this->params->get('height')); ?>"
			scrolling="<?php echo $this->escape($this->params->get('scrolling')); ?>"
			frameborder="<?php echo $this->escape($this->params->get('frameborder', 0)); ?>"
			class="wrapper">
			<?php echo JText::_('COM_WRAPPER_NO_IFRAMES'); ?>
		</iframe>
	<?php endif; ?>
</div>
