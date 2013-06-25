<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");		
$html=<<<cd
	<div id="right" class="" > 
		<div id="pic"></div>
		<span> اسم فایل</span>
		<span> اندازه فایل</span>
		<a href="">انتخاب</a>
		<a href="">خروج</a>
	</div>	
	<div id="body" class=""></div>
cd;
	
?>