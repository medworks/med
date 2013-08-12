<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	$login = Login::getLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	if ($_GET['item']!="blockmgr")	exit();
	$db = Database::GetDatabase();
	$msg = Message::GetMessage();
	if ($_GET['act']=="do")
	{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت بلاک ها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=blockmgr&act=new"> ایجاد بلاک
					<span class="add-block"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=blockmgr&act=mgr" >حذف/ویرایش بلاک
					<span class="edit-block"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
} else
if ($_GET['act']=="new" or $_GET['act']=="edit")
{
$msgs = GetMessage($_GET['msg']);	
$pos = array("right"=>"راست",
              "left"=>"چپ",
			  "top"=>"بالا",
			  "bottom"=>"پایین");
$pos = SelectOptionTag("cbpos",$pos,"right");
$auth = array("all"=>"کلیه کاربران",
              "admin"=>"کاربران مدیر ",
			  "user"=>"کاربران عضو");
$auth = SelectOptionTag("cbauth",$auth,"all");

$type = array("normal"=>"عادی",
              "circular"=>"چرخشی");
$type = SelectOptionTag("cbtype",$type,"normal");
$html=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){	   
			$("#frmnewsmgr").validationEngine();			
    });
	</script>	   
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	    <li><span>مدیریت اخبار</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmblocks" id="frmblocks" class="" action="" method="post" >
     <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
	 <div class="badboy"></div>
      <p>
         <label for="subject">عنوان </label>
         <span>*</span>
      </p>    
      <input type="text" name="subject" class="validate[required] subject" id="subject" value='{$row[subject]}'/> 
	  <p>
         <label for="subject">انتساب به پلاگین</label>
         <span>*</span>
      </p>
	  <p>
         <label for="cbpos">موقعیت مکانی</label>
         <span>*</span>
      </p> 
       {$pos}	  
      <p>
         <label for="order">ترتیب مکانی</label>
         <span>*</span>
      </p>    
      <input type="text" name="order" class="validate[required] subject" id="order" value='{$row[subject]}'/> 
      <p>
         <label for="cbauth">نمایش برای</label>
         <span>*</span>
      </p>
	  {$auth}
      <p>
         <label for="cbtype">نوع محتوا</label>
         <span>*</span>
      </p>    
      {$type}
	  <p>
         <label for="content">محتوا </label>
         <span>*</span>
      </p>   
	  <textarea cols="50" rows="10" name="content" class="detail" id="content" > </textarea>
	</form> 

<!-- TinyMCE -->
	<script type="text/javascript" src="../lib/js/tiny/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			// General options
			mode : "textareas",
			theme : "advanced",
			skin : "o2k7",
			plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
			init_instance_callback : "initialiseInstance",

			// Theme options
			theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen,|,table",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "right",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "../lib/js/tiny/tiny_mce/css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "../lib/js/tiny/tiny_mce/lists/template_list.js",
			external_link_list_url : "../lib/js/tiny/tiny_mce/lists/link_list.js",
			external_image_list_url : "../lib/js/tiny/tiny_mce/lists/image_list.js",
			media_external_list_url : "../lib/js/tiny/tiny_mce/lists/media_list.js",

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

		function initialiseInstance(editor){
			$('#submit').click(function(event){
				if(editor.getContent()==""){
					$('#detail_tbl').validationEngine('showPrompt', '* لطفا فیلد توضیحات را تکمیل نمایید', 'red', 'topRight');
				}else{
					$('#detail_tbl').validationEngine('hide');
				}
			});
		}
	</script>
	<!-- /TinyMCE -->   	
	
cd;
}
return $html;
?>