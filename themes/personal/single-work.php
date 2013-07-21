<?php
	include_once("./classes/database.php");
  	include_once("./lib/persiandate.php");
	$db = database::getDatabase();
	$works = $db->Select('works',NULL,"id={$_GET[wid]}"," sdate DESC");
	$sdate = ToJalali($works["sdate"]," l d F  Y ");
   	$fdate = ToJalali($works["fdate"]," l d F  Y ");
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
				<ul>
					<li><p class="sdate">{$sdate}</p></li>
					<li><p class="sep">|</p></li>
					<li><p class="fdate">{$fdate}</p></li>
				</ul>
				<div class="badboy"></div>
				<div class="text">{$works[body]}</div>
			</div>
		</div>
	</div>
cd;
return $html;
?>