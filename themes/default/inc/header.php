<?php
	include_once("classes/functions.php");
	$Site_Title = GetSettingValue('Site_Title',0);
	$Site_KeyWords = GetSettingValue('Site_KeyWords',0);
	$Site_Describtion = GetSettingValue('Site_Describtion',0);
?>
<!doctype html>
<html lang="fr">
<head>
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<meta charset="UTF-8">
	<title><?php echo $Site_Title;?></title>
	<meta name="description" content="<?php echo $Site_Describtion;?> "/>
	<meta name="keywords" content="<?php echo $Site_KeyWords;?> "/>
	<link rel="stylesheet" href="themes/css/1styles.css" />
	<link rel="stylesheet" href="themes/css/prettyphoto.css" />
	<link rel="stylesheet" href="themes/css/validationEngine.css"/>
	<link rel="stylesheet" href="themes/default/style.css" />

	<script src="lib/js/jquery.js" type="text/javascript"></script>
	<script src="lib/js/jquery.cycle.all.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine-en.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine.js" type="text/javascript"></script>	
	<script src="lib/js/CFInstall.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine-en.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine.js" type="text/javascript"></script>
	<script src="themes/js/jquery.prettyphoto.js" type="text/javascript"></script>	
	<script src="themes/default/js/script.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
		<script src="lib/js/html5shiv.js"></script>
	<![endif]-->
	<link rel="Shortcut Icon" href="themes/default/favicon.ico" />
</head>
<body>
  <script>
   CFInstall.check({
     mode: "overlay",
     destination: "http://media.mediateq.ir"
   });
  </script>
	<?php
	  include_once("./config.php");
	  include_once("./classes/database.php");
	  include_once("./lib/persiandate.php");

	  $datetime = ToJalali(date('Y-M-d H:i:s'),'l، d F Y');
	  $db = database::GetDatabase();
  	?>
  <div class="container">
	<header>
		<div class="top">
			<div class="time right"><p> <?php echo $datetime ?> </p></div>
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
					<li><a href="?item=gallery">گالری تصاویر</a></li>
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
				<a href="#"><img src="./themes/default/images/main/text-logo.png"></a>
			</div>
		</div>
		<div class="badboy"></div>
		<div class="main-menu">
			<menu>
				<li><a href="./"></a></li>
				<li><a href="?item=about">درباره ما</a></li>
				<li><a href="?item=works&act=do">کارهای ما</a></li>
				<li><a href="?item=news&act=do">اخبار</a></li>
				<li><a href="?item=gallery">گالری تصاویر</a></li>
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
  	  				$news = $db->SelectAll('news',NULL,NULL," ndate DESC");
					for($i=0 ; $i<count($news) ; $i++){
						$subject= $news[$i]["subject"];
						$subject= (mb_strlen($subject)>100) ? mb_substr($subject,0,100,"UTF-8")."..." : $subject;
						echo "<li><a href='?item=fullnews&act=do&wid={$news[$i]["id"]}' title='{$news[$i]["subject"]}'>$subject</a></li>";
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