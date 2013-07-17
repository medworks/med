<?php
$html=<<<cd
	<div class="contact-page" id="others-page">
		<div class="page-header" id="others-page">
			<h1>اخبار</h1>
			<div class="badboy"></div>
		</div>
		<div class="badboy"></div>
		<div class="contact" id="special-page">
			<div class="map">
				<iframe src="http://mapsengine.google.com/map/u/0/view?mid=zXBBpAwsRbSk.kCrA-zSqoLqw" width="720" height="350"></iframe>
			</div>
			<div class="detail">
				<div class="contact-form right">
					<h3>فرم تماس</h3>
					<p>شما می توانید از طریق فرم زیر با ما تماس حاصل فرمایید.</p>
					<form action="" method="post" accept-charset="utf-8">
						<label>نام<span> *</span></label>
						<p>
							<input type="text" name="name" class="name" id="name" />
						</p>
						<label>ایمیل<span> *</span></label>
						<p>
							<input type="text" name="email" class="email" id="email" />
						</p>
						<label>عنوان<span> *</span></label>
						<p>
							<input type="text" name="subject" class="subject" id="subject" />
						</p>
						<label>متن<span> *</span></label>
						<p>
							<textarea name="message" class="message" id="message"></textarea>
						</p>
						<p>
							<input type="submit" name="submit" class="submit btn" id="submit" value="ارسال" />
							<input type="reset" name="reset" class="reset btn" id="reset" value="پاک کردن" />
						</p>	
					</form>
				</div>
				<div class="address">
					<h3>مشخصات تماس</h3>
					<p>شما می توانید از طریق فرم زیر با ما تماس حاصل فرمایید.</p>
					<h4>آدرس</h4>
					<p class="addre">مشهد - سه راه فلسطین - ساختمان شماره 202 - طبقه اول - واحد 3</p>
					<h4>تلفن</h4>
					<p class="tel ltr">Tel: +98 (511) 766 6436</p>
					<p class="fax ltr">Fax: +98 (511) 761 3679</p>
					<h4>ایمیل</h4>
					<p class="email ltr">Email: <a href="mailto:info@mediateq.ir" title="Send Mail">info[at]mediateq.ir</a></p>
				</div>
			</div>
			<div class="badboy"></div>
		</div>
	</div>
cd;
return $html;
?>