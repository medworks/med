<?php	
	include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");
	$db = database::getDatabase();
 	$works = $db->Select('works',NULL,"id={$_GET[wid]}"," sdate DESC");
	$sdate = ToJalali($works["sdate"]," l d F  Y ");
	$fdate = ToJalali($works["fdate"]," l d F  Y ");
	$body= $works['body'];
	$body= strip_tags($body);
$html=<<<ht
	<div class="content single-page">
		<div class="title-menu">
			<menu>
				<li><a href="./">صفحه اصلی</a><span>/</span></li>
				<li><a href="?item=works&act=do">کارهای ما</a><span>/</span></li>
				<li><p>{$works[subject]}</p></li>
			</menu>
		<div class="badboy"></div>
		</div>
	<div class="box-right singlepage-box">
		<div class="image">
			<img src='{$works[image]}' alt='{$works[subject]}'>
		</div>
		<div class="tit-da-de">
			<div class="title">
				<p>{$works[subject]}</p>
			</div>
			<div class="date">
				<p><span>تاریخ شروع: {$sdate} </span></p>
				<p><span>تاریخ پایان: {$fdate}</span></p>
			</div>
			<div class="detail">
				<div class="overview left">
					<ul>
						<li>
							<h5>Graphic - 78%</h5>
							<span>
								<span style="width:78%"></span>
							</span>
						</li>
						<li>
							<h5>Dynamic - 90%</h5>
							<span>
								<span style="width:90%"></span>
							</span>
						</li>
						<li>
							<h5>Jquery - 58%</h5>
							<span>
								<span style="width:58%"></span>
							</span>
						</li>
						<li>
							<h5>Zepto - 38%</h5>
							<span>
								<span style="width:38%"></span>
							</span>
						</li>
						<li>
							<h5>Static - 10%</h5>
							<span>
								<span style="width:10%"></span>
							</span>
						</li>
					</ul>
				</div>
				<p>{$body}</p>
			</div>
			<div class="badboy"></div>
		</div>
	</div>
</div>
ht;
return $html;
?>