<!-- ****************Content (Right) part****************** -->
<?php
	if (GetPageName($_GET['item'],$_GET['act'])){
		echo include_once GetPageName($_GET['item'],$_GET['act']);
	}
	else{

	include_once("./classes/database.php");
	include_once("./lib/persiandate.php");

?>
<div class="content">
	<!-- ***********Slideshow************ -->
	<div id="ei-slider" class="slideshow ei-slider">
		<ul class="ei-slider-large">
			<li>
				<img src="./themes/default/images/main/others/slide1.jpg" alt="">
				<div class="ei-title">
					<h2><a href="#">اسلاید شماره 1</a></h2>
					<h3>جزئیات اسلاید شماره 1... جزئیات اسلاید شماره 1... جزئیات اسلاید شماره 1... </h3>
				</div>
			</li>
			<li>
				<img src="./themes/default/images/main/others/slide2.jpg" alt="">
				<div class="ei-title">
					<h2><a href="#">اسلاید شماره 2</a></h2>
					<h3>جزئیات اسلاید شماره 2... جزئیات اسلاید شماره 2... جزئیات اسلاید شماره 2... </h3>
				</div>
			</li>
			<li>
				<img src="./themes/default/images/main/others/slide3.jpg" alt="">
				<div class="ei-title">
					<h2><a href="#">اسلاید شماره 3</a></h2>
					<h3>جزئیات اسلاید شماره 3... جزئیات اسلاید شماره 3... جزئیات اسلاید شماره 3... </h3>
				</div>
			</li>
			<li>
				<img src="./themes/default/images/main/others/slide4.jpg" alt="">
				<div class="ei-title">
					<h2><a href="#">اسلاید شماره 4</a></h2>
					<h3>جزئیات اسلاید شماره 4... جزئیات اسلاید شماره 4... جزئیات اسلاید شماره 4... </h3>
				</div>
			</li>
		</ul>
		<ul class="ei-slider-thumbs">
			<li class="ei-slider-element"></li>
			<li><a href="#"></a><img src="./themes/default/images/main/others/slide1.jpg" alt=""></li>
			<li><a href="#"></a><img src="./themes/default/images/main/others/slide2.jpg" alt=""></li>
			<li><a href="#"></a><img src="./themes/default/images/main/others/slide3.jpg" alt=""></li>
			<li><a href="#"></a><img src="./themes/default/images/main/others/slide4.jpg" alt=""></li>
		</ul>
	</div>
	<script type="text/javascript">
	    jQuery(function() {
	        jQuery('#ei-slider').eislideshow({
				animation			: 'center',
				autoplay			: true,
				slideshow_interval	: 6000,
				speed          		: 800,
				titlesFactor		: 0.60,
				titlespeed          : 1000,
				thumbMaxWidth       : 100
	        });
	    });
	</script>
	<div class="badboy"></div>
	<!-- ***********Recent Works************ -->
	<div class="recent-works main-box">
		<h2>کارهای ما</h2>
		<div class="line"></div>
		<div class="badboy"></div>
		<div class="works box-right">
			<div id="slideshow-rec">
				<?php
					$db = database::getDatabase();
						$works = $db->SelectAll('works',NULL,NULL," fdate DESC");
					for($i=0 ; $i<count($works) ; $i++){
						echo "<div class='scroll-item'>
								<a href='#' title='{$works[$i]["subject"]}'><img src='{$works[$i]["image"]}' alt='{$works[$i]["subject"]}'></a>
								<h3><a href='#'>{$works[$i]["subject"]}</a></h3>
								<p><span>شروع: </span>{$works[$i]["sdate"]}</p><br />
								<p><span>پایان: </span>{$works[$i]["fdate"]}</p>
							  </div>";
					}

				?>
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
					timeout: 6000,
					pager:  '#nav',
					slideExpr: '.group_items',
					speed: 700,
					pause: true
				});
			});
	  });
	</script>
	<!-- ***********tabs************ -->
	<div class="box-right cat-box-content cat-box tab" id="cats-tabs-box">
		<div class="cat-tabs-header">
			<ul>
				<li><a href="#catab3">کارهای ما</a></li>
				<li><a href="#catab4">اخبار</a></li>
				<li><a href="#catab1">تصاویر</a></li>
			</ul>
		</div>
		<div class="cat-tabs-wrap" id="catab3">
			<ul>
				<li class="first-news">
					<div class="pic first-tab-pic">
						<a href="#" title="">
							<img src="./themes/default/images/main/others/slide2.jpg" alt="">
							<span class="overlay"></span>
						</a>
					</div>
				</li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
			<div class="badboy"></div>
		</div>
		<div class="cat-tabs-wrap" id="catab4">
			<ul>
				
			</ul>
			<div class="badboy"></div>
		</div>
		<div class="cat-tabs-wrap" id="catab1">
			<ul></ul>
			<div class="badboy"></div>
		</div>
	</div>
</div>
<?php 
	}
?>