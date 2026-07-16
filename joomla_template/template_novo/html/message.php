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

/**
 * Render the system message.
 *
 * @param   array  $msgList  An array contains system message.
 *
 * @return  string  System message markup.
 *
 * @since   3.2
 */
function renderMessage($msgList)
{
	// Build the return string.
	$buffer = '';
	$alert  = array('error' => 'alert-error', 'warning' => 'alert-warning', 'notice' => 'alert-info', 'message' => 'alert-success');

	// Only render the message list and the close button if has items.
	if (is_array($msgList) && (count($msgList) >= 1))
	{
		$buffer .= "\n<div id=\"system-message-container\">";
		$buffer .= "\n<div id=\"system-message\">";

		foreach ($msgList as $type => $msgs)
		{
			$buffer .= "\n<div class=\"alert " . $alert[$type] . "\">";

			// This requires JS so we should add it trough JS. Progressive enhancement and stuff.
			$buffer .= "<a class=\"close\" data-dismiss=\"alert\">&times;</a>";

			if (count($msgs))
			{
				$buffer .= "\n<h4 class=\"alert-heading\">" . JText::_($type) . "</h4>";
				$buffer .= "\n<div>";

				foreach ($msgs as $msg)
				{
					$buffer .= "\n\t\t<p>" . $msg . "</p>";
				}

				$buffer .= "\n</div>";
			}

			$buffer .= "\n</div>";
		}

		$buffer .= "\n</div>";
		$buffer .= "\n</div>";
	}

	return $buffer;
}
