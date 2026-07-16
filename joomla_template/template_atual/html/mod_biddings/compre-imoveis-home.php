<?php
/**
 * @package     Auctions
 * @subpackage  mod_auctions
 *
 * @author      Charles Guedes <charlesgcf@gmail.com>
 * @copyright   Copyright (C) 2018 Capgemini do Brasil. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

?>

<style>

/* .slidde {display: none;} */

/* .containerint {

width: 100%;
max-width: 100%;
margin: auto;


} */
.leftside {

width: 730px;

float: left;

}		
.carousel-inner, .borda-arredondada{
    border-radius: 10px;
}	
#compre-imoveis .carousel-control-next {
    /* right: 45px; */
    right: -55px;
    width: 70px;
}
#compre-imoveis .carousel-control-prev {
    /* left: 8px; */
    width: 70px;
    left: -90px;
    /* width: 70px; */

}
.slideshow {
height: 500px;
/* background-color: #CCC;  */
max-width: 1000px;
position: relative;
  margin: auto;
/* overflow: hidden;  */
}
.slideshowarea {
    max-width: 1000px;
/* width: auto; */
height: 500px;
/* background-color: #DDD;  */
/* transition: all 1s; */
}
.slidde {
    display: none;
/* width: 1090px; */
width:100%;
/* width: 1110px; */
height: 410px;
float: left;
background-repeat: no-repeat;
background-position: center;
background-size: cover;
transition: all 1s;

}
.itensInferior{
    
}

.slidebolinhas {
    cursor: pointer;
	position: absolute;
	width:200px;
    height:20px;
    z-index: 9;
    position: relative;
    margin-left: 50%;
    margin-bottom: 10px;
}

.active, .bolinha:hover {
  background-color: #717171;
}
.bolinha {
    display: none;
  /* cursor: pointer; */
  /* height: 15px; */
  /* width: 15px; */
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
    /* fdgdfg */
	width:20px;
	height:20px;
	/* float:left; */
	/* margin-right:5px; */
	cursor:pointer;
	/* background-color:#CCC; */
	/* border-radius:10px; */
}
.bolinha2{
    display: none;
  /* cursor: pointer; */
  /* height: 15px; */
  /* width: 15px; */
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
    /* fdgdfg */
	width:20px;
	height:20px;
	/* float:left; */
	/* margin-right:5px; */
	cursor:pointer;
	/* background-color:#CCC; */
	/* border-radius:10px; */
}


/* The dots/bullets/indicators
.bolinha {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
} */

.active, .bolinha:hover {
  background-color: #717171;
}

/* Next & previous buttons */
.prev, .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    margin-top: -30px;
    padding: 16px;
    color: white;
    font-weight: bold;
    font-size: 18px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
    text-align: center;
     background: gray; 
     /* background: transparent no-repeat center center; */
     background: #9e9e9e14 no-repeat center center;
    /* height: 60px; */
    /* top: 50%; */
    /* margin-top: -30px; */
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px
}



/* Position the "next button" to the right */
.next {
    right: 0;
    border-radius: 3px 0 0 3px;
    /* margin-right: 7.7%; */
    /* background-color: blue; */
    /* width: 4%;  */
    background-color: #d9efff59;
}

.prev{
    left: 0;
    border-radius: 3px 0 0 3px;
    /* margin-left: -8%; */
    /* background-color: green; */
    background-color: #d9efff59;
    /* width: 4%;  */
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
    background-color: rgba(0,0,0,0.8);
}


/* Novo teste */


/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 4.0s;
  animation-name: fade;
  animation-duration: 4.0s;
}
.fade:not(.show){
    opacity: unset;
    }
@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@media screen and (max-width: 1024px){
.slidde {
     max-width: 940px; 
}
.next {
    margin-right: 1%;
}

.prev{
    margin-left: 1%;
}
}

@media screen and (max-width: 992px){
.slidde {
    max-width: 940px;
}
.next {
    margin-right: 1%;
}

.prev{
    margin-left: 1%;
}
}
@media screen and (max-width: 768px){
.slidde {
    max-width: 740px;
    /* max-width: 100%; */
}
#compre-imoveis .carousel-control-next {
    right: 20px;
    /* right: -55px; */
    width: 70px;
}
#compre-imoveis .carousel-control-prev {
    left: 8px;
    width: 70px;
    /* left: -90px; */
    /* width: 70px; */

}
#compre-imoveis .carousel-control-next, #compre-imoveis .carousel-control-prev {
    height: 40px;
    top: 40%;
    margin-top: 7px;
    /* height: auto; */
}
}
@media screen and (max-width: 576px){
.slidde {
    /* max-width: 340px; */
    max-width: 100%;
    min-height: auto;
    padding-right: 10px;
}
.prev,
.next{
    /* top: 125%; */
    /* display: none; */
}
.slideshow{
    min-height: 530px;
    /* height: auto !important; */
}
#compre-imoveis .compre-dados {
    height: 280px;
    top: 10%;
    margin-top: -200px;
    padding: 0;
}
#compre-imoveis .carousel-control-next {
    right: 20px;
    /* right: -55px; */
    width: 70px;
}
#compre-imoveis .carousel-control-prev {
    left: 8px;
    width: 70px;
    /* left: -90px; */
    /* width: 70px; */

}
#compre-imoveis .carousel-control-next, #compre-imoveis .carousel-control-prev {
    height: 40px;
    top: 40%;
    margin-top: 7px;
    /* height: auto; */
}
}
/* @media only screen and (min-width:906px) and (max-width:1057px) {

.slidde,
.container {
    max-width:890px;
}

.next {
    display: none;
}

} */
</style>



