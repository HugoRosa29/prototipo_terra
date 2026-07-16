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

// Load the tooltip bootstrap script.
JHtml::_('bootstrap.tooltip', '.language-menu a', array('placement' => 'bottom'));
?>
<ul class="language-menu<?php echo $moduleclass_sfx; ?>">
	<?php foreach ($list as $language): ?>
		<?php if ($params->get('show_active', 0) || !$language->active): ?>
			<li<?php echo $language->active ? ' class="lang-active"' : ''; ?> dir="<?php echo JLanguage::getInstance($language->lang_code)->isRTL() ? 'rtl' : 'ltr'; ?>">
				<a href="<?php echo $language->link; ?>" title="<?php echo $language->title_native; ?>">
					<?php if ($params->get('image', 1)): ?>
						<?php echo JHtml::_('image', 'mod_languages/' . $language->image . '.gif', $language->title_native, null, true); ?>
					<?php else: ?>
						<?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef); ?>
					<?php endif; ?>
				</a>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>