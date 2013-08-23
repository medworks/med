<?php
	$db = database::GetDatabase();
	$address = GetSettingValue('Address',0);
	$tel = GetSettingValue('Tell_Number',0);
	$fax = GetSettingValue('Fax_Number',0);
$html=<<<cd
	<div class="contact-page" id="others-page">
		<div class="page-header" id="others-page">
			<h1>تماس با ما</h1>
			<div class="badboy"></div>
		</div>
		<div class="badboy"></div>
		<div class="contact" id="special-page">
			<div class="map">
					<iframe width="720" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?ie=UTF8&amp;hl=en&amp;oe=UTF8&amp;msa=0&amp;msid=203962002147300705700.0004e448a591f6f386335&amp;t=m&amp;ll=36.309506,59.568729&amp;spn=0.006052,0.012617&amp;z=16&amp;iwloc=0004e448a8492cc73b7ee&amp;output=embed"></iframe>
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
					<p>راه های تماس با ما</p>
					<h4>آدرس</h4>
					<p class="addre">{$address}</p>
					<h4>تلفن</h4>
					<p class="tel ltr">Tel: {$tel}</p>
					<p class="fax ltr">Fax: +{$fax}</p>
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