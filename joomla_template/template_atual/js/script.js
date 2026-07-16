jQuery(document).ready(function() {
    
    $(".interna-direita .parent .nav-child li").hide();
    $(".interna-direita .parent .nav-header").css('cursor','pointer');
    
    jQuery(".interna-direita .parent").on("click", function(e) {
        //e.preventDefault();
        console.log(this);
        if(jQuery(this).find('li').css('display') == 'block'){
            jQuery(this).find('li').hide();
        }else{
            jQuery(this).find('li').show();
        }
    });

    jQuery(".modal-ajuda").on("click", function(e) {
      e.preventDefault();
      var t = jQuery(this).attr('href');
      //alert(t);
      jQuery(t).modal("show");

    });

});


var swiperRegularize = new Swiper('.swiper-container', {
  slidesPerView: 3,
  spaceBetween: 30,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    640: {
      slidesPerView: 1,
      spaceBetween: 30,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 30,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 30,
    },
  }
});
