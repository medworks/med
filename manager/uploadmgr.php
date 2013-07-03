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
 if ($_GET['item']!="uploadmgr")	exit();
 $db = Database::GetDatabase();
 $overall_error = false;
 $pic_on_edit_section = null;
 if (isset($_POST["mark"]) and $_POST["mark"]!="srhnews")
 {
	 if(empty($_POST["selectpic"]))
		{ 
			//$msgs = $msg->ShowError("لط??ا ??ایل عکس را انتخاب کنید");
			//header('location:?item=slidesmgr&act=new&msg=4');
			$_GET["item"] = "slidesmgr";
			$_GET["act"] = "new";
			$_GET["msg"] = 4;
			$overall_error = true;
			//exit();
		}
  } 	
 if (!$overall_error && $_POST["mark"]=="saveslides")
 {						   				
	$fields = array("`image`","`subject`","`body`","`pos`");	
	$values = array("'{$_POST[selectpic]}'","'{$_POST[subject]}'","'{$_POST[body]}'","'{$_POST[cbpos]}'");
	if (!$db->InsertQuery('slides',$fields,$values)) 
	{
		//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
		header('location:?item=slidesmgr&act=new&msg=2');
		exit();
	} 	
	else 
	{  										
		//$msgs = $msg->ShowSuccess("ثبت اطلاعات با موفقیت انجام شد");
		header('location:?item=slidesmgr&act=new&msg=1');					
		exit();
	 }
 }
 else
 if (!$overall_error && $_POST["mark"]=="editslides")
 {			    
	$values = array("`image`"=>"'{$_POST[selectpic]}'",
	       		    "`subject`"=>"'{$_POST[subject]}'",
					"`body`"=>"'{$_POST[body]}'",
					"`pos`"=>"'{$_POST[cbpos]}'");		
	$db->UpdateQuery("slides",$values,array("id='{$_GET['sid']}'"));
	//echo $db->cmd;
	header('location:?item=slidesmgr&act=mgr');
 }

	if ($overall_error)
	{
		$row = array("image"=>$_FILES['pic']['name'],
					 "subject"=>$_POST['subject'],
					 "body"=>$_POST['body']);
	}
 
   if ($_GET['act']=="new")
	{
	    $pic_on_edit_insert_section ="<img id='img' src='' alt='' />";
		$editorinsert = "
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />	 
				<input type='hidden' name='mark' value='saveslides' />";
	}
	if ($_GET['act']=="edit")
	{
		$row=$db->Select("slides","*","id='{$_GET["sid"]}'",NULL);
		$pic_on_edit_insert_section = "<img src='{$row[image]}'width='200px' height='100px' />";
		$editorinsert = "
		<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editslides' />";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("slides"," id",$_GET["sid"]);
		if ($db->CountAll("slides")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=slidesmgr&act=mgr&pageNo={$_GET[pageNo]}");
	}	
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت آپلود عکس</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=uploadmgr&act=new">فایل جدید
					<span class="add-file"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=uploadmgr&act=mgr" id="news" name="news">
				  حذف/ویرایش فایلها
					<span class="edit-file"></span>
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
$chechbox = array("newspics"=>"پوشه اخبار",
                  "workspics"=>"پوشه فعالیت ها",
                  "userspics"=>"پوشه کاربران",
				  "slidespics"=>"پوشه اسلاید ها");
$checkboxes = CheckboxTag("picsadr",$chechbox);
$html=<<<cd
		<script type='text/javascript'>
			$(document).ready(function(){		
				$("#frmuploadmgr").validationEngine();			   
			});
		</script>
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت اسلاید</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>	     
		{$msgs}
		<form name="frmuploadmgr" id="frmuploadmgr" class="" action="" method="post" enctype="multipart/form-data" > 
			<p>
				<label for="pic">فایل </label>
				<span>*</span>
			</p>
			<div class="upload-file">
				<input type="file" name="pic" class="pic" id="pic" onChange="showPreview(this);" />  
				<span class="validate[required] filename"></span>
				<span class="action">انتخاب فایل</span>
			</div>		   
		   <div class="badboy"></div>
		   <div id="imgpreview">
				<img id="img" src="" alt="" />				
			</div>
			<p>
				<label for="subject">اسم مستعار</label>
				<span>*</span>
			</p>
			<input type="text" name="subject" class="validate[required] subject" id="subject" value="{$row[subject]}" />
			<p>
				<label for="body">توضیحات </label>
				<span>*</span>
			</p>
			<input type="text" name="body" class="validate[required] subject" id="body" value="{$row[body]}" /> 
			{$checkboxes}
			{$editorinsert}
				<input type="reset" value="پاک کردن" class='reset' /> 				
			</p>
		</form>
cd;
}
else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 			   
		$rows = $db->SelectAll(
				"uploadcenter",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"id DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				$_GET['item'] = "uploadmgr";
				$_GET['act'] = "mgr";
				$_GET['msg'] = 6;				
				//header("Location:?item=worksmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"uploadcenter",
				"*",
				null,
				"id DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews" )?$db->CountAll("uploadcenter"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["subject"] =(mb_strlen($rows[$i]["subject"])>20)?mb_substr($rows[$i]["subject"],0,20,"UTF-8")."...":$rows[$i]["subject"];
                $rows[$i]["body"] =(mb_strlen($rows[$i]["body"])>30)?
                mb_substr(html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8"), 0, 30,"UTF-8") . "..." :
                html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8");               
                $rows[$i]["image"] ="<img src='{$rows[$i][image]}' alt='{$rows[$i][subject]}' width='40px' height='40px' />";
				switch($rows[$i]["pos"])
				{
				 case 1: $rows[$i]["pos"] = "اسلاید بزرگ"; break;
				 case 2: $rows[$i]["pos"] = "اسلاید کوچک"; break;
				 case 3: $rows[$i]["pos"] = "همه موارد"; break;
				}
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}				
				$rows[$i]["edit"] = "<a href='?item=uploadmgr&act=edit&uid={$rows[$i]["id"]}' " .
						"style='text-decoration:none;'><img src='../themes/default/images/admin/icons/edit.gif'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این فعالیت اطمینان دارید؟',
				'?item=uploadmgr&act=del&pageNo={$_GET[pageNo]}&uid=');"
				 style='text-decoration:none;'> <img src='../themes/default/images/admin/icons/delete.gif'></a>
del;
               }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode.= DataGrid(array( 
							"image"=>"عکس",
							"subject"=>"عنوان",
							"body"=>"توضیحات",
							"pos"=>"موقعیت نمایش",							
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=uploadmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",
              "body"=>"توضیحات" );
$combobox = SelectOptionTag("cbsearch",$list,"subject");
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
							<form action="?item=uploadmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}							
									<input type="text" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  />
									<a href="?item=uploadmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=uploadmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
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