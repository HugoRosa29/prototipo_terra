<?php
/**
 * Template Terracap — "Eixos & Curvas"
 * Convertido do protótipo estático para Joomla 3.1 (modular).
 */
defined('_JEXEC') or die;

$app      = JFactory::getApplication();
$doc      = JFactory::getDocument();
$template = $this->template;
$chatUrl  = $this->params->get('chatUrl', 'https://terracap.chat.comunix.tech/chat-externo');

// Detecta se cada posição modular tem algum módulo publicado (evita seções vazias no HTML)
$hasMegaTerracap  = $this->countModules('mega-terracap');
$hasMegaServicos  = $this->countModules('mega-servicos');
$hasMegaImprensa  = $this->countModules('mega-imprensa');
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="theme-color" content="#003D6B">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Public+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="icon" href="<?php echo $this->baseurl; ?>/templates/<?php echo $template; ?>/favicon.ico">
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $template; ?>/css/terracap.css">
</head>
<body>
  <a href="#conteudo" class="skip-link">Pular para o conteúdo</a>

  <header class="site-header">
    <div class="container nav-row">
      <a class="brand" href="<?php echo $this->baseurl; ?>/">
        <img src="https://www.terracap.df.gov.br/images/sampledata/logo.png" alt="Terracap">
        <span class="coord">15°47'38"S&nbsp;&nbsp;47°55'40"O</span>
      </a>
      <nav class="main-nav" id="mainNav">

        <?php if ($hasMegaTerracap) : ?>
        <div class="nav-item" data-nav-item>
          <button class="nav-link-btn" aria-haspopup="true" aria-expanded="false">
            A Terracap
            <svg class="chev" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 4l3.5 4 3.5-4"/></svg>
          </button>
          <div class="mega-panel">
            <div class="mega-panel-inner container">
              <jdoc:include type="modules" name="mega-terracap" style="none" />
            </div>
          </div>
        </div>
        <?php endif; ?>

        <a href="#compre-imoveis">Compre</a>
        <a href="#regularize-imoveis">Regularize</a>

        <?php if ($hasMegaServicos) : ?>
        <div class="nav-item dropdown-sm" data-nav-item>
          <button class="nav-link-btn" aria-haspopup="true" aria-expanded="false">
            Serviços
            <svg class="chev" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 4l3.5 4 3.5-4"/></svg>
          </button>
          <div class="mega-panel">
            <div class="mega-panel-inner">
              <jdoc:include type="modules" name="mega-servicos" style="none" />
            </div>
          </div>
        </div>
        <?php endif; ?>

        <a href="#invista-em-brasilia">Invista</a>

        <?php if ($hasMegaImprensa) : ?>
        <div class="nav-item dropdown-sm" data-nav-item>
          <button class="nav-link-btn" aria-haspopup="true" aria-expanded="false">
            Imprensa
            <svg class="chev" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 4l3.5 4 3.5-4"/></svg>
          </button>
          <div class="mega-panel">
            <div class="mega-panel-inner">
              <jdoc:include type="modules" name="mega-imprensa" style="none" />
            </div>
          </div>
        </div>
        <?php endif; ?>

        <a href="#transparencia">Governança</a>
        <a href="#transparencia">Acesso à informação</a>

        <a href="https://servicosonline.terracap.df.gov.br/" class="btn btn-primary nav-cta-mobile" target="_blank" rel="noopener">Serviços Online</a>
      </nav>
      <div class="nav-actions">
        <button class="nav-search-btn" aria-label="Buscar no site" aria-haspopup="true" aria-expanded="false" data-search-toggle>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
        </button>
        <a href="https://servicosonline.terracap.df.gov.br/" class="btn btn-primary" target="_blank" rel="noopener">Serviços Online</a>
        <button class="nav-toggle" aria-expanded="false" aria-controls="mainNav" aria-label="Abrir menu">
          <svg class="icon-burger" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
          <svg class="icon-close" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="5" y1="5" x2="19" y2="19"/><line x1="19" y1="5" x2="5" y2="19"/></svg>
        </button>
      </div>
    </div>
  </header>

  <div class="search-overlay" data-search-overlay hidden>
    <div class="container search-overlay-inner">
      <form role="search" data-search-form>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
        <label class="sr-only" for="site-search">Buscar no site</label>
        <input id="site-search" type="search" placeholder="Buscar editais, serviços, notícias…" autocomplete="off" data-search-input>
        <button type="button" class="search-close" aria-label="Fechar busca" data-search-close>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="5" y1="5" x2="19" y2="19"/><line x1="19" y1="5" x2="5" y2="19"/></svg>
        </button>
      </form>
      <div class="search-suggestions">
        <span class="coord">Sugestões</span>
        <a href="#compre-imoveis">Editais de licitação</a>
        <a href="#regularize-imoveis">Regularização de imóveis (Venda Direta)</a>
        <a href="https://servicosonline.terracap.df.gov.br/" target="_blank" rel="noopener">Simulador de valores</a>
        <a href="#invista-em-brasilia">Investir em Brasília</a>
        <a href="#transparencia">Transparência e prestação de contas</a>
      </div>
    </div>
  </div>

  <main id="conteudo">

  <jdoc:include type="message" />

  <?php // Saída do componente Joomla ativo (necessário para páginas que não sejam a Home, ex.: artigos, contato, busca). ?>
  <jdoc:include type="component" />

  <section class="hero" id="topo" style="padding:0;">
    <img class="bg" src="https://www.terracap.df.gov.br/images/banners/_10A4972_-_2025-04-19_BSB-65_-_Fotos_Daniel_Santos-2.jpg" alt="">
    <span class="hero-coord">BRASÍLIA · DF<br>15°47'38"S 47°55'40"O<br>ALT. 1172M</span>
    <jdoc:include type="modules" name="hero" style="none" />
  </section>

  <section id="indicadores" aria-labelledby="indicadores-title">
    <div class="container">
      <jdoc:include type="modules" name="indicadores" style="none" />
    </div>
  </section>

  <div class="survey-divider"></div>

  <section id="territorio" aria-labelledby="territorio-title">
    <div class="container">
      <jdoc:include type="modules" name="territorio" style="none" />
    </div>
  </section>

  <div class="survey-divider"></div>

  <section id="compre-imoveis">
    <div class="container">
      <jdoc:include type="modules" name="compre" style="none" />
    </div>
  </section>

  <div class="survey-divider"></div>

  <section id="regularize-imoveis">
    <div class="container">
      <jdoc:include type="modules" name="regularize" style="none" />
    </div>
  </section>

  <div class="survey-divider"></div>

  <section id="servicos-online">
    <div class="container">
      <jdoc:include type="modules" name="servicos" style="none" />
    </div>
  </section>

  <section id="invista-em-brasilia" style="background:var(--azul-deep);">
    <div class="container">
      <jdoc:include type="modules" name="invista" style="none" />
    </div>
  </section>

  <section id="transparencia">
    <div class="container">
      <jdoc:include type="modules" name="transparencia" style="none" />
    </div>
  </section>

  <section id="atualizacoes">
    <div class="container">
      <jdoc:include type="modules" name="atualizacoes" style="none" />
    </div>
  </section>

  </main>

  <footer class="site-footer">
    <jdoc:include type="modules" name="footer" style="none" />
  </footer>

  <a href="<?php echo $this->escape($chatUrl); ?>" target="_blank" class="chat-fab" title="Chat on-line" aria-label="Chat on-line">
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

  <script src="<?php echo $this->baseurl; ?>/templates/<?php echo $template; ?>/js/terracap.js"></script>
</body>
</html>
