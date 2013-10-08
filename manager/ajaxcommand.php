<?php
	include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	include_once("../lib/persiandate.php");	
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	$db = Database::GetDatabase();
 if (isset($_GET["sec"]))
{
	$category = $db->SelectAll("category","*","secid={$_GET[sec]}","id ASC");
	$cbcategory = DbSelectOptionTag("cbcat",$category,"catname",null,null,"select validate[required]");
	echo $cbcategory;
}

if ($_GET["news"]=="reg")
{
	$msg="";
	$fields = array("`email`","`tel`","`name`");		
	$values = array("'{$_POST[email]}'","'{$_POST[tel]}'","'{$_POST[name]}'");
	
	$name=$_POST['name'];
	$email=$_POST['email'];

	if (strlen($name)>=1 && checkEmail($email)){
		if ($db->InsertQuery('usersnews',$fields,$values)){
	    	$msg="OK";}
	}else{
		$msg="<div class='notification_error rtl'>ثبت مشخصات شما با مشکل مواجه شد! لطفا فیلدها را بررسی نمایید و مجددا تلاش کنید.</div>";
	}
	echo $msg;
}

if ($_GET["cmd"]=="file")
{
	$pics = "";
	//echo "item is :",$_GET["item"];
    $dir = "../".$_GET["item"];
	$handle=opendir($dir);
    while ($file = readdir($handle))
    {        
         if (!preg_match("/^[.]/",$file,$out, PREG_OFFSET_CAPTURE))
         {             
			 if(is_file("{$dir}/".$file))
			 {                              
					  $dirname = "{$dir}/".basename($file);
					  $filename = basename($file);
					  $exe = substr($filename, strrpos($filename, '.') + 1);
					  $name = substr($filename, 0, strrpos($filename, '.'));
					  $allowedExts = array('jpg','jpeg','png','bmp','gif');

					if(in_array($exe, $allowedExts)){
                      $pics.=<<<cd
					    <li>
							<div class="pic">
								<a class="select" title="انتخاب عکس {$name}">
									<img src="{$dirname}" alt="{$name}" />
									<div class="overlay"></div>
								</a>
							</div>
							<h2><!-- <span class="highlight">نام فایل: </span> --><span class="filename">{$name}</span></h2>
						</li>	   
cd;
					}
			  }
        }
    }
	closedir($handle);
$html.=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){
			$('.cat-tabs-wrap a.select').click(function(){
	                var srcimg= $(this).children('img').attr('src');
	                $('img#previmage').attr('src',srcimg);
	                
	                var filename= $(this).parent().parent().children('h2').children('span.filename').text();
	                $('#namepreview').html(filename);

	               var size= getImgSize(srcimg);
	               $('#sizepreview').html(size);

	               var ext = $(this).children('img').attr('src').split('.').pop().toLowerCase();
	               $('#typepreview').html(ext);

	               $('#select').click(function(){
	                    var value= srcimg;
	                    $('#selectpic').val(value);
	                    value= value.split('/').reverse()[0];
	                    $('#showadd').val(value);
	               });
	            });
		});
	</script>
cd;
	echo $pics.$html;
	 
}
?>