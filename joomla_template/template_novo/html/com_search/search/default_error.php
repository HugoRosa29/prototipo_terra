<?php
/**
 * Erro / nenhum resultado (com_search) — redesign "Eixos e Curvas".
 */

// no direct access
defined('_JEXEC') or die;
?>
<?php if ($this->error): ?>
<div class="busca-vazia">
	<span class="code">NENHUM RESULTADO</span>
	<p><?php echo $this->escape($this->error); ?></p>
</div>
<?php endif; ?>
