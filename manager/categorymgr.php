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
 if ($_GET['item']!="catmgr")	exit();
 $db = Database::GetDatabase();
	$msg = Message::GetMessage();
	if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>دسته بندی</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<!-- <div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=catmgr&act=new">گروه جدید
					<span class="add-cat"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=catmgr&act=mgr" >حذف/ویرایش گروه ها
					<span class="edit-cat"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div> -->

		<form>
			
		</form> 
ht;
}
return $html;
?>