<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	$login = Login::getLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	if ($_GET['item']!="usermgr")	exit();
	$db = Database::GetDatabase();
	$msg = Message::GetMessage();
	
return $html;
?>