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
$doc = JFactory::getDocument();

// Note. It is important to remove spaces between elements.

?>
<?php $segundaOpcaoMenu = 0; ?>
<style>

.dropdown2:hover>.dropdown-menu {
  display: block;
}

.dropdown2>.dropdown-toggle:active {
  /*Without this, clicking will make it sticky*/
    pointer-events: none;
}

/* @media (min-width: 992px){
.navbar-expand-lg .navbar-collapse {
    flex-basis: 100%;
}
} */
</style>

<?php //endif; ?>
<?php // The menu class is deprecated. Use nav instead. ?>
<div class="menu-principal">
    <div class="container">
       	<nav class="navbar navbar-expand-lg navbar-light bg-light megamenu-base ">
       		<a class="navbar-brand" href="index.php">
       			<img src="<?php echo $doc->params->get('logo') ?>" class="img-fluid" alt="Logo Terracap">
       		</a>

			<button class="hamburger hamburger--collapse navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>

			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav mr-auto"<?php
					$tag = '';

					if ($params->get('tag_id') != null)
					{
						$tag = $params->get('tag_id') . '';

						echo ' id="' . $tag . '"';
					}
				?>>
				<?php  //echo '<pre>'; var_dump($list); exit;
				foreach ($list as $i => &$item):
					
					$class = 'item-' . $item->id;
					$activeMega = $item->params->get('activeMega');
					
					if($item->params->get('activeHover')){
						$activeHover = $item->params->get('activeHover');
					} else {
						$activeHover = 0;
					}

					//var_dump($activeHover,$activeMega);// exit;

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
					// MEGAMENU
					if ($item->level == 1 && $activeHover == 0)
					{
						$class .= ' nav-item dropdown megamenu-li';
					} elseif($item->level == 1 && $activeHover == 1){
						$class .= ' nav-item dropdown2 megamenu-li';
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
							require JModuleHelper::getLayoutPath('mod_menu', 'megamenu_' . $item->type);
							break;

						default:
							require JModuleHelper::getLayoutPath('mod_menu', 'megamenu_url');
							break;
					endswitch;

					if ($activeMega)
					{
						// Initialiase variables.
						$columnsMega = $item->params->get('columnsMega', 3);
						$structure   = $item->params->get('structure', 1);

						if ($structure)
						{
							echo '<div class="dropdown-menu megamenu" aria-labelledby="dropdown'.$item->id.'">';
							echo '<div class="container"> <div class="row">';
						}

						if ($subtitleMega = $item->params->get('subtitleMega'))
						{
							if ($structure)
							{
								echo '<div class="dropdown-menu megamenu" aria-labelledby="dropdown'.$item->id.'">';
								echo '<div class="' . $columnsMega . '">';
							}

							echo '<div class="page-header">';
							echo '<h4>' . $subtitleMega . '</h4>';
							echo '</div>';

							if ($structure)
							{
								echo '</div></div> </div>';
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
			</div>
		</nav>
    </div>
</div> <!-- end .menu-principal --> 	
