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

if ($menu_icon = $item->params->get('menu_icon'))
{
	$item->title = '<i class="' . $menu_icon . '"></i> ' . $item->title."-";
}
?>
<span class="nav-header"><?php echo $item->title; ?></span>