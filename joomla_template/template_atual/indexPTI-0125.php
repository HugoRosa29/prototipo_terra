<head>
      <!-- @template cleanportal 2019 -->
      <!-- INFORMACOES A RESPEITO DO ITEM
         ID: <?php echo TmplHelper::getID()."\n"; ?>
         ID MENU: <?php echo @$active_item->id."\n"; ?>
         Menu vinculado: <?php echo @$active_item->menutype."\n"; ?>
         URL completa, nao amigavel: <?php echo TmplHelper::getFullURL()."\n"; ?>
         -->
      <?php if($active_item->home != '1') : ?>     
      <jdoc:include type="head"/>
      <?php else: ?>
      <title><?php echo $sitename; ?></title>
      <meta charset="utf-8">
      <meta name="keywords" content="<?php echo $metaKey; ?>" />
      <?php endif; ?>
      <meta name="description" content="<?php echo $metaDesc; ?>" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" type="image/png" href="favicon.png" />
      <title><?php echo $sitename ?></title>
      <!-- JS -->
      <script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery.min.js"></script>
      <noscript>Javascript de carregamento do Framework Jquery</noscript>
      <script type="text/javascript">
         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
         ga('create', '<?php echo $this->params->get('logoText'); ?>', 'auto');
         ga('send', 'pageview');
      </script>
      <script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/swiper.min.js"></script>
      <!-- JS -->
      <!-- CSS -->
      <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/all.css">
      <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/style.css">

      <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/swiper.min.css">    
      <!-- CSS -->
      </head>
      <body>
      <?php if(!empty($active_item->home) && $active_item->home == '1'): ?>
         <div class="inicial">
      <?php else: ?>
         <div class="interna">
      <?php endif; ?>
           <header class="topo">
            <!-- menu principal --> 
               <jdoc:include type="modules" name="menu-principal" />
               
               <?php if(!empty($active_item->home) && $active_item->home == '1'): ?>
                  <!-- super banner -->
                  <jdoc:include type="modules" name="super-banner" />
               <?php endif; ?>
                  <jdoc:include type="modules" name="trilha-navegacao" />
           </header>
       </div>

       <?php if(TmplHelper::hasMessage()):  ?>
            <div class="row-fluid">
                <jdoc:include type="message" />
            </div>
        <?php endif; ?>

       <!-- menu pagina inicial-->
      <?php if (!empty($active_item->home) && $active_item->home == '1'): ?>

         <jdoc:include type="modules" name="pagina-inicial" />

      <?php else: ?>
          <div class="row">
            <div class="container">
               <?php
                $preffix = TmplHelper::getPagePositionPreffix($active_item);
                $posicao_topo = $preffix. '-topo';
                $posicao_rodape = $preffix. '-rodape';
                $posicao_direita = $preffix. '-direita';
                ?>
               <?php
               // adiciona o titulo da pagina
               $app = JFactory::getApplication();
               $menuitem = $app->getMenu()->getActive();
               ?>
                        
               <?php if($menuitem->component == "com_blankcomponent"):?>
                  <?php if($menuitem->params->get("menu_text")) : ?>
                     <h1 class="documentFirstHeading">
                        <?php if($menuitem->params->get("menu-anchor_title")) : ?>
                              <?php echo $menuitem->params->get("menu-anchor_title"); ?>
                           <?php else:?>
                              <?php echo $menuitem->title; ?>
                        <?php endif; ?>
                     </h1>
                  <?php endif; ?>
               <?php endif; ?>

              <?php if($this->countModules($posicao_topo) || $this->countModules("internas-topo")): ?>
              <div class="row">
                  <jdoc:include type="modules" name="internas-topo" headerLevel="2" style="container" />
                  <jdoc:include type="modules" name="<?php echo $posicao_topo ?>" headerLevel="2" style="container" />
              </div>
              <?php endif; ?>
              <?php if($this->countModules($posicao_direita) || $this->countModules("internas-direita")): ?>
              <div class="row">
                  <div class="col-md-8">
                      <?php if(  TmplHelper::isOnlyModulesPage() ): ?>
                           <jdoc:include type="modules" name="pagina-interna-capa" style="container" headerLevel="2" />
                           <jdoc:include type="modules" name="pagina-interna-capa-<?php echo $preffix ?>" style="container" headerLevel="2" />
                      <?php else: ?>
                          <jdoc:include type="component" />
                      <?php endif; ?>
                  </div>
                  <div class="col-md-4">
                      <jdoc:include type="modules" name="internas-direita" headerLevel="2" style="container" />
                      <jdoc:include type="modules" name="<?php echo $posicao_direita ?>" headerLevel="2" style="container" />
                  </div>
              </div>
              <?php else: ?>
              <div class="row">
                  <?php if(  TmplHelper::isOnlyModulesPage() ): ?>
                       <jdoc:include type="modules" name="pagina-interna-capa" style="container" headerLevel="2" />
                       <jdoc:include type="modules" name="pagina-interna-capa-<?php echo $preffix ?>" style="container" headerLevel="2" />
                  <?php else: ?>
                      <jdoc:include type="component" />
                  <?php endif; ?>
              </div>
              <?php endif; ?>

              <?php if($this->countModules($posicao_rodape) || $this->countModules("internas-rodape")): ?>
              <div class="row">
                  <jdoc:include type="modules" name="<?php echo $posicao_rodape ?>" headerLevel="2" style="container" />
                  <jdoc:include type="modules" name="internas-rodape" headerLevel="2" style="container" />
              </div>
              <?php endif; ?>
          </div>
       </div>
      <?php endif; ?>


      <!-- COMPRE IMOVEIS-->
 <section id="compre-imoveis">  
        <div class="container">
         <h2 class="text-center">Compre imóveis</h2>
         <p class="text-center">A compra de imóveis (Lotes, terrenos) se dá por editais de licitação ou editais de leilão. Aqui você vê os imóveis à venda e pode participar enviando sua proposta online ou presencial.</p>
         
         <div class="row">
            <div class="col-md-7">
               
               <div id="carousel-compre-imoveis" class="carousel slide" data-ride="carousel">
               <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
               </ol>

               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <img class="d-block w-100 rounded img-fluid" src="https://source.unsplash.com/250x150/?sig=1" alt="...">
                  </div>
                  <div class="carousel-item">
                     <img class="d-block w-100 img-fluid" src="https://source.unsplash.com/250x150/?sig=2" alt="...">
                  </div>
                  <div class="carousel-item">
                     <img class="d-block w-100 img-fluid" src="https://source.unsplash.com/250x150/?sig=3" alt="...">
                  </div>
               </div>

               <a class="carousel-control-prev" href="#carousel-compre-imoveis" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
               </a>
               <a class="carousel-control-next" href="#carousel-compre-imoveis" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
               </a>
               </div> <!-- end #carousel-compre-imoveis -->

            </div>
            <div class="col-md-5 container">
               <div class="bloco-amarelo">
               <h3 class="text-center">Edital de licitação 4/2019</h3>
               <div class="datas">
                  <div>
                     <p class="titulo">caucao até</p>
                     <p class="dia">25 de abril</p>
                  </div>
                  <div>
                     <p class="titulo">licitação até</p>
                     <p class="dia">25 de abril</p>
                  </div>
               </div>

               <div class="localizacao">
                  <p>Jardim Botânico, Riacho Fundo II, Samambaia, São Sebastião, Santa Maria e outros</p>
               </div>

               <div class="d-flex justify-content-center">
                  <a href="#" class="btn btn-outline-dark" title="Saiba Mais">Saiba Mais</a>
               </div>
            </div>
         </div> <!-- end .container -->
         </div>
      </div>
