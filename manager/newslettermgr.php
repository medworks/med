<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	if ($_GET['item']!="newslettermgr")	exit();
	$db = Database::GetDatabase();
	$msg = Message::GetMessage();
	if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت خبرنامه</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=newslettermgr&act=new">خبرنامه جدید
					<span class="add-user"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=newslettermgr&act=mgr" >حذف/ویرایش خبرنامه
					<span class="edit-user"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=newslettermgr&act=user" >مدیریت اعضا
					<span class="edit-user"></span>
				</a>
			  </li>			 
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}else
if ($_GET['act']=="new" or $_GET['act']=="edit")
{
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
<script type='text/javascript'>
	$(document).ready(function(){		
	$("#frmnewslettermgr").validationEngine();		 
    });	   
</script>	     
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
        <li><a href="#">مدیریت خبرنامه</a></li>
      </ul>
      <div class="badboy"></div>
  </div>  
  <div class="content">
    <form name="frmnewslettermgr" id= "frmnewslettermgr" class="usermgr" action="" method="post">
	  <div class="mes" id="message">{$msgs}</div>
       <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
       <p>
         <label for="subject">موضوع</label>
         <span>*</span>
       </p>  	 
       <input type="text" name="subject" class="validate[required] name" id="subject" value="{$row[subject]}" />
	   <p>
         <label for="body">متن خبر</label>
         <span>*</span>
       </p>  	 
       <textarea cols="5" rows="5" name="detail" class="detail" id="detail" > {$row[body]}</textarea>  
         <label for="email">ایمیل گیرنده(گان)</label>
         <span>*</span>
       </p>  	 
       <input type="text" name="email" class="validate[required,custom[email]] email ltr" id="email" value="{$row[email]}"/>
	   <label for="body">ارسال به کلیه کاربران</label>       
	   <input type="checkbox" name="recivers" value="all"> 
       {$editorinsert}
      	<input type="reset" value="پاک کردن" class="reset" /> 	 	 
       </p>
    </form>
    <div class="badboy"></div>
  </div>   
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
else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 			   
		$rows = $db->SelectAll(
				"users",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"id ASC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "usermgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=usermgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"users",
				"*",
				null,
				"id ASC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews" )?$db->CountAll("users"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		                       
					$rows[$i]["image"] ="<img src='{$rows[$i][image]}' alt='{$rows[$i][subject]}' width='40px' height='40px' />";				
					if ($i % 2==0)
					{
						$rowsClass[] = "datagridevenrow";
					}
					else
					{
						$rowsClass[] = "datagridoddrow";
					}				
				$rows[$i]["edit"] = "<a href='?item=usermgr&act=edit&uid={$rows[$i]["id"]}' class='edit-field'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این فعالیت اطمینان دارید؟',
				'?item=usermgr&act=del&pageNo={$_GET[pageNo]}&uid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
               }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode.= DataGrid(array( 
							"name"=>"نام",
							"family"=>"نام خانوادگی",
							"image"=>"عکس",
							"email"=>"ایمیل",
							"username"=>"نام کاربری",
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=usermgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("name"=>"نام",
              "family"=>"نام خانوادگی",
			  "username"=>"نام کاربری");              
$combobox = SelectOptionTag("cbsearch",$list,"name");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});		
	});
</script>	   
					<div class="title">
				      <ul>
				        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
					    <li><span> مدیریت آپلود</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=usermgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}							
									<input type="text" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  />
									<a href="?item=usermgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=usermgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhnews" /> 
								{$msgs}
								{$gridcode} 
							</form>
					   </center>
					</div>

edit;
$html = $code;
}	
	
return $html;
?>