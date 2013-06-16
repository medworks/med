<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");	
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
					<span class="add-news"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=slidesmgr&act=mgr" id="news" name="news">
				  حذف/ویرایش عکس ها
					<span class="edit-news"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}else
if ($_GET['act']=="new")
{
$list = array("1"=>"اسلاید بزرگ",
              "2"=>"اسلاید کوچک",
			  "3"=>"همه موارد");			  
$combobox = SelectOptionTag("cbpos",$list,"1");
$html=<<<cd
		<script type='text/javascript'>
			$(document).ready(function(){		
				$("#frmslidesmgr").validationEngine();
			});	
			function PreviewImg()
			{				
			    document.getElementById('img').src=document.getElementById('pic').value;
				$("img").css( "width", "80", "height", "60" );				
			}
		</script>	     
		<form name="frmslidesmgr" id="frmslidesmgr" class="" action="" method="post" enctype="multipart/form-data" > 
			<p>
				<label for="pic">عکس </label>
				<span>*</span>
			</p>
			<input type="file" name="pic" class="validate[required] pic" id="pic" onchange="PreviewImg();" />  
			<div id="imgpreview">
				<img id="img" src="" alt="Image" />				
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
			<input type='submit' id='submit' value='ذخیره' class='submit' />
			<input type="reset" value="پاک کردن" class='reset' /> 	
		</form>
cd;
}
return $html;
?>	