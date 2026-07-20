<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.terracap2026
 *
 * Template Terracap "Eixos e Curvas" — redesign 2026.
 * Convertido do protótipo estático (index.html / terracap.css / terracap.js)
 * mantendo as posições de módulo do template onepageterracap2019.
 *
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Variáveis ativas
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$sitename = $app->get('sitename', '');
$metaDesc = $app->get('MetaDesc', '');
$metaKey  = $app->get('MetaKeys', '');

$jinput      = $app->input;
$itemid      = $jinput->get('Itemid', 0, 'integer');
$menu        = $app->getMenu();
$active_item = $menu->getItem($itemid);
$isHome      = (!empty($active_item->home) && $active_item->home == '1');

// Helper (mesmo do template anterior — usado também pelos overrides em html/)
require_once JPATH_SITE . '/templates/' . $this->template . '/helper.php';

$doc->setHtml5(true);

$tpl_url      = $this->baseurl . '/templates/' . $this->template;
$servicos_url = $this->params->get('servicosUrl', 'https://servicosonline.terracap.df.gov.br/');
$chat_url     = $this->params->get('chatUrl', 'https://terracap.chat.comunix.tech/chat-externo');
$analytics    = $this->params->get('analytics', '');

// Logotipo: parâmetro do template ou imagem oficial do portal
if ($this->params->get('logo')) {
	$logo = JURI::root(true) . '/' . $this->params->get('logo');
} else {
	$logo = 'https://www.terracap.df.gov.br/images/sampledata/logo.png';
}

// Prefixo para links âncora (nas internas, âncoras apontam para a home)
$ancora = $isHome ? '' : $this->baseurl . '/';

// Os módulos herdados do site atual foram feitos para o CSS/JS do template antigo
// (style.css, mega-menu.js, swiper). Enquanto não forem adaptados ao novo estilo,
// o template usa o conteúdo estático do protótipo; habilite cada posição nos
// parâmetros do template ("Conteúdo") conforme for migrando os módulos.
$usarModuloMenu    = (int) $this->params->get('usarModuloMenu', 0);
$usarModuloBanner  = (int) $this->params->get('usarModuloBanner', 0);
$usarModulosHome   = (int) $this->params->get('usarModulosHome', 0);
$usarModulosRodape = (int) $this->params->get('usarModulosRodape', 0);

// Camada legada (CSS/JS do template antigo) nas páginas internas: dá base de
// estilo aos overrides e módulos herdados; o novo estilo carrega depois e vence.
$legadoInternas = (!$isHome && $this->params->get('carregarBootstrapInternas', 1));

// Cache-busting dos assets do template: a URL muda quando o arquivo muda,
// evitando que navegadores/proxies sirvam CSS/JS antigos após um redeploy.
$assetVer = function ($rel) {
	$f = __DIR__ . '/' . $rel;
	return is_file($f) ? '?v=' . filemtime($f) : '';
};

$hasMenu         = $usarModuloMenu && $this->countModules('menu-principal');
$hasBanner       = $usarModuloBanner && $this->countModules('super-banner');
$hasHomeModules  = $usarModulosHome && $this->countModules('pagina-inicial');
$hasRodape1      = $usarModulosRodape && $this->countModules('rodape-1');
$hasRodape2      = $usarModulosRodape && $this->countModules('rodape-2');
$hasRodape3      = $usarModulosRodape && $this->countModules('rodape-3');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<?php if ($metaDesc && $isHome) : ?>
	<meta name="description" content="<?php echo $metaDesc; ?>" />
	<?php endif; ?>
	<?php if ($metaKey && $isHome) : ?>
	<meta name="keywords" content="<?php echo $metaKey; ?>" />
	<?php endif; ?>
	<meta name="theme-color" content="#003D6B" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $tpl_url; ?>/favicon.ico" />

	<!-- Fontes do redesign: Space Grotesk (display), Public Sans (texto), JetBrains Mono (rótulos) -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Public+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
	<!-- Material Icons: o style.css legado e os overrides (html/) usam a fonte por ligadura -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- CSS -->
	<?php if ($legadoInternas) : ?>
	<!-- Camada legada (template antigo) somente nas internas: os overrides herdados (html/) dependem dela -->
	<link rel="stylesheet" href="<?php echo $tpl_url; ?>/css/bootstrap.min.css<?php echo $assetVer('css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo $tpl_url; ?>/css/style.css<?php echo $assetVer('css/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo $tpl_url; ?>/css/media-querie.css<?php echo $assetVer('css/media-querie.css'); ?>">
	<link rel="stylesheet" href="<?php echo $tpl_url; ?>/css/user.css<?php echo $assetVer('css/user.css'); ?>">
	<!-- Ícones "icon-*" do Joomla (icomoon do núcleo) -->
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/jui/css/icomoon.css">
	<!-- Font Awesome 5 via CDN: a cópia do template antigo veio sem a pasta webfonts
	     e sem os pacotes de ícones do modo SVG+JS; o CDN traz CSS + fontes completos -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous">
	<?php endif; ?>
	<!-- O novo estilo carrega por último e prevalece sobre a camada legada -->
	<link rel="stylesheet" href="<?php echo $tpl_url; ?>/css/terracap.css<?php echo $assetVer('css/terracap.css'); ?>">
	<link rel="stylesheet" href="<?php echo $tpl_url; ?>/css/interno.css<?php echo $assetVer('css/interno.css'); ?>">

	<?php if ($legadoInternas) : ?>
	<!-- jQuery + Bootstrap JS no <head>, como no template anterior: módulos herdados
	     imprimem <script> inline com jQuery no meio da página (abas, acordeões,
	     geolocalização) e quebrariam se o jQuery só carregasse no fim do body -->
	<script src="<?php echo $tpl_url; ?>/js/jquery.min.js<?php echo $assetVer('js/jquery.min.js'); ?>"></script>
	<script src="<?php echo $tpl_url; ?>/js/bootstrap.min.js<?php echo $assetVer('js/bootstrap.min.js'); ?>"></script>
	<?php endif; ?>

	<?php if ($analytics) : ?>
	<script type="text/javascript">
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', '<?php echo $analytics; ?>', 'auto');
		ga('send', 'pageview');
	</script>
	<?php endif; ?>
