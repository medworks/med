<?php
	function GetPage($func)
	{
		switch($func)
		{
			case 'initial':
				return "index.php";
			break;
			case 'home':
                return "index-content.php";
			break;
			case 'contact':
                return "themes/personal/contact.php";
			break;
			case 'works':
                return "themes/personal/works.php";
			break;
			case 'news':
                return "themes/personal/news.php";
			break;
		}
	}
?>
<section class="middle">
	<div class="main-menu">
		<menu>
			<li><a href="?item=home"><span class="home-icon"></span>خانه</a>
				<menu>
					<li><a href="#">خانه 1</a></li>
					<li><a href="#">خانه 2</a></li>
					<li><a href="#">خانه 3</a></li>
					<li><a href="#">خانه 4</a></li>
				</menu>
			</li>
			<li><a href="?item=works"><span class="works-icon"></span>کارهای ما</a></li>
			<li><a href="?item=news"><span class="news-icon"></span>اخبار</a></li>
			<li><a href="?item=contact"><span class="contact-icon"></span>تماس با ما</a></li>
		</menu>
	</div>
	<div class="contain">
		<div class="inner">
			<div class="inner-wrap">
		<?php
		    if (isset($_GET['item']))  
		    	echo include_once GetPage($_GET['item']);
		    else
		    	header("Location: ?item=home");
		?>