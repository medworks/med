<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="./themes/default/1styles.css" />
	<link rel="stylesheet" href="./themes/default/style.css" />

	<script src="./lib/js/jquery.js" type="text/javascript"></script>
	<script src="./lib/js/jquery.cycle.all.js" type="text/javascript"></script>
	<script src="./lib/js/jquery.validationEngine-en.js" type="text/javascript"></script>
	<script src="./lib/js/jquery.validationEngine.js" type="text/javascript"></script>	
	<script src="./themes/default/js/script.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
		<script src="./lib/js/html5shiv.js"></script>
		<script src="./lib/js/selectivizr-min.js"></script>
	<![endif]-->
	<link rel="Shortcut Icon" href="./themes/default/favicon.ico" />
</head>
<body>
	<?php
	  include_once("./config.php");
	  include_once("./classes/database.php");
	  include_once("./lib/persiandate.php");
	?>
	<div class="container">
		<header>
			<div class="top">
				<div class="time right"><p><?php $datetime = ToJalali(date('Y-M-d H:i:s'),'l، d F Y'); echo "$datetime"; ?></p></div>
				<div class="search left">
					<form action="">
						<input type="text" name="search" class="search-box right" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}" />
						<input type="submit" name="submit" class="submit left" value="" />
						<span class="left"></span>
					</form>
					<div class="badboy"></div>
				</div>
				<div class="top-menu">
					<menu class="menu">
						<li><a href="./">صفحه اصلی</a></li>
						<li><a href="?item=about">درباره ما</a></li>
						<li><a href="#">گالری تصاویر</a>
							<menu>
								<li><a href="#">گالری تصاویر 1</a></li>
								<li><a href="#">گالری تصاویر 2</a></li>
								<li><a href="#">گالری تصاویر 3</a></li>
								<li><a href="#">گالری تصاویر 4</a></li>
								<li><a href="#">گالری تصاویر 5</a></li>
							</menu>
						</li>
						<li><a href="#">خدمات</a>
							<menu>
								<li><a href="#">خدمات 1</a></li>
								<li><a href="#">خدمات 2</a></li>
								<li><a href="#">خدمات 3</a></li>
								<li><a href="#">خدمات 4</a></li>
								<li><a href="#">خدمات 5</a></li>
							</menu>
						</li>
						<li><a href="?item=contact">تماس با ما</a></li>
					</menu>
				</div>
			</div>
			<div class="badboy"></div>
			<div class="mid">
				<div class="logo left">
					<h2>
						<a href="./" title="مدیا تک">
							<img src="./themes/default/images/main/logo.png" alt="مدیا تک">
							<strong>Mediateq....</strong>
						</a>
					</h2>
				</div>
				<div class="ads right">
					<a href="#"><img src="./themes/default/images/main/others/ads.jpg"></a>
				</div>
			</div>
			<div class="badboy"></div>
			<div class="main-menu">
				<menu>
					<li><a href="./"></a></li>
					<li><a href="?item=about">درباره ما</a></li>
					<li><a href="?item=works&act=do">کارهای ما</a></li>
					<li><a href="?item=news&act=do">اخبار</a></li>
					<li><a href="#">گالری تصاویر</a>
						<menu>
							<li><a href="#">گالری تصاویر 1</a></li>
							<li><a href="#">گالری تصاویر 2</a></li>
							<li><a href="#">گالری تصاویر 3</a></li>
							<li><a href="#">گالری تصاویر 4</a></li>
							<li><a href="#">گالری تصاویر 5</a></li>
						</menu>
					</li>
					<li><a href="#">خدمات</a>
						<menu>
							<li><a href="#">خدمات 1</a></li>
							<li><a href="#">خدمات 2</a></li>
							<li><a href="#">خدمات 3</a></li>
							<li><a href="#">خدمات 4</a></li>
							<li><a href="#">خدماتر 5</a></li>
						</menu>
					</li>
					<li><a href="?item=contact">تماس با ما</a></li>
				</menu>
			</div>
		</header>
		<section class="br-news">
			<span class="right">خبرهای اخیر</span>
			<div class="news right">
				<ul>
					<?php
						$db = database::getDatabase();
	  					$news = $db->SelectAll('news',NULL,NULL," ndate DESC");

						for($i=0 ; $i<9 ; $i++){
							$body= substr($news[$i]["body"],3,60);
							echo "<li><a href='#' title='{$news[$i]["subject"]}'>$body...</a></li>";
						}
					?>
				</ul>
				<script type="text/javascript">
					jQuery(document).ready(function(){
										createTicker(); 
									});
				</script>
			</div>
			<div class="badboy"></div>
		</section>
		<!-- Start of Content Part -->
		<section class="main-content">