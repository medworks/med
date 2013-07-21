<?php
	include_once("./classes/functions.php");
 	include_once("./classes/database.php");
  	include_once("./lib/persiandate.php");
	$db = database::GetDatabase();

$html=<<<cd
					</div>
					<footer>
						<div class="inner-wrap">
							<div class="first">
								<div class="title"><h2>اخبار</h2></div>
								<ul>
cd;
									$news= $db->SelectAll('news',NULL,NULL," ndate DESC");
									for($i=0 ; $i<3 ; $i++){
										$ndate= ToJalali($news[$i]["ndate"]," l d F  Y ساعت H:m");
$html.=<<<cd
										<li>
											<div class="text">
												<p><a href="?item=fullnews&wid={$news[$i][id]}" title="{$news[$i][subject]}">{$news[$i][subject]}</a></p>
												<span class="date">{$ndate}</span>
											</div>
										</li>
cd;
									}
$html.=<<<cd
								</ul>
							</div>
							<div class="second">
								<div class="title"><h2>کارهای ما</h2></div>
								<ul>
cd;
									$works= $db->SelectAll('works',NULL,NULL," fdate DESC");
									for($i=0 ; $i<3 ; $i++){
										$sdate= ToJalali($works[$i]["sdate"]," l d F  Y");
										$fdate= ToJalali($works[$i]["fdate"]," l d F  Y");
$html.=<<<cd
										<li>
											<div class="text">
												<p><a href="?item=fullworks&wid={$works[$i][id]}" title="{$works[$i][subject]}">{$works[$i][subject]}</a></p>
												<span class="sdate">{$sdate}</span>
												<span class="sep">|</span>
												<span class="fdate">{$fdate}</span>
												<div class="badboy"></div>
											</div>
										</li>
cd;
									}
$html.=<<<cd
								</ul>
							</div>
							<div class="third">
								<div class="title"><h2>ارتباط با ما</h2></div>
								<ul>
									<li>
										<div class="text">
											<p>راههای ارتباط با ما</p>
											<p class='address'><span>آدرس:</span> مشهد، سه راه فلسطسن، ساختمان 202، طبقه اول، واحد 3</p>
											<p class="tel ltr"><span>Tel:</span> +98 (511) 766 6436</p>
											<p class="fax ltr"><span>Fax:</span> +98 (511) 761 3679</p>
											<p class='email ltr'><span>E-Mail:</span><a href="mailto:info@mediateq.ir"> info[at]mediateq.ir</a></p>
										</div>
									</li>
								</ul>
							</div>
							<div class="badboy"></div>
						</div>
					</footer>
					<div class="bot-footer">
						<div class="inner-wrap">
							<p class="copyright ltr">&copy; 2013 Mediateq. All rights reserved.</p>
							<div class="social">
								<ul>
									<li class="rss"><a href="#"></a></li>
									<li class="twitter"><a href="#"></a></li>
									<li class="facebook"><a href="#"></a></li>
									<li class="dribbble"><a href="#"></a></li>
									<li class="pinterest"><a href="#"></a></li>
								</ul>
								<div class="badboy"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="badboy"></div>
		</section>
	</div>
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
cd;

echo $html;
?>