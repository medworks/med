<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");	
	include_once("../classes/login.php");
	$login = Login::getLogin();
    if (!$login->IsLogged())
	 {
		header("Location: ../index.php");
		die(); // solve a security bug
	 }
	$db = Database::GetDatabase();
	if ($_POST['mark']=="editabout")
	{
		SetSettingValue("About_System",$_POST["about"]);		
		header('location:?item=settingmgr&act=do');
	}
	if ($_GET['act']=="do")
   {
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت اخبار</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=settingmgr&act=about">متن درباره ما
					<span class="add-user"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=settingmgr&act=seo" >اطلاعات سئو 
					<span class="edit-user"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=settingmgr&act=emails" >ایمیل ها 
					<span class="edit-user"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=settingmgr&act=grid" >جداول اطلاعات 
					<span class="edit-user"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}
else
	if ($_GET['act']=="about")
	{
	$About_System = GetSettingValue('About_System',0);
	$html=<<<ht
	<form name="frmworksmgr" id= "frmabout" action="" method="post" >
		<p>
			 <label for="about">درباره ما </label>
			 <span>*</span>
		   </p>
		   <textarea cols="50" rows="10" name="about" class="validate[required] detail" id="detail">{$About_System}</textarea>
		   <p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editabout' />
		     <input type="reset" value="پاک کردن" class="reset" /> 	 	 
		   </p>
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
ht;
	}
	
return $html;
?>