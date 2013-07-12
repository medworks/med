// ******** Active menu
$(document).ready(function(){
    var url= window.location.href;
    $('.main-menu a').each(function(){
        if(this.href.trim() == url){
            $(this).parent().addClass("active");
        }else if(this.href.trim().match(/full/g)){
            var href= url.substr(url.indexOf("full"), url.indexOf("&"));
            href= href.split('full');
            href= href[1].split('&');
            $('.main-menu a[href*="'+href[0]+'"]').parent().addClass('active');
        }
    });
});
// ******** Slideshow
jQuery(document).ready(function(){
   jQuery('.banner').revolution({
          delay:5000,
          startheight:500,
          startwidth:960,

          hideThumbs:300,

          thumbWidth:100,   
          thumbHeight:50,
          thumbAmount:5,

          navigationType:"none",                    
          navigationArrows:"verticalcentered",      
          navigationStyle:"round",              

          touchenabled:"on",                    
          onHoverStop:"on",                 

          navOffsetHorizontal:0,
          navOffsetVertical:20,

          stopAtSlide:-1,
          stopAfterLoops:-1,

          shadow:0,                     
          fullWidth:"off"                   
      });
});
// ******** Client part tabs
jQuery(document).ready(function(){
    $(".cat-tabs-wrap").hide();
        $(".cat-tabs-header ul li:first").addClass("active").show();
        $(".cat-tabs-wrap:first").show(); 
        $(".cat-tabs-header ul li").click(function() {
            $(".cat-tabs-header ul li").removeClass("active");
            $(this).addClass("active");
            $(".cat-tabs-wrap").hide();
            var activeTab = $(this).find("a").attr("href");
            $(activeTab).fadeIn();
            return false;
        });
    
    $("#tabbed-widget .tabs-wrap").hide();
    $("#tabbed-widget ul.posts-taps li:first").addClass("active").show();
    $("#tabbed-widget .tabs-wrap:first").show(); 
    $("#tabbed-widget  li.tabs").click(function() {
        $("#tabbed-widget ul.posts-taps li").removeClass("active");
        $(this).addClass("active");
        $("#tabbed-widget .tabs-wrap").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;
    });
});