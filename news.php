<?php
  include_once("./config.php");
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = database::getDatabase();
  $news = $db->SelectAll('news',NULL,NULL," ndate DESC");
  $html = " <div class='content'>
              <div class='main-box'>
                <h2>اخبار</h2>
                <div class='line'></div>
                <div class='badboy'></div>
                ";

  for($i=0;$i<count($news);$i++){
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
$html.=" </div></div> ";  
return $html;
?>