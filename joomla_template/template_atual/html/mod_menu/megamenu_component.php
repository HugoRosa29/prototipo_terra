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
$class = $item->anchor_css ?   $item->anchor_css   : '';
$title = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';

// MEGAMENU
if ($item->params->get('activeMega') && $item->level == 1)
{
	$class .= ' nav-link ';

	$att = "id=\"dropdown$item->id\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"";

} elseif($item->level == 1 || $item->level == 'NULL') {
	$class .= ' nav-link';
}else{
	$class .= ' dropdown-item';
}

if (!empty($class))
{
	$class = ' class="' . trim($class) . '"';
}
if ($item->menu_image)
{
	$item->params->get('menu_text', 1) ?
	$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" /><span class="image-title">' . $item->title . '</span> ' :
	$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />';
}
else
{
	$linktype = '<span class="text">' . $item->title . '</span>';
}

if ($menu_icon = $item->params->get('menu_icon'))
{
	$linktype = '<i class="' . $menu_icon . '"></i> ' . $linktype;
}

if ($badge = $item->params->get('menu_badge'))
{
	$linktype = $linktype . ' <span class="badge">' . $badge . '</span>';
}

if ($label = $item->params->get('menu_label'))
{
	$linktype = '<span class="label ' . $label . '">' . $linktype . '</span>';
}
if($item->title != "Busca" && $activeHover == 1){
	// exit;
	$linktype = '<span class="text">' . $item->title . '</span>';
	$linktype .= '<span class="seta-baixo" style="
		margin-left: 5px;
		content: &quot;&quot;;
		display: inline-block;
		vertical-align: middle;
		margin-right: 10px;
		width: 0;
		height: 0;
		border-left: 5px solid transparent;
		border-right: 5px solid transparent;
		border-top: 5px solid #000;
	"></span>';
	// var_dump($linktype);
	// exit;
	}

switch ($item->browserNav):
	default:
	case 0:
?><a <?php echo $class; ?>href="<?php echo $item->flink; ?>" <?php echo $title; ?>><?php echo $linktype; ?> </a><?php
		break;
	case 1:
		// _blank
?><a <?php echo $class; ?>href="<?php echo $item->flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
	case 2:
	// window.open
?><a <?php echo $class; ?>href="<?php echo $item->flink; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;" <?php echo $title; ?>><?php echo $linktype; ?></a>
<?php
		break;
endswitch;
