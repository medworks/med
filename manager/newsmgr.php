<?php 
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");
	$db = Database::getDatabase();
	if (isset($_POST["mark"]))
	{
		list($hour,$minute,$second) = split(':', date('H:i:s'));
		list($year,$month,$day) = split("-", trim($_POST["ndate"]));
		//echo "ntime is :",$hour,$minute,$second;
		//echo "<br/>ndate is :",trim($_POST["ndate"]);
		//echo "<br/>date is :",tr_num($year),$month,$day;
		list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);
		//echo "<br/> gdate is :",$gyear,$gmonth,$gday;
		$ndatetime = date("Y-m-d H:i:s",mktime($hour, $minute, $second, $gmonth, $gday, $gyear));
		//echo "<br/> ndatetime is :",$ndatetime;
	}
	if ($_POST["mark"]=="savenews")
    {       
	   if((!empty($_FILES["pic"])) && ($_FILES['pic']['error'] != 0))
		{ 
			//$msgs = $msg->ShowError("لط�?ا �?ایل عکس را انتخاب کنید");
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
				$values = array("'{$_POST[subject]}'","'{$newname_site}'","'{$_POST[detail]}'","'{$ndatetime}'","'1'","'{$_POST[res]}'");		
				if (!$db->insertquery('news',$fields,$values)) 
  				{
  					//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
					header('location:?item=newsmgr&act=do&msg=2');
					exit();
  				} 	
  				else 
  				{  										
  					//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو�?قیت انجام شد");
					header('location:?item=newsmgr&act=new&msg=1');
  				}  				 
			}		     			
		}			
	} else
	if ($_POST["mark"]=="editnews")
	{		
		$values = array("`subject`"=>"'{$_POST[subject]}'",
		                 "`image`"=>"'{$newname_site}'",
						 "`body`"=>"'{$_POST[detail]}'",
						 "`ndate`"=>"'{$ndatetime}'",
						 "`userid`"=>"'1'",
						 "`resource`"=>"'{$_POST[res]}'");		
        $db->updatequery("news",$values,array("id='{$_GET[nid]}'"));
		header('location:?item=newsmgr&act=mgr');
	}
if ($_GET['item']!="newsmgr")	exit();

if ($_GET['act']=="new")
{
	$editorinsert = "
		<p>
			<input type='submit' id='submit' value='ذخیره' class='submit' />	 
			<input type='hidden' name='mark' value='savenews' />";
}
if ($_GET['act']=="edit")
{
	$row=$db->SelectFromTable("news","*","id='{$_GET["nid"]}'",NULL);
	$editorinsert = "
	<p>
      	 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
      	 <input type='hidden' name='mark' value='editnews' />";
}
if ($_GET['act']=="del")
{
	$db->delete("news"," id",$_GET["nid"]);
	header('location:?item=newsmgr&act=mgr');
}
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="#">پیشخوان</a></li>
	        <li><a href="#">مدیریت اخبار</a></li>
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
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmnewsmgr" id="frmnewsmgr" class="" action="" method="post" enctype="multipart/form-data" >  
       <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
       <p>
         <label for="subject">عنوان </label>
         <span>*</span>
       </p>    
       <input type="text" name="subject" class="validate[required] subject" id="subject" value='{$row['subject']}'/> 
  	   <p>
         <label for="pic">عکس </label>
         <span>*</span>
       </p>
       <input type="file" name="pic" class="pic" id="pic" />  
  	   <p>
         <label for="detail">توضیحات </label>
         <span>*</span>
       </p>
       <textarea cols="50" rows="10" name="detail" class="detail" id="detail" > {$row['body']}</textarea>
  	   <p>
        <label for="sdate">تاریخ </label>
        <span>*</span><br /><br />
        <input type="text" name="ndate" class="validate[required] ndate" id="date_input_1" value='{$row['ndate']}' />
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
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,	
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
} else
if ($_GET['act']=="mgr")
{
$rows = $db->SelectAll(
		"news",
		"*",
        null,
		"ndate DESC",
		$_GET["pageNo"]*10,
		10);

                $rowsClass = array();
                $colsClass = array();
                $rowCount =$db->countAll("news");
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["subject"] =(mb_strlen($rows[$i]["subject"])>15)?mb_substr($rows[$i]["subject"],0,15,"UTF-8")."...":$rows[$i]["subject"];
                $rows[$i]["body"] =(mb_strlen($rows[$i]["body"])>15)?
                mb_substr(html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8"), 0, 15,"UTF-8") . "..." :
                html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8");               
                $rowss[$i]["ndate"] =ToJalali($rows[$i]["ndate"]);
                                $rows[$i]["option"] =$rows[$i]["option"];
                                if ($i % 2==0)
                                 {
                                        $rowsClass[] = "datagridevenrow";
                                 }
                                else
                                {
                                        $rowsClass[] = "datagridoddrow";
                                }
                                $rows[$i]["edit"] = "<a href='?item=newsmgr&act=edit&nid={$rows[$i]["id"]}' " .
                                        "style='text-decoration:none;'><img src='../themes/default/images/admin/icons/edit.gif'></a>";

                                $rows[$i]["delete"]=<<< del
                                <a href="javascript:void(0)"
                                onclick="DelMsg('{$rows[$i]['id']}',
                                    'از حذف این خبر اطمینان دارید',
                                '?item=newsmgr&act=del&nid=');"
                                 style='text-decoration:none;'><img src='../themes/default/images/admin/icons/delete.gif'></a>
del;
                         }

    if (!$_GET["pageNo"]) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= datagrid(array( 
							"subject"=>"عنوان",
							"body"=>"شرح",
							"ndate"=>"تاریخ",
							"resource"=>"منبع",
                            "edit"=>"ویرایش",
							"delete"=>"حذ�?", ), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=newsmgr&act=mgr");
                    
            }
$code=<<<edit
                    <div class="Top">                       
						<center>
							<form action="" method="post">
								{$gridcode} 
							</form>
					   </center>
					</div>

edit;
$html = $code;
}	
return $html;

?>
