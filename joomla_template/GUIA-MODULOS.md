# Template Terracap para Joomla 3.1 — Guia de instalação e módulos

## 1. Instalar o template

1. Compacte a pasta `terracap/` (o conteúdo dela, não a pasta em si dentro de outra pasta) em um `.zip`. Já existe um `terracap.zip` pronto ao lado desta pasta.
2. No painel do Joomla: **Extensões → Gerenciar → Carregar Pacote** e envie o `terracap.zip`.
   - Alternativa: copiar a pasta `terracap/` por FTP direto em `/templates/terracap/` no servidor.
3. Vá em **Extensões → Modelos → Estilos**, selecione **terracap - Padrão** e clique em **Definir Padrão** (estrela) para torná-lo o template ativo do site.
4. Confira o **Menu Home**: como este é um site "one-page", recomendo que o item de menu Home aponte para um artigo em branco (sem corpo, com "Mostrar título" = Não) ou para "Item de Menu Especial" sem componente — isso evita que o Joomla tente renderizar um conteúdo de componente por cima do layout. O `index.php` já inclui `<jdoc:include type="component" />`, necessário para outras páginas (contato, busca, artigos avulsos), mas ele fica "invisível" quando a Home não tem conteúdo de componente.

## 2. Como o template ficou modular

Cada seção do site virou uma **posição de módulo**. Nada de conteúdo fica "preso" no código do template — tudo é editável em **Módulos → Novo → Personalizado (Custom)**, atribuído à posição correspondente e à página **Home**.

Para colar o HTML de cada seção abaixo no editor do módulo:
- Crie o módulo do tipo **Personalizado (Custom / mod_custom)**.
- No campo de conteúdo, clique no botão da barra do editor **"Código Fonte" / "Source Code"** (ou troque temporariamente o editor padrão para **Nenhum/None** em Sistema → Configurações Globais → Site, se preferir colar HTML puro sem o TinyMCE reformatar).
- **Mostrar título:** Ocultar (o título visual de cada seção já vem dentro do HTML colado).
- **Posição:** a indicada em cada bloco abaixo.
- **Páginas atribuídas:** apenas Home (ou "Em todas as páginas" se fizer sentido, ex.: rodapé).

As seções com marcações `data-*` (mapa do território, carrossel de empreendimentos, contador de indicadores) dependem do `terracap.js` do template — não altere esses atributos ao editar o texto, apenas os textos/links/imagens.

---

### Posição `mega-terracap` — Dropdown "A Terracap" (menu)

```html
<div class="mega-col">
  <h5>Conheça a Terracap</h5>
  <a class="mega-link" href="#">Quem somos, organograma, agenda de autoridades</a>
  <h5 class="stacked">Gestão</h5>
  <a class="mega-link" href="#">Compras e Serviços</a>
  <a class="mega-link" href="#">Prestação de contas</a>
  <a class="mega-link" href="#">Concursos públicos</a>
  <a class="mega-link" href="#">PDTI</a>
</div>
<div class="mega-col">
  <h5>Órgãos colegiados</h5>
  <a class="mega-link" href="#">Atas e resoluções</a>
  <h5 class="stacked">Projetos e Estudos</h5>
  <a class="mega-link" href="#">Urbanização e mobilidade</a>
  <a class="mega-link" href="#">Estudos turísticos e geodésicos</a>
  <a class="mega-link" href="#">Audiências públicas</a>
  <a class="mega-link" href="#">Terracap Cidadã</a>
</div>
<div class="mega-col">
  <h5 class="stacked">Acesso à Informação</h5>
  <a class="mega-link" href="#transparencia">Ouvidoria</a>
  <a class="mega-link" href="#">Notícias</a>
  <a class="mega-link" href="#compre-imoveis">Licitações (compras)</a>
</div>
<div class="mega-col">
  <a class="mega-link" href="#">Perguntas Frequentes (FAQ)</a>
  <a class="mega-link" href="#">Para Servidores</a>
  <a class="mega-link" href="#">Comissão de Ética — COET</a>
</div>
```

### Posição `mega-servicos` — Dropdown "Serviços" (menu)

```html
<a class="mega-link" href="https://servicosonline.terracap.df.gov.br/" target="_blank" rel="noopener">Simulador de Valores</a>
<a class="mega-link" href="https://servicosonline.terracap.df.gov.br/" target="_blank" rel="noopener">Regularização (Venda Direta)</a>
<a class="mega-link" href="https://servicosonline.terracap.df.gov.br/" target="_blank" rel="noopener">Declarações e Certidões</a>
<a class="mega-link" href="https://servicosonline.terracap.df.gov.br/" target="_blank" rel="noopener">Consulta de Requerimentos</a>
```

