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

/**
 * marker_class: Class based on the selection of text, none, or icons
 * jicon-text, jicon-none, jicon-icon
 */
?>
<div class="row">
	<div class="col-md-6">
		<?php if ($this->contact->misc): ?>
			<?php echo $this->contact->misc; ?>
		<?php endif ?>
	</div>
	<div class="col-md-6">
		<div class="well">
		<h3><i class="icon-globe"></i> <?php echo JText::_('COM_CONTACT_OUR_ADDRESS'); ?></h3>
			<ul class="list-unstyled contact-address">
				<?php if (($this->params->get('address_check') > 0) && ($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)): ?>
					<?php if ($this->contact->address && $this->params->get('show_street_address')): ?>
						<li class="contact-street">
							<strong><?php echo JText::_('COM_CONTACT_ADDRESS'); ?>:</strong> <?php echo $this->contact->address; ?>
						</li>
					<?php endif; ?>

					<?php if ($this->contact->suburb && $this->params->get('show_suburb')): ?>
						<li class="contact-suburb">
							<strong><?php echo JText::_('COM_CONTACT_SUBURB'); ?>:</strong> <?php echo $this->contact->suburb; ?>
						</li>
					<?php endif; ?>
					<?php if ($this->contact->state && $this->params->get('show_state')): ?>
						<li class="contact-state">
							<strong><?php echo JText::_('COM_CONTACT_STATE'); ?>:</strong> <?php echo $this->contact->state; ?>
						</li>
					<?php endif; ?>
					<?php if ($this->contact->postcode && $this->params->get('show_postcode')): ?>
						<li class="contact-postcode">
							<strong><?php echo JText::_('COM_CONTACT_POSTCODE'); ?>:</strong> <?php echo $this->contact->postcode; ?>
						</li>
					<?php endif; ?>
					<?php if ($this->contact->country && $this->params->get('show_country')): ?>
						<li class="contact-country">
							<strong><?php echo JText::_('COM_CONTACT_COUNTRY'); ?>:</strong> <?php echo $this->contact->country; ?>
						</li>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ($this->contact->email_to && $this->params->get('show_email')): ?>
					<li class="contact-emailto">
						<strong><?php echo JText::_('COM_CONTACT_EMAIL'); ?>:</strong> <a href="mailto:<?php echo $this->contact->email_to; ?>"><?php echo $this->contact->email_to; ?></a>
					</li>
				<?php endif; ?>
				<?php if ($this->contact->telephone && $this->params->get('show_telephone')): ?>
					<li class="contact-telephone">
						<strong><?php echo JText::_('COM_CONTACT_TELEPHONE'); ?>:</strong> <?php echo nl2br($this->contact->telephone); ?>
					</li>
				<?php endif; ?>
				<?php if ($this->contact->fax && $this->params->get('show_fax')): ?>
					<li class="contact-fax">
						<strong><?php echo JText::_('COM_CONTACT_FAX'); ?>:</strong> <?php echo nl2br($this->contact->fax); ?>
					</li>
				<?php endif; ?>
				<?php if ($this->contact->mobile && $this->params->get('show_mobile')): ?>
					<li class="contact-mobile">
						<strong><?php echo JText::_('COM_CONTACT_MOBILE'); ?>:</strong> <?php echo nl2br($this->contact->mobile); ?>
					</li>
				<?php endif; ?>
				<?php if ($this->contact->webpage && $this->params->get('show_webpage')): ?>
					<li class="contact-webpage">
						<strong><?php echo JText::_('COM_CONTACT_WEBPAGE'); ?>:</strong> <a href="<?php echo $this->contact->webpage; ?>" target="_blank"><?php echo JStringPunycode::urlToUTF8($this->contact->webpage); ?></a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</div>
