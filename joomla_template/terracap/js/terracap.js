(function(){
  var header = document.querySelector('.site-header');
  var navToggle = header.querySelector('.nav-toggle');
  var navItems = Array.prototype.slice.call(header.querySelectorAll('[data-nav-item]'));

  function closeItem(item){
    item.classList.remove('open');
    var btn = item.querySelector('.nav-link-btn');
    if(btn) btn.setAttribute('aria-expanded','false');
  }
  function closeAllItems(except){
    navItems.forEach(function(item){ if(item !== except) closeItem(item); });
  }

  navItems.forEach(function(item){
    var btn = item.querySelector('.nav-link-btn');
    if(!btn) return;
    btn.addEventListener('click', function(e){
      e.stopPropagation();
      var isOpen = item.classList.contains('open');
      closeAllItems(item);
      if(isOpen){ closeItem(item); }
      else{ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
    });
  });

  document.addEventListener('click', function(e){
    if(!header.contains(e.target)) closeAllItems();
  });
  document.addEventListener('keydown', function(e){
    if(e.key === 'Escape'){
      closeAllItems();
      if(header.classList.contains('nav-open')){
        header.classList.remove('nav-open');
        navToggle.setAttribute('aria-expanded','false');
      }
    }
  });

  navToggle.addEventListener('click', function(e){
    e.stopPropagation();
    var isOpen = header.classList.toggle('nav-open');
    navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    navToggle.setAttribute('aria-label', isOpen ? 'Fechar menu' : 'Abrir menu');
    if(!isOpen) closeAllItems();
  });

  window.addEventListener('resize', function(){
    if(window.innerWidth > 780 && header.classList.contains('nav-open')){
      header.classList.remove('nav-open');
      navToggle.setAttribute('aria-expanded','false');
      navToggle.setAttribute('aria-label','Abrir menu');
    }
  });
})();

/* ---------- busca: overlay + filtro ---------- */
(function(){
  var toggle = document.querySelector('[data-search-toggle]');
  var overlay = document.querySelector('[data-search-overlay]');
  if(!toggle || !overlay) return;
  var input = overlay.querySelector('[data-search-input]');
  var closeBtn = overlay.querySelector('[data-search-close]');
  var form = overlay.querySelector('[data-search-form]');
  var suggestions = overlay.querySelector('.search-suggestions');
  var defaultHTML = suggestions ? suggestions.innerHTML : '';

  var searchIndex = [
    { title:'Início', keywords:'topo home pagina inicial banner', href:'#topo' },
    { title:'Indicadores institucionais', keywords:'indicadores numeros hectares imoveis licitados empreendimentos estatisticas territorio em numeros', href:'#indicadores' },
    { title:'Onde a Terracap atua — mapa do território', keywords:'territorio mapa regioes noroeste ceilandia aguas claras plano piloto jardim botanico samambaia arniqueira', href:'#territorio' },
    { title:'Empreendimentos com portal próprio', keywords:'empreendimentos aldeias do cerrado loteamento portal', href:'#territorio' },
    { title:'Compre Imóveis', keywords:'compra comprar imoveis lotes venda proposta', href:'#compre-imoveis' },
    { title:'Editais de licitação em andamento', keywords:'edital editais licitacao leilao caucao venda direta reurb', href:'#compre-imoveis' },
    { title:'Regularize Imóveis (Venda Direta)', keywords:'regularizacao regularizar venda direta reurb propostas quadras', href:'#regularize-imoveis' },
    { title:'Serviços', keywords:'servicos simulador de valores declaracoes certidoes consulta de requerimentos', href:'#servicos-online' },
    { title:'Simulador de Valores', keywords:'simulador valores licitacao imoveis calculo', href:'https://servicosonline.terracap.df.gov.br/', external:true },
    { title:'Declarações e Certidões', keywords:'declaracoes certidoes documentos', href:'https://servicosonline.terracap.df.gov.br/', external:true },
    { title:'Consulta de Requerimentos', keywords:'consulta requerimentos processos acompanhamento', href:'https://servicosonline.terracap.df.gov.br/', external:true },
    { title:'Invista em Brasília', keywords:'investir negocios agronegocio polo agroindustrial rio preto autodromo aeroporto projeto orla', href:'#invista-em-brasilia' },
    { title:'Transparência e prestação de contas', keywords:'transparencia ouvidoria acesso a informacao canal de denuncias etica carta de servicos e-protocolo', href:'#transparencia' },
    { title:'Receba atualizações por e-mail', keywords:'newsletter atualizacoes e-mail editais leilao chamamento publico avisos', href:'#atualizacoes' },
    { title:'Proposta online / presencial', keywords:'proposta compra online presencial enviar', href:'https://comprasonline.terracap.df.gov.br/', external:true },
    { title:'Chat on-line', keywords:'chat atendimento contato suporte fale conosco', href:'https://terracap.chat.comunix.tech/chat-externo', external:true }
  ];

  function normalize(str){
    return (str || '').normalize('NFD').replace(/[̀-ͯ]/g,'').toLowerCase();
  }

  function runSearch(query){
    var terms = normalize(query).split(/\s+/).filter(Boolean);
    if(!terms.length) return [];
    var results = [];
    searchIndex.forEach(function(item){
      var titleN = normalize(item.title);
      var haystack = titleN + ' ' + normalize(item.keywords);
      var matched = terms.every(function(term){ return haystack.indexOf(term) > -1; });
      if(matched) results.push({ item: item, score: titleN.indexOf(terms[0]) > -1 ? 0 : 1 });
    });
    results.sort(function(a, b){ return a.score - b.score; });
    return results.map(function(r){ return r.item; });
  }

  function renderResults(query){
    if(!suggestions) return;
    var trimmed = query.trim();
    if(!trimmed){
      suggestions.innerHTML = defaultHTML;
      return;
    }
    var results = runSearch(trimmed);
    var html = '<span class="coord">' + (results.length ? 'Resultados' : 'Nenhum resultado') + '</span>';
    if(results.length){
      results.slice(0, 8).forEach(function(item){
        var attrs = item.external ? ' target="_blank" rel="noopener"' : '';
        html += '<a href="' + item.href + '"' + attrs + '>' + item.title + '</a>';
      });
    } else {
      html += '<p class="search-empty">Nenhum item encontrado para "' + trimmed.replace(/</g, '&lt;') + '". Tente outro termo.</p>';
    }
    suggestions.innerHTML = html;
  }

  function open(){
    overlay.hidden = false;
    toggle.setAttribute('aria-expanded','true');
    window.setTimeout(function(){ input.focus(); }, 10);
    document.addEventListener('keydown', onKeydown);
  }
  function close(){
    overlay.hidden = true;
    toggle.setAttribute('aria-expanded','false');
    toggle.focus();
    document.removeEventListener('keydown', onKeydown);
    input.value = '';
    renderResults('');
  }
  function onKeydown(e){
    if(e.key === 'Escape') close();
  }

  toggle.addEventListener('click', function(){
    if(overlay.hidden) open(); else close();
  });
  closeBtn.addEventListener('click', close);
  overlay.addEventListener('click', function(e){
    if(e.target === overlay) close();
  });
  input.addEventListener('input', function(){ renderResults(input.value); });
  form.addEventListener('submit', function(e){
    e.preventDefault();
    var results = runSearch(input.value);
    if(!results.length) return;
    var target = results[0];
    if(target.external) window.open(target.href, '_blank', 'noopener');
    else { window.location.href = target.href; close(); }
  });
})();

/* ---------- mapa de território ---------- */
(function(){
  var nodes = Array.prototype.slice.call(document.querySelectorAll('.territory-node'));
  var panel = document.querySelector('[data-territory-panel]');
  if(!nodes.length || !panel) return;

  var title = panel.querySelector('[data-panel-title]');
  var status = panel.querySelector('[data-panel-status]');
  var desc = panel.querySelector('[data-panel-desc]');
  var link = panel.querySelector('[data-panel-link]');

  var statusInfo = {
    regularizacao:  { label:'Regularização em curso', stamp:'stamp-verde' },
    empreendimento: { label:'Novo empreendimento',     stamp:'stamp-data-azul' },
    estudo:         { label:'Estudo em andamento',     stamp:'stamp-dourado' },
    concluido:      { label:'Concluído',                stamp:'stamp-cerrado' }
  };

  var regionInfo = {
    'noroeste':        { name:'Noroeste',        desc:'Área com processos de regularização fundiária de interesse específico em fase de análise documental.' },
    'ceilandia':       { name:'Ceilândia',        desc:'Regularização de quadras residenciais com envio de propostas de venda direta em andamento.' },
    'aguas-claras':    { name:'Águas Claras',     desc:'Novo empreendimento misto com estudo de viabilidade urbanística concluído.' },
    'plano-piloto':    { name:'Plano Piloto',     desc:'Estudos urbanísticos e geodésicos em curso para atualização do zoneamento de áreas públicas remanescentes.' },
    'jardim-botanico': { name:'Jardim Botânico',  desc:'Lotes residenciais e comerciais em licitação, com propostas recebidas de forma online ou presencial.' },
    'samambaia':       { name:'Samambaia',        desc:'Regularização fundiária de núcleos urbanos informais, com apoio da Terracap Cidadã.' },
    'arniqueira':      { name:'Arniqueira',       desc:'Setor Habitacional com chamamentos públicos residenciais e comerciais já concluídos.' }
  };

  function selectNode(node){
    nodes.forEach(function(n){
      n.classList.remove('is-active');
      n.setAttribute('aria-pressed','false');
    });
    node.classList.add('is-active');
    node.setAttribute('aria-pressed','true');

    var region = regionInfo[node.dataset.region];
    var st = statusInfo[node.dataset.status];
    if(!region || !st) return;

    title.textContent = region.name;
    desc.textContent = region.desc;
    status.textContent = st.label;
    status.className = 'stamp ' + st.stamp;
    link.href = '#' + node.dataset.region;
    panel.style.backgroundImage = node.style.backgroundImage;
  }

  nodes.forEach(function(node){
    node.addEventListener('click', function(){ selectNode(node); });
  });

  var initialActive = nodes.filter(function(n){ return n.classList.contains('is-active'); })[0] || nodes[0];
  panel.style.backgroundImage = initialActive.style.backgroundImage;
})();

/* ---------- indicadores: contadores animados + reveal ao rolar ---------- */
(function(){
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var counters = Array.prototype.slice.call(document.querySelectorAll('[data-count-to]'));
  var revealEls = Array.prototype.slice.call(document.querySelectorAll('.reveal'));

  function animateCount(el){
    var target = parseInt(el.dataset.countTo, 10) || 0;
    var suffix = el.dataset.suffix || '';
    if(reduceMotion){
      el.textContent = target.toLocaleString('pt-BR') + suffix;
      return;
    }
    var start = null;
    var duration = 1200;
    function step(ts){
      if(start === null) start = ts;
      var progress = Math.min((ts - start) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      var value = Math.round(target * eased);
      el.textContent = value.toLocaleString('pt-BR') + suffix;
      if(progress < 1) window.requestAnimationFrame(step);
    }
    window.requestAnimationFrame(step);
  }

  if(!('IntersectionObserver' in window)){
    counters.forEach(animateCount);
    revealEls.forEach(function(el){ el.classList.add('is-visible'); });
    return;
  }

  var counterObserver = new IntersectionObserver(function(entries, obs){
    entries.forEach(function(entry){
      if(entry.isIntersecting){
        animateCount(entry.target);
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: .5 });
  counters.forEach(function(el){ counterObserver.observe(el); });

  var revealObserver = new IntersectionObserver(function(entries, obs){
    entries.forEach(function(entry){
      if(entry.isIntersecting){
        entry.target.classList.add('is-visible');
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: .15 });
  revealEls.forEach(function(el){ revealObserver.observe(el); });
})();

/* ---------- carrossel de portais de empreendimentos ---------- */
(function(){
  var carousels = Array.prototype.slice.call(document.querySelectorAll('[data-carousel]'));
  if(!carousels.length) return;

  carousels.forEach(function(carousel){
    var track = carousel.querySelector('[data-carousel-track]');
    var prevBtn = carousel.querySelector('[data-carousel-prev]');
    var nextBtn = carousel.querySelector('[data-carousel-next]');
    var dotsWrap = carousel.querySelector('[data-carousel-dots]');
    if(!track) return;
    var cards = Array.prototype.slice.call(track.children);
    if(!cards.length) return;

    var dots = cards.map(function(card, i){
      var dot = document.createElement('button');
      dot.type = 'button';
      dot.setAttribute('aria-label', 'Ir para item ' + (i + 1));
      if(i === 0) dot.classList.add('is-active');
      dot.addEventListener('click', function(){
        card.scrollIntoView({ behavior: 'smooth', inline: 'start', block: 'nearest' });
      });
      if(dotsWrap) dotsWrap.appendChild(dot);
      return dot;
    });

    function scrollByCard(dir){
      var amount = track.clientWidth * dir;
      track.scrollBy({ left: amount, behavior: 'smooth' });
    }
    if(prevBtn) prevBtn.addEventListener('click', function(){ scrollByCard(-1); });
    if(nextBtn) nextBtn.addEventListener('click', function(){ scrollByCard(1); });

    var ticking = false;
    function updateActiveDot(){
      var trackLeft = track.getBoundingClientRect().left;
      var closest = 0, closestDist = Infinity;
      cards.forEach(function(card, i){
        var dist = Math.abs(card.getBoundingClientRect().left - trackLeft);
        if(dist < closestDist){ closestDist = dist; closest = i; }
      });
      dots.forEach(function(dot, i){ dot.classList.toggle('is-active', i === closest); });
    }
    track.addEventListener('scroll', function(){
      if(ticking) return;
      ticking = true;
      window.requestAnimationFrame(function(){ updateActiveDot(); ticking = false; });
    });
  });
})();

/* ---------- newsletter: feedback de envio ---------- */
(function(){
  var form = document.querySelector('[data-newsletter-form]');
  if(!form) return;
  var feedback = form.querySelector('[data-newsletter-feedback]');

  form.addEventListener('submit', function(e){
    e.preventDefault();
    if(!form.checkValidity()){
      feedback.textContent = 'Verifique o e-mail informado e a confirmação de ciência da política de privacidade.';
      feedback.classList.add('is-error');
      return;
    }
    feedback.classList.remove('is-error');
    feedback.textContent = 'Cadastro recebido — você passará a receber os próximos editais por e-mail.';
    form.reset();
  });
})();
