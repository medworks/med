<?php
  include_once("./config.php");
  include_once("./classes/database.php");
  $db = database::getDatabase();
  $works = $db->SelectAll('works',NULL,NULL," fdate DESC");
  $html = " <div class='content'>
              <div class='main-box'>
                <h2>کارهای ما</h2>
                <div class='line'></div>
                <div class='badboy'></div>
                ";

  for($i=0 ; $i<count($works) ; $i++)
  {
  $html.=<<<cd
    <div class='box-right'> 
  	  <div class='title'>
        <a href="#" title='{$works[$i]["subject"]}'><p>{$works[$i]["subject"]}</p></a>
      </div>
      <div class='time'>
        <p><span>تاریخ شروع:</span> {$works[$i]["sdate"]} </p>
        <p><span>تاریخ پایان:</span> {$works[$i]["fdate"]}</p>  
      </div>
      <div class='badboy'></div>
      <div class="pic">
        <a href="#" title='{$works[$i]["subject"]}'><img src='{$works[$i]["image"]}' alt='{$works[$i]["subject"]}'></a>
      </div>
  		<div class="detail">
  			{$works[$i]["body"]}
  		</div>
      <div class='badboy'></div>
    </div>
cd;
  }
$html.=" </div></div> ";  
return $html;
?>