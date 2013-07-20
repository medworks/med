<?php
	include_once("./classes/database.php");
	$db = database::GetDatabase();
$html=<<<cd
<!-- *********************Slideshow part************************** -->
<div class="slideshow ltr bannercontainer responsive">
	<div class="banner ltr">
		<ul>
cd;
			$slides= $db->SelectAll('slides',NULL,NULL," pos ASC");
			for($i=0 ; $i<count($slides) ; $i++){
$html.=<<<cd
            <li data-transition="slotfade-horizontal" data-slotamount="1" data-masterspeed="300" data-thumb="{$slides[$i][image]}">
				<img src="{$slides[$i][image]}" alt="{$slides[$i][subject]}" >

                <div class="caption large_text sft"
                     data-x="50"
                     data-y="44"
                     data-speed="300"
                     data-start="800"
                     data-easing="easeOutExpo">
                     <p style="white-space: normal;">{$slides[$i][subject]}</p>
                </div>

                <div class="caption medium_text sfl"
                     data-x="79"
                     data-y="150"
                     data-speed="300"
                     data-start="1100"
                     data-easing="easeOutExpo">
                     <p style="white-space: normal;">{$slides[$i][body]}</p>
                </div>

                <div class="caption lfl"
                     data-x="53"
                     data-y="192"
                     data-speed="300"
                     data-start="1400"
                     data-easing="easeOutExpo"  >
                     <img width='200px' height="150px" src="{$slides[$i][image]}" alt="{$slides[$i][subject]}">
                 </div>
            </li>
cd;
			}
$html.=<<<cd
        </ul>
        <div class="tp-bannertimer"></div>
	</div>
</div>
<!-- *********************Client part************************** -->
<div class="client-part">
	<div class="cat-tabs-wrap" id="tab1">
		<div class="title"><h2>تب یک</h2></div>
		<div class="text"><p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمر<p></div>
	</div>
	<div class="cat-tabs-wrap" id="tab2">
		<div class="title"><h2>تب دو</h2></div>
		<div class="text"><p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمر<p></div>
	</div>
	<div class="cat-tabs-wrap" id="tab3">
		<div class="title"><h2>تب سه</h2></div>
		<div class="text"><p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمر<p></div>
	</div>
	<div class="cat-tabs-wrap" id="tab4">
		<div class="title"><h2>تب چهار</h2></div>
		<div class="text"><p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمر<p></div>
	</div>
	<div class="cat-tabs-header">
		<ul>
			<li><a href="#tab1"><span class="tab1-icon"></span>تب یک</a></li>
			<li><a href="#tab2"><span class="tab2-icon"></span>تب دو</a></li>
			<li><a href="#tab3"><span class="tab3-icon"></span>تب سه</a></li>
			<li><a href="#tab4"><span class="tab4-icon"></span>تب چهار</a></li>
		</ul>	
	</div>
	<div class="badboy"></div>
</div>
<hr class="arrow">
<!-- *********************Work part************************** -->
<h2 class="work-title">کارهای ما</h2>
<div class="works-part">
	<div id="slideshow-rec">
		<div class='scroll-item'>
			<a href='#' title=''><img src='themes/personal/images/others/slide2.jpg' alt=''></a>
			<h2><a href='' title=''>کار اول</a></h2>
			<p>توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... </p>
		</div>
		<div class='scroll-item'>
			<a href='#' title=''><img src='themes/personal/images/others/slide2.jpg' alt=''></a>
			<h2><a href='' title=''>کار اول</a></h2>
			<p>توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... </p>
		</div>
		<div class='scroll-item'>
			<a href='#' title=''><img src='themes/personal/images/others/slide2.jpg' alt=''></a>
			<h2><a href='' title=''>کار اول</a></h2>
			<p>توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... </p>
		</div>
		<div class='scroll-item'>
			<a href='#' title=''><img src='themes/personal/images/others/slide2.jpg' alt=''></a>
			<h2><a href='' title=''>کار اول</a></h2>
			<p>توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... </p>
		</div>
		<div class='scroll-item'>
			<a href='#' title=''><img src='themes/personal/images/others/slide2.jpg' alt=''></a>
			<h2><a href='' title=''>کار اول</a></h2>
			<p>توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... توضیحات کار اول... </p>
		</div>
	</div>
	<div class="badboy"></div>
	<div class="nav">
		<a id="prev1" href="#">Prev</a>
		<a id="next1" href="#">Next</a>
	</div>
	<div class="badboy"></div>
