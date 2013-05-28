<?php
	error_reporting (E_ALL ^ E_NOTICE);
    include_once("./classes/functions.php");
	include_once("./themes/default/main.php");
	$page_load = include_once GetPageName($_GET['item'],$_GET['act']); 	
	echo $page_load;
?>