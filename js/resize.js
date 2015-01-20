$(function() {
        $(".well.sidenav").affix();
        $(window).resize(function() {
                $(".well.sidenav").data("offset-top", 200);              
                
      });
});     