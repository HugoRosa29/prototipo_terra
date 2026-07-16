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

// Load the tooltip bootstrap script.
JHtml::_('bootstrap.tooltip');
?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-vertical" role="form">
	<?php if ($params->get('pretext')): ?>
		<div class="pretext">
			<p><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>
	<div class="userdata">
		<div class="form-group">
			<?php if (!$params->get('usetext')): ?>
				<div class="input-prepend">
					<span class="add-on">
						<span class="icon-user hasTooltip" title="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>"></span>
						<label for="modlgn-username" class="element-invisible"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
					</span>
					<input id="modlgn-username" type="text" name="username" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
				</div>
			<?php else: ?>
				<label for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?></label>
				<input id="modlgn-username" type="text" name="username" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
			<?php endif; ?>
		</div>
		<div class="form-group">
			<?php if (!$params->get('usetext')): ?>
				<div class="input-prepend">
					<span class="add-on">
						<span class="icon-lock hasTooltip" title="<?php echo JText::_('JGLOBAL_PASSWORD') ?>">
						</span>
							<label for="modlgn-passwd" class="element-invisible"><?php echo JText::_('JGLOBAL_PASSWORD'); ?>
						</label>
					</span>
					<input id="modlgn-passwd" type="password" name="password" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
				</div>
			<?php else: ?>
				<label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
				<input id="modlgn-passwd" type="password" name="password" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
			<?php endif; ?>
		</div>
		<?php if (count($twofactormethods) > 1): ?>
		<div class="form-group">
			<?php if (!$params->get('usetext')): ?>
				<div class="input-prepend input-append">
					<span class="add-on">
						<span class="icon-star hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>">
						</span>
							<label for="modlgn-secretkey" class="element-invisible"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?>
						</label>
					</span>
					<input id="modlgn-secretkey" type="text" name="secretkey" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
					<span class="btn width-auto hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
						<span class="icon-help"></span>
					</span>
			</div>
			<?php else: ?>
				<label for="modlgn-secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY') ?></label>
				<input id="modlgn-secretkey" type="text" name="secretkey" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
				<span class="btn width-auto hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
					<span class="icon-help"></span>
				</span>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php if (JPluginHelper::isEnabled('system', 'remember')): ?>
		<div class="checkbox">
			<label for="modlgn-remember">
				<input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
				<?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?>
			</label>
		</div>
		<?php endif; ?>
		<button type="submit" tabindex="0" name="Submit" class="btn btn-success"><?php echo JText::_('JLOGIN') ?></button>
		<?php $usersConfig = JComponentHelper::getParams('com_users'); ?>
		<?Php if ($usersConfig->get('allowUserRegistration')): ?>
			<ul class="unstyled">
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>"><?php echo JText::_('MOD_LOGIN_REGISTER'); ?> <span class="icon-arrow-right"></span></a>
				</li>
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
				</li>
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
				</li>
			</ul>
		<?php endif; ?>
		<div>
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="user.login" />
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</div>
	<?php if ($params->get('posttext')): ?>
		<div class="posttext">
			<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>
