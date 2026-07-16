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

// Load the behavior scripts.
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
?>
<div class="registration<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
		</div>
	<?php endif; ?>

	<form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate form-vertical" role="form" enctype="multipart/form-data">
		<div class="row">
			<?php
			// Iterate through the form fieldsets and display each one.
			foreach ($this->form->getFieldsets() as $fieldset): ?>
				<?php $fields = $this->form->getFieldset($fieldset->name); ?>
				<?php if (count($fields)): ?>
					<div class="col-md-6">
						<fieldset>
							<?php
							// If the fieldset has a label set, display it as the legend.
							if (isset($fieldset->label)): ?>
								<h4><?php echo JText::_($fieldset->label); ?></h4>
							<?php endif; ?>

							<?php
							// Iterate through the fields in the set and display them.
							foreach ($fields as $field): ?>
								<?php
								// If the field is hidden, just display the input.
								if ($field->hidden): ?>
									<?php echo $field->input; ?>
								<?php else: ?>
									<div class="form-group">
										<?php
										// @todo Twitter Bootstrap class fix.
										if ($field->type != 'Spacer')
										{
											$field->class = trim($field->class) . ' form-control';
										}
										?>
										<?php echo $field->label; ?>
										<?php if (!$field->required && $field->type != 'Spacer') : ?>
											<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
										<?php endif; ?>
										<?php echo $field->input; ?>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						</fieldset>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-success validate"><?php echo JText::_('JREGISTER'); ?></button>
			<a class="btn" href="<?php echo JRoute::_(''); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
		</div>
		<div>
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="registration.register" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