### Posição `mega-imprensa` — Dropdown "Imprensa" (menu)

```html
<a class="mega-link" href="#">Notícias</a>
<a class="mega-link" href="#">Fotos e vídeos</a>
<a class="mega-link" href="#">Contato para imprensa</a>
```

### Posição `hero` — Bloco principal do topo

```html
<div class="hero-frame">
  <div class="hero-inner">
    <div class="hero-manifesto">
      <span class="hero-mark" aria-hidden="true"></span>
      <span class="eyebrow hero-eyebrow">Terracap · Companhia Imobiliária de Brasília</span>
      <h1 class="hero-statement">A terra que<br>constrói Brasília.</h1>
      <p class="hero-lede">Conheça a jornada, do lote à transparência.</p>
      <nav class="hero-links" aria-label="Principais serviços">
        <a href="#compre-imoveis">Comprar imóvel</a>
        <a href="#regularize-imoveis">Regularizar imóvel</a>
        <a href="#invista-em-brasilia">Investir em Brasília</a>
      </nav>
    </div>
  </div>
</div>

<a class="hero-ticker" href="#invista-em-brasilia">
  <div class="container hero-ticker-inner">
    <span class="hero-ticker-dot" aria-hidden="true"></span>
    <span class="hero-ticker-label">Chamamento público 01/2026</span>
    <span class="hero-ticker-title">Polo Agroindustrial do Rio Preto</span>
    <svg class="hero-ticker-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
  </div>
</a>
```

*Imagem de fundo do hero (`https://www.terracap.df.gov.br/images/banners/...`) e o selo de coordenadas ficaram fixos no `index.php` (design do template). Se quiser trocá-los sem mexer em código, me avise que eu movo isso para um parâmetro do template também.*

### Posição `indicadores` — Indicadores institucionais

```html
<span class="eyebrow">Território em números</span>
<h2 class="section-title" id="indicadores-title">Indicadores institucionais</h2>
<p class="section-sub">Antes do próximo lote ou contrato, um retrato do que a Terracap já entregou para o Distrito Federal — a base sobre a qual esta história continua.</p>

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
    <span class="kpi-label">Imóveis licitados</span>
    <span class="kpi-value" data-count-to="1312" data-suffix="">0</span>
    <svg class="kpi-spark" data-accent="data-azul" viewBox="0 0 100 28" preserveAspectRatio="none" aria-hidden="true">
      <polyline class="spark-muted" points="0,22 12,18 24,20 36,15 48,16 60,11" />
      <polyline class="spark-accent" points="60,11 72,12 84,6 100,5" />
    </svg>
    <span class="kpi-delta kpi-up">+312 no último edital</span>
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
```

### Posição `territorio` — Mapa + Carrossel de empreendimentos

```html
<span class="eyebrow">O território</span>
<h2 class="section-title" id="territorio-title">Onde a Terracap atua</h2>
<p class="section-sub">Antes de comprar ou regularizar, conheça o mapa: cada região do Distrito Federal está em um momento diferente desta história — regularização, novo empreendimento, estudo ou conclusão. Selecione uma região para ver o que está em curso, ou visite o portal oficial dos empreendimentos que já têm site próprio.</p>

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
          <img src="<?php echo $this->baseurl; ?>/templates/terracap/img/Aldeias-do-Cerrado-1 - Copia.jpeg" alt="">
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
  <a href="#compre-imoveis" class="btn btn-line">Ver imóveis à venda</a>
  <a href="#regularize-imoveis" class="btn btn-line">Regularizar meu imóvel</a>
</div>
```

> **Atenção:** o módulo Custom padrão do Joomla **não executa PHP**. O `<?php echo $this->baseurl; ?>` acima é só para você lembrar o caminho correto — troque manualmente pela URL real do seu site, ex.: `/templates/terracap/img/Aldeias-do-Cerrado-1 - Copia.jpeg`, ou use a URL completa `https://seusite.gov.br/templates/terracap/img/Aldeias-do-Cerrado-1 - Copia.jpeg`.

### Posição `compre` — Compre Imóveis

```html
<span class="eyebrow">Aquisição</span>
<h2 class="section-title">Compre Imóveis</h2>
<p class="section-sub">Depois de explorar o território, é hora de encontrar o seu lote.<br>Escolha o seu imóvel e garanta-o enviando sua proposta online ou presencial!</p>

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
  <a href="#" class="btn btn-line">Veja todos os editais</a>
</div>
```

### Posição `regularize` — Regularize Imóveis