</section>   
      <!-- COMPRE IMOVEIS-->


      <!-- REGULARIZA IMOVEIS-->
      <div class="container-fluidcinza2">
         <div class="imagem-fundo3"></div>
         <div class="bkg2"></div>
         <nav id="compra-regulariza-home" class="container">
            <h2 class="text-center titulo-home-white">Regularize imóveis</h2>
            <p class="text-center texto-home-white mb-5">A compra de imóveis (Lotes, terrenos) se dá por editais de licitação ou editais de leilão. Aqui você vê os imóveis à venda e pode participar enviando sua proposta online ou presencial.</p>
            <div class="row ">
               <div class="col-sm">
                  <img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/img/img1-exemplo-item-regularize-imoveis.png" class="img-fluid" alt="Logo Terracap">
                  <div class="titulo-bloco-regularize mt-4">Edital região 1</div>
                  <p class="texto-regularize-white">Cadastro: 22/02/2019 até 30/04/2019</p>
                  <p class="texto-regularize-white">Proposta: 30/04/2019 até 31/12/2019</p>
               </div>
               <div class="col-sm">
                  <img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/img/img1-exemplo-item-regularize-imoveis.png" class="img-fluid" alt="Logo Terracap">
                  <div class="titulo-bloco-regularize mt-4">Edital região 1</div>
                  <p class="texto-regularize-white">Cadastro: 22/02/2019 até 30/04/2019</p>
                  <p class="texto-regularize-white">Proposta: 30/04/2019 até 31/12/2019</p>
               </div>
               <div class="col-sm">
                  <img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/img/img1-exemplo-item-regularize-imoveis.png" class="img-fluid" alt="Logo Terracap">
                  <div class="titulo-bloco-regularize mt-4">Edital região 1</div>
                  <p class="texto-regularize-white">Cadastro: 22/02/2019 até 30/04/2019</p>
                  <p class="texto-regularize-white">Proposta: 30/04/2019 até 31/12/2019</p>
               </div>
            </div>
         </nav>
         <div  class="container d-flex justify-content-center">
            <a href="#" class="btn btn-outline-light" title="Saiba Mais">Saiba Mais</a>
         </div>
      </div>
      <div class="imagem-fundo2"></div>
      <!-- REGULARIZA IMOVEIS-->


      <!-- SERVIÇOS ONLINE -->
      <section id="servicos-online">
         <div class="container">

            <h2 class="text-center titulo-home-black">Serviço online</h2>
            <p class="text-center mb-5">Para quem já comprou imóvel: aqui você acompanha processos, consulta requerimentos e acessa serviços como declarações, certidões.</p>

            <div class="row">
               <div class="col-md-3">
                  <a href="#" title="Title do link">
                     <div class="item rounded d-flex flex-column justify-content-center align-items-center p-3 text-center shadow-sm">
                        <span class="texto-servicos-black  ">DECLARAÇÕES E CERTIDÕES</span>
                     </div>
                  </a>
               </div>
               <div class="col-md-3">
                  <a href="#" title="Title do link">
                     <div class="item rounded d-flex flex-column justify-content-center align-items-center p-3 text-center shadow-sm">
                        <span class="texto-servicos-black">REQUERIMENTO E PROCESSOS</span>
                     </div>
                  </a>
               </div>
               <div class="col-md-3">
                  <a href="#" title="Title do link">
                     <div class="item rounded d-flex flex-column justify-content-center align-items-center p-3 text-center shadow-sm">
                        <span class="texto-servicos-black">2ª VIA DE BOLETO E IMPOSTO DE RENDA</span>
                     </div>
                  </a>
               </div>
               <div class="col-md-3">
                  <a href="#" title="Ver todos os serviços">
                      <div class="item-link rounded d-flex flex-column justify-content-center align-items-center p-3 text-center">
                        <span class="texto-servicos-black">VER TODOS <i class="fas fa-arrow-right"></i></span>
                     </div>
                  </a>
               </div>
            </div>

         </div>
      </section>
    
      <div class="imagem-fundo">
      </div>
