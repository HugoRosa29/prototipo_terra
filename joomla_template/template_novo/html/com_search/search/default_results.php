<?php
/**
 * Itens do resultado de busca — redesign "Eixos e Curvas".
 * Cada resultado vira um card com título, trecho, tags e data em mono.
 * Mantém o ajuste de rota do override anterior (AGENDADIRIGENTES).
 */

// no direct access
defined('_JEXEC') or die;
?>

<div class="resultado-lista <?php echo $this->pageclass_sfx; ?>">
	<?php foreach ($this->results as $result): ?>
		<article class="resultado-item">
			<h3 class="resultado-titulo">
				<?php if ($result->href): ?>
					<a href="<?php echo preg_match('/AGENDADIRIGENTES/', strtoupper($result->href)) ? JRoute::_($result->href) . '&Itemid=101' : JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1): ?> target="_blank"<?php endif; ?>>
						<?php echo $result->title; ?>
					</a>
				<?php else: ?>
					<?php echo $result->title; ?>
				<?php endif; ?>
			</h3>

			<p class="resultado-texto">
				<?php echo $result->text; ?>
			</p>

			<div class="resultado-meta">
				<?php if ($this->params->get('show_date') && $result->created != ''): ?>
					<span class="resultado-data"><?php echo JText::sprintf($result->created); ?> — <?php echo $this->escape($result->section); ?></span>
				<?php endif; ?>
				<?php if (@$result->metakey != ''): ?>
					<span class="resultado-tags">
						tags: <?php TemplateSearchHelper::displayMetakeyLinks($result->metakey, '', $this->escape($this->origkeyword)); ?>
					</span>
				<?php endif; ?>
			</div>
		</article>
	<?php endforeach; ?>
</div>
