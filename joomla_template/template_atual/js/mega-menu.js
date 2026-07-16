jQuery(document).ready(function() {
    jQuery(".megamenu").on("click", function(e) {
        e.stopPropagation();
    });

    var forEach = function(t, o, r) { if ("[object Object]" === Object.prototype.toString.call(t))
            for (var c in t) Object.prototype.hasOwnProperty.call(t, c) && o.call(r, t[c], c, t);
        else
            for (var e = 0, l = t.length; l > e; e++) o.call(r, t[e], e, t) };

    var hamburgers = document.querySelectorAll(".hamburger");
    if (hamburgers.length > 0) {
        forEach(hamburgers, function(hamburger) {
            hamburger.addEventListener("click", function() {
                this.classList.toggle("is-active");
            }, false);
        });
    }

    // $(document).ready(function(){

        //console.log("teste fora");
        jQuery(".dropdown").mouseleave(function(){
            //Megamenu fechar automaticamente ao sair do subMenu(megamenu)
            jQuery('.megamenu').removeClass('show');
        });
        jQuery(".megamenu").mouseleave(function(){ console.log("teste fora");
            //Megamenu fechar automaticamente ao sair do subMenu(megamenu)
            jQuery('.megamenu').removeClass('show');
        });
    // });
});