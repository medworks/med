<?php
  include_once("./config.php");
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = database::getDatabase();
  $works = $db->SelectAll('works',NULL,NULL," fdate DESC");
  $html = " <div class='content'>
              <div class='main-box'>
                <h2>کارهای ما</h2>
                <div class='line'></div>
                <div class='badboy'></div>
                ";

  for($i=0 ; $i<count($works) ; $i++){
    $sdate = ToJalali($works[$i]["sdate"]," l d F  Y ");
    $fdate = ToJalali($works[$i]["fdate"]," l d F  Y ");
  $html.=<<<cd
    <div class='box-right'> 
  	  <div class='title'>
        <a href="?item=fullworks&act=do&wid={$works[$i]["id"]}" title='{$works[$i]["subject"]}'><p>{$works[$i]["subject"]}</p></a>
      </div>
      <div class='time'>
        <p><span>تاریخ شروع:</span> $sdate </p>
        <p><span>تاریخ پایان:</span> $fdate </p>  
      </div>
      <div class='badboy'></div>
      <div class="pic">
        <a href="?item=fullworks&act=do&wid={$works[$i]["id"]}" title='{$works[$i]["subject"]}'><img src='{$works[$i]["image"]}' alt='{$works[$i]["subject"]}'></a>
      </div>
  		<div class="detail">
  			{$works[$i]["body"]}
  		</div>
      <a href="?item=fullworks&act=do&wid={$works[$i]["id"]}" title="" class="button">توضیحات بیشتر</a>
      <div class='badboy'></div>
    </div>
cd;
  }
$html.=" </div></div> ";  
return $html;
?>