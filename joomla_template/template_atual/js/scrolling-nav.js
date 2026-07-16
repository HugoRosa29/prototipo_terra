jQuery(function() {
    jQuery('.nav-item a').bind('click', function(event) {

        var jQueryanchor = jQuery(this);
        
        jQuery('html, body').stop().animate({
            scrollTop: jQuery(jQueryanchor.attr('href')).offset().top-120
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
     });
});
