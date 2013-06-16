TINY={};
function T$(id){return document.getElementById(id)}

TINY.ajax=function(){
    return{
        call:function(u,d,f,p){
            var x=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject('Microsoft.XMLHTTP');
            x.onreadystatechange=function(){
                if(x.readyState==4&&x.status==200){
                    if(d){
                        var t=T$(d);
                        t.innerHTML=x.responseText
                    }
                //    if(f){
                 //       var c=new Function(f); c()
                  //  }
                }
                else if (x.readyState==0 || x.readyState==1 || x.readyState==2 || x.readyState==3) {
                       var t=T$(d);
                        t.innerHTML=f;
                }
		
            };
            if(p){
                x.open('POST',u,true);
                x.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                x.send(p)
            }else{
                x.open('GET',u,true);
                x.send(null)
            }
        }
    };
}();

//TINY.ajax.call('get.php?id=32', 'content', 'display("red")'); // GET
//TINY.ajax.call('post.php', 'content', 'display("green")', 'id=32'); // POST
function NewWin(url,name)
{
    window.open(url, name,'status=yes,scrollbars=yes,toolbar=yes,resizable=1,menubar=no,location=no,width=570px,height=500px');
}

function DelMsg(id,msg,link)
{
  if(confirm(msg))
  {
	setTimeout('document.location.href="'+link+id+'"',1 )
  }
}
function GoUrl(url)
{
	setTimeout('document.location.href="'+url+'"',1 )

}
function ShowTab(tabNo,idxOfEndTab)
{
    //alert("test");
    for(var i=1;i<=idxOfEndTab;i++)
    {
        document.getElementById("tab_"+i).style.display = 'none';
    }
        document.getElementById("tab_"+tabNo).style.display = 'block';
}
function DisEna(id,act)
{
    var obj = document.getElementById(id);
    obj.disabled = act;
}

/*****************active menu**********************/ 
$(document).ready(function(){
    $('#mainnav a').each(function(index) {
        if(this.href.trim() == window.location){
            $(this).parent().addClass("active");
            $(this).parent().append('<span class="current-arrow"></span>');
        }
    });
});
// *****************hide all validate message***********************
$(document).ready(function(){
    $('.reset').click(function(){
        $('.formError').validationEngine('hideAll');
    })
});