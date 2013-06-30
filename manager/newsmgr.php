<?php 
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	include_once("../lib/persiandate.php");	
	$login = Login::getLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	$db = Database::GetDatabase();
	$sess = Session::GetSesstion();	
	$userid = $sess->Get("userid");
	$overall_error = false;
	if ($_GET['item']!="newsmgr")	exit();	   
	if (isset($_POST["mark"]) and $_POST["mark"]!="srhnews")
	{
	   date_default_timezone_set('Asia/Tehran');
	   list($hour,$minute,$second) = explode(':', Date('H:i:s'));
	   list($year,$month,$day) = explode("-", trim($_POST["ndate"]));		
	   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);		
	   $ndatetime = Date("Y-m-d H:i:s",mktime($hour, $minute, $second, $gmonth, $gday, $gyear));		
				  
	   if(empty($_POST["selectpic"]))
	   { 
			//$msgs = $msg->ShowError("لط??ا ??ایل عکس را انتخاب کنید");
			//header('location:?item=newsmgr&act=new&msg=4');
			$_GET["item"] = "newsmgr";
			$_GET["act"] = "new";
			$_GET["msg"] = 4;
			$overall_error = true;
			//exit();
		}
		else						
		if (empty($_POST['detail']))
		{
		   //header('location:?item=newsmgr&act=new&msg=5');
			$_GET["item"] = "newsmgr";
			$_GET["act"] = "new";
			$_GET["msg"] = 5;
		   $overall_error = true;
		}			
		
	}	
	if (!$overall_error && $_POST["mark"]=="savenews")
	{	    
		$fields = array("`subject`","`image`","`body`","`ndate`","`userid`","`resource`");
		$_POST["detail"] = addslashes($_POST["detail"]);
		$values = array("'{$_POST[subject]}'","'{$_POST[selectpic]}'","'{$_POST[detail]}'","'{$ndatetime}'","'{$userid}'","'{$_POST[res]}'");		
		if (!$db->InsertQuery('news',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=newsmgr&act=new&msg=2');
			exit();
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو??قیت انجام شد");
			header('location:?item=newsmgr&act=new&msg=1');
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editnews")
	{		
	    $_POST["detail"] = addslashes($_POST["detail"]);
		$values = array("`subject`"=>"'{$_POST[subject]}'",
		                 "`image`"=>"'{$_POST[selectpic]}'",
						 "`body`"=>"'{$_POST[detail]}'",
						 "`ndate`"=>"'{$ndatetime}'",
						 "`userid`"=>"'{$userid}'",
						 "`resource`"=>"'{$_POST[res]}'");		
        $db->UpdateQuery("news",$values,array("id='{$_GET[nid]}'"));
		header('location:?item=newsmgr&act=mgr');
	}

	if ($overall_error)
	{
		$row = array("subject"=>$_POST['subject'],
		             "image"=>$_POST['image'],
					 "body"=>$_POST['detail'],
					 "ndate"=>$_POST['ndate'],
					 "userid"=>$userid,
					 "resource"=>$_POST['res']);
	}
	
	
if ($_GET['act']=="new")
{
	$editorinsert = "
		<p>
			<input type='submit' id='submit' value='ذخیره' class='submit' />	 
			<input type='hidden' name='mark' value='savenews' />";
}
if ($_GET['act']=="edit")
{
	$row=$db->Select("news","*","id='{$_GET["nid"]}'",NULL);
	$row['ndate'] = ToJalali($row["ndate"]);
	$editorinsert = "
	<p>
      	 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
      	 <input type='hidden' name='mark' value='editnews' />";
}
if ($_GET['act']=="del")
{
	$db->Delete("news"," id",$_GET["nid"]);
	if ($db->CountAll("news")%10==0) $_GET["pageNo"]-=1;		
	header("location:?item=newsmgr&act=mgr&pageNo={$_GET[pageNo]}");
}
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php">پیشخوان</a></li>
	        <li><span>مدیریت اخبار</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=newsmgr&act=new">درج خبر جدید
					<span class="add-news"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=newsmgr&act=mgr" id="news" name="news">حذف/ویرایش اخبار
					<span class="edit-news"></span>
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
			$("#frmnewsmgr").validationEngine();			
    });
	</script>	   
  <div class="title">
      <ul>
        <li><a href="adminpanel.php">پیشخوان</a></li>
	    <li><span>مدیریت اخبار</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmnewsmgr" id="frmnewsmgr" class="" action="" method="post" >  
       <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
       <p>
         <label for="subject">عنوان </label>
         <span>*</span>
       </p>    
       <input type="text" name="subject" class="validate[required] subject" id="subject" value='{$row[subject]}'/> 
  	   <p>
         <label for="pic">عکس </label>
         <span>*</span>
       </p>       
	   <p>
	   		<input type="text" name="selectpic" class="validate[required] selectpic" id="selectpic" value='{$row[image]}' />
	   		<input type="text" class="showadd" id="showadd" value='{$row[image]}' />
	   		<a class="filesbrowserbtn" id="filesbrowserbtn" name="newsmgr" title="گالری تصاویر">گالری تصاویر</a>
	   		<a class="selectbuttton" id="selectbuttton" title="انتخاب">انتخاب</a>
	   </p>
	   <div class="badboy"></div>
	   <div id="filesbrowser"></div>
	   <div class="badboy"></div>
       	<div id="imgpreview">
			<img id="img" src="" alt="" />				
		</div>
  	   <p>
         <label for="detail">توضیحات </label>
         <span>*</span>
       </p>
       <textarea cols="50" rows="10" name="detail" class="detail" id="detail" > {$row[body]}</textarea>
  	   <p>
        <label for="sdate">تاریخ </label>
        <span>*</span><br /><br />
        <input type="text" name="ndate" class="validate[required] ndate" id="date_input_1" value='{$row[ndate]}' />
        <img src="../themes/default/images/admin/cal.png" id="date_btn_1" alt="cal-pic">
         <script type="text/javascript">
          Calendar.setup({
            inputField  : "date_input_1",   // id of the input field
            button      : "date_btn_1",   // trigger for the calendar (button ID)
                ifFormat    : "%Y-%m-%d",       // format of the input field
                showsTime   : false,
                dateType  : 'jalali',
                showOthers  : true,
                langNumbers : true,
                weekNumbers : true
          });
        </script>
       </p>
       <p>
  	   <label>منبع خبر </label>
       <span>*</span>   	 
       </p>
       <input type="text" name="res" class='validate[required]' value='{$row['resource']}'/>
	   {$editorinsert}       
      	 <input type="reset" value="پاک کردن" class='reset' /> 	 	     
       </p>  
	</form>
	<div class='badboy'></div>	
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
} else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 		
	    if ($_POST["cbsearch"]=="ndate")
		{
		   date_default_timezone_set('Asia/Tehran');		   
		   list($year,$month,$day) = explode("/", trim($_POST["txtsrh"]));		
		   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);		
		   $_POST["txtsrh"] = Date("Y-m-d",mktime(0, 0, 0, $gmonth, $gday, $gyear));
		}
		$rows = $db->SelectAll(
				"news",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"ndate DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				$_GET['item'] = "newsmgr";
				$_GET['act'] = "mgr";
				$_GET['msg'] = 6;				
				//header("Location:?item=newsmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"news",
				"*",
				null,
				"ndate DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews")?$db->CountAll("news"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["subject"] =(mb_strlen($rows[$i]["subject"])>20)?mb_substr($rows[$i]["subject"],0,20,"UTF-8")."...":$rows[$i]["subject"];
                $rows[$i]["body"] =(mb_strlen($rows[$i]["body"])>30)?
                mb_substr(html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8"), 0, 30,"UTF-8") . "..." :
                html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8");               
                $rows[$i]["ndate"] =ToJalali($rows[$i]["ndate"]," l d F  Y ");
				$rows[$i]["image"] ="<img src='{$rows[$i][image]}' alt='{$rows[$i][subject]}' width='40px' height='40px' />";                                            
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}
				$rows[$i]["username"]=GetUserName($rows[$i]["userid"]); 
				$rows[$i]["edit"] = "<a href='?item=newsmgr&act=edit&nid={$rows[$i]["id"]}' " .
						"style='text-decoration:none;'><img src='../themes/default/images/admin/icons/edit.gif'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این خبر اطمینان دارید؟',
				'?item=newsmgr&act=del&pageNo={$_GET[pageNo]}&nid=');"
				 style='text-decoration:none;'><img src='../themes/default/images/admin/icons/delete.gif'></a>
