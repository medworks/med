// contact validate
function validateText(str,len){
    return str.length >= len;
}

function validateEmail(str){
    var emailPattern = /^[a-z0-9+_%.-]+@(?:[a-z0-9-]+\.)+[a-z]{2,6}$/i ;

    return emailPattern.test(str);
}

(function($){
    $(function(){
        $('form#contact').submit(function(){
            var feild, err=false;
    
            target = $('#name');
    
            if (validateText( target.val(), 3 )) {
    
                target.removeClass('err').addClass('ok');
    
            }else{
    
                target.removeClass('ok').addClass('err');
                err= true;
            }
    
            target = $('#email');
    
            if (validateEmail(target.val())) { 
    
                target.removeClass('err').addClass('ok');
            }else {
    
                target.removeClass('ok').addClass('err');
                err=true;
            }
    
            target = $('#message');
    
            if (validateText( target.val(), 7 )) {
    
                target.removeClass('err').addClass('ok');
    
            }else {
    
                target.removeClass('ok').addClass("err");
                err=true;
            }
    
            return !err;
        });
    });

    $(function(){
        $('form#commentform').submit(function(){
            var feild, err=false;
    
            target = $('#author');
    
            if (validateText( target.val(), 3 )) {
    
                target.removeClass('err').addClass('ok');
    
            }else{
    
                target.removeClass('ok').addClass('err');
                err= true;
            }
    
            target = $('#email');
    
            if (validateEmail(target.val())) { 
    
                target.removeClass('err').addClass('ok');
            }else {
    
                target.removeClass('ok').addClass('err');
                err=true;
            }
    
            target = $('#comment');
    
            if (validateText( target.val(), 7 )) {
    
                target.removeClass('err').addClass('ok');
    
            }else {
    
                target.removeClass('ok').addClass("err");
                err=true;
            }
    
            return !err;
        });
    });
})(jQuery);


