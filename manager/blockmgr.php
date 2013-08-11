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
	if ($_GET['item']!="blockmgr")	exit();
	$db = Database::GetDatabase();
	$msg = Message::GetMessage();
	if ($_GET['act']=="do")
	{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت بلاک ها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=blockmgr&act=new"> ایجاد بلاک
					<span class="add-works"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=blockmgr&act=mgr" >حذف/ویرایش بلاک
					<span class="edit-works"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
} else
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
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	    <li><span>مدیریت اخبار</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmblocks" id="frmblocks" class="" action="" method="post" >
     <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
	</form> 
cd;
}
return $html;
?>