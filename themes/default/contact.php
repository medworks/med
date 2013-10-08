<?php
	include_once("../../classes/functions.php");
	$msg="";
	$admin = 'info@mediateq.ir';

	$name    = $_POST['family'];
	$email   = $_POST['email'];
	$subject = $_POST['subject'];
	$text    = $_POST['message'];

	$message = "$text";

	if( strlen($name)>=1 && checkEmail($email) && strlen($text)>=1 ){
		if( @mail (
				$admin,
				"$subject",
				$message,
				"From:$name $email" )
		){
			$msg="OK";

		}else{
			$msg="<div class='notification_error rtl'>خطا! پیام شما ارسال نشد لطفا مجددا تلاش نمایید.</div>";

		}
	}else{
		$msg="<div class='notification_error rtl'>خطا! لطفا فیلدها را بررسی نمایید و مجددا ارسال کنید!</div>";
	}

echo $msg;
?>