<?php if ($params->get('show_description') == 1): ?>
<div class="retranca text-center mb-5"><?php echo $params->get('name_description'); ?></div>
<?php endif ?>



<!-- <div class="container"> -->
			 <!-- <div class="containerint">   -->
				
					<div class="slideshow" id="slideshow">
                    <div class="slidebolinhas">
                    <?php  
                        $i = 0; //var_dump($i,"teste");
                        foreach ($list as $key => $item){
                            //$number = $item->id;
                            echo '<div class="bolinha" onclick="mudarSlide('.$i.')" style="display:none;"></div>';
                            $i++;
                            //var_dump($i,"teste 22"); 
                        // exit;
                       }//exit;

                        ?>
                        
						</div> 
						<div class="slideshowarea">
                       <?php //for($numero = 0; $numero < $i; $numero++):  ?>
						<!--	<div class="slidde" style="background-image:url('https://www.google.com.br/logos/google.jpg')"> 
							<div class="slideinfo">
								<div class="slideinfo-titulo">
									<?php //echo 'Titulo'.$item;?>
								</div>
								<div class="slideinfo-subtitulo">
									SubTitulo Test <?php //echo 'SubTitulo'.$item;?>
								</div>
							</div>
                            </div> -->

<?php foreach ($list as $key => $item): ?>
    <div class="slidde fade">
<div class="row">
    <div class="col-md-7">
        <div id="carousel-compre-imoveis<?php echo $item->id; ?>" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php //foreach ($list as $key => $item): ?>
                    <?php if (json_decode($item->image)): ?>
                        <?php foreach (json_decode($item->image) as $key2 => $value): ?>
                            <!-- <li data-target="#carouselExampleIndicators" data-slide-to="<?php //echo $key2; ?>"></li> -->
                        <?php endforeach; ?>
                    <?php elseif ($item->image): ?>
                        <!-- <li data-target="#carouselExampleIndicators" data-slide-to="<?php //echo $key; ?>"></li> -->
                    <?php endif ?>    
                <?php //endforeach; ?>
            </ol>

            <div class="carousel-inner borda-arredondada">
                <?php //foreach ($list as $key => $item): ?>
                    <?php if (json_decode($item->image)): ?>
                        <?php foreach (json_decode($item->image) as $key2 => $value): ?>
                            <?php $image = $value ? JUri::root() . 'images/biddings/' . $value : 'com_biddings/no-image.png'; ?>
                                <div class="carousel-item <?php echo ($key2==0)?'active':'';?>">
                                    <a href="<?php echo $item->link ? $item->link:'#'; ?>" title="<?php echo $item->title ?>">
                                        <img class="d-block w-100 rounded img-fluid" src="<?php echo $image ?>" alt="<?php echo $item->title ?>">
                                    </a>
                                </div>
                        <?php endforeach ?>
                    <?php elseif ($item->image): ?>
                        <?php $image = $item->image ? JUri::root() . 'images/biddings/' . $item->image : 'com_biddings/no-image.png'; ?>
                            <div class="carousel-item <?php echo ($key==0)?'active':'';?>">
                                <a href="<?php echo $item->link ? $item->link:'#'; ?>" title="<?php echo $item->title ?>">
                                    <img class="d-block w-100 rounded img-fluid" src="<?php echo $image ?>" alt="<?php echo $item->title ?>">
                                </a>
                            </div>
                    <?php endif ?>
                <?php //endforeach; ?>
            </div>

            <!-- <a class="carousel-control-prev" href="#carousel-compre-imoveis<?php //echo $item->id; ?>" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
           <a class="carousel-control-next" href="#carousel-compre-imoveis<?php //echo $item->id; ?>" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a> -->
       </div> <!-- end #carousel-compre-imoveis -->

    </div>

    <div class="col-md-5 container">

        <div class="compre-dados bloco-<?php echo $params->get('backgroundcolor'); ?>">
            
            <h3 class="text-center"><?php echo $item->title ?></h3>
            <div class="horario-entrega mb-4">
                Entrega das propostas entre <?php echo $params->get('hora-inicio') ; ?> e <?php echo $params->get('hora-fim') ; ?>
            </div>
            <div class="datas mb-4">
                <div>
                    <p class="titulo">Caução até</p>
                    <p class="dia"><?php echo JHtml::_("date", strtotime($item->date_deposit), 'd F'); ?></p>
                </div>
                <div>
                    <p class="titulo">Licitação em</p>
                    <p class="dia"><?php echo JHtml::_("date", strtotime($item->date_bidding), 'd F'); ?></p>
                </div>
            </div>
            <div class="localizacao  mb-1">
                <div>
                    <?php if(!empty($item->location) ):  ?>
                        <?php $len=strlen($item->location); ?>

                        <?php  if ($len>102) {
                            $item->location = substr($item->location,0,105).'...';
                            }  ?>
                        <p class="text-justify"><?php echo $item->location; ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="<?php echo $item->link ? $item->link:'#'; ?>" class="btn btn-outline-dark mr-2" title="Saiba Mais">Saiba Mais</a>
                
                <?php if($params->get('show_link2')):?>
                    <a href="<?php echo $params->get('url_link2');?>" class="btn ml-2 <?php echo $params->get('class');?>" title="<?php echo $params->get('name_link2');?>" target="_blank"><?php echo $params->get('name_link2');?></a>
                <!-- <a style="margin-left: 15px; " href="https://comprasonline.terracap.df.gov.br/bidding/external/watch" class="btn btn-outline-dark" title="Acompanhe ao Vivo">Acompanhe ao Vivo</a> -->
            <?php endif ?>
            </div>
            
        </div>
    </div> <!-- end .container -->
