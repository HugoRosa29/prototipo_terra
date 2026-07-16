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

if ($this->user->get('guest'))
{
	// The user is not logged in.
	echo $this->loadTemplate('login');
}
else
{
	// The user is already logged in.
	echo $this->loadTemplate('logout');
}
