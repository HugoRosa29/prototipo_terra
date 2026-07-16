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
<div class="search<?php echo $moduleclass_sfx ?>">
	<form action="<?php echo JRoute::_('index.php');?>" method="post" class="form-inline">
		<?php
		$output = '<label for="mod-search-searchword" class="element-invisible">' . $label . '</label><input name="searchword" id="mod-search-searchword" maxlength="' . $maxlength . '"  class="inputbox search-query" type="text" size="' . $width . '" value="' . $text . '"  onblur="if (this.value==\'\') this.value=\'' . $text . '\';" onfocus="if (this.value==\'' . $text . '\') this.value=\'\';" />';

		if ($button):
			if ($imagebutton):
				$button = ' <input type="image" value="' . $button_text . '" class="button" src="' . $img . '" onclick="this.form.searchword.focus();"/>';
			else:
				$button = ' <button class="button btn btn-primary" onclick="this.form.searchword.focus();">' . $button_text . '</button>';
			endif;
		endif;

		switch ($button_pos):
			case 'top':
				$button = $button . '<br />';
				$output = $button . $output;
				break;

			case 'bottom':
				$button = '<br />' . $button;
				$output = $output . $button;
				break;

			case 'right':
				$output = $output . $button;
				break;

			case 'left':
			default:
				$output = $button . $output;
				break;
		endswitch;

		echo $output;
		?>
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
	</form>
</div>