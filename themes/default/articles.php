<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();
  $pageNo = ($_GET["pid"]) ? $_GET["pid"] : 1;
  $maxItemsInPage = GetSettingValue('Max_Post_Number',0);
  $from = ($pageNo - 1) * $maxItemsInPage;
  $count = $maxItemsInPage;
  
  $articles = $db->SelectAll("articles","*",null,"ndate DESC",$from,$count);
  $itemsCount = $db->CountAll("articles");
  $html = " <div class='content'>
              <div class='main-box'>
                <h2>مطالب خواندنی ";
                if ($_GET["pid"]>1){
                  $html.="<span>(صفحه {$_GET[pid]})</span>";
                }

  $html.="</h2><div class='line'></div>
  <div class='badboy'></div>";  

  foreach($articles as $key => $post){
  	$ndate = ToJalali($post["ndate"]," l d F  Y ساعت H:m");
  	$post["userid"] = GetUserName($post["userid"]);
    $body= $post["body"];
    $body= strip_tags($body);
    $body= (mb_strlen($body)>500) ? mb_substr($body,0,500,"UTF-8")."..." : $body;
  	$html.=<<<cd
		<div class='box-right'> 
		<div class='title'>
			<a href="article-{$post["id"]}.html" title='{$post["subject"]}'><p>{$post["subject"]}</p></a>
		</div>
		<div class='time'>
			<p><span>زمان ثبت:</span> {$ndate}</p>  
			<p><span>توسط:</span> {$post["userid"]} </p>
			<p><span>منبع:</span> {$post["resource"]}</p>  
		</div>
		<div class='badboy'></div>
  		<div class="detail">
  			<p>{$body}</p>
cd;
      if (mb_strlen($body)>500){
      $html.=<<<cd
      <a href="article-{$post[id]}.html" title="ادامه مطلب" class="button">ادامه مطلب</a>
cd;
      }
      $html.=<<<cd
  		</div>
		<div class='badboy'></div>
	   </div>
cd;
  }
$html.=" </div> ";  
$linkFormat = 'articles'.$pid='%PN%'.'.html';;
$maxPageNumberAtTime = GetSettingValue('Max_Page_Number',0);
$pageNos = Pagination($itemsCount, $maxItemsInPage, $pageNo, $maxPageNumberAtTime, $linkFormat);
$html .= '<center>' . $pageNos . '</center> </div>';
return $html;
?>