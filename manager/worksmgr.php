<?php
    include_once("./config.php");
    include_once("./classes/database.php");
	include_once("./classes/messages.php");
	include_once("./classes/session.php");	
	include_once("./classes/functions.php");
	//$sess = Session::getSesstion();
    if ($_POST["mark"]=="saveworks")
	{
		$db = Database::getDatabase();
		$msg = Message::getMessage();
		$msgs = "";	
    
		if((empty($_FILES["pic"])) && ($_FILES['pic']['error'] != 0))
		{    
			//$msgs = $msg->ShowError("لطفا فایل عکس را انتخاب کنید");
			header('location:?item=worksmgr&act=do&msg=4');
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
			$newname_os = OS_ROOT.'/workspics/'.$newfilename.$ext;
			$newname_site = SITE_ROOT.'/workspics/'.$newfilename.$ext;
			if (!move_uploaded_file($_FILES["pic"]["tmp_name"],$newname_os))
			{     
				//$msgs = $msg->ShowError("عمليات آپلود با مشكل مواجه شد");
				header('location:?item=worksmgr&act=do&msg=3');
				exit();
			}	 
		    else
			{			
  				$fields = array("`subject`","`image`","`body`","`sdate`","`fdate`");
  				$values = array("'{$_POST[subject]}'","'{$newname_site}'","'{$_POST[detail]}'","'{$_POST[sdate]}'","'{$_POST[fdate]}'");	
  				if (!$db->insertquery('works',$fields,$values)) 
  				{
  					//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
					header('location:?item=worksmgr&act=do&msg=2');
					exit();
  				} 	
  				else 
  				{  										
  					//$msgs = $msg->ShowSuccess("ثبت اطلاعات با موفقیت انجام شد");
					header('location:?item=worksmgr&act=do&msg=1');					
					exit();
					
  				}  				 
			}
		}	
	}

$msgs = getMessage($_GET['msg']);
$html=<<<cd
<script type='text/javascript'>
	$(document).ready(function(){		
		$("#submit").click(function(){		    
			//alert("test");
			//$("#message").html('saeid hatami');
		//window.location.href="?item=worksmgr&act=do";
			//$("#message").fadeOut(5000,function (){
              //    window.location.href="?item=worksmgr&act=do"});
			 
          });
		  
//	$("#frmworksmgr").validationEngine();	  
    });	   
</script>	     
  <div class="title">
      <ul>
        <li><a href="#">پیشخوان</a></li>
        <li><a href="#">مدیریت کارها</a></li>
      </ul>
      <div class="badboy"></div>
  </div>  
  <div class="content">
    <form name="frmworksmgr" id= "frmworksmgr" class="worksmgr" action="" method="post" enctype="multipart/form-data" >
	  <div class="mes" id="message">{$msgs}</div>
       <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
       <p>
         <label for="subject">عنوان </label>
         <span>*</span>
       </p>  	 
       <input type="text" name="subject" class="validate[required] subject" id="subject" />
       <p>
    	   <label for="pic">عکس </label>
         <span>*</span>
       </p>
       <input type="file" name="pic" class="pic" id="pic" />
       <p>
  	     <label for="detail">توضیحات </label>
         <span>*</span>
       </p>
       <textarea cols="50" rows="10" name="detail" class="detail" id="detail"> </textarea>
       <p>
  	    <label for="sdate">تاریخ شروع </label>
        <span>*</span><br /><br />
        <input type="text" name="sdate" class="validate[required] sdate" id="date_input_1" />
        <img src="./themes/default/images/admin/cal.png" id="date_btn_1" alt="cal-pic">
         <script type="text/javascript">
          Calendar.setup({
            inputField  : "date_input_1",   // id of the input field
            button      : "date_btn_1",   // trigger for the calendar (button ID)
                ifFormat    : "%A, %e %B %Y",       // format of the input field
                showsTime   : true,
                dateType  : 'jalali',
                showOthers  : true,
                langNumbers : true,
                weekNumbers : true
          });
        </script>
       </p>
       <p>
  	     <label for="fdate">تاریخ پایان </label>
         <span>*</span><br /><br />
         <input type="text" name="fdate" class="validate[required] fdate" id="date_input_2" />
         <img src="./themes/default/images/admin/cal.png" id="date_btn_2" alt="cal-pic">
         <script type="text/javascript">
          Calendar.setup({
            inputField  : "date_input_2",   // id of the input field
            button      : "date_btn_2",   // trigger for the calendar (button ID)
                ifFormat    : "%A, %e %B %Y",       // format of the input field
                showsTime   : true,
                dateType  : 'jalali',
                showOthers  : true,
                langNumbers : true,
                weekNumbers : true,
          });
        </script>
       </p>
       <p>
      	 <input type="submit" value="ذخیره" id="submit" class="submit" />	 
      	 <input type="hidden" id="mark" class="mark" name="mark" value="saveworks" />
      	 <input type="reset" value="پاک کردن" class="reset" /> 	 	 
       </p>
    </form>
    <div class="badboy"></div>
  </div>
  
<!-- TinyMCE -->
<script type="text/javascript" src="./lib/js/tiny/tiny_mce.js"></script>
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