<?php 
    include_once("./config.php");
    include_once("./classes/database.php");	
	include_once("./classes/functions.php");
	if ($_POST["mark"]=="savenews")
    {
       $db = Database::getDatabase();
	   if((!empty($_FILES["pic"])) && ($_FILES['pic']['error'] != 0))
		{ 
			//$msgs = $msg->ShowError("لطفا فایل عکس را انتخاب کنید");
			header('location:?item=newsmgr&act=do&msg=4');
			exit();
		}
		else
		{
			$filename =strtolower(basename($_FILES['pic']['name']));
			$ext = substr($filename, strrpos($filename, '.') + 1);
			//$newfilename= md5(rand() * time());
			$newfilename = $_POST['subject'];	 
			$ext=".".$ext;          
			//$newfilename = $_FILES['pic']['name'];
			$newname_os = OS_ROOT.'/newspics/'.$newfilename.$ext;
			$newname_site = SITE_ROOT.'/newspics/'.$newfilename.$ext;
			if (!move_uploaded_file($_FILES["pic"]["tmp_name"],$newname_os))
			{       
				//$msgs = $msg->ShowError("عمليات آپلود با مشكل مواجه شد");
				header('location:?item=newsmgr&act=do&msg=3');
				exit();
			}
			else
			{
				$fields = array("`subject`","`image`","`body`","`ndate`","`userid`","`resource`");
				$values = array("'{$_POST[subject]}'","'{$newname_site}'","'{$_POST[detail]}'","'{$_POST[ndate]}'","'1'","'{$_POST[res]}'");		
				if (!$db->insertquery('news',$fields,$values)) 
  				{
  					//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
					header('location:?item=newsmgr&act=do&msg=2');
					exit();
  				} 	
  				else 
  				{  										
  					//$msgs = $msg->ShowSuccess("ثبت اطلاعات با موفقیت انجام شد");
					header('location:?item=newsmgr&act=do&msg=1');					
  				}  				 
			}		     			
		}			
	}
$msgs = getMessage($_GET['msg']);	
$html=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){	   
			$("#frmnewsmgr").validationEngine();
       });
	</script>	   
       <div class="title">
      <ul>
        <li><a href="#">پیشخوان</a></li>
        <li><a href="#">مدیریت اخبار</a></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class='content'>
	<form name="frmnewsmgr" class="" action="" method="post" enctype="multipart/form-data" >  
       <label>
         عنوان:   	 
         <input type="text" name="validate[required] subject" class='subject' />
  	   </label>
       <span class='badboy'></span>  
  	   <label>
         عکس:
         <input type="file" name="pic" class='pic' />
  	   </label>
       <span class='badboy'></span>  
  	   <label>
         توضیحات:
         <textarea cols="50" rows="10" name="detail" class='detail'> </textarea>
  	   </label>
       <span class='badboy'></span> 
  	   <label>
          تاریخ :   	 
         <input type="text" name="ndate" class='validate[required] ndate' />
  	   </label>       
	   <span class='badboy'></span> 
  	   <label>
          منبع خبر :   	 
         <input type="text" name="res" class='validate[required]' />
  	   </label>  
      <div class="left" >{$msgs}</div>	   
       <span class='badboy'></span>  
    	 <input type="submit" id="submit" value="ذخیره" class='submit' />	 
    	 <input type="hidden" name="mark" value="savenews" />
    	 <input type="reset" value="پاک کردن" class='reset' /> 	 	     
	</form>
	<div class='badboy'></div>	
  </div>  

<!-- TinyMCE -->
<script type="text/javascript" src="lib/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		skin : "o2k7",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "tiny_mce/css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "tiny_mce/lists/template_list.js",
		external_link_list_url : "tiny_mce/lists/link_list.js",
		external_image_list_url : "tiny_mce/lists/image_list.js",
		media_external_list_url : "tiny_mce/lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->  
   
cd;
return $html;

?>
