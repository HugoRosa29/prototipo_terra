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

<input type="text" id="busca-servico" onkeyup="myFunction()" placeholder="Busque seu serviço.." title="Serviços de A a Z">

<div id="list-servico">
	<?php foreach (array_chunk($list, count($list) / 3) as $i => $row): ?>
		<ul  class="nav-child list-column-<?php echo $i; ?> unstyled small<?php echo $moduleclass_sfx; ?> ">
			<?php foreach ($row as $item): ?>
				<?php $target = $item->redirect ? ' target="' . $item->target . '"' : ''; ?>
				<li>
					<a href="<?php echo $item->link; ?>"<?php echo $target; ?>>
						<!-- <i class="<?php echo $item->params->get('icon', 'icon-file'); ?>"></i>  --><span class="text"><?php echo htmlspecialchars($item->name); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endforeach; ?>
</div>

<script>
function myFunction() {
	var input, filter, ul, li, a, i, txtValue;	
	input = document.getElementById("busca-servico");	
	filter = input.value.toUpperCase();	
	ul = document.getElementById("list-servico");
	li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
			li[i].style.display = "none";
        }
    }
}
</script>