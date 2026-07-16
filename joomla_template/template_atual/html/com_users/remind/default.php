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
<div class="remind<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')): ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>
	<form id="user-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=remind.remind'); ?>" method="post" class="form-validate form-vertical" role="form">
		<?php foreach ($this->form->getFieldsets() as $fieldset): ?>
			<p><?php echo JText::_($fieldset->label); ?></p>
			<div class="row">
				<div class="col-md-4">
					<fieldset>
						<?php foreach ($this->form->getFieldset($fieldset->name) as $name => $field): ?>
							<div class="form-group">
								<?php
								// @todo Twitter Bootstrap class fix.
								$field->class = trim($field->class) . ' form-control';
								?>
								<?php echo $field->label; ?>
								<?php echo $field->input; ?>
							</div>
						<?php endforeach; ?>
					</fieldset>
				</div>
			</div>
		<?php endforeach; ?>
		<div class="form-actions">
			<button type="submit" class="btn btn-success validate"><?php echo JText::_('JSUBMIT'); ?></button>
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
