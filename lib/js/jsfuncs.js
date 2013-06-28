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
// **********************Image preview**********************************
/*
function showPreview(ele){
    $('form #img').attr({
                        'src': '',
                        'alt': 'Image',
                        'width':'0',
                        'height': '0'
                    });
    $('form .upload-file .filename').html('عکس مورد نظر را انتخاب نمایید');

    var size= Math.round(ele.files[0].size/1024);
    var ext = $('form #pic').val().split('.').pop().toLowerCase();
    var prevsize="1024";
    var name= $('form #pic').val().replace(/C:\\fakepath\\/i, '');

    if(ext=='jpeg' || ext=='jpg' || ext=='png' || ext=='bmp' || ext=='gif'){
        if (size<=prevsize){
           $('form #img').fadeIn().css('display','block').attr({
                'src': ele.value,
                'alt': 'Image',
                'width': '200px',
                'height': '100px'
            }); // for IE
            if (ele.files && ele.files[0]){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('form #img').fadeIn().attr({
                        'src': e.target.result,
                        'alt': 'Image',
                        'width':'200px',
                        'height': '100px'
                    });
                }
                reader.readAsDataURL(ele.files[0]);
                $('form .upload-file .filename').html(name);
            }
        }else{
            alert("حجم عکس انتخابی شما "+size+"KB می باشد. حجم عکس باید از "+prevsize+"KB کمتر باشد");
            $('form #pic').val("");
            $('form #img').attr({
                        'src': '',
                        'alt': 'Image',
                        'width':'0',
                        'height': '0'
                    });
            $('form .upload-file .filename').html('عکس مورد نظر را انتخاب نمایید');
        }
    }else{
        alert("عکس شما باید با پسوندهای معتبر باشد: JPEG , JPG , PNG , BMP , GIF");
        $('form #pic').val("");
        $('form #img').attr({
                        'src': '',
                        'alt': 'Image',
                        'width':'0',
                        'height': '0'
                    });
        $('form .upload-file .filename').html('عکس مورد نظر را انتخاب نمایید');
    }
}
*/
// **********************files browser****************************
function getImgSize(imgSrc){
    var newImg = new Image();
    newImg.src = imgSrc;
    var height = newImg.height;
    var width = newImg.width;
    p = $(newImg).load(function(){
        return {width: newImg.width, height: newImg.height};
    });
    return (p[0]['height']+" * "+p[0]['width']);
}

$(window).load(function(){
    $("a#filesbrowserbtn").click(function(){
        $('#filesbrowser').css('display','block');
        $('#filesbrowser').load('filebrowser.php?item=newsmgr',function(){
            $('.picmanager .files li a').click(function(){
                var srcimg= $(this).children('img').attr('src');
                $('img#previmage').attr('src',srcimg);
                
                var filename= $(this).parent().parent().children('h2').children('span.filename').text();
                $('#namepreview').html(filename);

               var size= getImgSize(srcimg);
               $('#sizepreview').html(size);

               var ext = $(this).children('img').attr('src').split('.').pop().toLowerCase();
               $('#typepreview').html(ext);

               $('#select').click(function(){
                    $('#selectpic').val(srcimg);
               });
            });
            $('#exit').click(function(){
               $('#filesbrowser').empty();
               $('#filesbrowser').css('display','none');
            }); 
        });
    })
});