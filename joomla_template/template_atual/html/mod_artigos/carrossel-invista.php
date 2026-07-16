<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<script type="text/javascript">
	var swiper = new Swiper('.swiper-container', {
		slidesPerView: 3,
		spaceBetween: 30,
		pagination: {
		el: '.swiper-pagination',
		clickable: true,
		},
	});
</script>


<!-- <div class="container carrossel-invista">

        <div class="row">

                    <?php foreach ($list as $key => $item) : ?>
                        <div class="col-4">
                            <a href="<?php echo $item->link; ?>">
                                <img src="<?php echo json_decode($item->images)->image_intro ?>" class="figure-img img-fluid rounded projetos-img" alt="<?php echo $item->title ?>">
                                
                                <h5 class="d-flex justify-content-center">
                                    <?php echo $item->title; ?>
                                </h5>
                             </a>
                        </div>
                    <?php endforeach ?>

        </div>

</div> -->


<script>
jQuery(function(){
        //jQuery = jQuery.noConflict();  
        jQuery(".carrossel").carouseller({
        //scrollSpeed: 650,
        //autoScrollDelay: -1800,
	
});
});

    </script>

<?php if ($params->get('show_description') == 1): ?>
	<div class="retranca descricao text-center mb-5"><?php echo $params->get('name_description'); ?></div>
<?php endif ?>


<div class="carrossel carouseller ">
    <a href="javascript:void(0)" class="carouseller__left"><i class="material-icons" aria-hidden="true">arrow_back_ios</i></a>
    
    <div class="carouseller__wrap">
        <div class="carouseller__list" style="left: 0px;">

			<?php foreach ($list as $key => $item) : ?>
            <div class="sld__4">

                <a class="card-padrao" href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>">
                    <div class="item-mosaico">
                        <img src="<?php echo json_decode($item->images)->image_intro ?>" alt="<?php echo $item->title; ?>" class="foto-mosaico">
                        <div class="chamada-mosaico">
                            <div class="titulo-mosaico"><?php echo $item->title; ?></div>
                        </div>
                    </div>
                </a>

            </div> <!-- end .sld__4 -->
            <?php endforeach ?>

        </div> <!-- end .carouseller__list -->
    </div>

    <a href="javascript:void(0)" class="carouseller__right"><i class="material-icons" aria-hidden="true">arrow_forward_ios</i></a>
</div>


<?php if ($params->get('show_link') == 1): ?>
 	<div  class="container d-flex justify-content-center">
    	<a href="<?php echo $params->get('url_link') ?>" class="btn btn-outline-light" title="<?php echo $params->get('name_link') ?>"><?php echo $params->get('name_link') ?></a>
 	</div>
<?php endif ?>