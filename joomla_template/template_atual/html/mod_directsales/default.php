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
?>

<?php if ($params->get('show_description') == 1): ?>
	<div class="retranca text-center mb-5"><?php echo $params->get('name_description'); ?></div>
<?php endif ?>


<div class="row">
	<div class="swiper-container">
		<div class="swiper-wrapper">	

		<?php foreach ($list as $key=>$item): //var_dump($item);?>
			<div class="swiper-slide">
				<?php if($item->show_sketch == 0): ?>
					<a class="card-regularize" href="http://servicosonline2.terracap.df.gov.br/" target="_blank" title="Faça seu cadastro">
				<?php else: ?>
					<a class="card-regularize" href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>">
				<?php endif; ?>
					<div class="item-mosaico" >
						<?php if ($image): ?>
									<?php $image = $item->image ? JUri::root() . 'images/directsales/' . $item->image : 'com_directsales/no-image.png'; ?>
									<?php echo JHtml::_('image', $image, $item->title, 'class="foto-mosaico"', true); ?>
								
								<div class="chamada-mosaico">
									<div class="titulo-mosaico">
										<?php if ($item_title): ?>
													<?php $title =  substr(htmlspecialchars($item->location),0,40); 
														echo $title;
														echo (strlen(htmlspecialchars($item->location)) < 40)? '':'...';
													?>
										<?php endif; ?>
									</div>
									<span class="descricao-mosaico">
										<?php echo $item->title;?>
									</span>
								</div>
								
									<?php if($item->show_sketch == 0): ?>
										<?php if(strtolower($item->statuscad) != "encerrado"): ?>
												<div class="periodo">
													<div>CADASTRAMENTO - <span>
													<?php echo date("d/m", strtotime($item->date_start)); ?> <?php echo $item->date_end=='0000-00-00'? '</strong> a <strong>'.date("d/m", strtotime($item->date_end)):''; ?> </span></div>
												</div>
												
												<div class="status2">
													<?php if($item->statuscad): ?>
													<span class="situacao 
															<?php 
																$statuscad = strtolower($item->statuscad);
																//die($statusprop);
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
													</div>
													<?php else: ?>
														<span class="situacao "></span>
													<?php endif; ?>
											<?php else:?>
												<div class="status">
													<span class="tipo">CADASTRO</span>
													<?php if($item->statuscad): ?>
													<span class="situacao 
															<?php 
																$statuscad = strtolower($item->statuscad);
																//die($statusprop);
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
														<span class="situacao "></span>
													<?php endif; ?>
												</div>
											<?php endif;?>
									<?php elseif($item->show_sketch == 1): ?>
										<div class="status">
											<span class="tipo">PROPOSTA<?php /*echo $$item->status_id_cad; */?></span>
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
														}?>">
														<?php echo strtoupper( $statusprop); ?>
												</span>
											<?php else: ?>
												<span class="situacao "></span>
											<?php endif; ?>
										</div>
								<?php endif;?>
						<?php endif; ?>
					</div>
				</a>
			</div> <!-- end .swiper-slide -->
		<?php endforeach; //exit; ?>

		</div> <!-- end .swiper-wrapper -->

		<!-- Add Arrows -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div> <!-- end .swiper-container -->
</div> <!-- end .row -->


<div class="row">
	<?php if ($params->get('show_button') == 1):?>
		<div  class="container d-flex justify-content-center">
			<a href="<?php echo $linkButton; ?>" class="btn btn-outline-dark" title="<?php echo $button; ?>"><?php echo $button; ?></a>
		</div>
	<?php endif;?>
</div> <!-- end .row -->


<div class="row">
	<?php 
	// Chamado 2623/2019 - Inclusão de links e Carrossel
	$document = JFactory::getDocument();
	$renderer = $document->loadRenderer('modules');
	$position = "mais-regularize";
	$options = array('style' => 'container');
	echo $renderer->render($position, $options, null);
	?>
</div> <!-- end .row -->



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