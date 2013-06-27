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
				<img id="previmage" src="" alt="">
			</div>
			<div class="detail">
				<h2><span class="highlight">نام فایل: </span><span id="namepreview"></span></h2>
				<p><span class="highlight">پسوند: </span><span id="typepreview"></span></p>
				<p><span class="highlight">سایز: </span><span id="sizepreview"></span></p>
			</div>
			<a href="#" title="" class="button">انتخاب</a>
			<a href="#" title="" class="button">خروج</a>
		</div>
		<div class="files right">
			<div class="pics">
				<ul>
					<li>
						<div class="pic">
							<a class="select" title="انتخاب عکس">
								<img src="../themes/default/images/main/others/slide1.jpg" alt="" />
								<div class="overlay"></div>
							</a>
						</div>
						<h2><span class="highlight">نام فایل: </span><span class="filename">اسلاید یک</span></h2>
					</li>
					<li>
						<div class="pic">
							<a title="انتخاب عکس">
								<img src="../themes/default/images/main/others/slide2.jpg" alt="" />
								<div class="overlay"></div>
							</a>
						</div>
						<h2><span class="highlight">نام فایل: </span><span class="filename">اسلاید دو</span></h2>
					</li>
					<li>
						<div class="pic">
							<a title="انتخاب عکس">
								<img src="../themes/default/images/main/others/slide3.jpg" alt="" />
								<div class="overlay"></div>
							</a>
						</div>
						<h2><span class="highlight">نام فایل: </span><span class="filename">اسلاید سه</span></h2>
					</li>
					<li>
						<div class="pic">
							<a title="انتخاب عکس">
								<img src="../themes/default/images/main/others/slide4.jpg" alt="" />
								<div class="overlay"></div>
							</a>
						</div>
						<h2><span class="highlight">نام فایل: </span><span class="filename">اسلاید چهار</span></h2>
					</li>
					<li>
						<div class="pic">
							<a title="انتخاب عکس">
								<img src="../themes/default/images/main/others/logo.png" alt="" />
								<div class="overlay"></div>
							</a>
						</div>
						<h2><span class="highlight">نام فایل: </span><span class="filename">لگو</span></h2>
					</li>
				</ul>
				<div class="badboy"></div>
			</div>
		</div>
		<div class="badboy"></div>
	</div>
cd;
echo $html;
?>