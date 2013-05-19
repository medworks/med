<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="./1styles.css" />
	<link rel="stylesheet" href="./style.css" />
	<script src="./js/jquery.js" type="text/javascript"></script>
	<script src="./js/script.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
		<script src="./js/html5shiv.js"></script>
	<![endif]-->
	<link rel="Shortcut Icon" href="./favicon.ico" />
</head>
<body>
	<div class="container">
		<?php
			include("./inc/header.php");
		?>

		<?php
			include("./inc/br-news.php");
		?>

		<section class="main-content">
			<div class="content right">
				<div class="slideshow"></div>
			</div>
			<div class="sidebar left"></div>
			<div class="badboy"></div>
		</section>

		<footer>
			
		</footer>
	</div>
</body>
</html>