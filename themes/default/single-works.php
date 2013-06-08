<?php
	include("inc/header.php");
	$db = database::getDatabase();
 	$works = $db->SelectAll('works',NULL,NULL," sdate DESC");	
?>

<div class="content single-page">
	<div class="title-menu">
		<menu>
			<li><a href="./">صفحه اصلی</a><span>/</span></li>
			<li><a href="#">اخبار</a><span>/</span></li>
			<li><p><?php echo "{$works[$i]["subject"]}"; ?></p></li>
		</menu>
		<div class="badboy"></div>
	</div>
	<div class="box-right">
		<div class="image">
			<img src='<?php echo "{$works[$i]["image"]}" ?>' alt='<?php echo "{$works[$i]["subject"]}" ?>'>
		</div>
		<div class="title">
			<p><?php echo "{$works[$i]["subject"]}"; ?></p>
		</div>
		<div class="date">
			<p><span>تاریخ شروع: <?php echo "{$works[$i]["sdate"]}"; ?></span></p>
			<p><span>تاریخ پایان: <?php echo "{$works[$i]["fdate"]}"; ?></span></p>
		</div>
		<div class="detail">
			<div class="text right">
				
			</div>
			<div class="overview left">
				<ul>
					<li>
						<h5>Graphic - 78%</h5>
						<span>
							<span style="width:78%"></span>
						</span>
					</li>
					<li>
						<h5>Dynamic - 90%</h5>
						<span>
							<span style="width:90%"></span>
						</span>
					</li>
					<li>
						<h5>Jquery - 58%</h5>
						<span>
							<span style="width:58%"></span>
						</span>
					</li>
					<li>
						<h5>Zepto - 38%</h5>
						<span>
							<span style="width:38%"></span>
						</span>
					</li>
					<li>
						<h5>Static - 10%</h5>
						<span>
							<span style="width:10%"></span>
						</span>
					</li>
				</ul>
			</div>
			<p>توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... توضیحات در مورد پروژه... </p>
			<div class="badboy"></div>
		</div>
	</div>
</div>

<?php
	include ('inc/sidebar.php');

	include("inc/bot-ads.php");

	include("inc/footer.php");
?>