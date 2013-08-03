<?php
	include_once("./classes/database.php");
  	include_once("./lib/persiandate.php");
  	$db = Database::GetDatabase();
    $pageNo = ($_GET["pid"]) ? $_GET["pid"] : 1;
    $maxItemsInPage = GetSettingValue('Max_Post_Number',0);
    $from = ($pageNo - 1) * $maxItemsInPage;
    $count = $maxItemsInPage;
  	$news = $db->SelectAll("news","*",null,"ndate DESC",$from,$count);
  	$itemsCount = $db->CountAll("news");

$html=<<<cd
	<div class="news-page" id="others-page">
		<div class="page-header">
			<h1>اخبار</h1>
			<div class="filter">
				<menu>
					<li><a href="#" class="filter-button">انتخاب نوع خبر</a>
						<menu>
							<li><a href="#" data-filter="*" class="active">همه موارد</a></li>
cd;
							for($i=0 ; $i<count($category) ; $i++){

$html.=<<<cd
								<li><a href="#" data-filter=".{$news[$i][catname]}">{$news[$i][catname]}</a></li>
cd;
							}
$html.=<<<cd

			            </menu>
		            </li>
	            </menu>
			</div>
			<div class="badboy"></div>
		</div>
		<div class="badboy"></div>
		<div class="news" id="special-page">
			<ul class="items">
cd;
				for($i=0 ; $i<count($news) ; $i++){
					$ndate= ToJalali($news[$i]["ndate"]," l d F  Y ساعت H:m");
					$news["userid"] = GetUserName($news[$i]["userid"]);
					$body= $news[$i]["body"];
				    $body= strip_tags($body);
				    $body= (mb_strlen($body)>100) ? mb_substr($body,0,100,"UTF-8")."..." : $body;
$html.=<<<cd
					<li class="item {$news[$i][catname]}">
						<div class="overlay">
							<a href="?item=fullnews&wid={$news[$i][id]}">
								<img src="{$news[$i][image]}" alt="{$news[$i][subject]}" />
							</a>
						</div>
						<div class="detail">
							<h3><a href="?item=fullnews&wid={$news[$i][id]}" title="{$news[$i][subject]}">{$news[$i][subject]}</a></h3>
							<ul>
								<li><p class="date">{$ndate}</p></li>
							</ul>
							<div class="badboy"></div>
							<ul>
								<li><p class="by">{$news["userid"]}</p></li>
								<li><p class="sep">|</p></li>
								<li><p class="type">اجتماعی</p></li>
							</ul>
							<div class="badboy"></div>
							<p class="text">{$body}</p>
						</div>
					</li>
cd;
				}
$html.=<<<cd
			</ul>
			<div class="badboy"></div>
		</div>
	</div>
cd;

$linkFormat = '?item=news&pid=%PN%';
$maxPageNumberAtTime = GetSettingValue('Max_Page_Number',0);
$pageNos = Pagination($itemsCount, $maxItemsInPage, $pageNo, $maxPageNumberAtTime, $linkFormat);

$html.=<<<cd
		{$pageNos}
cd;
return $html;
?>