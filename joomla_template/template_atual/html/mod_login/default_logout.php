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

// Load the keepalive behavior script.
JHtml::_('behavior.keepalive');
?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-vertical">
	<?php if ($params->get('greeting')): ?>
		<div class="form-group login-greeting">
			<?php if ($params->get('name') == 0): ?>
				<?php echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name'))); ?>
			<?php else: ?>
				<?php echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username'))); ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<input type="submit" name="Submit" class="btn btn-success" value="<?php echo JText::_('JLOGOUT'); ?>" />
	<div>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>