<?php
/**
 * @package		SP Flickr Gallery
 * @copyright	Copyright (C) 2010 - 2015 JoomShaper. All rights reserved.
 * @license		GNU General Public License version 2 or later; 
 */

// no direct access
defined('_JEXEC') or die;
?>

<!----------------------- Swipe ---------------------------------------->

<link rel="stylesheet" href="//idangero.us/swiper/dist/css/swiper.min.css">

<style>
    .swiper-container {
      width: 100%;
      height: 100%;
      margin-left: auto;
      margin-right: auto;
    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
    
</style>

<?php
if($params->get('flickr_display_gallery') == 0){ 

	$Images = "[".$params->get('flickr_id_img1').",".$params->get('flickr_id_img2').",".$params->get('flickr_id_img3').",".$params->get('flickr_id_img4').",".$params->get('flickr_id_img5').",".$params->get('flickr_id_img6').",".$params->get('flickr_id_img7').",".$params->get('flickr_id_img8').",".$params->get('flickr_id_img9')."]";
?>	
	<script type="text/javascript"> 
		
		//Chave da API: https://www.flickr.com/services/apps/by/140227800@N03
		//Parametros do JSON: https://www.flickr.com/services/api/explore/flickr.photos.search
		//Parametros da Imagem: https://www.flickr.com/services/api/misc.urls.html
		//Obter imagem individual: https://www.flickr.com/services/api/explore/flickr.photos.getInfo

		jQuery(document).ready(function(){
		 	var flickr_api_key = '<?php echo $params->get('flickr_api_key'); ?>';
		 	var flickr_id = '<?php echo $params->get('flickr_id'); ?>';
		 	var flickr_setid = '<?php echo $params->get('flickr_setid'); ?>';
		 	var arrayImages = <?php echo $Images; ?>;
		 	var itensSucesso = 0;
		 	var itensPreenchidos = 0;
		 	var arrayHtml = new Array();
		 	var colunas = <?php echo $params->get('columns'); ?>;
		 	var colunaItens = 0;

		 	if(colunas == 3){
		 		colunaItens = 4;//divisão bootstap
		 	}else{
		 		colunaItens = 3;//divisão bootstap
		 	}

		 	//inicializar:
		 	for (k = arrayImages.length - 1; k >= 0; k--){
		 		arrayHtml[k] = "";
		 		if(arrayImages[k] != undefined){
		 			itensPreenchidos++;
		 		}
		 	}

		 	jQuery.each(arrayImages, function(i, id_image) {
			    if(id_image != undefined){
			    	jQuery.ajax({
				   		url: "https://api.flickr.com/services/rest/?method=flickr.photos.getInfo&api_key="+flickr_api_key+"&photo_id="+id_image+"&format=json&nojsoncallback=1",
				       	dataType: "json",
				       	success: function(json){
				       		imageHtml = '<div id="'+i+'" class="swiper-slide"><a href="https://www.flickr.com/photos/mineducacao/'+json.photo.id+'/in/album-'+flickr_setid+'/" title="'+json.photo.title._content+'"><img src="https://farm'+json.photo.farm+'.staticflickr.com/'+json.photo.server+'/'+json.photo.id+'_'+json.photo.secret+'_c.jpg" alt="'+json.photo.title._content+'"><span class="title-photo">'+json.photo.title._content+'</span></a></div>';
				       		
				       		arrayHtml[i] = imageHtml;
					 
						   	itensSucesso++;
						   	if( itensSucesso == itensPreenchidos ){
								jQuery('#fotos').html(arrayHtml.join(''));
						   	}
				    	},
				    	error: function(){ 
				    		console.log('Erro ao carregar imagem.');
				    	}  
				 	});
			    }	
			});

	    }); 
	</script>

<?php } ?>

<div class="swiper-container">

	<?php if($params->get('flickr_display_gallery') == 1) {?>
			<?php if($params->get('flickr_id')) {?>
				<div class="swiper-wrapper" id="fotos"></div>
			<?php } ?>
	<?php }else{ ?>
		<div class="swiper-wrapper" id="fotos"></div>
	<?php }?>

	<div class="swiper-pagination"></div>

	<div class="swiper-button-next"></div>
	<div class="swiper-button-prev"></div>
</div>
<br><br>
<div class="container d-flex justify-content-center">
    <a href="<?php echo $params->get('link_rodape'); ?>" title="<?php echo $params->get('texto_link_rodape'); ?>" class="btn btn-outline-dark">
        <?php echo $params->get('texto_link_rodape'); ?>
    </a>
</div>

<script src="//idangero.us/swiper/dist/js/swiper.min.js"></script>

<script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 30,
      keyboard: {
        enabled: true,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>