<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");		
$html=<<<cd
	<div class="picmanager">
		<div class="prev right">
			<div class="pic">
				<img src="../themes/default/images/main/others/slide1.jpg" alt="">
			</div>
		</div>
		<div class="files"></div>
		<div class="badboy"></div>
	</div>
cd;
echo $html;
?>