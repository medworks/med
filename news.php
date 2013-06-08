<?php
  include_once("./config.php");
  include_once("./classes/database.php");
  $db = database::getDatabase();
  $news = $db->SelectAll('news',NULL,NULL," ndate DESC");
  $html = " <div class='content'>
              <div class='main-box'>
                <h2>اخبار</h2>
                <div class='line'></div>
                <div class='badboy'></div>
                ";

  for($i=0;$i<count($news);$i++)
  {
  $html.=<<<cd
    <div class='box-right'> 
  	  <div class='title'>
        <a href="#" title='{$news[$i]["subject"]}'><p>{$news[$i]["subject"]}</p></a>
      </div>
      <div class='time'>
        <p><span>تاریخ ثبت:</span> {$news[$i]["ndate"]}</p>  
        <p><span>توسط:</span> {$news[$i]["userid"]} </p>
        <p><span>منبع:</span> {$news[$i]["resource"]}</p>  
      </div>
      <div class='badboy'></div>
      <div class="pic">
        <a href="#" title='{$news[$i]["subject"]}'><img src='{$news[$i]["image"]}' alt='{$news[$i]["subject"]}'></a>
      </div>
  		<div class="detail">
  			{$news[$i]["body"]}
  		</div>
      <div class='badboy'></div>
    </div>
cd;
  }
$html.=" </div></div> ";  
return $html;
?>