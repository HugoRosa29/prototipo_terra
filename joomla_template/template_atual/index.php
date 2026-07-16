<?php
/**
* @package     Joomla.Site
* @subpackage  Templates.protostar
*
* @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$jinput   = JFactory::getApplication()->input;
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename','');
$metaDesc = $app->get('MetaDesc','');
$metaKey = $app->get('MetaKeys','');
$frontpage = ($option == 'com_content' && $view == 'featu');
$article = ($option == 'com_content' && $view == 'article');

$jinput = $app->input;
$itemid = $jinput->get('Itemid', 0, 'integer');
$menu = $app->getMenu();
$active_item = $menu->getItem($itemid);

//echo '<pre>';
//var_dump($app);
// Define helper
require_once  JPATH_SITE .'/templates/'.$this->template.'/helper.php';


// Output as HTML5
$doc->setHtml5(true);

if($task == "edit" || $layout == "form" )
{
  $fullWidth = 1;
}
else
{
  $fullWidth = 0;
}

exec("git rev-parse --abbrev-ref HEAD", $branchName);
exec("git describe --tags --abbrev=0", $tagName);

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
   	<head>
		
		<!-- VERSIONAMENTO DO PORTAL
	 	VERSÃO: <?php echo $tagName[0]."\n"; ?>
	 	TAG: <?php echo $branchName[0]."\n"; ?>
		 -->

		<!-- @template onepageterracap2019 -->
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

		<link rel="shortcut icon" type="image/png" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/favicon.png" />
		<title><?php echo $sitename ?></title>

		<!-- JS -->
		<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery.min.js"></script>
		<noscript>Javascript de carregamento do Framework Jquery</noscript>
		<script type="text/javascript">
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
			ga('create', '<?php echo $this->params->get('analytics'); ?>', 'auto');
			ga('send', 'pageview');
        </script>
		<!-- JS -->

		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/all.css">
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="https://swiperjs.com/package/css/swiper.min.css"> -->
		<link rel="stylesheet" href="https://unpkg.com/swiper@6.0.0/swiper-bundle.min.css">
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/style.css">
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/media-querie.css">
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/hamburgers.min.css">
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/carouseller.css">
		<!-- CSS -->

		<!-- FONT MATERIAL ICONS -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!-- FONT MATERIAL ICONS -->

	</head>
	<?php 
		/* ID 877 corresponde ao invista em brasília */
		if($active_item->id == 877):
			$cor_capa = 'cor-preto';
		else:
			$cor_capa = $active_item->params->get("menu-anchor_css");
		endif;
	?>
	<body class="<?php echo $cor_capa; ?>" data-spy="scroll" >
      	<?php if(!empty($active_item->home) && $active_item->home == '1'): ?>
        <div class="inicial">
      	<?php else: ?>
        <div class="interna">
      	<?php endif; ?>
           	<header class="topo">
			   <?php 				
			    if(    	 $_SERVER['HTTP_HOST'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == '127.0.0.1:8080' 
			   			|| $_SERVER['HTTP_HOST'] == 'portal-devatual'
				){	
					echo "<h4 class=\"ambiente\">DevAtual <br>$tagName[0] <br> $branchName[0]</h4>";

				}elseif(    $_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'localhost:8080'
							|| $_SERVER['HTTP_HOST'] == 'portal-homol'
				){	
					echo "<h4 class=\"ambiente\">Homologação <br>$tagName[0] <br> $branchName[0]</h4>";
				}
				?> 

	            <!-- menu principal --> 
               	<jdoc:include type="modules" name="menu-principal" />
               	<?php if(!empty($active_item->home) && $active_item->home == '1'): ?>
                  	<!-- super banner -->
                  	<jdoc:include type="modules" name="super-banner" />
               	<?php endif; ?>
                  	
           	</header>

	       	<?php if(TmplHelper::hasMessage()):  ?>
	            <div>
	                <jdoc:include type="message" />
	            </div>
        	<?php endif; ?>

       	<!-- menu pagina inicial-->
      	<?php if (!empty($active_item->home) && $active_item->home == '1'): ?>

	         	<jdoc:include type="modules" name="pagina-inicial" style="paginaInicial" />

		<?php else: ?>

			<div class="container">

				<jdoc:include type="modules" name="trilha-navegacao" />
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
	                     <h2>
	                        <?php if($menuitem->params->get("menu-anchor_title")) : ?>
	                              <?php echo $menuitem->params->get("menu-anchor_title"); ?>
	                           <?php else:?>
	                              <?php echo $menuitem->title; ?>
	                        <?php endif; ?>
	                     </h2>
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
					  	<div class="interna-direita">
							  <jdoc:include type="modules" name="internas-direita" style="container" />
							  <jdoc:include type="modules" name="<?php echo $posicao_direita ?>" style="container" />
						  </div>
	                  </div>
	              </div>
	              <?php else: ?>

	                  <?php if(  TmplHelper::isOnlyModulesPage() ): ?>
	                       <jdoc:include type="modules" name="pagina-interna-capa" style="paginaCapa"  />
	                       <jdoc:include type="modules" name="pagina-interna-capa-<?php echo $preffix ?>" style="paginaCapa" />
	                  <?php else: ?>
	                      <jdoc:include type="component" />
	                  <?php endif; ?>
	              <?php endif; ?>

	              <?php if($this->countModules($posicao_rodape) || $this->countModules("internas-rodape")): ?>
	              <div class="row">
	                  <jdoc:include type="modules" name="<?php echo $posicao_rodape ?>" headerLevel="2" style="container" />
	                  <jdoc:include type="modules" name="internas-rodape" headerLevel="2" style="container" />
	              </div>
	              <?php endif; ?>

			</div> <!-- end .container --> 
	    <?php endif; ?>
		</div>  	
	
		<div class="fixed-action-btn click-to-toggle">

			<!-- <button type="button" class="btn" target="_blank" data-toggle="tooltip" data-placement="left" title="teste!1 dgdfgd dfg !"> -->
			<!-- <span>Exemplo de utilização de tooltips. -->
				<a href="https://terracap.chat.comunix.tech/chat-externo" target="_blank" data-toggle="tooltip" data-placement="left" title="Chat Online">
				<!-- <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-chat-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
					<path fill-rule="evenodd" d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
				</svg> -->
				<img src="templates/onepageterracap2019/img/chat_messages_14395.png" alt="" class="chat-stilo">
				  </br>
				  </a>
				
			<!-- </button >          -->
			
		</div>
		<span class="chat-online">  <a href="https://terracap.chat.comunix.tech/chat-externo" target="_blank" data-toggle="tooltip" data-placement="left" title="Chat Online" style="color: #fff;"> Chat On-line </a> </span> 
      	<footer class="rodape">
	     	<div class="container">
	            <div class="row">
		            <div class="item-rodape col-md-3 borda-lateral coluna-1">
		            	<jdoc:include type="modules" name="rodape-1" style="none" />
						<h4 class="font-titulo-artigos">ATENDIMENTO AO PÚBLICO</h4>
						<p class="mb-3">Atendimento SAC: <?php echo $this->params->get('sac');?><p>
						<p  class="mb-3"> Atendimento presencial: <?php echo $this->params->get('endereco');?></p>
						<?php if($this->params->get('ocultarFinalRodape') != 1): ?>
						<p class="padding-top-30">Horário de atendimento teste2: <?php echo $this->params->get('horario');?> Telefone: <?php echo $this->params->get('telefone');?></p>
						<?php endif; ?>
					</div>
	                <div class="item-rodape col-md-4 borda-lateral">
	                	<jdoc:include type="modules" name="rodape-2" style="none" />
	                </div>
	                <div class="item-rodape col-md-5">
                		<jdoc:include type="modules" name="rodape-3" style="none" />
		            </div>
	            </div>
	     	</div>
      	</footer>
	    
		<!-- End Layout -->

		<?php if ($this->countModules('debug')): ?>
		 <jdoc:include type="modules" name="debug" style="none" />
		<?php endif; ?>

		<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/scrolling-nav.js"></script>
		<noscript>Javascript de carregamento do jquery do projeto</noscript>
		<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/bootstrap.min.js"></script>
		<noscript>Javascript de carregamento do jquery do projeto</noscript>
		<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery.easing.min.js"></script>
		<noscript>Javascript de carregamento do jquery do projeto</noscript>
		<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/carouseller.js"></script>
		<noscript>Javascript de carregamento do jquery do projeto</noscript>
		<script  type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/swiper.min.js"></script>
		<noscript>Javascript de carregamento do jquery do projeto</noscript>
		<!-- JS -->
		<!-- Script MegaMenu-->
		<script  type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/mega-menu.js"></script>
		<!-- Script MegaMenu-->
		<script  type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/script.js"></script>

		<script type="text/javascript">
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})
		</script>
		<?php if($active_item->home != '1') : ?> 
		<script type="text/javascript">
		  	// Script criado para sobrescrever os link de menu ancora das paginas internas dos templates onpage,
		  	// afim de que se comportem como os itens de menu ancora da home.
		  	if('<?php echo JURI::base() ?>' != jQuery('base').attr('href')){
		      	jQuery('a.ancora').each(function(){
		        	url = jQuery(this).attr('href');
		        	parturl = url.slice(url.indexOf("#"), jQuery(this).attr('href').length);
		        	parturl = parturl.replace('#','/');
		        	if(url.indexOf("#")!=-1){
			        	jQuery(this).removeAttr('data-toggle');
			      		jQuery(this).attr('href','<?php echo JURI::base() ?>index.php'+parturl);
			        }
		  		});
			}
		</script>
		<?php endif; ?>
   	</body>
</html>