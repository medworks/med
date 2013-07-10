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