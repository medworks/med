<?php
	include_once("./classes/database.php");
	include_once("./lib/persiandate.php");
?>
<div class="sidebar">
	<!-- ***********Slideshow************ -->
	<div class="social simple-box">
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
	<!-- ***********Login Panel************ -->
	<div class="login-panel main-box">
		<h2>ورود کاربران</h2>
		<div class="line"></div>
		<div class="badboy"></div>
		<div class="login box-left">
			<form action="">
				<p><input type="text" name="username" class="username" value="نام کاربری" onfocus="if (this.value == 'نام کاربری') {this.value = '';}" onblur="if (this.value == '') {this.value = 'نام کاربری';}" /></p>
				<p><input type="password" name="password" class="password" value="رمز عبور" onfocus="if (this.value == 'رمز عبور') {this.value = '';}" onblur="if (this.value == '') {this.value = 'رمز عبور';}" /></p>
				<p class="right"><input type="submit" name="submit" class="submit" value="ورود" /></p>
				<label class="right">به خاطر بسپار <input type="checkbox" checked="checked" name="remember" class="remember"/></label>
			</form>
			<div class="badboy"></div>
			<a href="#" class="forget">رمز خود را فراموش کرده ام!</a>
			<div class="badboy"></div>
		</div>
	</div>
	<!-- ***********Gallery Slideshow************ -->
	<div class="gallery flexslider simple-box" id="slider">
		<ul class="slides">
			<li>
				<a href="#"><img src="./themes/default/images/main/others/slide1.jpg" alt=""></a>
				<div class="slider-caption">
					<h2><a href="#">اسلاید شماره 1</a></h2>
				</div>
			</li>
			<li>
				<a href="#"><img src="./themes/default/images/main/others/slide2.jpg" alt=""></a>
				<div class="slider-caption">
					<h2><a href="#">اسلاید شماره 2</a></h2>
				</div>
			</li>
		</ul>
	</div>
	<script>
		jQuery(window).load(function() {
		  jQuery('#slider').flexslider({
			animation: "fade",
			slideshowSpeed: 7000,
			animationSpeed: 600,
			randomize: false,
			pauseOnHover: true,
			controlNav: false
		  });
		});
	</script>
	<!-- ***********Tabed menu************ -->
	<div class="widget" id="tabbed-widget">
		<div class="box-left tab">
			<div class="widget-container">
				<div class="widget-top">
					<ul class="tabs posts-taps">
						<li class="tabs active"><a href="#tab1">کارهای ما</a></li>
						<li class="tabs"><a href="#tab2">اخبار</a></li>
						<li class="tabs"><a href="#tab3">تصاویر</a></li>
						<li class="tabs"><a href="#tab4">پست ها</a></li>
					</ul>
				</div>
				<div class="tabs-wrap" id="tab1">
					<ul>
						<?php
							$db = database::getDatabase();
  							$works = $db->SelectAll('works',NULL,NULL," fdate DESC");
  							 for($i=0 ; $i<5 ; $i++){
  							 	$sdate = ToJalali($works[$i]["sdate"]," l d F  Y ");
    							$fdate = ToJalali($works[$i]["fdate"]," l d F  Y ");
    							echo "<li>
    									<div class='pic right'>
    										<a href='?item=fullworks&act=do&wid={$works[$i]["id"]}' title='{$works[$i]["subject"]}'>
    											<img src='{$works[$i]["image"]}' alt='{$works[$i]["subject"]}'>
    										</a>
    									</div>
    									<div class='detail right'>
    										<h3>
    											<a href='?item=fullworks&act=do&wid={$works[$i]["id"]}' title='{$works[$i]["subject"]}'>{$works[$i]["subject"]}</a>
    										</h3>
    										<span class='date'>
    											<span>$sdate</span>
    										</span>
    										<span class='date'>
    											<span>$fdate</span>
    										</span>
    									</div>
    								  </li>";
  							 }
						?>
					</ul>
				</div>
				<div class="tabs-wrap" id="tab2">
					<ul>
						<?php
							$db = database::getDatabase();
  							$news = $db->SelectAll('news',NULL,NULL," ndate DESC");
  							 for($i=0 ; $i<5 ; $i++){
  							 	$ndate = ToJalali($news[$i]["sdate"]," l d F  Y ");
    							echo "<li>
    									<div class='pic right'>
    										<a href='?item=fullnews&act=do&wid={$news[$i]["id"]}' title='{$news[$i]["subject"]}'>
    											<img src='{$news[$i]["image"]}' alt='{$news[$i]["subject"]}'>
    										</a>
    									</div>
    									<div class='detail right'>
											<h3>
												<a href='?item=fullnews&act=do&wid={$news[$i]["id"]}' title='{$news[$i]["subject"]}'>{$news[$i]["subject"]}</a>
											</h3>
											<span class='date'>
												<span>$ndate</span>
											</span>
										</div>
    								  </li>";
  							 }
						?>
					</ul>
				</div>
				<div class="tabs-wrap" id="tab3"></div>
				<div class="tabs-wrap" id="tab4"></div>
			</div>
			<div class="badboy"></div>
		</div>
	</div>
</div>
<div class="badboy"></div>