del;
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
							"subject"=>"عنوان",
							"image"=>"تصویر",
							"body"=>"توضیحات",
							"ndate"=>"تاریخ",
							"resource"=>"منبع",
							"username"=>"کاربر",
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=newsmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",
              "body"=>"توضیحات",
			  "ndate"=>"تاریخ",
			  "resource"=>"منبع");
$combobox = SelectOptionTag("cbsearch",$list,"subject");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});
		$('#cbsearch').change(function(){
			$("select option:selected").each(function(){
	            if($(this).val()=="ndate"){
	            	$('.cal-btn').css('display' , 'inline-block');
	            	return false;
	            }else{
	            	$('.cal-btn').css('display' , 'none');
	            }
  			});
		});
	});
</script>	   
					<div class="title">
				      <ul>
				        <li><a href="adminpanel.php">پیشخوان</a></li>
					    <li><span>مدیریت اخبار</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=newsmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>

								<p class="search-form">
									<input type="text" id="date_input_1" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  /> 
									<img src="../themes/default/images/admin/cal.png" class="cal-btn" id="date_btn_2" alt="cal-pic">
							         <script type="text/javascript">
							          Calendar.setup({
							            inputField  : "date_input_1",   // id of the input field
							            button      : "date_btn_2",   // trigger for the calendar (button ID)
							                ifFormat    : "%Y/%m/%d",       // format of the input field
							                showsTime   : false,
							                dateType  : 'jalali',
							                showOthers  : true,
							                langNumbers : true,
							                weekNumbers : true
							          });
							        </script>
									<a href="?item=newsmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=newsmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
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
