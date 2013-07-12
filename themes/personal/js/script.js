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
   /* $('.text-container li a').each(function(){
        var href= $(this).attr('href');
        href= href.split('#');
        // alert(href[1]);
        var selectDivID= $(this).parent().parent().parent().children('.tab').attr('id');
        var selectDiv= $(this).parent().parent().parent().children('.tab');
        if(selectDivID == href[1]){
          selectDiv.css({
            'display':'block',
            'visibility':'visible',
            'position':'static'
          })
        }
        

    })*/

jQuery(".cat-tabs-wrap").hide();
    jQuery(".cat-tabs-header ul li:first").addClass("active").show();
    jQuery(".cat-tabs-wrap:first").show(); 
    jQuery(".cat-tabs-header ul li").click(function() {
        jQuery(".cat-tabs-header ul li").removeClass("active");
        jQuery(this).addClass("active");
        jQuery(".cat-tabs-wrap").hide();
        var activeTab = jQuery(this).find("a").attr("href");
        jQuery(activeTab).fadeIn();
        return false;
    });
    
    jQuery("#tabbed-widget .tabs-wrap").hide();
    jQuery("#tabbed-widget ul.posts-taps li:first").addClass("active").show();
    jQuery("#tabbed-widget .tabs-wrap:first").show(); 
    jQuery("#tabbed-widget  li.tabs").click(function() {
        jQuery("#tabbed-widget ul.posts-taps li").removeClass("active");
        jQuery(this).addClass("active");
        jQuery("#tabbed-widget .tabs-wrap").hide();
        var activeTab = jQuery(this).find("a").attr("href");
        jQuery(activeTab).fadeIn();
        return false;
    });
});