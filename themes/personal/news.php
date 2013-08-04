<?php
	include_once("./classes/database.php");
  	include_once("./lib/persiandate.php");
  	$db = Database::GetDatabase();
  	$news = $db->SelectAll("news","*",null,"ndate DESC");

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
							for($i=0 ; $i<count($news) ; $i++){
								if($news[$i]['groupname']!=null){
$html.=<<<cd
								<li><a href="#" data-filter=".{$news[$i][groupname]}">{$news[$i][groupname]}</a></li>
cd;
							}}
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
					<li class="item {$news[$i][groupname]}">
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
								<li><p class="type">{$news[$i][groupname]}</p></li>
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

return $html;
?>