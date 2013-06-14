<!-- ****************Content (Right) part****************** -->
<?php
	if (GetPageName($_GET['item'],$_GET['act'])){
	 // echo "param is :",$_GET['item'],"<->",$_GET['act'];
		echo include_once GetPageName($_GET['item'],$_GET['act']);
		//exit();
	}else{
		include_once("./classes/database.php");
		include_once("./lib/persiandate.php");
		$db = database::GetDatabase();

$html="<div class='content'>
		<!-- ***********Slideshow************ -->
		<div id='ei-slider' class='slideshow ei-slider'>
			<ul class='ei-slider-large'>";
$html.=<<<cd
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
cd;
		$html.="</ul>
		<ul class='ei-slider-thumbs'>";
$html.=<<<cd
			<li class="ei-slider-element"></li>
			<li><a href="#"></a><img src="./themes/default/images/main/others/slide1.jpg" alt=""></li>
			<li><a href="#"></a><img src="./themes/default/images/main/others/slide2.jpg" alt=""></li>
			<li><a href="#"></a><img src="./themes/default/images/main/others/slide3.jpg" alt=""></li>
			<li><a href="#"></a><img src="./themes/default/images/main/others/slide4.jpg" alt=""></li>
cd;
$html.=<<<cd
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
cd;
								
				$works = $db->SelectAll('works',NULL,NULL," fdate DESC");
				for($i=0 ; $i<count($works) ; $i++){
					$sdate= ToJalali($works[$i]["sdate"]," l d F  Y");
					$fdate= ToJalali($works[$i]["fdate"]," l d F  Y");
$html.=<<<cd
					<div class='scroll-item'>
						<a href='?item=fullworks&act=do&wid={$works[$i][id]}' title='{$works[$i][subject]}'><img src='{$works[$i][image]}' alt='{$works[$i][subject]}'></a>
						<h3><a href='?item=fullworks&act=do&wid={$works[$i][id]}' title='{$works[$i][subject]}'>{$works[$i][subject]}</a></h3>
						<p><span>شروع: </span>{$sdate}</p><br />
						<p><span>پایان: </span>{$fdate}</p>
					  </div>
cd;
				}

$html.=<<<cd
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
	<!-- ***********2 columns************ 
		<div class="two-columns">
			<div class="column1 right main-box">
				<h2>کارهای ما</h2>
				<div class="line"></div>
				<div class="badboy"></div>
				<div class="box-right">
					<ul>
						<li class="first-li">
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
								<div class="detial"><p>نتظنبت منضتبنشیت شت مکشتمک ت نتظنبت منضتبنشیت شت مکشتمک ت نتظنبت منضتبنشیت شت مکشتمک ت</p></div>							
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
					</ul>
					<div class="badboy"></div>
				</div>
			</div>
			<div class="column2 right main-box">
				<h2>اخبار</h2>
				<div class="line"></div>
				<div class="badboy"></div>
				<div class="box-right">
					<ul>
						<li class="first-li">
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
								<div class="detial"><p>نتظنبت منضتبنشیت شت مکشتمک ت نتظنبت منضتبنشیت شت مکشتمک ت نتظنبت منضتبنشیت شت مکشتمک ت</p></div>							
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
					</ul>
					<div class="badboy"></div>
					</ul>
				</div>
			</div>
			<div class="badboy"></div>
		</div>
		-->
	<!-- ***********tabs************ -->
	<div class="box-right cat-box-content cat-box tab" id="cats-tabs-box">
		<div class="cat-tabs-header">
			<ul>
				<li><a href="#catab4">اخبار</a></li>
				<li><a href="#catab1">تصاویر</a></li>
			</ul>
		</div>
		<div class="cat-tabs-wrap" id="catab4">
			<ul>
cd;
				
				$news = $db->SelectAll('news',NULL,NULL," ndate DESC");
				$ndate = ToJalali($news[0]["ndate"]," l d F  Y");
$html.=<<<cd
				<li class="first-li">
					<div class="pic first-tab-pic">
						<a href="?item=fullworks&act=do&wid={$news[0][id]}" title="{$news[0][subject]}">
							<img src="{$news[0][image]}" alt="{$news[0][subject]}">
							<span class="overlay"></span>
						</a>
					</div>
					<h2>
						<a href="?item=fullworks&act=do&wid={$news[0][id]}" title="{$news[0][subject]}">{$news[0][subject]}</a>
					</h2>
					<div class="date"><p><span>{$ndate}</span></p></div>
					<div class="detial"><p>{$news[0][body]}</p></div>
				</li>
cd;
				for($i=1 ; $i<5 ; $i++){
					$ndate= ToJalali($news[$i]["ndate"]," l d F  Y");
$html.=<<<cd
					<li>
						<div class="pic">
							<a href="?item=fullworks&act=do&wid={$news[$i][id]}" title="{$news[$i][subject]}">
								<img src="{$news[$i][image]}" alt="{$news[$i][subject]}">
							</a>
						</div>
						<h2>
							<a href="?item=fullworks&act=do&wid={$news[$i][id]}" title="{$news[$i][subject]}">{$news[$i][subject]}</a>
						</h2>
						<div class="date"><p><span>$ndate</span></p></div>
					</li>				
cd;
				}
$html.=<<<cd
			</ul>
			<div class="badboy"></div>
			</ul>
			<div class="badboy"></div>
		</div>
		<div class="cat-tabs-wrap" id="catab1">
			<ul>
cd;
$html.=<<<cd
			</ul>
			<div class="badboy"></div>
		</div>
	</div>
</div>
cd;
 	}
echo $html;
?>