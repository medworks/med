<?php
	include_once("config.php");
    include_once("classes/database.php"); 
	include_once("classes/functions.php");
	include_once("lib/RSS2Writer.php");
	
	$db = Database::GetDatabase();
	$news = $db->SelectAll("news","*",NULL,"ndate DESC");
	$Site_Title=GetSettingValue("Site_Title",1);
	$Site_Describtion=GetSettingValue("Site_Describtion",1);
	$Admin_Email=GetSettingValue("Admin_Email",1);
	$now = date("D, d M Y H:i:s T");
	$site = "www.mediateq.ir";
	$uri = "?item=fullnews&act=do&wid=";
	
	$rss2_writer = new RSS2Writer(
									$Site_Title, 
									$Site_Describtion, 
									'www.mediateq.ir', 
									6, //indent
									false //use CDATA
		                          );
	foreach ($news as $row)
	{		 
		//$rss2_writer->addCategory();
		$rss2_writer->addItem($row['subject'],$row['body'], $uri.$row['id']);		
	}
	//header("Content-Type: application/rss+xml");
	echo $rss2_writer->getXML();
?>