</div>


                     

                </div>
<?php endforeach; ?>

                      <!-- Next and previous buttons -->

                       <?php //endfor;?>



</div>


						<!--	<div class="slidde" style="background-image:url('https://www.google.com.br/logos/google.jpg')"> 
							<div class="slideinfo">
								<div class="slideinfo-titulo">
									Titulo Test 2
								</div>
								<div class="slideinfo-subtitulo">
									SubTitulo Test 2
								</div>
							</div>
							</div> -->
							
  <?php if($i > 1): ?>
<a class="carousel-control-prev" onclick="plusSlides(-1)" role="button" data-slide="prev">  
<!-- <  -->

<span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" onclick="plusSlides(1)"> 
 <!-- >  -->
 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
  </a>
<?php endif; ?>

  <!-- <a class="carousel-control-prev" href="#carousel-compre-imoveis<?php //echo $item->id; ?>" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
           <a class="carousel-control-next" href="#carousel-compre-imoveis<?php //echo $item->id; ?>" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a> -->
					</div>
                    
<div class="slidebolinhas">
                <?php  
                        $i = 0; //var_dump($i,"teste");
                        foreach ($list as $key => $item){
                            //$number = $item->id;
                            echo '<div class="bolinha2" onclick="mudarSlide('.$i.')" ></div>';
                            $i++;
                            //var_dump($i,"teste 22"); 
                        // exit;
                       }//exit;

                        ?>
</div>
				<!-- </div> -->
				<!-- </div> -->


<?php if ($params->get('show_link3') == 1): ?>
<div class="row" style="float: right; width: 70%; margin-top: 20px;">
<?php if ($params->get('show_link3') == 1): ?>
  
    <div class="row-fluid module links-destaques">
        <a href="<?php echo $params->get('url_link3'); ?>" class="btn btn-outline-dark" title="<?php echo $params->get('name_link'); ?>"  target="_blank";><?php echo $params->get('name_link3'); ?></a>
    </div>
<?php endif ?>

<?php if ($params->get('show_link') == 1): ?>
    <div class="row-fluid module links-destaques">
        <a href="<?php echo $params->get('url_link'); ?>" class="btn btn-outline-dark" title="<?php echo $params->get('name_link'); ?>"><?php echo $params->get('name_link'); ?></a>
    </div>
   
<?php endif ?>
</div>
<?php elseif ($params->get('show_link') == 1): ?>
    <div class="d-flex justify-content-center">
        <a href="<?php echo $params->get('url_link'); ?>" class="btn btn-outline-dark" title="<?php echo $params->get('name_link'); ?>"><?php echo $params->get('name_link'); ?></a>
    </div>
<?php endif ?>

<script>
var slideIndex = 1;
showSlidesTeste(slideIndex);


//window.onload = function(){
function showSlidesTeste(n) {
    console.log("mobile2222");
  var i;
  var slides = document.getElementsByClassName("slidde");
  var dots = document.getElementsByClassName("bolinha");
  var dots2 = document.getElementsByClassName("bolinha2");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots2[i].className = dots2[i].className.replace(" active", "");
  }
  for (i = 0; i < dots2.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  dots2[slideIndex-1].className += " active";
  var myTime = setTimeout(showSlidesTeste, 8200);
  //setInterval(plusSlides, 2000);
}

function plusSlides(n) {
    showSlidesPassar(slideIndex += n);
}


function showSlidesPassar(n) {
    console.log("ajuste");
  var i;
  var slides = document.getElementsByClassName("slidde");
  var dots = document.getElementsByClassName("bolinha");
  var dots2 = document.getElementsByClassName("bolinha2");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  for (i = 0; i < dots2.length; i++) {
      dots2[i].className = dots2[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  dots2[slideIndex-1].className += " active";

}

function currentSlide(n) {
    showSlidesTeste(slideIndex = n);
}

</script>   