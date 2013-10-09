<?php
	include_once("classes/functions.php");
	include_once("classes/seo.php");
	$seo = Seo::GetSeo();	
?>
<!doctype html>
<html lang="fa">
<head>
	<title><?php echo $seo->Site_Title;?></title>

	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=IE8">
	<meta charset="UTF-8">
	<meta name="google-site-verification" content="-v04lxRhdr83WUdcvx52bws3lGnycYZQE03LNstOteg" />
	<meta name="description" content="<?php echo $seo->Site_Describtion;?>"/>
	<meta name="keywords" content="<?php echo $seo->Site_KeyWords;?>"/>
	<meta name="robots" content="INDEX,FOLLOW">
	<meta http-equiv="Content-Language"  content="Fa">

	<link rel="stylesheet" href="themes/css/1styles.css" />
	<link rel="stylesheet" href="themes/css/prettyphoto.css" />
	<link rel="stylesheet" href="themes/css/validationEngine.css"/>
	<link rel="stylesheet" href="themes/default/style.css" />

	<script src="lib/js/jquery.js" type="text/javascript"></script>
	<script src="lib/js/jquery.cycle.all.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine-en.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine.js" type="text/javascript"></script>	
	<script src="lib/js/jquery.validationEngine-en.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine.js" type="text/javascript"></script>
	<script src="themes/js/jquery.prettyphoto.js" type="text/javascript"></script>
	<script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyDun8B3aM33iKhRIZniXwprr2ztGlzgnrQ&sensor=false'></script>
	<script src="themes/default/js/script.js" type="text/javascript"></script>
	<!-- Piwik -->
		<script type="text/javascript"> 
		  var _paq = _paq || [];
		  _paq.push(['trackPageView']);
		  _paq.push(['enableLinkTracking']);
		  (function() {
			var u=(("https:" == document.location.protocol) ? "https" : "http") + "://mediateq.ir/analys//";
			_paq.push(['setTrackerUrl', u+'piwik.php']);
			_paq.push(['setSiteId', 1]);
			var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
			g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
		  })();

		</script>
		<noscript><p><img src="http://mediateq.ir/analys/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
	<!-- End Piwik Code -->
	<!--[if lt IE 9]>
		<script src="lib/js/html5shiv.js"></script>
	<![endif]-->
	<link rel="Shortcut Icon" href="themes/default/favicon.ico" type="image/x-icon"/>
	<link rel="icon" href="themes/personal/favicon.ico" type="image/x-icon"/>
</head>
<body>
	<?php
	  include_once("./config.php");
	  include_once("./classes/database.php");
	  include_once("./lib/persiandate.php");

	  $datetime = ToJalali(date('Y-M-d H:i:s'),'l، d F Y');
	  $db = Database::GetDatabase();
  	?>
  <div class="container">
	<header>
		<div class="top">
			<div class="time right"><p> <?php echo $datetime ?> </p></div>
			<div class="search left">
				<form action="./search.php" method="post" name="frmsearch">
					<p></p>
					<input type="text" name="search" class="search-box right" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}" />
					<input type="submit" name="submit" class="submit left" value="" />
					<input type="hidden" name="mark" value="search" />
					<span class="left"></span>
				</form>

				<div class="badboy"></div>
			</div>
			<div class="top-menu">
				<span class="left"><a href="?item=search&act=do" class="advance-search ttip" title="جستجوی پیشرفته"></a></span>
				<menu class="menu">
					<li><a href="./">صفحه اصلی</a></li>
					<li><a href="?item=about">درباره ما</a></li>
					<li><a href="?item=gallery">گالری تصاویر</a></li>
					<!-- <li><a href="#">خدمات</a>
						<menu>
							<li><a href="#">خدمات 1</a></li>
							<li><a href="#">خدمات 2</a></li>
							<li><a href="#">خدمات 3</a></li>
							<li><a href="#">خدمات 4</a></li>
							<li><a href="#">خدمات 5</a></li>
						</menu>
					</li> -->
					<li><a href="?item=contact">تماس با ما</a></li>
				</menu>
				<div class="badboy"></div>
			</div>
		</div>
		<div class="badboy"></div>
		<div class="mid">
			<div class="logo left">
				<h2>
					<a href="./" title="مدیا تک">
						<img src="./themes/default/images/logo.png" alt="مدیا تک">
						<strong>Mediateq....</strong>
					</a>
				</h2>
			</div>
			<div class="ads right">
				<a href="./" title="مدیا تک"><img src="./themes/default/images/text-logo.png" alt="mediateq"></a>
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
				<!-- <li><a href="#">خدمات</a>
					<menu>
						<li><a href="#">خدمات 1</a></li>
						<li><a href="#">خدمات 2</a></li>
						<li><a href="#">خدمات 3</a></li>
						<li><a href="#">خدمات 4</a></li>
						<li><a href="#">خدماتر 5</a></li>
					</menu>
				</li> -->
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
					for($i=0 ; $i<5 ; $i++){
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