// Anchor link for scroll
(function($){
    $(function(){
        $('#scroll-top-top a').click(function(){
            $('html, body').animate({scrollTop:0}, 500);
        })
        return false;
    });
})(jQuery);
/***************************************************************************************/
jQuery(document).ready(function() {

    //tooltip();
    jQuery('.ttip , .tooltip-n').tipsy({fade: true, gravity: 's'});
    jQuery('.tooldown, .tooltip-s').tipsy({fade: true, gravity: 'n'});
    
    jQuery('.tooltip-nw').tipsy({fade: true, gravity: 'nw'});
    jQuery('.tooltip-ne').tipsy({fade: true, gravity: 'ne'});   
    jQuery('.tooltip-w').tipsy({fade: true, gravity: 'w'});
    jQuery('.tooltip-e').tipsy({fade: true, gravity: 'e'});
    jQuery('.tooltip-sw').tipsy({fade: true, gravity: 'w'});
    jQuery('.tooltip-se').tipsy({fade: true, gravity: 'e'});

    //Scroll To top
    jQuery(window).scroll(function(){
        if (jQuery(this).scrollTop() > 100) {
            jQuery('#topcontrol').css({bottom:"15px"});
        } else {
            jQuery('#topcontrol').css({bottom:"-100px"});
        }
    });
    jQuery('#topcontrol').click(function(){
        jQuery('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });

    //Menus
    jQuery('menu > li > menu, menu > li > menu > li > menu, menu > li > menu > li > menu> li > menu, .top-menu  menu > li > menu, .top-menu  menu > li > menu > li > menu, .top-menu  menu > li > menu > li > menu> li > menu ').parent('li').addClass('parent-list');
    jQuery('.parent-list').find("a:first").append(' <span class="sub-indicator">&raquo;</span>');

    jQuery("li , .top-menu li").each(function(){  
        var $sublist = jQuery(this).find('menu:first');       
        jQuery(this).hover(function(){  
            $sublist.stop().css({overflow:"hidden", height:"auto", display:"none"}).slideDown(200, function(){
                jQuery(this).css({overflow:"visible", height:"auto"});
            }); 
        },
        function(){ 
            $sublist.stop().slideUp(200, function() {   
                jQuery(this).css({overflow:"hidden", display:"none"});
            });
        }); 
    });
    
   
    
});

// tipsy, version 1.0.0a
(function(a){function b(a,b){return typeof a=="function"?a.call(b):a}function c(a){while(a=a.parentNode){if(a==document)return true}return false}function d(b,c){this.$element=a(b);this.options=c;this.enabled=true;this.fixTitle()}d.prototype={show:function(){var c=this.getTitle();if(c&&this.enabled){var d=this.tip();d.find(".tipsy-inner")[this.options.html?"html":"text"](c);d[0].className="tipsy";d.remove().css({top:0,left:0,visibility:"hidden",display:"block"}).prependTo(document.body);var e=a.extend({},this.$element.offset(),{width:this.$element[0].offsetWidth,height:this.$element[0].offsetHeight});var f=d[0].offsetWidth,g=d[0].offsetHeight,h=b(this.options.gravity,this.$element[0]);var i;switch(h.charAt(0)){case"n":i={top:e.top+e.height+this.options.offset,left:e.left+e.width/2-f/2};break;case"s":i={top:e.top-g-this.options.offset,left:e.left+e.width/2-f/2};break;case"e":i={top:e.top+e.height/2-g/2,left:e.left-f-this.options.offset};break;case"w":i={top:e.top+e.height/2-g/2,left:e.left+e.width+this.options.offset};break}if(h.length==2){if(h.charAt(1)=="w"){i.left=e.left+e.width/2-15}else{i.left=e.left+e.width/2-f+15}}d.css(i).addClass("tipsy-"+h);d.find(".tipsy-arrow")[0].className="tipsy-arrow tipsy-arrow-"+h.charAt(0);if(this.options.className){d.addClass(b(this.options.className,this.$element[0]))}if(this.options.fade){d.stop().css({opacity:0,display:"block",visibility:"visible"}).animate({opacity:this.options.opacity})}else{d.css({visibility:"visible",opacity:this.options.opacity})}}},hide:function(){if(this.options.fade){this.tip().stop().fadeOut(function(){a(this).remove()})}else{this.tip().remove()}},fixTitle:function(){var a=this.$element;if(a.attr("title")||typeof a.attr("original-title")!="string"){a.attr("original-title",a.attr("title")||"").removeAttr("title")}},getTitle:function(){var a,b=this.$element,c=this.options;this.fixTitle();var a,c=this.options;if(typeof c.title=="string"){a=b.attr(c.title=="title"?"original-title":c.title)}else if(typeof c.title=="function"){a=c.title.call(b[0])}a=(""+a).replace(/(^\s*|\s*$)/,"");return a||c.fallback},tip:function(){if(!this.$tip){this.$tip=a('<div class="tipsy"></div>').html('<div class="tipsy-arrow"></div><div class="tipsy-inner"></div>');this.$tip.data("tipsy-pointee",this.$element[0])}return this.$tip},validate:function(){if(!this.$element[0].parentNode){this.hide();this.$element=null;this.options=null}},enable:function(){this.enabled=true},disable:function(){this.enabled=false},toggleEnabled:function(){this.enabled=!this.enabled}};a.fn.tipsy=function(b){function e(c){var e=a.data(c,"tipsy");if(!e){e=new d(c,a.fn.tipsy.elementOptions(c,b));a.data(c,"tipsy",e)}return e}function f(){var a=e(this);a.hoverState="in";if(b.delayIn==0){a.show()}else{a.fixTitle();setTimeout(function(){if(a.hoverState=="in")a.show()},b.delayIn)}}function g(){var a=e(this);a.hoverState="out";if(b.delayOut==0){a.hide()}else{setTimeout(function(){if(a.hoverState=="out")a.hide()},b.delayOut)}}if(b===true){return this.data("tipsy")}else if(typeof b=="string"){var c=this.data("tipsy");if(c)c[b]();return this}b=a.extend({},a.fn.tipsy.defaults,b);if(!b.live)this.each(function(){e(this)});if(b.trigger!="manual"){var h=b.live?"live":"bind",i=b.trigger=="hover"?"mouseenter":"focus",j=b.trigger=="hover"?"mouseleave":"blur";this[h](i,f)[h](j,g)}return this};a.fn.tipsy.defaults={className:null,delayIn:0,delayOut:0,fade:false,fallback:"",gravity:"n",html:false,live:false,offset:0,opacity:.8,title:"title",trigger:"hover"};a.fn.tipsy.revalidate=function(){a(".tipsy").each(function(){var b=a.data(this,"tipsy-pointee");if(!b||!c(b)){a(this).remove()}})};a.fn.tipsy.elementOptions=function(b,c){return a.metadata?a.extend({},c,a(b).metadata()):c};a.fn.tipsy.autoNS=function(){return a(this).offset().top>a(document).scrollTop()+a(window).height()/2?"s":"n"};a.fn.tipsy.autoWE=function(){return a(this).offset().left>a(document).scrollLeft()+a(window).width()/2?"e":"w"};a.fn.tipsy.autoBounds=function(b,c){return function(){var d={ns:c[0],ew:c.length>1?c[1]:false},e=a(document).scrollTop()+b,f=a(document).scrollLeft()+b,g=a(this);if(g.offset().top<e)d.ns="n";if(g.offset().left<f)d.ew="w";if(a(window).width()+a(document).scrollLeft()-g.offset().left<b)d.ew="e";if(a(window).height()+a(document).scrollTop()-g.offset().top<b)d.ns="s";return d.ns+(d.ew?d.ew:"")}}})(jQuery);


//ELASTIC IMAGE SLIDESHOW
(function(a,b,c){var d=b.event,e;d.special.smartresize={setup:function(){b(this).bind("resize",d.special.smartresize.handler)},teardown:function(){b(this).unbind("resize",d.special.smartresize.handler)},handler:function(a,b){var c=this,d=arguments;a.type="smartresize";if(e){clearTimeout(e)}e=setTimeout(function(){jQuery.event.handle.apply(c,d)},b==="execAsap"?0:100)}};b.fn.smartresize=function(a){return a?this.bind("smartresize",a):this.trigger("smartresize",["execAsap"])};b.Slideshow=function(a,c){this.$el=b(c);this.$list=this.$el.find("ul.ei-slider-large");this.$imgItems=this.$list.children("li");this.itemsCount=this.$imgItems.length;this.$images=this.$imgItems.find("img:first");this.$sliderthumbs=this.$el.find("ul.ei-slider-thumbs").hide();this.$sliderElems=this.$sliderthumbs.children("li");this.$sliderElem=this.$sliderthumbs.children("li.ei-slider-element");this.$thumbs=this.$sliderElems.not(".ei-slider-element");this._init(a)};b.Slideshow.defaults={animation:"sides",autoplay:false,slideshow_interval:3e3,speed:800,easing:"",titlesFactor:.6,titlespeed:800,titleeasing:"",thumbMaxWidth:150};b.Slideshow.prototype={_init:function(a){this.options=b.extend(true,{},b.Slideshow.defaults,a);this.$imgItems.css("opacity",0);this.$imgItems.find("div.ei-title > *").css("opacity",0);this.current=0;var c=this;this.$loading=b('<div class="ei-slider-loading">Loading</div>').prependTo(c.$el);b.when(this._preloadImages()).done(function(){c.$loading.hide();c._setImagesSize();c._initThumbs();c.$imgItems.eq(c.current).css({opacity:1,"z-index":10}).show().find("div.ei-title > *").css("opacity",1);if(c.options.autoplay){c._startSlideshow()}c._initEvents()})},_preloadImages:function(){var a=this,c=0;return b.Deferred(function(d){a.$images.each(function(e){b("<img/>").load(function(){if(++c===a.itemsCount){d.resolve()}}).attr("src",b(this).attr("src"))})}).promise()},_setImagesSize:function(){this.elWidth=this.$el.width();var a=this;this.$images.each(function(c){var d=b(this);imgDim=a._getImageDim(d.attr("src"));d.css({width:imgDim.width,height:imgDim.height,marginLeft:imgDim.left,marginTop:imgDim.top})})},_getImageDim:function(a){var b=new Image;b.src=a;var c=this.elWidth,d=this.$el.height(),e=d/c,f=b.width,g=b.height,h=g/f,i,j,k,l;if(e>h){j=d;i=d/h}else{j=c*h;i=c}return{width:i,height:j,left:(c-i)/2,top:(d-j)/2}},_initThumbs:function(){this.$sliderElems.css({"max-width":this.options.thumbMaxWidth+"%",width:100/this.itemsCount+"%"});this.$sliderthumbs.css("max-width",this.options.thumbMaxWidth*this.itemsCount+"%").show()},_startSlideshow:function(){var a=this;this.slideshow=setTimeout(function(){var b;a.current===a.itemsCount-1?b=0:b=a.current+1;a._slideTo(b);if(a.options.autoplay){a._startSlideshow()}},this.options.slideshow_interval)},_slideTo:function(a){if(a===this.current||this.isAnimating)return false;this.isAnimating=true;var c=this.$imgItems.eq(this.current),d=this.$imgItems.eq(a),e=this,f={zIndex:10},g={opacity:1};if(this.options.animation==="sides"){f.left=a>this.current?-1*this.elWidth:this.elWidth;g.left=0}d.find("div.ei-title > h2").css("margin-right",50+"px").stop().delay(this.options.speed*this.options.titlesFactor).animate({marginRight:0+"px",opacity:1},this.options.titlespeed,this.options.titleeasing).end().find("div.ei-title > h3").css("margin-right",-50+"px").stop().delay(this.options.speed*this.options.titlesFactor).animate({marginRight:0+"px",opacity:1},this.options.titlespeed,this.options.titleeasing);b.when(c.css("z-index",1).find("div.ei-title > *").stop().fadeOut(this.options.speed/2,function(){b(this).show().css("opacity",0)}),d.css(f).stop().animate(g,this.options.speed,this.options.easing),this.$sliderElem.stop().animate({left:this.$thumbs.eq(a).position().left},this.options.speed)).done(function(){c.css("opacity",0).find("div.ei-title > *").css("opacity",0);e.current=a;e.isAnimating=false})},_initEvents:function(){var c=this;b(a).on("smartresize.eislideshow",function(a){c._setImagesSize();c.$sliderElem.css("left",c.$thumbs.eq(c.current).position().left)});this.$thumbs.on("click.eislideshow",function(a){if(c.options.autoplay){clearTimeout(c.slideshow);c.options.autoplay=false}var d=b(this),e=d.index()-1;c._slideTo(e);return false})}};var f=function(a){if(this.console){console.error(a)}};b.fn.eislideshow=function(a){if(typeof a==="string"){var c=Array.prototype.slice.call(arguments,1);this.each(function(){var d=b.data(this,"eislideshow");if(!d){f("cannot call methods on eislideshow prior to initialization; "+"attempted to call method '"+a+"'");return}if(!b.isFunction(d[a])||a.charAt(0)==="_"){f("no such method '"+a+"' for eislideshow instance");return}d[a].apply(d,c)})}else{this.each(function(){var c=b.data(this,"eislideshow");if(!c){b.data(this,"eislideshow",new b.Slideshow(a,this))}})}return this}})(window,jQuery);