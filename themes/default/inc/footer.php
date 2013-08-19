</section>
<!-- END of Content Part -->
<!-- <section class="ads-bot">
	<a href="#">
		<img src="./themes/default/images/main/others/ads.jpg" alt="">
	</a>
</section> -->
	</div>
	<footer>
		<div class="container">
			<div class="first">
				<div class="title"><h4>اخبار</h4></div>
				<div class="content">
					<ul>
						<?php
							$db = database::GetDatabase();
		  					$news = $db->SelectAll('news',NULL,NULL," ndate DESC");
							for($i=0 ; $i<3 ; $i++){
								if($news[$i]['subject']!=null){
			  						$ndate = ToJalali($news[$i]["ndate"]," l d F  Y-H:m");
									echo "<li>
											<div class='pic'><a href='?item=fullnews&act=do&wid={$news[$i][id]}' title='{$news[$i]["subject"]}'><img src='{$news[$i]["image"]}'alt='{$news[$i]["subject"]}'></a></div>
											<h3><a href='?item=fullnews&act=do&wid={$news[$i][id]}' title='{$news[$i]["subject"]}'>{$news[$i]["subject"]}</a></h3>
											<span class='date'>{$ndate}</span>
										</li>";
							}}
						?>
					</ul>
					<div class="badboy"></div>
				</div>
			</div>
			<div class="second">
				<div class="title"><h4>گالری تصاویر</h4></div>
				<div class="content">
					<ul>
						<?php
							$db = database::GetDatabase();
		  					$gallery = $db->SelectAll('gallery',NULL,NULL," id DESC");
		  					
							for($i=0 ; $i<3 ; $i++){
								if($gallery[$i]['image']!=null){
									echo "<li>
											<div class='pic'><a href='{$gallery[$i][image]}' rel='prettyphoto[gallery1]' title='{$gallery[$i]["subject"]}'><img src='{$gallery[$i]["image"]}'alt='{$gallery[$i]["subject"]}'></a></div>
											<h3>{$gallery[$i]["subject"]}</h3>
										</li>";
							}}
						?>
					</ul>
					<div class="badboy"></div>
				</div>
			</div>
			<div class="third">
				<div class="title"><h4>پروژهای اخیر</h4></div>
				<div class="content">
					<ul>
						<?php
							$db = database::GetDatabase();
		  					$works = $db->SelectAll('works',NULL,NULL," fdate DESC");
		  					
							for($i=0 ; $i<3 ; $i++){
								if($works[$i]['subject']!=null){
									$sdate = ToJalali($works[$i]["sdate"]," l d F  Y"); 
			  						$fdate = ToJalali($works[$i]["fworksdate"]," l d F  Y"); 
									echo "<li>
											<div class='pic'><a href='?item=fullworks&act=do&wid={$works[$i][id]}' title='{$works[$i]["subject"]}'><img src='{$works[$i]["image"]}'alt='{$works[$i]["subject"]}'></a></div>
											<h3><a href='?item=fullworks&act=do&wid={$works[$i][id]}' title='{$works[$i]["subject"]}'>{$works[$i]["subject"]}</a></h3>
											<span class='date'>{$sdate}</span>
											<span class='date'>{$fdate}</span>
										</li>";
							}}
						?>
					</ul>
					<div class="badboy"></div>
				</div>
			</div>
			<div class="forth">
				<div class="title"><h4>لینک های مفید</h4></div>
				<div class="content">
					<ul>
						<li>
							<div class='pic'><a href='http://php.net' title='php' target="_blank"><img src='./themes/default/images/php-logo.jpg' alt='php'></a></div>
							<h3><a href='http://php.net' title='php' target="_blank">Php</a></h3>
						</li>
						<li>
							<div class='pic'><a href='http://zeptojs.com' title='Zepto.js' target="_blank"><img src='./themes/default/images/zepto-logo.jpg' alt='zepto.js'></a></div>
							<h3><a href='http://zeptojs.com' title='Zepto.js' target="_blank">Zepto.js</a></h3>
						</li>
						<li>
							<div class='pic'><a href='http://jquery.com/' title='jquery' target="_blank"><img src='./themes/default/images/jquery_logo.jpg' alt='jquery'></a></div>
							<h3><a href='http://jquery.com/' title='jquery' target="_blank">Jquery</a></h3>
						</li>
					</ul>
					<div class="badboy"></div>
				</div>
			</div>
			<div class="badboy"></div>
		</div>
	</footer>
	<section class="bot-footer">
		<div class="container">
			<div class="copyright left">
				<a href="#">Mediateq</a>
				 © Copyright 2013, All Rights Reserved
			</div>
			<?php
				$gplus = GetSettingValue('Gplus_Add',0);
				$facebook = GetSettingValue('FaceBook_Add',0);
				$twitter = GetSettingValue('Twitter_Add',0);
				$rss = GetSettingValue('Rss_Add',0);
			?>
			<div class="social right">
				<ul>
					<li><a href="#" class="ttip" original-title="Pinterest"><img src="./themes/default/images/pinterest.png" alt="Pinterest"></a></li>
					<li><a href="#" class="ttip" original-title="Dribbble"><img src="./themes/default/images/dribbble.png" alt="Dribbble"></a></li>
					<li><a href="#" class="ttip" original-title="Youtube"><img src="./themes/default/images/youtube.png" alt="Youtube"></a></li>
					<li><a href="#" class="ttip" original-title="Behance"><img src="./themes/default/images/behance.png" alt="Behance"></a></li>
					<li><a href="#" class="ttip" original-title="Instagram"><img src="./themes/default/images/instagram.png" alt="Instagram"></a></li>
					<li><a href="http://<?php echo $rss; ?>" target="_blank" class="ttip" original-title="Rss"><img src="./themes/default/images/rss.png" alt="Rss"></a></li>
					<li><a href="https://<?php echo $facebook; ?>" target="_blank" class="ttip" original-title="Facebook"><img src="./themes/default/images/facebook.png" alt="Facebook"></a></li>
					<li><a href="https://<?php echo $twitter; ?>" target="_blank" class="ttip" original-title="Twitter"><img src="./themes/default/images/twitter.png" alt="Twitter"></a></li>
					<li><a href="https://<?php echo $gplus; ?>" class="ttip" original-title="Google plus"><img src="./themes/default/images/gplus.png" alt="Google plus"></a></li>
				</ul>
			</div>
			<div class="badboy"></div>
		</div>
	</section>
	<div id="topcontrol"></div>
	<script type="text/javascript">
		  $(document).ready(function(){
		    $("a[rel^='prettyphoto']").prettyPhoto({
		    	autoplay_slideshow: true,
		    	show_title: false,
		    });
		  });
	</script>
</body>
</html>