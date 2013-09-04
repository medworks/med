<?php

$admin = 'info@mediateq.ir';
$name    = $_POST['family'];
$email   = $_POST['email'];
$subject   = $_POST['subject'];
$text    = $_POST['message'];

$message = "$text";

if( strlen($name)>=8 && strlen($email)>=7 && strlen($text)>=10 ){
	if( @mail (
			$admin,
			"$subject",
			$message,
			"From:$name $email" )
	){
		echo '<script type="text/javascript">
				alert("پیام شما با موفقیت ارسال شد.");
			  </script>';
     
	}else{
		echo '<script type="text/javascript">
				alert("خطا! پیام شما ارسال نشد لطفا مجددا تلاش نمایید.");
			  </script>';
	}
	header("Location:?item=contact");
}

$address = GetSettingValue('Address',0);
$tel = GetSettingValue('Tell_Number',0);
$fax = GetSettingValue('Fax_Number',0);

$html="
	   <script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyDun8B3aM33iKhRIZniXwprr2ztGlzgnrQ&sensor=false'></script>
	   <script>
			function initialize()
			{
				var mapProp = {
				  center:new google.maps.LatLng(36.309462, 59.567817),
				  zoom:18,
				  mapTypeId:google.maps.MapTypeId.ROADMAP
				  };

				var map=new google.maps.Map(document.getElementById('googleMap'),mapProp);

				var marker=new google.maps.Marker({
				 	 position:myCenter,
				  });

				marker.setMap(map);

				var infowindow = new google.maps.InfoWindow({
					  content:'Mediateq'
				  });

				infowindow.open(map,marker);

			}

			google.maps.event.addDomListener(window, 'load', initialize);

	   </script>";

$html.=<<<cd
		<div class='content'><div class='recent-works main-box'>
			<h2>تماس ما</h2>
			<div class='line'></div>
			<div class='badboy'></div>
			<div class='contact box-right'>

				<script type='text/javascript'>
					$(document).ready(function(){	   
						$("#contactfrm").validationEngine();			
			    });
				</script>

				<div id="googleMap" style="width:588px;height:380px;"></div>

				<form action="" id="contactfrm" method="post">
				   <p class="note">شما می توانید از طریق زیر با ما در تماس باشید</p>
				   <div class="addreess"><p>آدرس: $address</p></div>
				   <div class="tel"><p>تلفن: $tel</p></div>
				   <div class="fax"><p>تلفکس: $fax</p></div>
				   <div class="email"><p><a href="mailto:info@mediateq.ir" target="_blank">ایمیل: info[at]mediateq.ir</a></p></div>
				   <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
				   <p>
			         <label for="pic">نام و نام خانوادگی </label>
			         <span>*</span>
			       </p>
			       <input type="text" name="family" class="validate[required] family" id="family"/>
				   <p>
			         <label for="pic">ایمیل </label>
			         <span>*</span>
			       </p>
			       <input type="text" name="email" class="validate[required,custom[email]] ltr email" id="email"/>
			       <p>
			         <label for="subject">عنوان </label>
			         <span>*</span>
			       </p>    
			       <input type="text" name="subject" class="validate[required] subject" id="subject"/> 
				   <p>
				   	 <label for="subject">پیام </label>
			         <span>*</span>
				   </p>
			       <textarea name="message" class="validate[required]"></textarea>
			       <p>
						<input type="submit" id="submit" value="ارسال" class="submit">	 
						<input type="hidden" name="mark" value="savenews">       
			      	 	<input type="reset" value="پاک کردن" class="reset"> 	 	     
			       </p>
				</form>
			</div>
		</div></div>
cd;
return $html;
?>