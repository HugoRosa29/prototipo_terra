<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_artigos
 *
 * Layout "destaques" — redesign "Eixos e Curvas".
 * Carrossel moderno de notícias em slides hero (imagem + scrim + título).
 * O carrossel Bootstrap 4 original (data-ride="carousel") não funcionava porque
 * o JS do Bootstrap não é carregado neste template; aqui a interação é feita por
 * um script vanilla autocontido (sem jQuery) e por scroll-snap nativo, de modo
 * que continua navegável mesmo sem JS. Usa a classe .noticias-carrossel para
 * não colidir com a grade .listagem-capa-noticias (interno.css).
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<div class="noticias-carrossel <?php echo $moduleclass_sfx; ?>" data-noticias-carrossel>
	<div class="nc-stage">
		<div class="nc-viewport">
			<div class="nc-track">
				<?php foreach ($list as $key => $item) : ?>
					<a class="nc-slide" href="<?php echo $item->link; ?>" title="<?php echo htmlspecialchars($item->title); ?>">
						<div class="nc-media">
							<?php if (!empty($item->img)) : ?>
								<img src="<?php echo $item->img; ?>" alt="<?php echo htmlspecialchars($item->title); ?>"<?php echo $key > 0 ? ' loading="lazy"' : ''; ?>>
							<?php endif; ?>
						</div>
						<div class="nc-body">
							<span class="nc-date"><?php echo date('d/m', strtotime($item->created)); ?> · <?php echo date('H:i', strtotime($item->created)); ?></span>
							<h3 class="nc-title"><?php echo $item->title; ?></h3>
							<?php if (!empty($item->introtext)) : ?>
								<p class="nc-desc"><?php echo substr(strip_tags($item->introtext), 0, 160) . '...'; ?></p>
							<?php endif; ?>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>

		<button type="button" class="nc-nav nc-prev" aria-label="Notícia anterior">
			<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 5l-7 7 7 7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
		</button>
		<button type="button" class="nc-nav nc-next" aria-label="Próxima notícia">
			<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5l7 7-7 7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
		</button>
	</div>

	<div class="nc-dots" aria-hidden="true"></div>
</div>

<?php if ($params->get('show_link')) : ?>
	<div class="mostrar-conteudo text-center">
		<a href="<?php echo $params->get('url_link'); ?>" title="<?php echo $params->get('name_link'); ?>"><?php echo $params->get('name_link'); ?></a>
	</div>
<?php endif; ?>

<script>
(function () {
	function initCarrossel(root) {
		if (root.dataset.ncReady) { return; }
		root.dataset.ncReady = '1';

		var viewport = root.querySelector('.nc-viewport');
		var slides   = Array.prototype.slice.call(root.querySelectorAll('.nc-slide'));
		var dotsWrap = root.querySelector('.nc-dots');
		var prev     = root.querySelector('.nc-prev');
		var next     = root.querySelector('.nc-next');
		if (!viewport || slides.length === 0) { return; }

		var current = 0;

		var dots = slides.map(function (_, i) {
			var b = document.createElement('button');
			b.type = 'button';
			b.className = 'nc-dot' + (i === 0 ? ' is-active' : '');
			b.setAttribute('aria-label', 'Ir para notícia ' + (i + 1));
			b.addEventListener('click', function () { goTo(i); });
			dotsWrap.appendChild(b);
			return b;
		});

		function setActive(i) {
			current = i;
			for (var d = 0; d < dots.length; d++) {
				dots[d].classList.toggle('is-active', d === i);
			}
		}

		function goTo(i) {
			if (i < 0) { i = slides.length - 1; }
			if (i >= slides.length) { i = 0; }
			viewport.scrollTo({ left: slides[i].offsetLeft, behavior: 'smooth' });
			setActive(i);
		}

		if (prev) { prev.addEventListener('click', function () { goTo(current - 1); }); }
		if (next) { next.addEventListener('click', function () { goTo(current + 1); }); }

		// mantém os dots em sincronia com o scroll manual / arrasto
		if ('IntersectionObserver' in window) {
			var io = new IntersectionObserver(function (entries) {
				entries.forEach(function (e) {
					if (e.isIntersecting) {
						var idx = slides.indexOf(e.target);
						if (idx > -1) { setActive(idx); }
					}
				});
			}, { root: viewport, threshold: 0.6 });
			slides.forEach(function (s) { io.observe(s); });
		}

		// autoplay (pausa em hover/foco/toque; respeita prefers-reduced-motion)
		var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		var timer = null;
		function play() {
			if (reduce || slides.length < 2) { return; }
			stop();
			timer = window.setInterval(function () { goTo(current + 1); }, 6000);
		}
		function stop() { if (timer) { window.clearInterval(timer); timer = null; } }

		root.addEventListener('mouseenter', stop);
		root.addEventListener('mouseleave', play);
		root.addEventListener('focusin', stop);
		root.addEventListener('focusout', play);
		viewport.addEventListener('touchstart', stop, { passive: true });
		play();
	}

	function initAll() {
		var list = document.querySelectorAll('[data-noticias-carrossel]');
		for (var i = 0; i < list.length; i++) { initCarrossel(list[i]); }
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initAll);
	} else {
		initAll();
	}
})();
</script>
