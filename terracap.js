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

/* ---------- busca: overlay ---------- */
(function(){
  var toggle = document.querySelector('[data-search-toggle]');
  var overlay = document.querySelector('[data-search-overlay]');
  if(!toggle || !overlay) return;
  var input = overlay.querySelector('[data-search-input]');
  var closeBtn = overlay.querySelector('[data-search-close]');
  var form = overlay.querySelector('[data-search-form]');

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
  form.addEventListener('submit', function(e){ e.preventDefault(); });
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
