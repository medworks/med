<?php
	include_once("./classes/database.php");
	include_once("./lib/persiandate.php");
	$db = database::GetDatabase();
 	$news = $db->Select('news',NULL,"id={$_GET[wid]}"," ndate DESC");
  	$ndate = ToJalali($news["ndate"]," l d F  Y ساعت H:m");
  	$news["userid"] = GetUserName($news["userid"]);
$html=<<<cd
	<div class="singlenew-page" id="others-page">
		<div class="page-header">
			<h1><span>اخبار / </span>{$news[subject]}</h1>
			<div class="badboy"></div>
		</div>
		<div class="badboy"></div>
		<div class="singlenew" id="special-page">
			<div class="pic">
				<img src="{$news[image]}" alt="{$news[subject]}" />
			</div>
			<div class='detail'>
				<h2>{$news[subject]}</h2>
				<ul>
					<li><p class="date">{$ndate}</p></li>
					<li><p class="sep">|</p></li>
					<li><p class="by">{$news["userid"]}</p></li>
					<li><p class="sep">|</p></li>
					<li><p class="type">اجتماعی</p></li>
				</ul>
				<div class="badboy"></div>
				<div class="text">{$news[body]}</div>
			</div>
		</div>
	</div>
cd;
return $html;
?>