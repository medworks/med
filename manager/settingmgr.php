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
	else
	if ($_POST['mark']=="editseo")
	{
		SetSettingValue("Site_Title",$_POST["title"]);
		SetSettingValue("Site_KeyWords",$_POST["keywords"]);
		SetSettingValue("Site_Describtion",$_POST["describe"]);
		header('location:?item=settingmgr&act=do');	
	}
	else
	if ($_POST['mark']=="editemail")
	{
		SetSettingValue("Admin_Email",$_POST["admin_email"]);
		SetSettingValue("News_Email",$_POST["news_email"]);
		SetSettingValue("Contact_Email",$_POST["contact_email"]);
		header('location:?item=settingmgr&act=do');		
	}
	else
	if ($_POST['mark']=="editgrid")
	{
		SetSettingValue("Max_Page_Number",$_POST["Max_Page_Number"]);
		SetSettingValue("Max_Post_Number",$_POST["Max_Post_Number"]);		
		header('location:?item=settingmgr&act=do');		
	}
	if ($_GET['act']=="do")
   {
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت تنظیمات</span></li>
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
	<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
	        <li><a href="?item=settingmgr&act=do">مدیریت تنظیمات</a></li>
			<li><span>درباره ما</span></li>
	      </ul>
	      <div class="badboy"></div>
	</div>
	<form name="frmabout" id= "frmabout" action="" method="post" >
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
	else
	if ($_GET['act']=="seo")
	{
		$Site_Title = GetSettingValue('Site_Title',0);
		$Site_KeyWords = GetSettingValue('Site_KeyWords',0);
		$Site_Describtion = GetSettingValue('Site_Describtion',0);
		$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
	        <li><a href="?item=settingmgr&act=do">مدیریت تنظیمات</a></li>
			<li><span>اطلاعات سئو</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
			<form name="frmseo" id= "frmseo" action="" method="post" >
				<p>
					<label for="subject">عنوان سایت </label>
					<span>*</span>
				</p>    
				<input type="text" name="title" class="validate[required] subject" id="title" value='{$Site_Title}'/>
				<p>
					<label for="subject">کلمات کلیدی </label>
					<span>*</span>
				</p>    
				<input type="text" name="keywords" class="validate[required] subject" id="keywords" value='{$Site_KeyWords}'/>
								<p>
					<label for="subject">توضیحات سایت </label>
					<span>*</span>
				</p>    
				<input type="text" name="describe" class="validate[required] subject" id="describe" value='{$Site_Describtion}'/>
				<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editseo' />
		     <input type="reset" value="پاک کردن" class="reset" /> 	 	 
		   </p>
			</form>
ht;
	}
	else
	if ($_GET['act']=="emails")
	{
		$Admin_Email = GetSettingValue('Admin_Email',0);
		$News_Email = GetSettingValue('News_Email',0);
		$Contact_Email = GetSettingValue('Contact_Email',0);
		$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
	        <li><a href="?item=settingmgr&act=do">مدیریت تنظیمات</a></li>
			<li><span>ایمیل ها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
			<form name="frmemails" id= "frmemails" action="" method="post" >
				<p>
					<label for="subject">ایمیل ادمین</label>
					<span>*</span>
				</p>    
				<input type="text" name="admin_email" class="validate[required] subject" id="admin_email" value='{$Admin_Email}'/>
				<p>
					<label for="subject">ایمیل خبرنامه </label>
					<span>*</span>
				</p>    
				<input type="text" name="news_email" class="validate[required] subject" id="news_email" value='{$News_Email}'/>
								<p>
					<label for="subject"> ایمیل تماس با ما</label>
					<span>*</span>
				</p>    
				<input type="text" name="contact_email" class="validate[required] subject" id="contact_email" value='{$Contact_Email}'/>
				<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editemail' />
		     <input type="reset" value="پاک کردن" class="reset" /> 	 	 
		   </p>
			</form>
ht;
	}
	else
	if ($_GET['act']=="grid")
	{
		$Max_Page_Number = GetSettingValue('Max_Page_Number',0);
		$Max_Post_Number = GetSettingValue('Max_Post_Number',0);		
		$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
	        <li><a href="?item=settingmgr&act=do">مدیریت تنظیمات</a></li>
			<li><span>جداول اطلاعات</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
			<form name="frmemails" id= "frmemails" action="" method="post" >
				<p>
					<label for="subject">تعداد صفحه در صفحه بندی</label>
					<span>*</span>
				</p>    
				<input type="text" name="Max_Page_Number" class="validate[required] subject" id="Max_Page_Number" value='{$Max_Page_Number}'/>
				<p>
					<label for="subject">تعداد مطلب در صفحه اول</label>
					<span>*</span>
				</p>    
				<input type="text" name="Max_Post_Number" class="validate[required] subject" id="title" value='{$Max_Post_Number}'/>				
				<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editgrid' />
		     <input type="reset" value="پاک کردن" class="reset" /> 	 	 
		   </p>
			</form>
ht;
	}	
	
return $html;
?>