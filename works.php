<?php
  include_once("./classes/database.php");
  $db = database::getDatabase();
  $works = $db->SelectAll('works',NULL,NULL," sdate");
  $html = " <div class='content'>
              <div class='main-box'>
                <h2>کارهای ما</h2>
                <div class='line'></div>
                <div class='badboy'></div>
                <div class='box-right'> ";

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
$html.=" </div></div></div> ";  
return $html;
?>