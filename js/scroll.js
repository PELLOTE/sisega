function GoUp() {
        $('html, body').animate({scrollTop: '0px'}, 800);
}

//$("#to_top").topLink({min: 300, fadeSpeed: 500});
//$("a[href=#to_top]").click(function() {
//        $("html, body").animate({scrollTop: 0}, "slow");
//        return false;
//});

//jQuery.fn.topLink = function(d) {
//        d = jQuery.extend({min: 1, fadeSpeed: 200}, d);
//        return this.each(function() {
//                var e = $(this);
//                e.hide();
//                $(window).scroll(function() {
//                        if ($(window).scrollTop() >= d.min) {
//                                e.fadeIn(d.fadeSpeed);
//                        } else {
//                                e.fadeOut(d.fadeSpeed);
//                        }
//                });
//        });
//};