<?php
/**
 * @package     Auctions
 * @subpackage  mod_compreimoveis
 *
 * Layout "compre-imoveis-aba" — abas Licitações / Leilões no estilo
 * "Eixos e Curvas" (sem jQuery e sem CSS inline; estilos em interno.css).
 *
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Data por extenso (a definição original ficava no override de com_directsales,
// que não roda nesta página — a guarda evita redeclaração quando rodam juntas)
if (!function_exists('dataExtenso')) {
	function dataExtenso($data)
	{
		if (empty($data) || $data == '0000-00-00' || $data == '0000-00-00 00:00:00') {
			return '—';
		}
		$meses = array(
			1 => 'janeiro', 2 => 'fevereiro', 3 => 'março', 4 => 'abril',
			5 => 'maio', 6 => 'junho', 7 => 'julho', 8 => 'agosto',
			9 => 'setembro', 10 => 'outubro', 11 => 'novembro', 12 => 'dezembro'
		);
		$ts = strtotime($data);
		return date('d', $ts) . ' de ' . $meses[(int) date('n', $ts)] . ' de ' . date('Y', $ts);
	}
}

$document = JFactory::getDocument();
$renderer = $document->loadRenderer('modules');

// IDs únicos por instância: permite mais de um módulo de abas na mesma página
$uid = 'm' . (isset($module->id) ? (int) $module->id : uniqid());
?>

<div class="abas-compre" data-abas>
	<div class="abas-nav" role="tablist" aria-label="Modalidades de compra">
		<button type="button" class="aba-btn is-active" data-aba="aba-licitacoes-<?php echo $uid; ?>" role="tab" aria-selected="true">Licitações</button>
		<button type="button" class="aba-btn" data-aba="aba-leiloes-<?php echo $uid; ?>" role="tab" aria-selected="false">Leilões</button>
	</div>

	<!-- ================= LICITAÇÕES ================= -->
	<div class="aba-conteudo is-active" id="aba-licitacoes-<?php echo $uid; ?>" role="tabpanel">
		<div class="aba-grid">
			<div>
				<p class="introducao">Quando você vende algum produto, como decide para quem vender? Geralmente, utilizam-se critérios tais como: quem paga mais, quem dá uma entrada maior, quem paga em um menor número de parcelas, entre outros.</p>

				<h4 class="table-heading">Editais mais recentes</h4>

				<?php $n = 0; ?>
				<?php foreach ($list2 as $item) : ?>
					<?php
					if (json_decode($item->image)) {
						$image = JUri::root() . 'images/biddings/thumbnails/' . json_decode($item->image)[0];
					} elseif ($item->image) {
						$image = JUri::root() . 'images/biddings/thumbnails/' . $item->image;
					} else {
						$image = '';
					}
					?>
					<?php if ($n++ > 0) : ?><div class="survey-divider" aria-hidden="true"></div><?php endif; ?>
					<a class="edital-card plot-frame" href="<?php echo $item->link ? $item->link : '#'; ?>">
						<div class="edital-thumb">
							<?php if ($image) : ?>
								<img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($item->title); ?>">
							<?php endif; ?>
						</div>
						<div class="edital-info">
							<span class="edital-titulo"><?php echo $item->title; ?></span>
							<div class="edital-datas">
								<div>
									<span class="k">Caução até</span>
									<span class="v"><?php echo dataExtenso($item->date_deposit); ?></span>
								</div>
								<div>
									<span class="k">Licitação em</span>
									<span class="v"><?php echo dataExtenso($item->date_bidding); ?></span>
								</div>
							</div>
							<?php if (!empty($item->description)) : ?>
								<p class="edital-desc"><?php echo substr(strip_tags($item->description), 0, 120); ?></p>
							<?php endif; ?>
						</div>
					</a>
				<?php endforeach; ?>

				<div class="section-footer-actions">
					<a href="#" class="btn btn-line" title="Ver todos">Ver todos</a>
				</div>
			</div>

			<aside>
				<div class="interna-direita">
					<?php echo $renderer->render('contexto-licitacao', array('style' => 'container'), null); ?>
				</div>
			</aside>
		</div>
	</div>

	<!-- ================= LEILÕES ================= -->
	<div class="aba-conteudo" id="aba-leiloes-<?php echo $uid; ?>" role="tabpanel">
		<div class="aba-grid">
			<div>
				<p class="introducao">O leilão é outra modalidade de venda de imóveis da Terracap: os lotes são ofertados em sessões públicas, com lances a partir do valor mínimo definido em edital.</p>

				<h4 class="table-heading">Leilões mais recentes</h4>

				<?php $n = 0; ?>
				<?php foreach ($list as $item) : ?>
					<?php
					if (json_decode($item->image)) {
						$image = JUri::root() . 'images/auctions/thumbnails/' . json_decode($item->image)[0];
					} elseif ($item->image) {
						$image = JUri::root() . 'images/auctions/thumbnails/' . $item->image;
					} else {
						$image = '';
					}
					?>
					<?php if ($n++ > 0) : ?><div class="survey-divider" aria-hidden="true"></div><?php endif; ?>
					<a class="edital-card plot-frame" href="<?php echo $item->link ? $item->link : '#'; ?>">
						<div class="edital-thumb">
							<?php if ($image) : ?>
								<img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($item->title); ?>">
							<?php endif; ?>
						</div>
						<div class="edital-info">
							<span class="edital-titulo"><?php echo $item->title; ?></span>
							<div class="edital-datas">
								<div>
									<span class="k">Data do 1º leilão</span>
									<span class="v"><?php echo dataExtenso($item->date_one); ?></span>
								</div>
								<div>
									<span class="k">Data do 2º leilão</span>
									<span class="v"><?php echo dataExtenso($item->date_two); ?></span>
								</div>
							</div>
							<?php if (!empty($item->description)) : ?>
								<p class="edital-desc"><?php echo substr(strip_tags($item->description), 0, 120); ?></p>
							<?php endif; ?>
						</div>
					</a>
				<?php endforeach; ?>

				<div class="section-footer-actions">
					<a href="#" class="btn btn-line" title="Ver todos">Ver todos</a>
				</div>
			</div>

			<aside>
				<div class="interna-direita">
					<?php echo $renderer->render('contexto-leilao', array('style' => 'container'), null); ?>
				</div>
			</aside>
		</div>
	</div>
</div>

<script>
// Abas sem jQuery: um único handler delegado atende todas as instâncias
// [data-abas] da página (o guard evita registro duplicado quando mais de
// um módulo de abas imprime este mesmo script).
(function(){
	if (window._terracapAbas) { return; }
	window._terracapAbas = true;
	function maisProximo(el, sel){
		var m = Element.prototype.matches || Element.prototype.msMatchesSelector;
		while (el && el.nodeType === 1) {
			if (m.call(el, sel)) { return el; }
			el = el.parentNode;
		}
		return null;
	}
	document.addEventListener('click', function(ev){
		var btn = maisProximo(ev.target, '.aba-btn[data-aba]');
		if (!btn) { return; }
		var wrap = maisProximo(btn, '[data-abas]');
		if (!wrap) { return; }
		Array.prototype.forEach.call(wrap.querySelectorAll('.aba-btn[data-aba]'), function(b){
			b.classList.remove('is-active');
			b.setAttribute('aria-selected', 'false');
		});
		Array.prototype.forEach.call(wrap.querySelectorAll('.aba-conteudo'), function(p){
			p.classList.remove('is-active');
		});
		btn.classList.add('is-active');
		btn.setAttribute('aria-selected', 'true');
		var alvo = document.getElementById(btn.getAttribute('data-aba'));
		if (alvo) { alvo.classList.add('is-active'); }
	});
})();
</script>
