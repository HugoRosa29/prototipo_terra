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
<div class="search<?php echo $moduleclass_sfx ?> form-group">
	<form action="<?php echo JRoute::_('index.php');?>" method="post" class="form-inline">
		<div class="input-group">
			
				<input type="text" id="mod-search-searchword" class="form-control inputbox input-lg search-query" name="searchword" maxlength="50" size="<?php echo $width; ?>" placeholder="<?php echo $text; ?>" />
				<div class="input-group-append">
					<button class="button btn btn-success" onclick="this.form.searchword.focus();"><i class="icon-search"></i> <?php echo $button_text; ?></button>
				</div>
		</div>
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
	</form>
</div>