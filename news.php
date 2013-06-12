<?php
  include_once("./config.php");
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  include_once("./classes/functions.php");
  $db = Database::GetDatabase();
  $pageNo = ($_GET["pid"]) ? $_GET["pid"] : 1;
  $maxItemsInPage = 5;
  $from = ($pageNo - 1) * $maxItemsInPage;
  $count = $maxItemsInPage;
  
  $news = $db->SelectAll("news","*",null,"ndate DESC",$from,$count);
  $itemsCount = $db->CountAll("news");//count($news);
  $html = " <div class='content'>
              <div class='main-box'>
                <h2>اخبار</h2>
                <div class='line'></div>
                <div class='badboy'></div>
                ";  
  foreach($news as $key => $post)				
 {
	$ndate = ToJalali($news["ndate"]," l d F  Y ");
	$html.=<<<cd
		<div class='box-right'> 
		<div class='title'>
			<a href="?item=fullnews&act=do&wid={$news[$i]["id"]}" title='{$news[$i]["subject"]}'><p>{$news[$i]["subject"]}</p></a>
		</div>
		<div class='time'>
			<p><span>تاریخ ثبت:</span> {$ndate}</p>  
			<p><span>توسط:</span> {$news[$i]["userid"]} </p>
			<p><span>منبع:</span> {$news[$i]["resource"]}</p>  
		</div>
		<div class='badboy'></div>
		<div class="pic">
			<a href="?item=fullnews&act=do&wid={$news[$i]["id"]}" title='{$news[$i]["subject"]}'><img src='{$news[$i]["image"]}' alt='{$news[$i]["subject"]}'></a>
		</div>
  		<div class="detail">
  			{$news[$i]["body"]}
  		</div>
		<a href="?item=fullnews&act=do&wid={$news[$i]["id"]}" title="" class="button">توضیحات بیشتر</a>
		<div class='badboy'></div>
	   </div>
cd;
  }
$html.=" </div> ";  
$linkFormat = '?item=news&act=do&pid=%PN%';
$maxPageNumberAtTime = 3;
$pageNos = Pagination($itemsCount, $maxItemsInPage, $pageNo, $maxPageNumberAtTime, $linkFormat);
$html .= '<center>' . $pageNos . '</center> </div>';
return $html;
?>