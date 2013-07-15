<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	$login = Login::getLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	if ($_GET['item']!="pluginmgr")	exit();
	$db = Database::GetDatabase();
	$msg = Message::GetMessage();
	if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت پلاگین ها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=pluginmgr&act=new"> ایجاد بلاک
					<span class="add-works"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=pluginmgr&act=mgr" >حذف/ویرایش بلاک
					<span class="edit-works"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}
return $html;
?>