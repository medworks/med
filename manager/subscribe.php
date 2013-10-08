<?php
	error_reporting (E_ALL ^ E_NOTICE);
	include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	include_once("../lib/persiandate.php");	

	$db = Database::GetDatabase();

	$msg="";
	$fields = array("`email`","`tel`","`name`");		
	$values = array("'{$_POST[email]}'","'{$_POST[tel]}'","'{$_POST[name]}'");
	
	$name=$_POST['name'];
	$email=$_POST['email'];

	if (strlen($name)>=1 && checkEmail($email)){
		if ($db->InsertQuery('usersnews',$fields,$values)){
	    	$msg="OK";}
	}else{
		$msg="<div class='notification_error rtl'>ثبت مشخصات شما با مشکل مواجه شد! لطفا فیلدها را بررسی نمایید و مجددا تلاش کنید.</div>";
	}
	echo $msg;

?>