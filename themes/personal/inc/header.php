<?php
	$Site_Title = GetSettingValue('Site_Title',0);
	$Site_KeyWords = GetSettingValue('Site_KeyWords',0);
	$Site_Describtion = GetSettingValue('Site_Describtion',0);
	$tel = GetSettingValue('Tell_Number',0);
?>
<!doctype html>
<html lang="fr">
<head>
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<meta charset="UTF-8">
	<title><?php echo $Site_Title;?></title>
	<link rel="stylesheet" href="themes/css/1styles.css" />
	<link rel="stylesheet" href="themes/css/prettyphoto.css" />
	<link rel="stylesheet" href="themes/css/validationEngine.css"/>
	<link rel="stylesheet" href="themes/personal/settings.css" />
	<link rel="stylesheet" href="themes/personal/style.css" />

	<script src="lib/js/jquery.js" type="text/javascript"></script>
	<script src="lib/js/jquery.cycle.all.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine-en.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine.js" type="text/javascript"></script>	
	<script src="lib/js/CFInstall.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine-en.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine.js" type="text/javascript"></script>
	<script src="themes/js/jquery.prettyphoto.js" type="text/javascript"></script>	
	<script src="themes/personal/js/jquery.themepunch.plugins.min.js" type="text/javascript"></script>
	<script src="themes/personal/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
	<script src="themes/personal/js/jquery.hoverdir.min.js" type="text/javascript"></script>
	<script src="themes/personal/js/jquery.isotope.min.js" type="text/javascript"></script>
	<script src="themes/personal/js/script.js" type="text/javascript"></script>
	<script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyDun8B3aM33iKhRIZniXwprr2ztGlzgnrQ&sensor=false'></script>
	<!--[if lt IE 9]>
		<script src="lib/js/html5shiv.js"></script>
	<![endif]-->
	<link rel="Shortcut Icon" href="themes/personal/favicon.ico" />
</head>
<body>
	<div class="container">
		<!-- Header part -->
		<header>
			<div class="logo left">
				<h2>
					<a href="./" title="Mediateq"><img src="themes/personal/images/logo.png" alt="Mediateq" /></a>
					<strong>Mediateq</strong>
				</h2>
			</div>
			<div class="information right">
				<ul>
					<li ><span class="email-icon"></span><a href="mailto:info@mediateq.ir" title="Send mail" target="_blank">info<span class="at"></span>mediateq.ir</a></li>
					<li class="ltr"><span class="tel-icon"></span><a title="Tel"><?php echo $tel; ?></a></li>
				</ul>	
			</div>
			<div class="badboy"></div>
		</header>	