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
<?php if (!empty($list)): ?>
	<ul class="archive-module<?php echo $moduleclass_sfx; ?>">
		<?php foreach ($list as $item): ?>
			<li>
				<a href="<?php echo $item->link; ?>"><?php echo $item->text; ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>