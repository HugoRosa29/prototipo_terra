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

foreach ($this->form->getFieldset() as $field)
{
	$this->form->setFieldAttribute($field->fieldname, 'class', trim($field->class) . ' form-control');
}

if (isset($this->error)): ?>
	<div class="contact-error">
		<?php echo $this->error; ?>
	</div>
<?php endif; ?>
<div class="contact-form">
	<form id="contact-form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" role="form">
		<p><?php echo JText::_('COM_CONTACT_FORM_LABEL'); ?></p>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group">
					<?php echo $this->form->getLabel('contact_name'); ?>
					<?php echo $this->form->getInput('contact_name'); ?>
				</div>
				<div class="form-group">
					<?php echo $this->form->getLabel('contact_email'); ?>
					<?php echo $this->form->getInput('contact_email'); ?>
				</div>
				<div class="form-group">
					<?php echo $this->form->getLabel('contact_subject'); ?>
					<?php echo $this->form->getInput('contact_subject'); ?>
				</div>
				<?php //Dynamically load any additional fields from plugins. ?>
				<?php foreach ($this->form->getFieldsets() as $fieldset): ?>
					<?php if ($fieldset->name != 'contact'): ?>
						<?php $fields = $this->form->getFieldset($fieldset->name); ?>
						<?php foreach ($fields as $field): ?>
							<div class="form-group">
								<?php if ($field->hidden): ?>
									<?php echo $field->input; ?>
								<?php else: ?>
									<?php echo $field->label; ?>
									<?php if (!$field->required && $field->type != "Spacer"): ?>
										<span class="optional"><?php echo JText::_('COM_CONTACT_OPTIONAL'); ?></span>
									<?php endif; ?>
									<?php echo $field->input; ?>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					<?php endif ?>
				<?php endforeach; ?>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group">
					<?php echo $this->form->getLabel('contact_message'); ?>
					<?php echo $this->form->getInput('contact_message'); ?>
				</div>
				<?php if ($this->params->get('show_email_copy')): ?>
					<div class="checkbox">
						<label for="jform_contact_email_copy" id="jform_contact_email_copy-lbl" class="hasTooltip" title="<?php echo JHtml::tooltipText('COM_CONTACT_CONTACT_EMAIL_A_COPY_LABEL', 'COM_CONTACT_CONTACT_EMAIL_A_COPY_DESC'); ?>">
							<?php echo $this->form->getInput('contact_email_copy'); ?>
							<strong><?php echo JText::_('COM_CONTACT_CONTACT_EMAIL_A_COPY_LABEL'); ?></strong>
						</label>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="form-actions">
			<button class="btn btn-success validate" type="submit"><?php echo JText::_('COM_CONTACT_CONTACT_SEND'); ?></button>
		</div>
		<div>
			<input type="hidden" name="option" value="com_contact" />
			<input type="hidden" name="task" value="contact.submit" />
			<input type="hidden" name="return" value="<?php echo $this->return_page; ?>" />
			<input type="hidden" name="id" value="<?php echo $this->contact->slug; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
