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
?>
<div class="custom<?php echo $moduleclass_sfx; ?>" <?php if ($params->get('backgroundimage')): ?> style="background-image: url(<?php echo $params->get('backgroundimage'); ?>)"<?php endif; ?>>
	<?php echo $module->content; ?>
</div>