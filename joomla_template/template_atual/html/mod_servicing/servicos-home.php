<?php
/**
 * @package     Servicing
 * @subpackage  mod_servicing
 *
 * @author      Bruno Batista <bruno.batista@ctis.com.br>
 * @copyright   Copyright (C) 2013 CTIS IT Services. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Load dependent classes.
require_once JPATH_SITE . '/components/com_servicing/helpers/route.php';
?>

<?php if ($params->get('show_description') == 1): ?>
<div class="retranca text-center mb-5"><?php echo $params->get('name_description'); ?></div>
<?php endif ?>
<div class="row">
	<?php foreach ($list as $key => $item): ?>
	   	<?php $target = $item->redirect ? ' target="' . $item->target . '"' : ''; ?>
       <div class="col-md-3">
      	<?php if ($item->summary): ?>
			<a href="<?php echo $item->link; ?>" data-title="<?php echo htmlspecialchars($item->name); ?>" data-content="<?php echo htmlspecialchars($item->summary); ?>"<?php echo $target; ?>>
		<?php else: ?>
			<a href="<?php echo $item->link; ?>"<?php echo $target; ?>>
		<?php endif; ?>	
        	<div class="item rounded d-flex flex-column justify-content-center align-items-center p-3 text-center shadow-sm">
                	<span class="texto-servicos-black  "><?php echo htmlspecialchars($item->name); ?></span>
             	</div>
          	</a>
       </div>
	   	<?php if($key == 6): ?>
	   		<?php if ($params->get('show_link') == 1): ?>
			   	<div class="col-md-3 ">
					<a href="<?php echo $params->get('url_link'); ?>" alt="<?php echo $params->get('name_link'); ?>">
						<div class="item-link rounded d-flex flex-column justify-content-center align-items-center p-3 text-center">
							<span class="texto-servicos-black"><?php echo $params->get('name_link'); ?> <i class="fas fa-arrow-right"></i></span>
						</div>
					</a>
			   	</div>
		   	<?php endif ?>
	   	<?php endif; ?>
   	<?php endforeach; ?>
</div>