<?php
/**
 * @package     Directsales
 * @subpackage  mod_directsales
 *
 * @author      Charles Guedes <charlesgcf@gmail.com>
 * @copyright   Copyright (C) 2018 Capgemini do Brasil. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Get the document object.
$doc = JFactory::getDocument();

if(!empty($chave)){
	echo "<script type=\"text/javascript\" src=\"https://maps.googleapis.com/maps/api/js?key=$chave \"></script>";
	echo "<script type=\"text/javascript\">var temChave = true; </script>";
}else{
	echo "<script type=\"text/javascript\">var temChave = false; </script>";
}

//echo "<pre>";
//var_dump($listCad,$listProp);
?>




<div class="container mt-3">
	<div class="row">	
		<div class="col-md-8">
			<div class="proposta">
				<h4 class="mb-4">Editais de Convocação</h4>

				<div class="row">
				<?php if ($listProp): ?>
					<?php foreach ($listProp as $key=>$item): ?>
							<div class="col-md-6">
								<a href="<?php echo $item->link; ?>" class="card-regularize">
									<div class="item-mosaico">
										<?php if ($image): ?>
				                    		<?php $image = $item->image ? JUri::root() . 'images/directsales/' . $item->image : 'com_directsales/no-image.png'; ?>
											<?php echo JHtml::_('image', $image, $item->title, 'class="foto-mosaico"', true); ?>
				                    	<?php endif; ?>

										<div class="chamada-mosaico">								
											<div class="titulo-mosaico"><?php echo $item->location; ?></div>
											<span class="descricao-mosaico"><?php echo $item->title;?></span>
										</div>
										<div class="status">

											<span class="tipo">PROPOSTA</span>
											<?php if($item->statusprop): ?>
											<span class="situacao 
													<?php 
														$statusprop = strtolower($item->statusprop);
														//die($statusprop);
														switch ($statusprop) {
															case 'disponível':
																echo 'disponivel';
																break;
															case 'iniciado':
																echo 'iniciado';
																break;
															case 'aberto':
																echo 'aberto';
																break;
															case 'encerrado':
																echo 'encerrado';
																break;
															default:
																echo 'em-analise';
																break;
													}?>"><?php echo strtoupper( $statusprop); ?></span>
											<?php else: ?>
												<span class="situacao "></span>
											<?php endif; ?>
											<span class="data"> De <?php echo date("d/m", strtotime($item->date_start_prop)); ?> a <?php echo date("d/m", strtotime($item->date_end_prop)); ?></span>
										</div>
									</div>
								</a>
							</div> <!-- end .col-md-6 -->
					<?php endforeach; ?>
				<?php endif; ?>

					<?php if ($params->get('show_button') == 1): ?>
						<div class="container d-flex justify-content-center">
		                    <a href="<?php echo $params->get('link_button'); ?>" class="btn btn-outline-dark">
	                            <?php echo $params->get('button'); ?>
		                    </a>
			            </div>    
			        <?php endif ?>
				</div> <!-- end .row -->
			</div>

			
			<div class="cadastro">
				<h4 class="mb-4">Cadastramento</h4>

				<div class="row">
					<div class="col-md-6">

							<div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
								<div class="carousel-inner">
										<?php  if($listCad): ?>
										
											<?php foreach ($listCad as $key=>$item): ?>
												<div class="carousel-item <?php echo $key==0?'active':'';?>">
												
													<a href="http://servicosonline2.terracap.df.gov.br/" target="_blank" >
													<!--a href="<?php echo $item->link; ?>" class="card-regularize"-->
														<div class="item-mosaico">
															<?php if ($image): ?>
																<?php $image = $item->image ? JUri::root() . 'images/directsales/' . $item->image : 'com_directsales/no-image.png'; ?>
																<?php echo JHtml::_('image', $image, $item->title, 'class="foto-mosaico"', true); ?>
															<?php endif; ?>

															<div class="chamada-mosaico">								
																<div class="titulo-mosaico"><?php echo $item->location; ?></div>
																<span class="descricao-mosaico"><?php echo $item->title;?></span>
															</div>

															<?php if(strtolower($item->statuscad) != "encerrado"): ?>
																<div class="periodo">
																	<div>CADASTRAMENTO</div>
																	<div><strong><?php echo date("d/m", strtotime($item->date_start)); ?></strong> a <strong><?php echo date("d/m", strtotime($item->date_end)); ?></strong></div>
																</div>
															<?php else:?>
																<div class="status">
																	<?php if($item->statuscad): ?>
																	<span class="situacao 
																			<?php 
																				$statuscad = strtolower($item->statuscad);
																				//die($statuscad);
																				switch ($statuscad) {
																					case 'disponível':
																						echo 'disponivel';
																						break;
																					case 'iniciado':
																						echo 'iniciado';
																					break;		
																					case 'aberto':
																						echo 'aberto';
																						break;
																					case 'encerrado':
																						echo 'encerrado';
																						break;
																					default:
																						echo 'em-analise';
																						break;
																			}?>"><?php echo strtoupper( $statuscad); ?></span>
																	<?php else: ?>
																		<span class="situacao"></span>
																	<?php endif; ?>
																</div>
															<?php endif;?>
														</div>
													</a>
												
												</div>
										<?php endforeach; ?>
									<?php endif  ?>
																																
									<div class="carrossel-paginacao">
										<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>

									
								</div>

								<div class="lista-noticia">
								</div>
						</div>							
							
					</div> <!-- end .col-md-6 -->
					
					<!-- div class="col-md-6 cj-botoes" -->
					<div class="col-md-6">
						<div class="botoes-area-cadastro">
						<?php 
					            // Monta posição virtual para escrever módulos - Botões Cadastro
					            $document = JFactory::getDocument();
					            $renderer = $document->loadRenderer('modules');
					            $position = "contexto-regularize-botoes";
					            $options = array('style' => 'none');
					            echo $renderer->render($position, $options, null);
					        	?>
					        </div>
					</div>		

				</div> <!-- end .row -->
			</div><!-- end .cadastro -->


		</div> <!-- end .col-md-8 -->
        

	    <div class="col-md-4">
	    	<div class="interna-direita">
	            <?php 
	            // Monta posição virtual para escrever módulos
	            $document = JFactory::getDocument();
	            $renderer = $document->loadRenderer('modules');
	            $position = "contexto-regulariza-imovel";
	            $options = array('style' => 'container');
	            echo $renderer->render($position, $options, null);
	        	?>
			</div>
	    </div>
    </div>
</div>





<script>

jQuery('#localizacao').click(function(e){
	e.preventDefault();

	function showPosition(position) {
		 
		if(!temChave){
			console.log('Chave do serviço de geolocalização inválida ou não encontrada.');
			document.getElementById("basic-url").value = position.coords.latitude + ","  + position.coords.longitude;
		}else{
			var lat = position.coords.latitude;
			var lng = position.coords.longitude;
			
			var latlng = new google.maps.LatLng(lat, lng);
			var geocoder = new google.maps.Geocoder();
			
			geocoder.geocode({'latLng': latlng}, function(results, status) {
				console.log(status);
				if (status == google.maps.GeocoderStatus.OK) {
				console.log(results);
				if (results[1]) {
					//formatted address
					console.log(results[0].formatted_address);
					//find country name
					for (var i=0; i<results[0].address_components.length; i++) {
						for (var b=0; b<results[0].address_components[i].types.length;b++) {

						//there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
							if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
								//this is the object you are looking for
								estado = results[0].address_components[i];
								break;
							}
							if (results[0].address_components[i].types[b] == "administrative_area_level_4") {
								//this is the object you are looking for
								cidade = results[0].address_components[i];
								break;
							}
						}
					}
					//city data
					//alert(cidade.long_name + "/" + estado.short_name);
					document.getElementById("basic-url").value = cidade.long_name + "/" + estado.short_name;

					} else {
					alert("Cidade não encontrada.");
					}
				} else {
					alert("Falha no serviço de Geolocalização: " + status);
				}
						
			});		
		}
					
	}
		
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
		
	} else { 
		alert('Geolocalização não é suportada pelo browser.');
	}
	
});

</script>