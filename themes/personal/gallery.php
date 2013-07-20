<?php
	include_once("./config.php");
 	include_once("./classes/functions.php");
	$db = database::GetDatabase();
	$pageNo = ($_GET["pid"]) ? $_GET["pid"] : 1;
	$maxItemsInPage = GetSettingValue('Max_Post_Number',0);
	$from = ($pageNo - 1) * $maxItemsInPage;
	$count = $maxItemsInPage;
	$slides = $db->SelectAll("slides","*",null," pos ASC",$from,$count);
    $itemsCount = $db->CountAll("slides");

$html=<<<cd
	<div class="gallery-page">
		<div class="page-header" id="others-page">
			<h1>گالری تصاویر</h1>
			<div class="badboy"></div>
		</div>
		<div class="badboy"></div>
		<div class="gallery" id="special-page">
			<ul>
cd;
				for($i=0 ; $i<count($slides) ; $i++){
					// $body= $slides[$i]['body'];
					// $body= strip_tags($body);
   					// $body= (mb_strlen($body)>250) ? mb_substr($body,0,250,"UTF-8")."..." : $body;
$html.=<<<cd
					<li>
						<div class="overlay">
							<a href="{$slides[$i][image]}" rel="prettyphoto[gallery3]">
								<img src="{$slides[$i][image]}" alt="{$slides[$i][subject]}" />
							</a>
						</div>
						<div class="detail">
							<h3><a href="{$slides[$i][image]}" rel="prettyphoto[gallery4] title="{$slides[$i][subject]}">{$slides[$i][subject]}</a></h3>
							<!-- <p class="text">{$body}</p> -->
						</div>
					</li>
cd;
				
				if(($i+1) % 3 == 0 || $i == (count($slides)-1))
$html.=<<<cd
					<span class="line"></span>
cd;
				}
$html.=<<<cd
			</ul>
			<div class="badboy"></div>
		</div>
cd;
		$linkFormat = '?item=gallery&pid=%PN%';
		$maxPageNumberAtTime = GetSettingValue('Max_Page_Number',0);
		$pageNos = Pagination($itemsCount, $maxItemsInPage, $pageNo, $maxPageNumberAtTime, $linkFormat);
		/*
		<div class="pageination">
			<a href="#" class="btn">1</a>
			<a href="#" class="btn">2</a>
			<a href="#" class="btn">3</a>
			<a href="#" class="btn">4</a>
			<a href="#" class="btn">5</a>
		</div>
		*/
$html.=<<<cd
			<center> $pageNos </center>
cd;
$html.=<<<cd
		<div class="badboy"></div>
	</div>
cd;
return $html;
?>