<!-- SERVIÇOS ONLINE -->



      
      <section id="invista-em-brasilia" class="container-fluid cor-marrom" style="color:#fff">
         <div class="container">
            <h2 class="text-center">Invista em Brasília</h2>

            <div class="swiper-container invista-em-brasilia">
				<div class="swiper-wrapper">

					<div class="swiper-slide">

						<div class="item">
							<div class="img-invista">
		                        <img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/img/img1-exemplo-item-invista.png" />       
		                     </div>
		                     <div class="txt-invista" >
		                        <h4>AEROPORTO EXECUTIVO</h4>
		                        <span class="descricao"> Solução alternativa para a aviação em Brasília, para um uso moderno e sustentável em favor da população</span>
		                        <a href="#" class="btn-veja-mais">VEJA MAIS <i class="fas fa-arrow-right"></i></a>
		                     </div> 
						</div>

					</div>
        			<div class="swiper-slide">

						<div class="item">
							<div class="img-invista">
		                        <img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/img/invista-03-560x400.png" />       
		                     </div>
		                     <div class="txt-invista" >
		                        <h4>PONTÃO DO LAGO SUL</h4>
		                        <span class="descricao">Polo de desenvolvimento científico, tecnológico e de inovação do Distrito federal</span>
		                        <a href="#" class="btn-veja-mais">VEJA MAIS <i class="fas fa-arrow-right"></i></a>
		                     </div> 
						</div>

					</div>
        			<div class="swiper-slide">Slide 3</div>
                  
				</div>

	              <!-- Add Arrows -->
	              <div class="swiper-button-next swiper-button-white proximo-invista"></div>
	              <div class="swiper-button-prev swiper-button-white anterior-invista"></div>
	          </div>

	          <script>
			    var swiperInvista = new Swiper('.invista-em-brasilia', {
			        slidesPerView: 2,
			        pagination: {
			            el: '.navegacao-invista',
			            clickable: true,
			        },
			        navigation: {
			            nextEl: '.proximo-invista',
			            prevEl: '.anterior-invista',
			        },
			    });
			</script>

	         <div  class="container d-flex justify-content-center">
	            <a href="#" class="btn btn-outline-light" title="Saiba Mais">Saiba Mais</a>
	         </div>

         </div>

      </section>

      
      <!-- INVISTA EM BRASILIA  -->


      <footer class="container-fluid ">
            <nav id="invista-home" class="container">
               <div class="row ">
                  <div class="col-sm ">
                     <h5>ATEDIMENTO AO PÚBLICO</h5>
                     <p> Atendimento presencial: localizado no Térreo do Ed. Sede da Terracap, no SAM Bloco F. </p>
                     <p>Horário de atendimento: 7h às 19h, dias úteis Telefone: 61 3350-2222</p>
                  </div>
                  <div class="col-sm">
                    <p>Baixe o app Terracap e faça cadastro de regularização e enviar propostas de licitação</p>
                  </div>
                  <div class="col-sm">
                     <h5>Noticias</h5>
                  </div>
               </div>
            </nav>
      </footer>






      <!-- REGULARIZA IMOVEIS-->
			<section id="regulariza-imoveis">
				<div class="container">
					<h2 class="text-center">Regularize imóveis</h2>
		            <p class="text-center mb-5">A compra de imóveis (Lotes, terrenos) se dá por editais de licitação ou editais de leilão. Aqui você vê os imóveis à venda e pode participar enviando sua proposta online ou presencial.</p>

		            <div class="row ">
						<!-- <div class="col-md-4">
							<div class="thumb-regulariza">
								<div>
									<a href="#" title="Title do link">
										<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/img/img1-exemplo-item-regularize-imoveis.png" class="img-fluid" alt="Logo Terracap">
									</a>
								</div>

								<span class="tipo">Cadastro</span>
								<span class="status disponivel">Em análise</span>
							</div>

							<div class="dados">
								<h5 class="mb-3">Condomínio Estância Jardim Bo...</h5>
								<p class="mb-2"><strong>Cadastro:</strong> 22/02/2019 até 30/04/2019</p>
								<p class="mb-2"><strong>Proposta:</strong> 30/04/2019 até 31/12/2019 </p>
							</div>

							<div>
								<a href="#" class="btn-veja-mais">VEJA MAIS <i class="fas fa-arrow-right"></i></a>
							</div>

						</div> -->
						<div class="col-md-4">
							<div class="thumb-regulariza">
								<div>
									<a href="#" title="Title do link">
										<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/img/img1-exemplo-item-regularize-imoveis.png" class="img-fluid" alt="Logo Terracap">
									</a>
								</div>

								<span class="tipo">Proposta</span>
								<span class="status em-analise">Em análise</span>
							</div>

							<div class="dados">
								<h5 class="mb-3">Condomínio Estância Jardim Bo...</h5>
								<p class="mb-2"><strong>Cadastro:</strong> 22/02/2019 até 30/04/2019</p>
								<p class="mb-2"><strong>Proposta:</strong> 30/04/2019 até 31/12/2019 </p>
							</div>

							<div>
								<a href="#" class="btn-veja-mais">VEJA MAIS <i class="fas fa-arrow-right"></i></a>
							</div>

						</div>
						<div class="col-md-4">
							<div class="thumb-regulariza">
								<div>
									<a href="#" title="Title do link">
										<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/img/img1-exemplo-item-regularize-imoveis.png" class="img-fluid" alt="Logo Terracap">
									</a>
								</div>

								<span class="status encerrado">Encerrado</span>
							</div>

							<div class="dados">
								<h5 class="mb-3">Condomínio Estância Jardim Bo...</h5>
								<p class="mb-2"><strong>Cadastro:</strong> 22/02/2019 até 30/04/2019</p>
								<p class="mb-2"><strong>Proposta:</strong> 30/04/2019 até 31/12/2019 </p>
							</div>

							<div>
								<a href="#" class="btn-veja-mais">VEJA MAIS <i class="fas fa-arrow-right"></i></a>
							</div>

						</div>
					</div>

					<div  class="container d-flex justify-content-center">
						<a href="#" class="btn btn-outline-light" title="Ver todos">Ver todos</a>
					</div>
				</div>
			</section>
		      <!-- REGULARIZA IMOVEIS-->