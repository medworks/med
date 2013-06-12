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
	$post["userid"] = GetUserName($post["userid"]);
	$html.=<<<cd
		<div class='box-right'> 
		<div class='title'>
			<a href="?item=fullnews&act=do&wid={$post["id"]}" title='{$post["subject"]}'><p>{$post["subject"]}</p></a>
		</div>
		<div class='time'>
			<p><span>تاریخ ثبت:</span> {$ndate}</p>  
			<p><span>توسط:</span> {$post["userid"]} </p>
			<p><span>منبع:</span> {$post["resource"]}</p>  
		</div>
		<div class='badboy'></div>
		<div class="pic">
			<a href="?item=fullnews&act=do&wid={$post["id"]}" title='{$post["subject"]}'><img src='{$post["image"]}' alt='{$post["subject"]}'></a>
		</div>
  		<div class="detail">
  			{$post["body"]}
  		</div>
		<a href="?item=fullnews&act=do&wid={$post["id"]}" title="" class="button">توضیحات بیشتر</a>
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