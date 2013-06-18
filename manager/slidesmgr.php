<?php
 include_once("../config.php");
 include_once("../classes/database.php");
 include_once("../classes/messages.php");
 include_once("../classes/session.php");	
 include_once("../classes/functions.php");
 include_once("../lib/persiandate.php");
 if ($_GET['item']!="slidesmgr")	exit();
 $db = Database::GetDatabase();
 if (isset($_POST["mark"]))
 {
	 $filename = strtolower(basename($_FILES['pic']['name']));
	 $ext = substr($filename, strrpos($filename, '.') + 1);
	 $newfilename= md5(rand() * time());
	 //$newfilename = $_POST['subject'];	 
	 $ext=".".$ext;          
	 //$newfilename = $_FILES['pic']['name'];
	 $newname_os = OS_ROOT.'/slidespics/'.$newfilename.$ext;
	 $newname_site = SITE_ROOT.'/slidespics/'.$newfilename.$ext;
	 if (!move_uploaded_file($_FILES["pic"]["tmp_name"],$newname_os))
	 {       
		//$msgs = $msg->ShowError("عمليات آپلود با مشكل مواجه شد");
		header('location:?item=slidesmgr&act=new&msg=3');
		exit();
	 }
  } 	
 if ($_POST["mark"]=="saveslides")
 {						   				
	$fields = array("`image`","`subject`","`body`","`pos`");	
	$values = array("'{$newname_site}'","'{$_POST[subject]}'","'{$_POST[body]}'","'{$_POST[cbpos]}'");
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
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php">پیشخوان</a></li>
	        <li><span>مدیریت اسلاید</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=slidesmgr&act=new">درج عکس جدید
					<span class="add-slide"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=slidesmgr&act=mgr" id="news" name="news">
				  حذف/ویرایش عکس ها
					<span class="edit-slide"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}else
if ($_GET['act']=="new")
{
$msgs = GetMessage($_GET['msg']);
$list = array("1"=>"اسلاید بزرگ",
              "2"=>"اسلاید کوچک",
			  "3"=>"همه موارد");			  
$combobox = SelectOptionTag("cbpos",$list,"1");
$html=<<<cd
		<script type='text/javascript'>
			$(document).ready(function(){		
				$("#frmslidesmgr").validationEngine();			   
			});
		</script>
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php">پیشخوان</a></li>
	        <li><span>مدیریت اسلاید</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>	     
		{$msgs}
		<form name="frmslidesmgr" id="frmslidesmgr" class="" action="" method="post" enctype="multipart/form-data" > 
			<p>
				<label for="pic">عکس </label>
				<span>*</span>
			</p>
			<input type="file" name="pic" class="validate[required] pic" id="pic" OnChange="showPreview(this)" />  
			<div id="imgpreview">
				<img id="img" src="" alt="" />				
			</div>
			<p>
				<label for="subject">عنوان </label>
				<span>*</span>
			</p>
			<input type="text" name="subject" class="validate[required] subject" id="subject" />
			<p>
				<label for="subject">توضیحات </label>
				<span>*</span>
			</p>
			<input type="text" name="body" class="validate[required] subject" id="body" /> 
			<p>
				<label for="cbpos">نمایش عکس در </label>
				<span>*</span>
			</p>
			{$combobox}
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />
				<input type="reset" value="پاک کردن" class='reset' /> 
				<input type='hidden' name='mark' value='saveslides' />
			</p>
		</form>
cd;
}
return $html;
?>	