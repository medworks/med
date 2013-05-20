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
				<div class="slideshow">
					<ul>
						<li>
							<img src="./images/others/slide1.jpg" alt="">
						</li>
					</ul>
				</div>
				<div class="badboy"></div>
				<div class="recent-works">
					<h2>کارهای اَخیر</h2>
					<div class="line"></div>
					<div class="badboy"></div>
					<div class="works">
						<ul>
							<li>
								<a href="#"><img src="./images/others/works.jpg" alt=""></a>
								<h3>توضیحات...</h3>
								<p>21 اردیبهشت 1392</p>
							</li>
							<li>
								<a href="#"><img src="./images/others/works.jpg" alt=""></a>
								<h3>توضیحات...</h3>
								<p>21 اردیبهشت 1392</p>
							</li>
							<li>
								<a href="#"><img src="./images/others/works.jpg" alt=""></a>
								<h3>توضیحات...</h3>
								<p>21 اردیبهشت 1392</p>
							</li>
						</ul>
						<div class="badboy"></div>
					</div>
				</div>
			</div>
			<div class="sidebar right">
				<div class="social">
					<ul>
						<li>
							<a href="#" class="dribble"></a>
						</li>
						<li>
							<a href="#" class="facebook"></a>
						</li>
						<li>
							<a href="#" class="twitter"></a>
						</li>
						<li>
							<a href="#" class="vimeo"></a>
						</li>
						<li>
							<a href="#" class="youtube"></a>
						</li>
						<li>
							<a href="#" class="rss"></a>
						</li>
					</ul>
					<div class="badboy"></div>
				</div>
			</div>
			<div class="badboy"></div>
		</section>

		<footer>
			
		</footer>
	</div>
</body>
</html>