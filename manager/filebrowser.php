<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");		
$html=<<<cd
	<div class="picmanager">
		<div class="prev right">
			<div class="pic">
				<img src="../themes/default/images/main/others/slide1.jpg" alt="">
			</div>
			<div class="detail">
				<h2><span>نام فایل: </span>اسلاید یک</h2>
				<p><span>سایز: </span>150 کیلوبایت</p>
			</div>
			<a href="#" title="" class="button">انتخاب</a>
			<a href="#" title="" class="button">خروج</a>
		</div>
		<div class="files"></div>
		<div class="badboy"></div>
	</div>
cd;
echo $html;
?>