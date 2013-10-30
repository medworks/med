<?php 
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	include_once("../lib/persiandate.php");	
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	$db = Database::GetDatabase();	
	$overall_error = false;
	if ($_GET['item']!="pollmgr")	exit();
	if ($_GET['act']=="do")
	{
		$html=<<<ht
			<div class="title">
			  <ul>
				<li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
				<li><span>مدیریت نظر سنجی</span></li>
			  </ul>
			  <div class="badboy"></div>
			</div>
			<div class="sub-menu" id="mainnav">
				<ul>
				  <li>		  
					<a href="?item=pollmgr&act=new">درج نظرسنجی جدید
						<span class="add-news"></span>
					</a>
				  </li>
				  <li>
					<a href="?item=pollmgr&act=mgr" id="poll" name="poll">حذف/ویرایش نظرسنجی
						<span class="edit-news"></span>
					</a>
				  </li>
				 </ul>
				 <div class="badboy"></div>
			</div>		 
ht;
	}
	else
	if ($_GET['act']=="new" or $_GET['act']=="edit")
	{
	}
?>	