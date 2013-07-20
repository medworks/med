<?php
	include_once("./classes/database.php");
	$db = database::getDatabase();
	$works = $db->Select('works',NULL,"id={$_GET[wid]}"," sdate DESC");
$html=<<<cd
	<div class="singlework-page" id="others-page">
		<div class="page-header">
			<h1><span>کارهای ما / </span>{$works[subject]}</h1>
			<div class="badboy"></div>
		</div>
		<div class="badboy"></div>
		<div class="singlework" id="special-page">
			<div class="pic">
				<img src="{$works[image]}" alt="{$works[subject]}" />
			</div>
			<div class='detail'>
				<h2>{$works[subject]}</h2>
				<!-- <p class="type">گرافیکی</p> -->
				{$works[body]}
			</div>
		</div>
	</div>
cd;
return $html;
?>