</div>
<!-- Script for rec work slideshow -->
<script type="text/javascript">
	$(document).ready(function() {
		var vids = $("#slideshow-rec .scroll-item");
		for(var i = 0; i < vids.length; i+=3) {
		  vids.slice(i, i+3).wrapAll('<div class="group_items"></div>');
		}
		$(function() {
			$('#slideshow-rec').cycle({
				fx: 'fade',
				timeout: 0,
				slideExpr: '.group_items',
				speed: 700,
				pause: true,
				prev: '#prev1', 
				next: '#next1',
			});
		});
 	});
</script>
<!-- END Script for rec work slideshow -->
<hr class="arrow">
<!-- *********************Tab part************************** -->
<div class="tabs-part">
	<div class="tit">
		<h2>عنوان عنوان عنوان ...</h2>
		<p>توضیحات... توضیحات... توضیحات... توضیحات... </p>
	</div>
	<div class="cat-tabs-header2">
		<ul>
			<li><a href="#tab5"><span class="tab5-icon"></span>تب یک</a></li>
			<li><a href="#tab6"><span class="tab6-icon"></span>تب دو</a></li>
			<li><a href="#tab7"><span class="tab7-icon"></span>تب سه</a></li>
			<li><a href="#tab8"><span class="tab8-icon"></span>تب چهار</a></li>
		</ul>	
	</div>
	<div class="cat-tabs">
		<div class="cat-tabs-wrap2" id="tab5">
			<div class="title"><h3>تب یک</h3></div>
			<div class="text"><p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر <p></div>
		</div>
		<div class="cat-tabs-wrap2" id="tab6">
			<div class="title"><h3>تب دو</h3></div>
			<div class="text"><p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر <p></div>
		</div>
		<div class="cat-tabs-wrap2" id="tab7">
			<div class="title"><h3>تب سه</h3></div>
			<div class="text"><p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر <p></div>
		</div>
		<div class="cat-tabs-wrap2" id="tab8">
			<div class="title"><h3>تب چهار</h3></div>
			<div class="text"><p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمرمرفی محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر محصولات ما به صورت مستمر <p></div>
		</div>
	</div>
	<div class="badboy"></div>
</div>
<hr class="arrow">
<!-- *********************Aboutus part************************** -->
<div class="about-part">
	<div class="left aboutus">
		<div class="tit"><h2>درباره ما</h2></div>
		<div class="detail">
			<div class="pic"><img src="themes/personal/images/others/a1.jpg" alt=""></div>
			<div class="text">
				<div class="arrow-box"><p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر <p></div>
			</div>
			<div class="badboy"></div>
		</div>
		<div class="detail">
			<div class="pic"><img src="themes/personal/images/others/a1.jpg" alt=""></div>
			<div class="text">
				<div class="arrow-box"><p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر <p></div>
			</div>
			<div class="badboy"></div>
		</div>
	</div>
	<div class="aboutworks">
		<div class="tit"><h2>چرا مشتریان ما را انتخاب می کنند</h2></div>
		<div class="detail">
			<p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر </p>
			<p class="tik"><span></span>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی </p>
			<p class="tik"><span></span>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی </p>
			<p class="tik"><span></span>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی </p>
			<p class="tik"><span></span>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی </p>
		</div>
	</div>
	<div class="badboy"></div>
</div>
cd;
return $html;
?>