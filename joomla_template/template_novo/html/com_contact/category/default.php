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

// Get the application.
$app = JFactory::getApplication('site');

// Get the template params.
$templateParams = $app->getTemplate(true)->params;

// Add JavaScript.
JHtml::script('https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false', false, true);
?>
<div class="contact-category<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading', 1)): ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>

	<?php echo $this->category->description; ?>

	<?php $groups = array_chunk($this->items, 4); ?>
	<?php foreach ($groups as $group): ?>
		<div class="row">
			<?php foreach ($group as $item): ?>
				<div class="col-md-3">
					<a href="<?php echo JRoute::_(ContactHelperRoute::getContactRoute($item->slug, $item->catid)); ?>">
						<div class="contact-item">
							<div class="contact-header">
								<h3><i class="icon-comments-alt"></i> <?php echo $this->escape($item->name); ?></h3>
							</div>
							<div class="contact-body">
								<?php echo $item->misc; ?>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>

	<script>
		function initialize() {
			var myLatlng = new google.maps.LatLng(
				<?php echo $templateParams->get('latitude', '-15.78199'); ?>,
				<?php echo $templateParams->get('longitude', '-47.90820'); ?>
			);
			var mapOptions = {
				zoom: <?php echo $templateParams->get('zoom', '14'); ?>,
				center: myLatlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			var map = new google.maps.Map(document.getElementById('gmap'), mapOptions);

			var marker = new google.maps.Marker({
				position: myLatlng,
				map: map
			});

			google.maps.event.addDomListener(window, 'resize', function() {
				map.setCenter(myLatlng);
			});
		}

		google.maps.event.addDomListener(window, 'load', initialize);

		jQuery(document).ready(function($) {
			$(window).on('resize', function() {
				var width = $(this).width();

				$('.gmap-wrapper').css({
					width: width,
					marginLeft: '-' + (width / 2) + 'px',
					left: "50%"
				});
			}).resize();
		});
	</script>
	<div class="gmap">
		<div class="gmap-wrapper">
			<div class="gmap-shadow-top"></div>
			<div class="gmap-shadow-bottom"></div>
			<div id="gmap" class="gmap-inner"></div>
		</div>
	</div>
</div>
