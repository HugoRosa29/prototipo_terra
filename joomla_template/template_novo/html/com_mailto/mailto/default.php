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
<script type="text/javascript">
	Joomla.submitbutton = function(pressbutton) {
		var form = document.getElementById('mailtoForm');

		// Do field validation.
		if (form.mailto.value == "" || form.from.value == "") {
			alert('<?php echo JText::_('COM_MAILTO_EMAIL_ERR_NOINFO'); ?>');
			return false;
		}
		form.submit();
	}
</script>
<?php $data = $this->get('data'); ?>
<div id="mailto-window">
	<div class="page-header">
		<div class="mailto-close pull-right">
			<a href="javascript: void window.close()" title="<?php echo JText::_('COM_MAILTO_CLOSE_WINDOW'); ?>">
				<span><i class="icon-off"></i> <?php echo JText::_('COM_MAILTO_CLOSE_WINDOW'); ?></span>
			</a>
		</div>
		<h4>
			<?php echo JText::_('COM_MAILTO_EMAIL_TO_A_FRIEND'); ?>
		</h4>
	</div>
	<form action="<?php echo JUri::base() ?>index.php" id="mailtoForm" method="post" role="form">
		<div class="form-group">
			<label for="mailto_field"><?php echo JText::_('COM_MAILTO_EMAIL_TO'); ?> <span class="star">*</span></label>
			<input type="text" id="mailto_field" name="mailto" class="form-control" size="25" value="<?php echo $this->escape($data->mailto); ?>"/>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6">
				<div class="form-group">
					<label for="sender_field"><?php echo JText::_('COM_MAILTO_SENDER'); ?> <span class="star">*</span></label>
					<input type="text" id="sender_field" name="sender" class="form-control" value="<?php echo $this->escape($data->sender); ?>" size="25" />
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6">
				<div class="form-group">
					<label for="from_field"><?php echo JText::_('COM_MAILTO_YOUR_EMAIL'); ?> <span class="star">*</span></label>
					<input type="text" id="from_field" name="from" class="form-control" value="<?php echo $this->escape($data->from); ?>" size="25" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="subject_field"><?php echo JText::_('COM_MAILTO_SUBJECT'); ?> <span class="star">*</span></label>
			<input type="text" id="subject_field" name="subject" class="form-control" value="<?php echo $this->escape($data->subject); ?>" size="25" />
		</div>
		<p>
			<button class="btn btn-success" onclick="return Joomla.submitbutton('send');"><?php echo JText::_('COM_MAILTO_SEND'); ?></button>
			<button class="btn btn-default" onclick="window.close();return false;"><?php echo JText::_('COM_MAILTO_CANCEL'); ?></button>
		</p>
		<div>
			<input type="hidden" name="layout" value="<?php echo $this->getLayout();?>" />
			<input type="hidden" name="option" value="com_mailto" />
			<input type="hidden" name="task" value="send" />
			<input type="hidden" name="tmpl" value="component" />
			<input type="hidden" name="link" value="<?php echo $data->link; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
