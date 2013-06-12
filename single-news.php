<?php	
	include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");	
	$db = database::getDatabase();
 	$news = $db->Select('news',NULL,"id={$_GET[wid]}"," ndate DESC");
	$ndate = ToJalali($news["ndate"]," l d F  Y ");
	$news[userid] = GetUserName($news["userid"]);
$html=<<<ht
	<div class="content single-page">
	<div class="title-menu">
		<menu>
			<li><a href="./">صفحه اصلی</a><span>/</span></li>
			<li><a href="?item=news&act=do">اخبار</a><span>/</span></li>
			<li><p>{$news[subject]}</p></li>
		</menu>
		<div class="badboy"></div>
	</div>
	<div class="box-right singlepage-box">
		<div class="image">
			<img src={$news[image]} alt={$news[subject]} />
		</div>
		<div class="tit-da-de">
			<div class="title">
				<p>{$news[subject]}</p>
			</div>
			<div class="date">
				<p><span>تاریخ ثبت: {$ndate} </span></p>
				<p><span>توسط: {$news[userid]}</span></p>
	        <p><span>منبع: {$news[resource]}</span></p>  
			</div>
			<div class="detail">
				{$news[body]}
			</div>
		</div>
	</div>
</div>
ht;
return $html;	
?>