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

jimport('joomla.html.html.bootstrap');

// Load the parameters.
$cparams = JComponentHelper::getParams('com_media');
?>
<div class="contact<?php echo $this->pageclass_sfx; ?>">
	<div class="page-header">
		<h1><?php echo $this->item->name; ?></h1>
	</div>

	<?php echo $this->item->misc; ?>

	<?php echo $this->loadTemplate('form'); ?>
</div>
