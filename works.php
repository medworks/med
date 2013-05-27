<?php
  include_once("./classes/database.php");
  $db = database::getDatabase();
  $works = $db->SelectAll('works',NULL,NULL," sdate");
  $html = " <div class='' > ";

  for($i=0;$i<=count($works);$i++)
  {
  $html.=<<<cd
	    <p> نام پروژه:{$works[$i]["subject"]}</p>
		<div class="">
			<p> توضیحات: </p>
			{$works[$i]["body"]}
		</div>
		<p> تاریخ شروع: {$works[$i]["sdate"]} </p>
		<p> تاریخ پایان: {$works[$i]["fdate"]}</p>	
cd;
  }
$html.=" </div> ";  
return $html;
?>