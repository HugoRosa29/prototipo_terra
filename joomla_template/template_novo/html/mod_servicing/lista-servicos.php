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
	<?php
	// Arredonda para cima: com divisão simples sobra uma 4ª coluna com o resto
	// (ex.: 31 itens / 3 = 10 por coluna → 10+10+10+1). O max() evita chunk 0
	// (divisão por zero / array_chunk inválido) quando há menos de 3 serviços.
	$porColuna = max(1, (int) ceil(count($list) / 3));
	?>
	<?php foreach (array_chunk($list, $porColuna) as $i => $row): ?>
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
	var input = document.getElementById("busca-servico");
	var lista = document.getElementById("list-servico");

	if (!input || !lista) {
		return;
	}

	var filtro = input.value.trim().toUpperCase();
	var itens  = lista.getElementsByTagName("li");

	for (var i = 0; i < itens.length; i++) {
		var link  = itens[i].getElementsByTagName("a")[0];
		var texto = link ? (link.textContent || link.innerText) : '';

		// Alterna uma classe em vez de style inline: na coluna lateral o
		// interno.css aplica "display:block !important" aos <li>, que venceria
		// um display:none escrito inline (!important > estilo inline).
		if (texto.toUpperCase().indexOf(filtro) > -1) {
			itens[i].className = itens[i].className.replace(/\s*servico-oculto\b/g, '');
		} else if (itens[i].className.indexOf('servico-oculto') === -1) {
			itens[i].className += ' servico-oculto';
		}
	}
}
</script>