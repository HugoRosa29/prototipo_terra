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

// Load the popover bootstrap script.
JHtml::_('bootstrap.popover', '.shortcut a', array('placement' => 'top'));

// Note. It is important to remove spaces between elements.
?>
<?php // The menu class is deprecated. Use nav instead. ?>
<section class="shortcuts<?php echo $class_sfx; ?>"<?php
	$tag = '';

	if ($params->get('tag_id') != null)
	{
		$tag = $params->get('tag_id') . '';

		echo ' id="' . $tag . '"';
	}
?>>
	<div class="container">
		<div class="well">
			<div class="row"><?php
foreach ($list as $i => &$item):
	$class = 'col-xs-6 col-sm-6 col-md-4 col-lg-3 item-' . $item->id;

	if ($item->id == $active_id)
	{
		$class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		$class .= ' active';
	}
	elseif ($item->type == 'alias')
	{
		$aliasToId = $item->params->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path))
		{
			$class .= ' alias-parent-active';
		}
	}

	if ($item->type == 'separator')
	{
		$class .= ' divider';
	}

	if (!empty($class))
	{
		$class = ' class="' . trim($class) . '"';
	}

	echo '<div' . $class . '>';
		echo '<div class="shortcut">';

			if ($menu_icon = $item->params->get('menu_icon'))
			{
				echo '<i class="' . $menu_icon . '"></i> ';
			}

			echo '<article>';
				echo '<h5>';

				// Render the menu item.
				switch ($item->type):
					case 'separator':
					case 'url':
					case 'component':
					case 'heading':
						require JModuleHelper::getLayoutPath('mod_menu', 'services_' . $item->type);
						break;

					default:
						require JModuleHelper::getLayoutPath('mod_menu', 'services_url');
						break;
				endswitch;

				echo '</h5>';
			echo '</article>';
		echo '</div>';
	echo '</div>';

endforeach;
?></div>
		</div>
	</div>
</section>