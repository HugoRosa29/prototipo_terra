<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * Layout "noticias-rodape" — redesign "Eixos e Curvas".
 * Lista de notícias com miniatura, título e hora em rótulo mono, usada
 * tanto no conteúdo (ex.: Sala de Imprensa) quanto no rodapé — o CSS em
 * interno.css adapta o visual quando dentro de .site-footer. Substitui o
 * grid col-sm-* do layout antigo, que quebrava fora do rodapé.
 *
 * Cada item usa a classe .noticia-entry (não .noticia-item): o style.css
 * legado tem um `.noticia-item{height:410px;overflow:hidden}` de outro
 * componente que, por colisão de nome, esticava estes cards a 410px.
 *
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="noticias-modulo">
	<h4 class="table-heading">Notícias</h4>

	<?php foreach ($list as $key => $item) : ?>
		<?php $image = json_decode($item->images); ?>
		<a class="noticia-entry" href="<?php echo $item->link; ?>" title="<?php echo htmlspecialchars($item->title); ?>">
			<?php if (!empty($image->image_intro)) : ?>
				<img class="noticia-thumb" src="<?php echo $image->image_intro; ?>" alt="">
			<?php endif; ?>
			<div class="noticia-body">
				<span class="noticia-titulo"><?php echo $item->title; ?></span>
				<span class="noticia-data coord"><?php echo date('H:i', strtotime($item->created)); ?> — <?php echo date('d/m', strtotime($item->created)); ?></span>
			</div>
		</a>
	<?php endforeach; ?>

	<?php if ($params->get('show_button')) : ?>
	<div class="section-footer-actions">
		<a href="<?php echo $params->get('link_button'); ?>" class="btn btn-line" title="<?php echo $params->get('name_button'); ?>"><?php echo $params->get('name_button'); ?></a>
	</div>
	<?php endif; ?>
</div>
