	</div>
	<footer>
		<div class="container">
			<div class="first">
				<div class="title"><h4>اخبار</h4></div>
				<div class="content">
					<ul>
						<?php
							$db = database::getDatabase();
		  					$news = $db->SelectAll('news',NULL,NULL," ndate ASC");

							for($i=0 ; $i<3 ; $i++){
								echo "<li>
										<div class='pic'><a href='#''><img src='{$news[$i]["image"]}'alt='{$news[$i]["subject"]}'></a></div>
										<h3><a href='#'>{$news[$i]["subject"]}</a></h3>
										<span class='date'>{$news[$i]["ndate"]}</span>
									</li>";
							}
						?>
					</ul>
					<div class="badboy"></div>
				</div>
			</div>
			<div class="second">
				<div class="title"><h4>گالری تصاویر</h4></div>
				<div class="content">
					<ul>
						<li>
							<div class="pic"><a href="#"><img src="./themes/default/images/main/others/works.jpg" alt=""></a></div>
							<h3><a href="#">جزئیات...  جزئیات... جزئیات... جزئیات...</a></h3>
							<span class="date">31 اردیبهشت 1392</span>
						</li>
						<li>
							<div class="pic"><a href="#"><img src="./themes/default/images/main/others/works.jpg" alt=""></a></div>
							<h3><a href="#">جزئیات...  جزئیات... جزئیات... جزئیات...</a></h3>
							<span class="date">31 اردیبهشت 1392</span>
						</li>
						<li>
							<div class="pic"><a href="#"><img src="./themes/default/images/main/others/works.jpg" alt=""></a></div>
							<h3><a href="#">جزئیات...  جزئیات... جزئیات... جزئیات...</a></h3>
							<span class="date">31 اردیبهشت 1392</span>
						</li>
					</ul>
					<div class="badboy"></div>
				</div>
			</div>
			<div class="third">
				<div class="title"><h4>پروژهای اخیر</h4></div>
				<div class="content">
					<ul>
						<?php
							$db = database::getDatabase();
		  					$works = $db->SelectAll('works',NULL,NULL," sdate DESC");

							for($i=0 ; $i<3 ; $i++){
								echo "<li>
										<div class='pic'><a href='#''><img src='{$works[$i]["image"]}'alt='{$works[$i]["subject"]}'></a></div>
										<h3><a href='#'>{$works[$i]["subject"]}</a></h3>
										<span class='date'>{$works[$i]["sdate"]}</span>
										<span class='date'>{$works[$i]["fdate"]}</span>
									</li>";
							}
						?>
					</ul>
					<div class="badboy"></div>
				</div>
			</div>
			<div class="forth">
				<div class="title"><h4>آخرین پست ها</h4></div>
				<div class="content">
					<ul>
						<li>
							<div class="pic"><a href="#"><img src="./themes/default/images/main/others/works.jpg" alt=""></a></div>
							<h3><a href="#">جزئیات...  جزئیات... جزئیات... جزئیات...</a></h3>
							<span class="date">31 اردیبهشت 1392</span>
						</li>
						<li>
							<div class="pic"><a href="#"><img src="./themes/default/images/main/others/works.jpg" alt=""></a></div>
							<h3><a href="#">جزئیات...  جزئیات... جزئیات... جزئیات...</a></h3>
							<span class="date">31 اردیبهشت 1392</span>
						</li>
						<li>
							<div class="pic"><a href="#"><img src="./themes/default/images/main/others/works.jpg" alt=""></a></div>
							<h3><a href="#">جزئیات...  جزئیات... جزئیات... جزئیات...</a></h3>
							<span class="date">31 اردیبهشت 1392</span>
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
			<div class="social right">
				<ul>
					<li><a href="#" class="ttip" original-title="Rss"><img src="./themes/default/images/main/rss.png" alt="Rss"></a></li>
					<li><a href="#" class="ttip" original-title="Facebook"><img src="./themes/default/images/main/facebook.png" alt="Facebook"></a></li>
					<li><a href="#" class="ttip" original-title="Twitter"><img src="./themes/default/images/main/twitter.png" alt="Twitter"></a></li>
					<li><a href="#" class="ttip" original-title="Pinterest"><img src="./themes/default/images/main/pinterest.png" alt="Pinterest"></a></li>
					<li><a href="#" class="ttip" original-title="Dribbble"><img src="./themes/default/images/main/dribbble.png" alt="Dribbble"></a></li>
					<li><a href="#" class="ttip" original-title="Youtube"><img src="./themes/default/images/main/youtube.png" alt="Youtube"></a></li>
					<li><a href="#" class="ttip" original-title="Behance"><img src="./themes/default/images/main/behance.png" alt="Behance"></a></li>
					<li><a href="#" class="ttip" original-title="Instagram"><img src="./themes/default/images/main/instagram.png" alt="Instagram"></a></li>
				</ul>
			</div>
			<div class="badboy"></div>
		</div>
	</section>
	<div id="topcontrol"></div>
</body>
</html>