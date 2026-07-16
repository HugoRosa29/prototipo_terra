<?php

// no direct access
defined('_JEXEC') or die ('Restricted access'); 

//$wcag = $params->get('wcag', 1) ? ' tabindex="0"' : ''; ?>
<?php if ($params->get('show_description') == 1): ?>
<div class="retranca descricao text-center mb-5"><?php echo $params->get('name_description'); ?></div>
<?php endif ?>
<div class="swiper-container invista-em-brasilia">
	<?php if ($params->get('show_description') == 1): ?>
	<?php endif ?>
	<div class="swiper-wrapper" id="swiper">
		<?php foreach ($slides as $slide): 
          	$rel = (!empty($slide->rel) ? 'rel="'.$slide->rel.'"':''); ?>

			<div class="swiper-slide">

				<div class="item">
					<div class="img-invista">
						<?php if($slide->image): ?>
							<img src="<?php echo $slide->image; ?>" alt="<?php echo $slide->alt; ?>" <?php echo (!empty($slide->img_title) ? ' title="'.$slide->img_title.'"':''); ?>  />
	                    <?php endif; ?>       
	                </div>
	                <div class="txt-invista" >
	                	<?php if($params->get('show_title')): ?>
							<h4><?php echo $slide->title; ?></h4>
						<?php endif; ?>

						<?php if($params->get('show_desc')): ?>
	                    	<span class="descricao"><?php echo $slide->description; ?></span>
						<?php endif; ?>
						<?php if($params->get('link_desc') && $slide->link): ?>
							<?php if($params->get('show_readmore') && $slide->link) { ?>
								<a href="<?php echo $slide->link; ?>" target="<?php echo $slide->target; ?>" <?php echo $rel; ?> class="readmore">
									VEJA MAIS <i class="fas fa-arrow-right"></i>
								</a>
							<?php } ?>
	                	<?php endif; ?>
	                </div> 
				</div>

			</div>
		<?php endforeach; ?>
	</div>

      <!-- Add Arrows -->
    <div class="swiper-button-next swiper-button-white proximo-invista"></div>
	<div class="swiper-button-prev swiper-button-white anterior-invista"></div>
</div>
<?php if ($params->get('show_link') == 1): ?>
 	<div  class="container d-flex justify-content-center">
    	<a href="<?php echo $params->get('url_link') ?>" class="btn btn-outline-light" title="<?php echo $params->get('name_link') ?>"><?php echo $params->get('name_link') ?></a>
 	</div>
<?php endif ?>

  <script>
	function slider(quantidade){		

	var swiperInvista = new Swiper('.invista-em-brasilia', {


		slidesPerView: quantidade,
		pagination: {
			el: '.navegacao-invista',
			clickable: true,
		},
		navigation: {
			nextEl: '.proximo-invista',
			prevEl: '.anterior-invista',
		},
	});

	}
	window.onload = function() {



		if (window.innerWidth < 980) {
			var slides = 1;
			slider(slides);

		}
		else{
			var slides = 2;
			slider(slides);
		}
	};
	window.onresize = function() {

		
		
		

		if (window.innerWidth < 980) {
			var slides = 1;
			slider(slides);

		}
		else{
			var slides = 2;
			slider(slides);
		}

		document.getElementById("swiper").style.transform = "translate3d(0px, 0px, 0px)";

	}
		
	

</script>
