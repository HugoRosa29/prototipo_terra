<?php
/**
 * @package     Social
 * @subpackage  mod_social
 *
 * @author      Bruno Batista <bruno.batista@ctis.com.br>
 * @copyright   Copyright (C) 2013 AtomTech IT Services. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

?>

<div class="row redesociais">
	<?php if ($facebookUsername): ?>
		<div class="col-sm">
			<a target="_blank" href="https://www.facebook.com/<?php echo $facebookUsername; ?>" title="<?php echo JText::_('MOD_SOCIAL_MESSAGE_FACEBOOK'); ?>"><img class="rounded" src="<?php echo juri::base(); ?>/templates/onepageterracap2019/img/ico-facebook.png" />  </a>
		</div>
	<?php endif; ?>
	<?php if ($instaUsername): ?>	
		<div class="col-sm">
			<a target="_blank" href="https://www.instagram.com/<?php echo $instaUsername; ?>" title="<?php echo JText::_('MOD_SOCIAL_MESSAGE_INSTA'); ?>"><img  class="rounded" src="<?php echo juri::base(); ?>/templates/onepageterracap2019/img/ico-instagram.png" />  </a>
		</div>
	<?php endif; ?>
  	<?php /*if ($rssUrl): ?>
	  	<div class="col-sm">
			<a href="<?php echo $rssUrl; ?>" title="<?php echo JText::_('MOD_SOCIAL_MESSAGE_RSS'); ?>"><img class="rounded" src="<?php echo juri::base(); ?>/templates/onepageterracap2019/img/ico-rss.png" />  </a>
	  	</div>
	<?php endif;*/ ?>
	<?php if ($twitterUsername): ?>
  		<div class="col-sm">
			<a target="_blank" href="https://twitter.com/<?php echo $twitterUsername; ?>" title="<?php echo JText::_('MOD_SOCIAL_MESSAGE_TWITTER'); ?>"><img  class="rounded" src="<?php echo juri::base(); ?>/templates/onepageterracap2019/img/ico-twitter.png" /> </a>
  		</div>
	<?php endif; ?>
	<?php if ($youtubeUsername): ?>
  		<div class="col-sm">
			<a target="_blank" href="https://www.youtube.com/<?php echo $youtubeUsername; ?>" title="<?php echo JText::_('MOD_SOCIAL_MESSAGE_YOUTUBE'); ?>"><img  class="rounded" src="<?php echo juri::base(); ?>/templates/onepageterracap2019/img/ico-youtube.png" /></a>
  		</div>
	<?php endif; ?>	
</div>