```html
<span class="eyebrow">Regularização</span>
<h2 class="section-title">Regularize Imóveis</h2>
<p class="section-sub">Comprar não é o único caminho até o seu endereço.<br> A Venda Direta é outra forma de tornar o seu imóvel seu, de direito.</p>

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
  <a href="#" class="btn btn-line">Veja todos</a>
</div>
```

### Posição `servicos` — Serviços Online

```html
<span class="eyebrow">Depois da compra</span>
<h2 class="section-title">Serviços</h2>
<p class="section-sub">A história não termina na assinatura. Para quem já comprou ou regularizou, esses são os canais para acompanhar processos, consultar requerimentos e emitir declarações e certidões.</p>

<div style="height:44px;"></div>

<div class="services-grid">
  <a class="service-card" href="https://servicosonline.terracap.df.gov.br/" target="_blank">
    <div class="icon"><span>%</span></div>
    <div class="label">Simulador de Valores — Licitação de Imóveis</div>
  </a>
  <a class="service-card" href="https://servicosonline.terracap.df.gov.br/" target="_blank">
    <div class="icon"><span>⇄</span></div>
    <div class="label">Regularização (Venda Direta)</div>
  </a>
  <a class="service-card" href="https://servicosonline.terracap.df.gov.br/" target="_blank">
    <div class="icon"><span>D</span></div>
    <div class="label">Declarações e Certidões</div>
  </a>
  <a class="service-card" href="https://servicosonline.terracap.df.gov.br/" target="_blank">
    <div class="icon"><span>R</span></div>
    <div class="label">Consulta de Requerimentos</div>
  </a>
</div>
```

### Posição `invista` — Invista em Brasília

```html
<span class="eyebrow" style="color:#7FC49A;">Novos negócios</span>
<h2 class="section-title" style="color:var(--white);">Invista em Brasília</h2>
<p class="section-sub" style="color:#A9B8C2;">Além do lote individual, a Terracap constrói parcerias em maior escala. Se a sua história com Brasília for além de uma casa, esses são os projetos abertos a investimento:</p>

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
```

### Posição `transparencia` — Transparência

```html
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
```

### Posição `atualizacoes` — Newsletter

```html
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
```

> Esse formulário só tem validação visual em JS — ele **não envia e-mail de verdade**. Para funcionar, é preciso plugar em uma extensão de newsletter (ex.: Acymailing) ou um endpoint próprio; posso fazer essa integração depois se você tiver a extensão escolhida.

### Posição `footer` — Rodapé completo

```html
<div class="container footer-grid">
  <div>
    <h4>Atendimento ao Público</h4>
    <p>SAC: <a href="mailto:sac@terracap.df.gov.br">sac@terracap.df.gov.br</a><br>Ouvidoria: telefone 162</p>
    <p style="margin-top:12px;">Atendimento presencial — GEATE e Ouvidoria, das 7h às 19h, em dias úteis.</p>
    <div class="footer-channels">
      <a href="https://servicosonline.terracap.df.gov.br/">Requerimento online</a>
      <a href="https://terracap.chat.comunix.tech/chat-externo" target="_blank">Chat on-line</a>
      <a href="#">(61) 3350-2222</a>
    </div>
    <p style="margin-top:16px;" class="coord" style="color:#8A8578;">SAM Bl. F Ed. Sede Terracap — Asa Norte<br>Brasília-DF, 70620-060</p>
  </div>

  <div>
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
  </div>

  <div>
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
    <a href="#" class="btn btn-onphoto" style="margin-top:8px;">Ver todas</a>
  </div>
</div>

<div class="footer-bottom">
  TERRACAP · COMPANHIA IMOBILIÁRIA DE BRASÍLIA · 15°47'38"S 47°55'40"O
</div>
```

*Recomendo, mais pra frente, trocar o bloco "Notícias" no rodapé por um módulo `mod_articles_news` (Artigos - Notícias) apontando para uma categoria "Notícias" de verdade, assim as duas últimas notícias saem automaticamente conforme você publica artigos — hoje esse bloco está com texto fixo, exatamente como no protótipo original.*

## 3. O que ficou fora do escopo desta primeira versão

- **Busca** (`data-search-form`) e **newsletter** (`data-newsletter-form`) são só front-end; não estão conectados a nenhum componente Joomla real ainda.
- O botão de chat flutuante usa o parâmetro `chatUrl` do template (**Extensões → Modelos → Estilos → terracap → Editar → Avançado**) — dá pra trocar o link sem editar código.
- `template_thumbnail.png` (miniatura do template no painel) não foi incluído — o template funciona normalmente sem ele, é só cosmético no admin.
