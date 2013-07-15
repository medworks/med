$(document).ready(function(){
// ******** Active menu
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
// ******** Slideshow
   $('.banner').revolution({
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
// ******** Client part tabs
      $(".cat-tabs-wrap").hide();
      $(".cat-tabs-header ul li:first-child").addClass("active").show();
      $(".cat-tabs-wrap:first-child").show(); 
      $(".cat-tabs-header ul li").click(function() {
          $(".cat-tabs-header ul li").removeClass("active");
          $(this).addClass("active");
          $(".cat-tabs-wrap").hide();
          var activeTab = $(this).find("a").attr("href");
          $(activeTab).fadeIn();
          return false;
      });
// ******** TABS part tabs
      $(".cat-tabs-wrap2").hide();
      $(".cat-tabs-header2 ul li:first").addClass("active").show();
      $(".cat-tabs-wrap2:first").show(); 
      $(".cat-tabs-header2 ul li").click(function() {
          $(".cat-tabs-header2 ul li").removeClass("active");
          $(this).addClass("active");
          $(".cat-tabs-wrap2").hide();
          var activeTab = $(this).find("a").attr("href");
          $(activeTab).show('slow');
          return false;
      });
// ******** Main menu effect
      $("li , .main-menu li").each(function(){  
          var $sublist = $(this).find('menu:first');       
          
          $(this).hover(function(){  
                $sublist.stop().css({overflow:"hidden", height:"auto", display:"none"}).slideDown(300, function(){
                    $(this).css({overflow:"visible", height:"auto"});
                }); 
            },function(){ 
                $sublist.stop().slideUp(200, function(){   
                    $(this).css({overflow:"hidden", display:"none"});
                });
          }); 

      });
// ******** Image hover
  $('#slideshow-rec .scroll-item a').append('<div class="more"></div>');
  $('#slideshow-rec .scroll-item > a ').hoverdir();
});