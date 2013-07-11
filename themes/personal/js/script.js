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
jQuery(document).ready(function() {
   jQuery('.banner').revolution(
      {
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

          shadow:1,                     
          fullWidth:"off"                   
      });
});