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

// Note. It is important to remove spaces between elements.
?>
<?php // The menu class is deprecated. Use nav instead. ?>
<ul class="list-unstyled<?php echo $class_sfx; ?>"<?php
	$tag = '';

	if ($params->get('tag_id') != null)
	{
		$tag = $params->get('tag_id') . '';

		echo ' id="' . $tag . '"';
	}
?>>
<?php
foreach ($list as $i => &$item):
	$class = 'item-' . $item->id;
	$activeMega = $item->params->get('activeMega');

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

	if ($item->deeper)
	{
		$class .= ' deeper';
	}

	if ($item->parent)
	{
		$class .= ' parent';
	}

	if (!empty($class))
	{
		$class = ' class="' . trim($class) . '"';
	}

	echo '<li' . $class . '>';

	// Render the menu item.
	switch ($item->type):
		case 'separator':
		case 'url':
		case 'component':
		case 'heading':
			require JModuleHelper::getLayoutPath('mod_menu', 'mainmenu_' . $item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'mainmenu_url');
			break;
	endswitch;

	if ($activeMega)
	{
		// Initialiase variables.
		$columnsMega = $item->params->get('columnsMega', 3);
		$structure   = $item->params->get('structure', 1);

		if ($structure)
		{
			echo '<div class="cols' . $columnsMega . '">';
		}

		if ($subtitleMega = $item->params->get('subtitleMega'))
		{
			if ($structure)
			{
				echo '<div class="col-12 col' . $columnsMega . '">';
			}

			echo '<div class="page-header">';
			echo '<h4>' . $subtitleMega . '</h4>';
			echo '</div>';

			if ($structure)
			{
				echo '</div>';
			}
		}

		// Display custom modules.
		$modules = JModuleHelper::getModules($item->params->get('positionMega'));

		foreach ($modules as $module)
		{
			$output = JModuleHelper::renderModule($module, array('style' => 'mega', 'structure' => $structure));
			$params = new JRegistry;
			$params->loadString($module->params);
			echo $output;
		}

		if ($structure)
		{
			echo '</div>';
		}
	}

	// The next item is deeper.
	if ($item->deeper)
	{
		echo '<ul class="nav-child unstyled small">';
	}

	// The next item is shallower.
	elseif ($item->shallower)
	{
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}

	// The next item is on the same level.
	else
	{
		echo '</li>';
	}

endforeach;
?></ul>