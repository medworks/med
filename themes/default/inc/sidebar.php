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
</div>
<div class="badboy"></div>