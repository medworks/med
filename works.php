<?php
  include_once("./config.php");
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();
  $pageNo = ($_GET["pid"]) ? $_GET["pid"] : 1;
  $maxItemsInPage = 5;
  $from = ($pageNo - 1) * $maxItemsInPage;
  $count = $maxItemsInPage;
  $works = $db->SelectAll("works","*",null,"fdate DESC",$from,$count);  
  $itemsCount = $db->CountAll("works");//count($works);
  $html = " <div class='content'>
              <div class='main-box'>
                <h2>کارهای ما</h2>
                <div class='line'></div>
                <div class='badboy'></div>
                ";

  foreach($works as $key => $post){
   $sdate = ToJalali($works[$i]["sdate"]," l d F  Y ");
   $fdate = ToJalali($works[$i]["fdate"]," l d F  Y ");
   $html.=<<<cd
		<div class='box-right'> 
		<div class='title'>
			<a href="?item=fullworks&act=do&wid={$post[id]}" title='{$post[subject]}'><p>{$post[subject]}</p></a>
		</div>
		<div class='time'>
        <p><span>تاریخ شروع:</span> $sdate </p>
        <p><span>تاریخ پایان:</span> $fdate </p>  
		</div>
		<div class='badboy'></div>
		<div class="pic">
        <a href="?item=fullworks&act=do&wid={$post[id]}" title='{$post[subject]}'><img src='{$post[image]}' alt='{$post[subject]}'></a>
		</div>
  		<div class="detail">
  			{$post[body]}
        <a href="?item=fullworks&act=do&wid={$post[id]}" title="" class="button">توضیحات بیشتر</a>
  		</div>
		<div class='badboy'></div>
		</div>
cd;
  }

$html.=" </div> ";  
$linkFormat = '?item=works&act=do&pid=%PN%';
$maxPageNumberAtTime = 3;
$pageNos = Pagination($itemsCount, $maxItemsInPage, $pageNo, $maxPageNumberAtTime, $linkFormat);
$html .= '<center>' . $pageNos . '</center> </div>';

return $html;
?>