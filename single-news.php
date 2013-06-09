<?php
	include_once("./themes/default/inc/header.php");

	include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");
	
?>

<div class="content single-page">
	<?php
		$db = database::getDatabase();
 		$news = $db->Select('news',NULL,"id={$_GET[wid]}"," ndate DESC");
	?>
	<div class="title-menu">
		<menu>
			<li><a href="./">صفحه اصلی</a><span>/</span></li>
			<li><a href="?item=news&act=do">اخبار</a><span>/</span></li>
			<li><p><?php echo "{$news["subject"]}"; ?></p></li>
		</menu>
		<div class="badboy"></div>
	</div>
	<div class="box-right singlepage-box">
		<div class="image">
			<img src='<?php echo "{$news["image"]}" ?>' alt='<?php echo "{$news[$i]["subject"]}" ?>'>
		</div>
		<div class="tit-da-de">
			<div class="title">
				<p><?php echo "{$news["subject"]}"; ?></p>
			</div>
			<div class="date">
				<p><span>تاریخ ثبت: <?php $ndate = ToJalali($news["ndate"]," l d F  Y "); echo "$ndate"; ?></span></p>
				<p><span>توسط: <?php echo "{$news["userid"]}"; ?></span></p>
	        <p><span>منبع: <?php echo "{$news["resource"]}"; ?></span></p>  
			</div>
			<div class="detail">
				<?php echo "{$news["body"]}"; ?>
			</div>
		</div>
	</div>
</div>

<?php
	include_once('./themes/default/inc/sidebar.php');

	include_once("./themes/default/inc/bot-ads.php");

	include_once("./themes/default/inc/footer.php");
?>