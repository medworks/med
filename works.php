<?php
  include_once("./classes/database.php");
  $db = database::getDatabase();
  $works = $db->SelectAll('works',NULL,NULL," sdate");
  $html = " <div class='content' >
              <div class='page'>
                <p><a href='./'>خانه</a>/ کارهای ما</p>
              </div> ";

  for($i=0;$i<count($works);$i++)
  {
  $html.=<<<cd
	    <div class='title'><p><span>نام پروژه:</span> {$works[$i]["subject"]}</p></div>
		<div class="detail">
			<p><span>توضیحات:</span> {$works[$i]["body"]}</p>
		</div>
    <div class='time'>
  		<p><span>تاریخ شروع:</span> {$works[$i]["sdate"]} </p>
  		<p><span>تاریخ پایان:</span> {$works[$i]["fdate"]}</p>	
    </div>
cd;
  }
$html.=" </div> ";  
return $html;
?>