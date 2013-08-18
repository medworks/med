<?php
	include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
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
 if (isset($_GET["sec"]))
{
	$category = $db->SelectAll("category","*","secid={$_GET[sec]}","id ASC");
	$cbcategory = DbSelectOptionTag("cbcat",$category,"catname",null,null,"select validate[required]");
	echo $cbcategory;
}
?>