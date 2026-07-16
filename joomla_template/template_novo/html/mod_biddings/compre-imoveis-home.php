<?php
/**
 * @package     Auctions
 * @subpackage  mod_biddings
 *
 * Layout "compre-imoveis-home" — editais em destaque no padrão
 * "Eixos e Curvas" (.featured/.plot-frame do redesign), substituindo o
 * slideshow legado com CSS/JS inline.
 *
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;
?>

<?php if ($params->get('show_description') == 1) : ?>
<p class="section-sub retranca"><?php echo $params->get('name_description'); ?></p>
<?php endif; ?>

<div class="editais-destaque">
	<?php foreach ($list as $key => $item) : ?>
		<?php
		// Primeira imagem do edital (campo pode ser JSON com várias ou string única)
		$imagens = json_decode($item->image);
		if ($imagens && count($imagens)) {
			$image = JUri::root() . 'images/biddings/' . $imagens[0];
		} elseif ($item->image) {
			$image = JUri::root() . 'images/biddings/' . $item->image;
		} else {
			$image = '';
		}

		$local = $item->location;
		if (!empty($local) && strlen($local) > 160) {
			$local = substr($local, 0, 160) . '…';
		}
		?>
		<div class="featured plot-frame">
			<div class="media">
				<a href="<?php echo $item->link ? $item->link : '#'; ?>" title="<?php echo htmlspecialchars($item->title); ?>">
					<?php if ($image) : ?>
						<img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($item->title); ?>">
					<?php endif; ?>
				</a>
				<span class="stamp stamp-verde">EM ANDAMENTO</span>
			</div>
			<div class="info">
				<h3><?php echo $item->title; ?></h3>
				<div class="data-grid">
					<?php if ($params->get('hora-inicio')) : ?>
					<div>
						<div class="k">Propostas</div>
						<div class="v"><?php echo $params->get('hora-inicio'); ?> – <?php echo $params->get('hora-fim'); ?></div>
					</div>
					<?php endif; ?>
					<div>
						<div class="k">Caução até</div>
						<div class="v"><?php echo JHtml::_('date', strtotime($item->date_deposit), 'd M'); ?></div>
					</div>
					<div>
						<div class="k">Licitação em</div>
						<div class="v"><?php echo JHtml::_('date', strtotime($item->date_bidding), 'd M'); ?></div>
					</div>
				</div>
				<?php if (!empty($local)) : ?>
				<div class="info-location">
					<strong>Localização:</strong> <?php echo $local; ?>
				</div>
				<?php endif; ?>
				<div class="info-actions">
					<a href="<?php echo $item->link ? $item->link : '#'; ?>" class="btn btn-line" title="Saiba mais">Saiba mais</a>
					<?php if ($params->get('show_link2')) : ?>
						<a href="<?php echo $params->get('url_link2'); ?>" class="btn btn-primary" title="<?php echo $params->get('name_link2'); ?>" target="_blank"><?php echo $params->get('name_link2'); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<?php if ($params->get('show_link') == 1 || $params->get('show_link3') == 1) : ?>
<div class="section-footer-actions">
	<?php if ($params->get('show_link3') == 1) : ?>
		<a href="<?php echo $params->get('url_link3'); ?>" class="btn btn-line" title="<?php echo $params->get('name_link3'); ?>" target="_blank"><?php echo $params->get('name_link3'); ?></a>
	<?php endif; ?>
	<?php if ($params->get('show_link') == 1) : ?>
		<a href="<?php echo $params->get('url_link'); ?>" class="btn btn-line" title="<?php echo $params->get('name_link'); ?>"><?php echo $params->get('name_link'); ?></a>
	<?php endif; ?>
</div>
<?php endif; ?>
