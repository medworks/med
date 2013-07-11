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
	$db = Database::GetDatabase();
	if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت اخبار</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=settingmgr&act=about">متن درباره ما
					<span class="add-user"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=settingmgr&act=seo" >اطلاعات سئو 
					<span class="edit-user"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=settingmgr&act=emails" >ایمیل ها 
					<span class="edit-user"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=settingmgr&act=grid" >جداول اطلاعات 
					<span class="edit-user"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}
	
return $html;
?>