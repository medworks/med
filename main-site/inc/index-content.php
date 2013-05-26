<section class="main-content">
	<div class="content right">
		<div id="ei-slider" class="slideshow ei-slider box">
			<ul class="ei-slider-large">
				<li>
					<img src="./images/others/slide1.jpg" alt="">
					<div class="ei-title">
						<h2><a href="#">اسلاید شماره 1</a></h2>
						<h3>جزئیات اسلاید شماره 1... جزئیات اسلاید شماره 1... جزئیات اسلاید شماره 1... </h3>
					</div>
				</li>
				<li>
					<img src="./images/others/slide2.jpg" alt="">
					<div class="ei-title">
						<h2><a href="#">اسلاید شماره 2</a></h2>
						<h3>جزئیات اسلاید شماره 2... جزئیات اسلاید شماره 2... جزئیات اسلاید شماره 2... </h3>
					</div>
				</li>
				<li>
					<img src="./images/others/slide3.jpg" alt="">
					<div class="ei-title">
						<h2><a href="#">اسلاید شماره 3</a></h2>
						<h3>جزئیات اسلاید شماره 3... جزئیات اسلاید شماره 3... جزئیات اسلاید شماره 3... </h3>
					</div>
				</li>
				<li>
					<img src="./images/others/slide4.jpg" alt="">
					<div class="ei-title">
						<h2><a href="#">اسلاید شماره 4</a></h2>
						<h3>جزئیات اسلاید شماره 4... جزئیات اسلاید شماره 4... جزئیات اسلاید شماره 4... </h3>
					</div>
				</li>
			</ul>
			<ul class="ei-slider-thumbs">
				<li class="ei-slider-element"></li>
				<li><a href="#"></a><img src="./images/others/slide1.jpg" alt=""></li>
				<li><a href="#"></a><img src="./images/others/slide2.jpg" alt=""></li>
				<li><a href="#"></a><img src="./images/others/slide3.jpg" alt=""></li>
				<li><a href="#"></a><img src="./images/others/slide4.jpg" alt=""></li>
			</ul>
		</div>

		<script type="text/javascript">
		    jQuery(function() {
		        jQuery('#ei-slider').eislideshow({
					animation			: 'center',
					autoplay			: true,
					slideshow_interval	: 3000,
					speed          		: 800,
					titlesFactor		: 0.60,
					titlespeed          : 1000,
					thumbMaxWidth       : 100
		        });
		    });
		</script>

		<div class="badboy"></div>
		<div class="recent-works main-box">
			<h2>کارهای اَخیر</h2>
			<div class="line"></div>
			<div class="badboy"></div>
			<div class="works box-right">
				<div id="slideshow-rec">
					<div class="scroll-item">
						<a href="#"><img src="./images/others/slide1.jpg" alt="" ></a>
						<h3><a href="#">عنوان شماره 1</a></h3>
						<p>5 اردیبهشت 1392</p>
					</div>
					<div class="scroll-item">
						<a href="#"><img src="./images/others/slide2.jpg" alt="" ></a>
						<h3><a href="#">عنوان شماره 1</a></h3>
						<p>5 اردیبهشت 1392</p>
					</div>
					<div class="scroll-item">
						<a href="#"><img src="./images/others/slide3.jpg" alt="" ></a>
						<h3><a href="#">عنوان شماره 2</a></h3>
						<p>5 اردیبهشت 1392</p>
					</div>
					<div class="scroll-item">
						<a href="#"><img src="./images/others/slide4.jpg" alt="" ></a>
						<h3><a href="#">عنوان شماره 3</a></h3>
						<p>5 اردیبهشت 1392</p>
					</div>
					<div class="scroll-item">
						<a href="#"><img src="./images/others/works.jpg" alt="" ></a>
						<h3><a href="#">عنوان شماره 4</a></h3>
						<p>5 اردیبهشت 1392</p>
					</div>
				</div>
				<div class="badboy"></div>
				<div id="nav" class="scroll-nav"></div>
				<div class="badboy"></div>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				var vids = jQuery("#slideshow-rec .scroll-item");
				for(var i = 0; i < vids.length; i+=4) {
				  vids.slice(i, i+4).wrapAll('<div class="group_items"></div>');
				}
				jQuery(function() {
					jQuery('#slideshow-rec').cycle({
						fx:     'scrollHorz',
						timeout: 3000,
						pager:  '#nav',
						slideExpr: '.group_items',
						speed: 700,
						pause: true
					});
				});
		  });
		</script>

	</div>
	<div class="sidebar right">
		<div class="social box">
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
		<div class="login-panel main-box">
			<h2>ورود کاربران</h2>
			<div class="line"></div>
			<div class="badboy"></div>
			<div class="login box-left">
				<form action="">
					<p><input type="text" name="username" class="username" value="نام کاربری" onfocus="if (this.value == 'نام کاربری') {this.value = '';}" onblur="if (this.value == '') {this.value = 'نام کاربری';}" /></p>
					<p><input type="password" name="password" class="password" value="رمز عبور" onfocus="if (this.value == 'رمز عبور') {this.value = '';}" onblur="if (this.value == '') {this.value = 'رمز عبور';}" /></p>
					<p class="right"><input type="submit" name="submit" class="submit" value="ورود" /></p>
					<label class="right"><input type="checkbox" checked="checked" name="remember" class="remember"/> به خاطر بسپار</label>
				</form>
				<div class="badboy"></div>
				<a href="#" class="forget">رمز خود را فراموش کرده ام!</a>
				<div class="badboy"></div>
			</div>
		</div>
	</div>
	<div class="badboy"></div>
</section>