</head>
<body class="<?php echo $isHome ? 'pagina-inicial' : 'pagina-interna'; ?> <?php echo TmplHelper::getPageClass($active_item, true); ?>">
	<a href="#conteudo" class="skip-link">Pular para o conteúdo</a>

	<header class="site-header">
		<div class="container nav-row">
			<a class="brand" href="<?php echo $this->baseurl; ?>/">
				<img src="<?php echo $logo; ?>" alt="<?php echo $sitename; ?>">
				<span class="coord">15°47'38"S&nbsp;&nbsp;47°55'40"O</span>
			</a>

			<nav class="main-nav" id="mainNav">
				<?php if ($hasMenu) : ?>
					<jdoc:include type="modules" name="menu-principal" style="none" />
				<?php else : ?>
					<!-- Fallback estático (nenhum módulo publicado em "menu-principal") -->
					<div class="nav-item" data-nav-item>
						<button class="nav-link-btn" aria-haspopup="true" aria-expanded="false">
							A Terracap
							<svg class="chev" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 4l3.5 4 3.5-4"/></svg>
						</button>
						<div class="mega-panel">
							<div class="mega-panel-inner container">
								<div class="mega-col">
									<h5>Conheça a Terracap</h5>
									<a class="mega-link" href="index.php/conheca-a-terracap">Quem somos, organograma, agenda de autoridades</a>
									<h5 class="stacked">Gestão</h5>
									<a class="mega-link" href="index.php/gestao-compras-e-servicos">Compras e Serviços, Prestação de contas, <br>Concursos públicos e PDTI</a>
								</div>
								<div class="mega-col">
									<h5>Órgãos colegiados</h5>
									<a class="mega-link" href="index.php/orgao-colegiado">Atas e resoluções</a>
									<h5 class="stacked">Projetos e Estudos</h5>
									<a class="mega-link" href="index.php/projetos-e-estudos">Urbanização e mobilidade, Estudos turísticos e geodésicos, <br>Audiências públicas e Terracap Cidadã</a>
								</div>
								<div class="mega-col">
									<a class="mega-link" href="index.php/perguntas-frequentes-faq">Perguntas Frequentes (FAQ)</a>
									<a class="mega-link" href="index.php/para-servidores">Para Servidores</a>
									<a class="mega-link" href="index.php/comissao-de-etica-coet">Comissão de Ética — COET</a>
								</div>
							</div>
						</div>
					</div>

					<a href="<?php echo $ancora; ?>#regularize-imoveis">Regularize</a>
					<a href="<?php echo $ancora; ?>#compre-imoveis">Compre</a>

					<div class="nav-item dropdown-sm" data-nav-item>
						<button class="nav-link-btn" aria-haspopup="true" aria-expanded="false">
							Serviços
							<svg class="chev" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 4l3.5 4 3.5-4"/></svg>
						</button>
						<div class="mega-panel">
							<div class="mega-panel-inner">
								<a class="mega-link" href="index.php/carta-de-servico" >Carta de Serviço</a>
								<a class="mega-link" href="<?php echo $servicos_url; ?>" target="_blank" rel="noopener">Serviços Online</a>
								<a class="mega-link" href="index.php/servicos-online">Todos os Serviços</a>
								<a class="mega-link" href="index.php/informacoes">Fale Conosco</a>
							</div>
						</div>
					</div>

					<a href="<?php echo $ancora; ?>#invista-em-brasilia">Invista</a>

					<div class="nav-item dropdown-sm" data-nav-item>
						<button class="nav-link-btn" aria-haspopup="true" aria-expanded="false">
							Imprensa
							<svg class="chev" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 4l3.5 4 3.5-4"/></svg>
						</button>
						<div class="mega-panel">
							<div class="mega-panel-inner">
								<a class="mega-link" href="index.php/noticia-imprensa">Notícias</a>
								<a class="mega-link" href="index.php/sala-imprensa">Sala de imprensa</a>
							</div>
						</div>
					</div>

					<a href="index.php/acesso-informacao-home">Governança</a>
					<a href="index.php/acesso-informacao-home">Acesso à informação</a>
				<?php endif; ?>

				<a href="<?php echo $servicos_url; ?>" class="btn btn-primary nav-cta-mobile" target="_blank" rel="noopener">Serviços Online</a>
			</nav>

			<div class="nav-actions">
				<button class="nav-search-btn" aria-label="Buscar no site" aria-haspopup="true" aria-expanded="false" data-search-toggle>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
				</button>
				<a href="<?php echo $servicos_url; ?>" class="btn btn-primary" target="_blank" rel="noopener">Serviços Online</a>
				<button class="nav-toggle" aria-expanded="false" aria-controls="mainNav" aria-label="Abrir menu">
					<svg class="icon-burger" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
					<svg class="icon-close" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="5" y1="5" x2="19" y2="19"/><line x1="19" y1="5" x2="5" y2="19"/></svg>
				</button>
			</div>
		</div>
	</header>

	<!-- Busca: overlay acionado pela lupa do cabeçalho -->
	<div class="search-overlay" data-search-overlay hidden>
		<div class="container search-overlay-inner">
			<form role="search" data-search-form action="<?php echo JRoute::_('index.php?option=com_search'); ?>" method="post">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
				<label class="sr-only" for="site-search">Buscar no site</label>
				<input id="site-search" name="searchword" type="search" placeholder="Buscar editais, serviços, notícias…" autocomplete="off" data-search-input>
				<input type="hidden" name="task" value="search" />
				<button type="button" class="search-close" aria-label="Fechar busca" data-search-close>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="5" y1="5" x2="19" y2="19"/><line x1="19" y1="5" x2="5" y2="19"/></svg>
				</button>
			</form>
			<div class="search-suggestions">
				<span class="coord">Sugestões</span>
				<a href="<?php echo $ancora; ?>#regularize-imoveis">Regularização de imóveis (Venda Direta)</a>
				<a href="<?php echo $ancora; ?>#compre-imoveis">Editais de licitação</a>
				<a href="<?php echo $servicos_url; ?>" target="_blank" rel="noopener">Simulador de valores</a>
				<a href="<?php echo $ancora; ?>#invista-em-brasilia">Investir em Brasília</a>
				<a href="<?php echo $ancora; ?>#transparencia">Transparência e prestação de contas</a>
			</div>
		</div>
	</div>

	<main id="conteudo">

	<?php if (TmplHelper::hasMessage()) : ?>
		<div class="container sistema-mensagens">
			<jdoc:include type="message" />
		</div>
	<?php endif; ?>

	<?php if ($isHome) : ?>

		<?php if ($hasBanner) : ?>
			<!-- super banner (módulo) -->
			<jdoc:include type="modules" name="super-banner" style="none" />
		<?php else : ?>
			<!-- Hero estático (nenhum módulo publicado em "super-banner") -->
			<section class="hero" id="topo" style="padding:0;">
				<img class="bg" src="https://www.terracap.df.gov.br/images/banners/_10A4972_-_2025-04-19_BSB-65_-_Fotos_Daniel_Santos-2.jpg" alt="">
				<span class="hero-coord">BRASÍLIA · DF<br>15°47'38"S 47°55'40"O<br>ALT. 1172M</span>

				<div class="hero-frame">
					<div class="hero-inner">
						<div class="hero-manifesto">
							<!-- <span class="hero-mark" aria-hidden="true"></span>
                             <span class="eyebrow hero-eyebrow">Terracap · Companhia Imobiliária de Brasília</span>  -->
							<h1 class="hero-statement hero-brand">Terracap</h1>
                            <h2 class="hero-statement">Conectando<br>Desenvolvendo.</h2> 
							<p class="hero-lede">Há mais de cinco décadas desenvolvendo a capital
							de todos os brasileiros.</p>
							<nav class="hero-links" aria-label="Principais serviços">
								<a href="#nosso-papel">Conhecer a Terracap</a>
								<a href="#regularize-imoveis">Regularizar imóvel</a>
								<a href="#compre-imoveis">Comprar imóvel</a>
								<a href="#invista-em-brasilia">Investir em Brasília</a>
							</nav>
						</div>
					</div>
				</div>

				<a class="hero-ticker" href="#invista-em-brasilia">
					<div class="container hero-ticker-inner">
						<svg class="hero-ticker-arrow hero-ticker-arrow--prev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 6l-6 6 6 6"/></svg>
						<div class="hero-ticker-content">
							<span class="hero-ticker-dot" aria-hidden="true"></span>
							<span class="hero-ticker-label">CHAMAMENTO PÚBLICO</span>
							<span class="hero-ticker-edital">EDITAL 01-2026</span>
							<span class="hero-ticker-title">Polo Agroindustrial do Rio Preto</span>
						</div>
						<svg class="hero-ticker-arrow hero-ticker-arrow--next" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg>
					</div>
				</a>
			</section>
		<?php endif; ?>

		<?php if ($hasHomeModules) : ?>

			<!-- Seções da home publicadas como módulos (chrome paginaInicial gera <section id><div class="container">) -->
			<jdoc:include type="modules" name="pagina-inicial" style="paginaInicial" />

		<?php else : ?>
			<!-- ============================================================
			     Home estática do protótipo (nenhum módulo em "pagina-inicial").
			     Ao publicar módulos nessa posição, este bloco deixa de aparecer.
			     ============================================================ -->

			<!-- ================= NOSSO PAPEL — bloco institucional ================= -->
			<section id="nosso-papel" aria-labelledby="papel-title">
				<div class="container">
					<span class="eyebrow">Nosso papel</span>
					<h2 class="section-title" id="papel-title">Desenvolvendo o Distrito Federal para as pessoas</h2>
					<p class="section-sub">A Terracap administra as terras públicas do DF. Mais do que comercializar imóveis, planejamos o crescimento das cidades, preservamos o Cerrado e garantimos que a terra cumpra sua função social.</p>

					<div style="height:40px;"></div>

					<div class="pillar-grid">
						<div class="pillar-card reveal">
							<span class="code">Desenvolvimento urbano</span>
							<h3>Planejamento que transforma cidades</h3>
							<p>Estudos urbanísticos, infraestrutura e novos bairros pensados para um crescimento ordenado, que respeita quem já vive no território.</p>
						</div>
						<div class="pillar-card reveal">
							<span class="code">Sustentabilidade</span>
							<h3>Cuidado com o território e o Cerrado</h3>
							<p>Preservação de áreas verdes, compensações ambientais e ocupação responsável do solo, construindo um futuro sustentável para o DF.</p>
						</div>
						<div class="pillar-card reveal">
							<span class="code">Compromisso social</span>
							<h3>A terra cumprindo sua função social</h3>
							<p>Regularização fundiária que garante endereço, segurança jurídica e dignidade para milhares de famílias do Distrito Federal.</p>
						</div>
					</div>
				</div>
			</section>

			<div class="survey-divider" data-tema="indicadores"></div>

			<!-- ================= INDICADORES ================= -->
			<section id="indicadores" aria-labelledby="indicadores-title">
				<div class="container">
					<span class="eyebrow">Território em números</span>
					<h2 class="section-title" id="indicadores-title">Indicadores institucionais</h2>
					<p class="section-sub">Mais do que lotes e contratos: um retrato do que a atuação da Terracap devolve ao Distrito Federal — e a base sobre a qual esta história continua.</p>

					<div style="height:40px;"></div>

					<div class="kpi-row">
						<div class="kpi-tile reveal">
							<span class="kpi-label">Hectares regularizados</span>
							<span class="kpi-value" data-count-to="18240" data-suffix=" ha">0</span>
							<svg class="kpi-spark" data-accent="verde" viewBox="0 0 100 28" preserveAspectRatio="none" aria-hidden="true">
								<polyline class="spark-muted" points="0,20 12,19 24,17 36,18 48,14 60,13" />
								<polyline class="spark-accent" points="60,13 72,10 84,7 100,4" />
							</svg>
							<span class="kpi-delta kpi-up">+6% em 12 meses</span>
						</div>
						<div class="kpi-tile reveal">
							<span class="kpi-label">Famílias atendidas pela regularização</span>
							<span class="kpi-value" data-count-to="21430" data-suffix="">0</span>
							<svg class="kpi-spark" data-accent="data-azul" viewBox="0 0 100 28" preserveAspectRatio="none" aria-hidden="true">
								<polyline class="spark-muted" points="0,22 12,18 24,20 36,15 48,16 60,11" />
								<polyline class="spark-accent" points="60,11 72,12 84,6 100,5" />
							</svg>
							<span class="kpi-delta kpi-up">+1.840 em 12 meses</span>
						</div>
						<div class="kpi-tile reveal">
							<span class="kpi-label">Empreendimentos em andamento</span>
							<span class="kpi-value" data-count-to="47" data-suffix="">0</span>
							<svg class="kpi-spark" data-accent="dourado" viewBox="0 0 100 28" preserveAspectRatio="none" aria-hidden="true">
								<polyline class="spark-muted" points="0,18 12,20 24,16 36,17 48,12 60,14" />
								<polyline class="spark-accent" points="60,14 72,9 84,10 100,6" />
							</svg>
							<span class="kpi-delta kpi-up">+8 novos projetos</span>
						</div>
						<div class="kpi-tile reveal">
							<span class="kpi-label">Anos a serviço do DF</span>
							<span class="kpi-value" data-count-to="58" data-suffix="">0</span>
							<svg class="kpi-spark" data-accent="cerrado" viewBox="0 0 100 28" preserveAspectRatio="none" aria-hidden="true">
								<polyline class="spark-muted" points="0,20 20,19 40,19 60,18" />
								<polyline class="spark-accent" points="60,18 74,17 88,16 100,15" />
							</svg>
							<span class="kpi-delta kpi-neutral">desde 1972</span>
						</div>
					</div>
				</div>
			</section>

			<div class="survey-divider" data-tema="projetos-terracap"></div>


         <!-- ================= CRIADOS PELA TERRACAP ================= -->
			<section id="projetos-terracap" aria-labelledby="projetos-terracap-title">
				<div class="container">
					<span class="eyebrow">Criados pela Terracap</span>
					<h2 class="section-title" id="projetos-terracap-title">Projetos que nasceram aqui</h2>
					<p class="section-sub">O desenvolvimento do DF também nasce de dentro da Terracap: quando o território pede uma nova direção, criamos as empresas e os projetos para conduzi-la — da inovação tecnológica à regularização do campo.</p>

					<div style="height:44px;"></div>

					<div class="spinoff-grid">
						<a class="spinoff-card plot-frame reveal" href="https://www.bioticsa.com.br/" target="_blank" rel="noopener">
							<div class="spinoff-banner spinoff-tech" style="background-image:url('<?php echo $tpl_url; ?>/img/biotic.jpg');">
								<span class="tag">Inovação · Tecnologia</span>
								<span class="sigla">BIOTIC</span>
							</div>
							<div class="body">
								<span class="code">SUBSIDIÁRIA TERRACAP · BIOTIC S.A.</span>
								<span class="title">Parque Tecnológico de Brasília</span>
								<p>Um milhão de metros quadrados dedicados à biotecnologia e à TIC — espaço para centenas de empresas e milhares de empregos qualificados no coração do DF.</p>
								<span class="dev-link">Conhecer o BIOTIC
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
								</span>
							</div>
						</a>

						<a class="spinoff-card plot-frame reveal" href="https://www.etr.df.gov.br/" target="_blank" rel="noopener">
							<div class="spinoff-banner spinoff-rural" style="background-image:url('<?php echo $tpl_url; ?>/img/etr.jpg');">
								<span class="tag">Regularização rural</span>
								<span class="sigla">ETR</span>
							</div>
							<div class="body">
								<span class="code">SUBSIDIÁRIA TERRACAP · ETR</span>
								<span class="title">Empresa de Regularização de Terras Rurais</span>
								<p>Criada para levar segurança jurídica ao campo: mais de 32 mil hectares regularizados e centenas de produtores rurais com a terra reconhecida.</p>
								<span class="dev-link">Conhecer a ETR
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
								</span>
							</div>
						</a>

						<a class="spinoff-card plot-frame reveal" href="#invista-em-brasilia">
							<div class="spinoff-banner spinoff-mais">
								<span class="tag">Projetos estruturantes</span>
								<span class="sigla">E muito mais</span>
							</div>
							<div class="body">
								<span class="code">DO PAPEL AO TERRITÓRIO</span>
								<span class="title">Do Projeto Orla ao Polo Agroindustrial</span>
								<p>A Terracap também desenha os grandes projetos que abrem novas fronteiras para o DF — lazer, agronegócio, aviação e esporte.</p>
								<span class="dev-link">Ver projetos abertos a investimento
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
								</span>
							</div>
						</a>
					</div>
				</div>
			</section>
                                  
                                  <div class="survey-divider" data-tema="territorio"></div>


			<!-- ================= TERRITÓRIO — mapa interativo ================= -->
			<section id="territorio" aria-labelledby="territorio-title">
				<div class="container">
					<span class="eyebrow">O território</span>
					<h2 class="section-title" id="territorio-title">Onde a Terracap atua</h2>
					<p class="section-sub">Antes de regularizar ou comprar, conheça o mapa: cada região do Distrito Federal está em um momento diferente desta história — regularização, novo empreendimento, estudo ou conclusão. Selecione uma região para ver o que está em curso, ou visite o portal oficial dos empreendimentos que já têm site próprio.</p>

					<div style="height:40px;"></div>

					<div class="territory-wrap">
						<div class="territory-map" role="group" aria-label="Mapa de regiões do Distrito Federal">
							<button type="button" class="territory-node" style="background-image:url('https://commons.wikimedia.org/wiki/Special:FilePath/Bras%C3%ADlia_-_Jardins_de_Burle_Marx_-_Unidade_de_Vizinhan%C3%A7a_(10).jpg?width=800');" data-region="noroeste" data-status="regularizacao" aria-pressed="false"><span>Noroeste</span></button>
							<button type="button" class="territory-node" style="background-image:url('https://commons.wikimedia.org/wiki/Special:FilePath/Ceil%C3%A2ndia_DF_Brasil_-_Vista_do_Centro_-_panoramio.jpg?width=800');" data-region="ceilandia" data-status="regularizacao" aria-pressed="false"><span>Ceilândia</span></button>
							<button type="button" class="territory-node" style="background-image:url('https://commons.wikimedia.org/wiki/Special:FilePath/Bras%C3%ADlia_DF_Brasil%2C_%C3%81guas_Claras_-_Sky_line_da_cidade_-_panoramio.jpg?width=800');" data-region="aguas-claras" data-status="empreendimento" aria-pressed="false"><span>Águas Claras</span></button>
							<button type="button" class="territory-node is-active" style="background-image:url('https://commons.wikimedia.org/wiki/Special:FilePath/Brasilia_-_Congresso_Nacional.jpg?width=800');" data-region="plano-piloto" data-status="estudo" aria-pressed="true"><span>Plano Piloto</span></button>
							<button type="button" class="territory-node" style="background-image:url('https://commons.wikimedia.org/wiki/Special:FilePath/Pond_-_Jardim_Bot%C3%A2nico_de_Bras%C3%ADlia_-_DSC09727.JPG?width=800');" data-region="jardim-botanico" data-status="empreendimento" aria-pressed="false"><span>Jardim Botânico</span></button>
							<button type="button" class="territory-node" style="background-image:url('https://commons.wikimedia.org/wiki/Special:FilePath/Samambaia_DF_Brasil_-_Panoramica_-_panoramio.jpg?width=800');" data-region="samambaia" data-status="regularizacao" aria-pressed="false"><span>Samambaia</span></button>
							<button type="button" class="territory-node" style="background-image:url('https://commons.wikimedia.org/wiki/Special:FilePath/Parque_Arniqueira.jpg?width=800');" data-region="arniqueira" data-status="concluido" aria-pressed="false"><span>Arniqueira</span></button>
						</div>

						<div class="territory-panel" data-territory-panel aria-live="polite" style="background-image:url('https://commons.wikimedia.org/wiki/Special:FilePath/Brasilia_-_Congresso_Nacional.jpg?width=800');">
							<span class="code">REGIÃO ADMINISTRATIVA</span>
							<h3 data-panel-title>Plano Piloto</h3>
							<span class="stamp stamp-dourado" data-panel-status>Estudo em andamento</span>
							<p data-panel-desc>Estudos urbanísticos e geodésicos em curso para atualização do zoneamento de áreas públicas remanescentes.</p>
							<a href="#" class="btn btn-onphoto" data-panel-link>Ver processos da região</a>
						</div>
					</div>

					<div class="territory-legend">
						<span><i class="dot dot-verde"></i>Regularização em curso</span>
						<span><i class="dot dot-data-azul"></i>Novo empreendimento</span>
						<span><i class="dot dot-dourado"></i>Estudo em andamento</span>
						<span><i class="dot dot-cerrado"></i>Concluído</span>
					</div>

					<div style="height:56px;"></div>

					<h3 class="table-heading">Mergulhe em nossos Empreendimentos</h3>
					<p class="section-sub" style="margin-top:-8px;margin-bottom:32px;">Fique por dentro dos nossos empreendimentos, explorando cada detalhe que ele tem a oferecer</p>

					<div class="dev-carousel" data-carousel>
						<button type="button" class="dev-nav-btn dev-nav-prev" data-carousel-prev aria-label="Empreendimento anterior">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 6l-6 6 6 6"/></svg>
						</button>
						<button type="button" class="dev-nav-btn dev-nav-next" data-carousel-next aria-label="Próximo empreendimento">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
						</button>

						<div class="dev-track" data-carousel-track>
							<div class="dev-slide">
								<a class="dev-card reveal" href="https://hugorosa29.github.io/prototipo_aldeia/" target="_blank" rel="noopener" draggable="false">
									<div class="dev-preview">
										<img src="<?php echo $tpl_url; ?>/img/aldeias-do-cerrado-1.jpeg" alt="">
									</div>
									<div class="dev-info">
										<span class="code">SETOR · HABITACIONAL</span>
										<span class="title">Aldeias do Cerrado</span>
										<p class="dev-desc">Loteamento com portal próprio, plantas de lotes, localização e condições de venda em detalhe.</p>
										<span class="dev-link">Visitar site oficial
											<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
										</span>
									</div>
								</a>
							</div>

							<div class="dev-slide">
								<div class="dev-card reveal" aria-disabled="true">
									<div class="dev-preview dev-preview-placeholder"><span>Em breve</span></div>
									<div class="dev-info">
										<span class="code">SETOR · MISTO</span>
										<span class="title">Novo portal em desenvolvimento</span>
										<p class="dev-desc">Este empreendimento ainda não tem site próprio publicado. Volte em breve.</p>
									</div>
								</div>
							</div>

							<div class="dev-slide">
								<div class="dev-card reveal" aria-disabled="true">
									<div class="dev-preview dev-preview-placeholder"><span>Em breve</span></div>
									<div class="dev-info">
										<span class="code">SETOR · COMERCIAL</span>
										<span class="title">Novo portal em desenvolvimento</span>
										<p class="dev-desc">Este empreendimento ainda não tem site próprio publicado. Volte em breve.</p>
									</div>
								</div>
							</div>
						</div>

						<div class="dev-dots" data-carousel-dots></div>
					</div>

					<div style="height:56px;"></div>

					<div class="section-footer-actions">
						<a href="index.php/regularize-imoveis" class="btn btn-line">Regularizar meu imóvel</a>
						<a href="index.php/compre-imoveis" class="btn btn-line">Ver imóveis à venda</a>
					</div>
				</div>
			</section>

			<div class="survey-divider" data-tema="compre-imoveis"></div>


			<!-- ================= COMPRE IMÓVEIS ================= -->
			<section id="compre-imoveis">
				<div class="container">
					<span class="eyebrow">Aquisição</span>
					<h2 class="section-title">Compre Imóveis</h2>
					<p class="section-sub">A venda de imóveis públicos financia o desenvolvimento do DF: os recursos retornam em infraestrutura, regularização e novos espaços urbanos.<br>Escolha o seu imóvel e envie sua proposta online ou presencial.</p>

					<div style="height:44px;"></div>

					<div class="featured plot-frame">
						<div class="media">
							<img src="https://www.terracap.df.gov.br/images/biddings/6a34359d7e1ec.png" alt="Edital de Licitação 09/2026 - Venda de Imóveis">
							<span class="stamp stamp-verde">EM ANDAMENTO</span>
						</div>
						<div class="info">
							<h3>Edital de Licitação 09/2026 — Venda de Imóveis</h3>
							<div class="data-grid">
								<div><div class="k">Propostas</div><div class="v">9h – 10h</div></div>
								<div><div class="k">Caução até</div><div class="v">09 jul</div></div>
								<div><div class="k">Licitação em</div><div class="v">10 jul</div></div>
							</div>
							<div class="info-location">
								<strong>Localização:</strong> Jardim Botânico, Noroeste, Ceilândia, Samambaia e demais regiões do Distrito Federal.
							</div>
							<div class="info-actions">
								<a href="#" class="btn btn-line">Saiba mais</a>
								<a href="https://comprasonline.terracap.df.gov.br/bidding/external/watch" target="_blank" class="btn btn-primary">Acompanhe ao vivo</a>
							</div>
						</div>
					</div>

					<div style="height:56px;"></div>

					<h3 class="table-heading">Painel de editais em andamento</h3>
					<div class="table-scroll reveal">
						<table class="data-table">
							<caption class="sr-only">Editais de licitação de imóveis em andamento, com região, modalidade, status e datas</caption>
							<thead>
								<tr>
									<th scope="col">Edital</th>
									<th scope="col">Região</th>
									<th scope="col">Modalidade</th>
									<th scope="col">Status</th>
									<th scope="col">Caução até</th>
									<th scope="col">Licitação em</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td data-label="Edital">09/2026</td>
									<td data-label="Região">Jardim Botânico, Noroeste, Ceilândia, Samambaia</td>
									<td data-label="Modalidade">Venda de imóveis</td>
									<td data-label="Status"><span class="stamp stamp-verde">Em andamento</span></td>
									<td data-label="Caução até">09 jul</td>
									<td data-label="Licitação em">10 jul</td>
								</tr>
								<tr>
									<td data-label="Edital">07/2026</td>
									<td data-label="Região">Águas Claras</td>
									<td data-label="Modalidade">Leilão</td>
									<td data-label="Status"><span class="stamp stamp-verde">Em andamento</span></td>
									<td data-label="Caução até">22 jul</td>
									<td data-label="Licitação em">24 jul</td>
								</tr>
								<tr>
									<td data-label="Edital">05/2026</td>
									<td data-label="Região">Residencial das Sucupiras</td>
									<td data-label="Modalidade">Venda de imóveis</td>
									<td data-label="Status"><span class="stamp stamp-alerta">Encerrado</span></td>
									<td data-label="Caução até">—</td>
									<td data-label="Licitação em">25 jun</td>
								</tr>
								<tr>
									<td data-label="Edital">04/2026</td>
									<td data-label="Região">SHVP Trecho 2, URB 26/19</td>
									<td data-label="Modalidade">Venda direta (REURB-E)</td>
									<td data-label="Status"><span class="stamp stamp-alerta">Encerrado</span></td>
									<td data-label="Caução até">—</td>
									<td data-label="Licitação em">18 jun</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="section-footer-actions">
						<a href="https://comprasonline.terracap.df.gov.br/" target="_blank" class="btn btn-line">Proposta online / presencial</a>
						<a href="index.php/compre-imoveis" class="btn btn-line">Veja todos os editais</a>
					</div>
				</div>
			</section>

			<div class="survey-divider" data-tema="regularize-imoveis"></div>

            <!-- ================= REGULARIZE IMÓVEIS ================= -->
			<section id="regularize-imoveis">
				<div class="container">
					<span class="eyebrow">Regularização</span>
					<h2 class="section-title">Regularize Imóveis</h2>
					<p class="section-sub">Um endereço reconhecido é segurança jurídica e dignidade para quem já construiu sua vida aqui.<br>A Venda Direta é o caminho para tornar o seu imóvel seu, de direito.</p>

					<div style="height:44px;"></div>

					<div class="scroller">
						<a class="card-lote plot-frame" href="#">
							<div class="thumb">
								<img src="https://www.terracap.df.gov.br/images/directsales/697ba17b1a747.jpeg" alt="">
								<span class="stamp stamp-verde">ABERTO</span>
							</div>
							<div class="body">
								<span class="code">PROPOSTA · 2026</span>
								<div class="title">Solicitação Individual de Compra — Ano 2026</div>
							</div>
						</a>
						<a class="card-lote plot-frame" href="#">
							<div class="thumb">
								<img src="https://www.terracap.df.gov.br/images/directsales/6a27ef5d954f4.png" alt="">
								<span class="stamp stamp-alerta">ENCERRADO</span>
							</div>
							<div class="body">
								<span class="code">EDITAL 04/2026</span>
								<div class="title">SHVP Trecho 2, URB 26/19 — Misto, 1° chamamento</div>
							</div>
						</a>
						<a class="card-lote plot-frame" href="#">
							<div class="thumb">
								<img src="https://www.terracap.df.gov.br/images/directsales/69c6f5d1097c6.jpeg" alt="">
								<span class="stamp stamp-alerta">ENCERRADO</span>
							</div>
							<div class="body">
								<span class="code">EDITAL 03/2026</span>
								<div class="title">SHVP Trecho 02 Residencial, 1° chamamento</div>
							</div>
						</a>
						<a class="card-lote plot-frame" href="#">
							<div class="thumb">
								<img src="https://www.terracap.df.gov.br/images/directsales/6997b6cd84b71.jpg" alt="">
								<span class="stamp stamp-alerta">ENCERRADO</span>
							</div>
							<div class="body">
								<span class="code">EDITAL 02/2026</span>
								<div class="title">SH Arniqueira Comercial, 1° chamamento</div>
							</div>
						</a>
						<a class="card-lote plot-frame" href="#">
							<div class="thumb">
								<img src="https://www.terracap.df.gov.br/images/directsales/6997b4b10c5bc.jpeg" alt="">
								<span class="stamp stamp-alerta">ENCERRADO</span>
							</div>
							<div class="body">
								<span class="code">EDITAL 01/2026</span>
								<div class="title">SH Arniqueira Residencial, 1° chamamento</div>
							</div>
						</a>
						<a class="card-lote plot-frame" href="#">
							<div class="thumb">
								<img src="https://www.terracap.df.gov.br/images/directsales/687004cd5acea.jpg" alt="">
								<span class="stamp stamp-alerta">ENCERRADO</span>
							</div>
							<div class="body">
								<span class="code">EDITAL 07/2025</span>
								<div class="title">SH Arniqueira Comercial, 3° chamamento</div>
							</div>
						</a>
					</div>

					<div class="section-footer-actions">
						<a href="index.php/regularize-imoveis" class="btn btn-line">Veja todos</a>
					</div>
				</div>
			</section>

			<div class="survey-divider" data-tema="servicos-online"></div>


			<!-- ================= SERVIÇOS ONLINE ================= -->
			<section id="servicos-online">
				<div class="container">
					<span class="eyebrow">Depois da compra</span>
					<h2 class="section-title">Serviços</h2>
					<p class="section-sub">A história não termina na assinatura. Para quem já comprou ou regularizou, esses são os canais para acompanhar processos, consultar requerimentos e emitir declarações e certidões.</p>

					<div style="height:44px;"></div>

					<div class="services-grid">
						<a class="service-card" href="<?php echo $servicos_url; ?>" target="_blank">
							<div class="icon"><span>%</span></div>
							<div class="label">Simulador de Valores — Licitação de Imóveis</div>
						</a>
						<a class="service-card" href="<?php echo $servicos_url; ?>" target="_blank">
							<div class="icon"><span>⇄</span></div>
							<div class="label">Regularização (Venda Direta)</div>
						</a>
						<a class="service-card" href="<?php echo $servicos_url; ?>" target="_blank">
							<div class="icon"><span>D</span></div>
							<div class="label">Declarações e Certidões</div>
						</a>
						<a class="service-card" href="<?php echo $servicos_url; ?>" target="_blank">
							<div class="icon"><span>R</span></div>
							<div class="label">Consulta de Requerimentos</div>
						</a>
					</div>
				</div>
			</section>

			<div class="survey-divider" data-tema="invista-em-brasilia"></div>


			<!-- ================= INVISTA EM BRASÍLIA ================= -->
			<section id="invista-em-brasilia" style="background:var(--azul-deep);">
				<div class="container">
					<span class="eyebrow" style="color:#7FC49A;">Novos negócios</span>
					<h2 class="section-title" style="color:var(--white);">Invista em Brasília</h2>
					<p class="section-sub" style="color:#A9B8C2;">Além do lote individual, a Terracap constrói parcerias que geram emprego, infraestrutura e desenvolvimento sustentável para todo o DF. Esses são os projetos abertos a investimento:</p>

					<div style="height:44px;"></div>

					<div class="scroller">
						<a class="card-satelite" href="#">
							<img src="https://www.terracap.df.gov.br/images/Novos_negocios/agro.png" alt="">
							<span class="code">SETOR · AGRONEGÓCIO</span>
							<span class="title">Polo Agroindustrial do Rio Preto</span>
						</a>
						<a class="card-satelite" href="#">
							<img src="https://www.terracap.df.gov.br/images/Novos_negocios/carro.png" alt="">
							<span class="code">SETOR · ESPORTES</span>
							<span class="title">Autódromo Internacional Nelson Piquet</span>
						</a>
						<a class="card-satelite" href="#">
							<img src="https://www.terracap.df.gov.br/images/Novos_negocios/aeroporto-executivo.png" alt="">
							<span class="code">SETOR · AVIAÇÃO</span>
							<span class="title">Aeroporto Planalto Central</span>
						</a>
						<a class="card-satelite" href="#">
							<img src="https://www.terracap.df.gov.br/images/Novos_negocios/projeto-orla.png" alt="">
							<span class="code">SETOR · URBANISMO</span>
							<span class="title">Projeto Orla</span>
						</a>
					</div>

					<div class="section-footer-actions">
						<a href="#" class="btn btn-onphoto">Veja todos</a>
					</div>
				</div>
			</section>

			<!-- ================= TRANSPARÊNCIA ================= -->
			<section id="transparencia">
				<div class="container">
					<span class="eyebrow" style="justify-content:center;">Transparência</span>
					<h2 class="section-title" style="text-align:center;">Tudo isso, à vista de todos</h2>
					<p class="section-sub" style="text-align:center;margin:16px auto 0;">O caminho até aqui — editais, contratos, investimentos — está aberto à consulta. Acompanhe a governança, acesse informações públicas e fale diretamente com a Terracap.</p>
					<div style="height:44px;"></div>
					<div class="legend-grid">
						<a class="legend-item" href="#"><img src="https://www.terracap.df.gov.br/images/sampledata/Ouvidoria-cpia.png" alt=""><span>Ouvidoria Terracap</span></a>
						<a class="legend-item" href="#" target="_blank"><img src="https://www.terracap.df.gov.br/images/sampledata/ico_participa.png" alt=""><span>Ouvidoria GDF</span></a>
						<a class="legend-item" href="#"><img src="https://www.terracap.df.gov.br/images/sampledata/ico-canal-denuncias.png" alt=""><span>Canal de Denúncias</span></a>
						<a class="legend-item" href="#"><img src="https://www.terracap.df.gov.br/images/COET/COET-Logo-pequena.png" alt=""><span>Comissão de Ética</span></a>
						<a class="legend-item" href="#"><img src="https://www.terracap.df.gov.br/images/sampledata/ico-carta-servicos.png" alt=""><span>Carta de Serviços</span></a>
						<a class="legend-item" href="#"><img src="https://www.terracap.df.gov.br/images/sampledata/ico-acesso-informacao.png" alt=""><span>Acesso à Informação</span></a>
						<a class="legend-item" href="#" target="_blank"><img src="https://www.terracap.df.gov.br/images/sampledata/e-protocolo_51.png" alt=""><span>e-Protocolo</span></a>
						<a class="legend-item" href="#" target="_blank"><img src="https://www.terracap.df.gov.br/images/sampledata/mulher_nao_se__cale_pb.png" alt=""><span>Mulher, não se cale</span></a>
					</div>
				</div>
			</section>

			<!-- ================= RECEBA ATUALIZAÇÕES ================= -->
			<section id="atualizacoes">
				<div class="container">
					<div class="newsletter-frame reveal">
						<div class="newsletter-copy">
							<span class="eyebrow">Continue acompanhando</span>
							<h2 class="section-title">Receba atualizações sobre editais e regularização</h2>
							<p class="section-sub" style="margin-top:12px;">Avisamos por e-mail quando um novo edital, leilão ou chamamento público for publicado — sem spam. Assim você acompanha os próximos capítulos desta história.</p>
						</div>
						<form class="newsletter-form" data-newsletter-form novalidate>
							<div class="field-row">
								<label class="sr-only" for="nl-email">E-mail</label>
								<input id="nl-email" name="email" type="email" required placeholder="seu@email.com" autocomplete="email">
								<button type="submit" class="btn btn-primary">Quero receber</button>
							</div>
							<label class="field-check">
								<input type="checkbox" required>
								<span>Concordo em receber comunicações da Terracap e estou ciente da <a href="#">Política de Privacidade</a>, conforme a LGPD.</span>
							</label>
							<p class="field-feedback" data-newsletter-feedback role="status" aria-live="polite"></p>
						</form>
					</div>
				</div>
			</section>

		<?php endif; ?>

	<?php else : ?>

		<!-- ============================================================ PÁGINA INTERNA -->
		<?php
		$preffix         = TmplHelper::getPagePositionPreffix($active_item);
		$posicao_topo    = $preffix . '-topo';
		$posicao_rodape  = $preffix . '-rodape';
		$posicao_direita = $preffix . '-direita';

		$menuitem   = $app->getMenu()->getActive();
		$soModulos  = TmplHelper::isOnlyModulesPage();
		$temDireita = $this->countModules($posicao_direita) || $this->countModules('internas-direita');
		$temCapa    = $this->countModules('pagina-interna-capa') || $this->countModules('pagina-interna-capa-' . $preffix);

		// Título da página: título alternativo da âncora ou título do item de menu
		$titulo_pagina = '';
		if ($menuitem) {
			$titulo_pagina = $menuitem->params->get('menu-anchor_title') ?: $menuitem->title;
		}
		// Componentes de conteúdo imprimem o próprio título; só exibimos o nosso
		// nas páginas de capa (com_blankcomponent), onde ninguém mais o faz.
		$exibe_titulo = $menuitem && $menuitem->component == 'com_blankcomponent' && $titulo_pagina;
		?>

		<div class="page-header-interna">
			<div class="container">
				<jdoc:include type="modules" name="trilha-navegacao" style="none" />
				<?php if ($exibe_titulo) : ?>
					<h1 class="titulo-pagina"><?php echo $titulo_pagina; ?></h1>
				<?php endif; ?>
			</div>
		</div>

		<div class="container pagina-interna-conteudo">

			<?php if ($this->countModules($posicao_topo) || $this->countModules('internas-topo')) : ?>
			<div class="bloco-modulos">
				<jdoc:include type="modules" name="internas-topo" headerLevel="2" style="container" />
				<?php if ($posicao_topo !== 'internas-topo') : // evita duplicar quando o prefixo da página é "internas" ?>
				<jdoc:include type="modules" name="<?php echo $posicao_topo; ?>" headerLevel="2" style="container" />
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if ($temDireita && (!$soModulos || $temCapa)) : ?>
				<!-- conteúdo + coluna lateral -->
				<div class="page-grid">
					<div class="page-main">
						<?php if ($soModulos) : ?>
							<jdoc:include type="modules" name="pagina-interna-capa" style="container" headerLevel="2" />
							<jdoc:include type="modules" name="pagina-interna-capa-<?php echo $preffix; ?>" style="container" headerLevel="2" />
						<?php else : ?>
							<jdoc:include type="component" />
						<?php endif; ?>
					</div>
					<aside class="page-aside">
						<div class="interna-direita">
							<jdoc:include type="modules" name="internas-direita" style="container" />
							<?php if ($posicao_direita !== 'internas-direita') : // evita duplicar quando o prefixo da página é "internas" ?>
							<jdoc:include type="modules" name="<?php echo $posicao_direita; ?>" style="container" />
							<?php endif; ?>
						</div>
					</aside>
				</div>
			<?php elseif ($soModulos) : ?>
				<?php if ($temCapa) : ?>
					<jdoc:include type="modules" name="pagina-interna-capa" style="paginaCapa" />
					<jdoc:include type="modules" name="pagina-interna-capa-<?php echo $preffix; ?>" style="paginaCapa" />
				<?php elseif ($temDireita) : ?>
					<!-- Página de capa sem módulos principais: os módulos de links da
					     lateral viram o conteúdo, exibidos como grade de cards -->
					<div class="capa-links">
						<jdoc:include type="modules" name="internas-direita" style="none" />
						<?php if ($posicao_direita !== 'internas-direita') : // evita duplicar quando o prefixo da página é "internas" ?>
						<jdoc:include type="modules" name="<?php echo $posicao_direita; ?>" style="none" />
						<?php endif; ?>
					</div>
				<?php endif; ?>
			<?php else : ?>
				<jdoc:include type="component" />
			<?php endif; ?>

			<?php if ($this->countModules($posicao_rodape) || $this->countModules('internas-rodape')) : ?>
			<div class="bloco-modulos">
				<?php if ($posicao_rodape !== 'internas-rodape') : // evita duplicar quando o prefixo da página é "internas" ?>
				<jdoc:include type="modules" name="<?php echo $posicao_rodape; ?>" headerLevel="2" style="container" />
				<?php endif; ?>
				<jdoc:include type="modules" name="internas-rodape" headerLevel="2" style="container" />
			</div>
			<?php endif; ?>

		</div><!-- fim .pagina-interna-conteudo -->

	<?php endif; ?>

	</main>

	<footer class="site-footer">
		<div class="container footer-grid">
			<div>
				<?php if ($hasRodape1) : ?>
				<jdoc:include type="modules" name="rodape-1" style="none" />
				<?php else : ?>
				<h4>Atendimento ao Público</h4>
				<p>SAC: <?php echo $this->params->get('sac'); ?><br>Ouvidoria: telefone 162</p>
				<p style="margin-top:12px;">Atendimento presencial — GEATE e Ouvidoria, <?php echo $this->params->get('horario'); ?>.</p>
				<div class="footer-channels">
					<a href="<?php echo $servicos_url; ?>">Requerimento online</a>
					<a href="<?php echo $chat_url; ?>" target="_blank">Chat on-line</a>
					<a href="tel:<?php echo preg_replace('/\D/', '', $this->params->get('telefone')); ?>"><?php echo $this->params->get('telefone'); ?></a>
				</div>
				<?php if ($this->params->get('ocultarFinalRodape') != 1) : ?>
				<p style="margin-top:16px;" class="coord"><?php echo $this->params->get('endereco'); ?></p>
				<?php endif; ?>
				<?php endif; ?>
			</div>

			<div>
				<?php if ($hasRodape2) : ?>
				<jdoc:include type="modules" name="rodape-2" style="none" />
				<?php else : ?>
				<h4>Fique conectado</h4>
				<p>Baixe o app Terracap e faça cadastro de regularização e envio de propostas de licitação.</p>
				<div class="app-badges">
					<a href="#"><img src="https://www.terracap.df.gov.br/templates/onepageterracap2019/img/google-play.png" alt="Google Play"></a>
					<a href="#"><img src="https://www.terracap.df.gov.br/templates/onepageterracap2019/img/app-store.png" alt="App Store"></a>
				</div>
				<div class="social-row">
					<a href="https://www.facebook.com/terracap" target="_blank" title="Facebook"><img src="https://www.terracap.df.gov.br/templates/onepageterracap2019/img/ico-facebook.png" alt=""></a>
					<a href="https://www.instagram.com/terracap/" target="_blank" title="Instagram"><img src="https://www.terracap.df.gov.br/templates/onepageterracap2019/img/ico-instagram.png" alt=""></a>
					<a href="https://www.youtube.com/channel/UCETVTSfQOwX1pMSVxEcG9QA" target="_blank" title="YouTube"><img src="https://www.terracap.df.gov.br/templates/onepageterracap2019/img/ico-youtube.png" alt=""></a>
				</div>
				<?php endif; ?>
			</div>

			<div>
				<?php if ($hasRodape3) : ?>
				<jdoc:include type="modules" name="rodape-3" style="none" />
				<?php else : ?>
				<h4>Notícias</h4>
				<div class="news-item">
					<img src="https://www.terracap.df.gov.br/images/Noticias-2019/Terracap_fachada.jpg" alt="">
					<div>
						<div class="headline">Terracap abre licitação com 107 imóveis e 16 lotes no Residencial das Sucupiras</div>
						<div class="time">17:22 — 25/06</div>
					</div>
				</div>
				<div class="news-item">
					<img src="https://www.terracap.df.gov.br/images/Noticias-2019/REURB_26_de_Setembro.png" alt="">
					<div>
						<div class="headline">Edital para Notificação de Terceiros Interessados</div>
						<div class="time">21:43 — 18/06</div>
					</div>
				</div>
				<a href="index.php/noticia-imprensa" class="btn btn-onphoto" style="margin-top:8px;">Ver todas</a>
				<?php endif; ?>
			</div>
		</div>

		<div class="footer-bottom">
			TERRACAP · COMPANHIA IMOBILIÁRIA DE BRASÍLIA · 15°47'38"S 47°55'40"O
		</div>
	</footer>

	<a href="<?php echo $chat_url; ?>" target="_blank" class="chat-fab" title="Chat on-line" aria-label="Chat on-line">
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<path d="M4 4h16v12H8l-4 4V4z"/>
			<circle cx="8.5" cy="10" r=".9" fill="currentColor" stroke="none"/>
			<circle cx="12" cy="10" r=".9" fill="currentColor" stroke="none"/>
			<circle cx="15.5" cy="10" r=".9" fill="currentColor" stroke="none"/>
		</svg>
	</a>

	<?php if ($this->countModules('debug')) : ?>
		<jdoc:include type="modules" name="debug" style="none" />
	<?php endif; ?>

	<script src="<?php echo $tpl_url; ?>/js/terracap.js<?php echo $assetVer('js/terracap.js'); ?>"></script>

	<?php if (!$isHome) : ?>
	<script>
		// Nas páginas internas, âncoras de menu (href="#secao") passam a apontar para a home,
		// como no comportamento do template anterior — agora sem depender de jQuery.
		(function(){
			var base = '<?php echo JURI::base(); ?>';
			document.querySelectorAll('a.ancora, .main-nav a[href^="#"]').forEach(function(a){
				var href = a.getAttribute('href') || '';
				var pos = href.indexOf('#');
				if (pos !== -1 && href.slice(pos + 1)) {
					a.removeAttribute('data-toggle');
					a.setAttribute('href', base + 'index.php/' + href.slice(pos + 1));
				}
			});
		})();
	</script>
	<?php endif; ?>
</body>
</html>
