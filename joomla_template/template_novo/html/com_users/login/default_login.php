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
<div class="login<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')): ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>
	<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != ''): ?>
		<div class="login-description">
	<?php endif; ?>
			<?php if ($this->params->get('logindescription_show') == 1): ?>
				<?php echo $this->params->get('login_description'); ?>
			<?php endif; ?>
			<?php if (($this->params->get('login_image') != '')) :?>
				<img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JTEXT::_('COM_USER_LOGIN_IMAGE_ALT')?>"/>
			<?php endif; ?>
	<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != ''): ?>
		</div>
	<?php endif; ?>
	<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" role="form">
		<fieldset>
			<?php foreach ($this->form->getFieldset('credentials') as $field): ?>
				<?php if (!$field->hidden): ?>
					<div class="form-group">
						<div class="row">
							<?php
							// @todo Twitter Bootstrap class fix.
							$field->class = trim($field->class) . ' form-control';
							?>
							<div class="col-lg-12">
								<?php echo $field->label; ?>
							</div>
							<div class="col-lg-6">
								<?php echo $field->input; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<button type="submit" class="btn btn-success"><?php echo JText::_('JLOGIN'); ?></button>
			<div>
				<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_url', $this->form->getValue('return'))); ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</div>
		</fieldset>
	</form>
</div>
<br>
<div>
	<ul class="list-unstyled">
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>"><?php echo JText::_('COM_USERS_LOGIN_RESET'); ?></a>
		</li>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>"><?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?></a>
		</li>
		<?php $usersConfig = JComponentHelper::getParams('com_users');

		if ($usersConfig->get('allowUserRegistration')): ?>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>"><?php echo JText::_('COM_USERS_LOGIN_REGISTER'); ?></a>
			</li>
		<?php endif; ?>
	</ul>
</div>
