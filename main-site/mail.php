<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8" />
	<title></title>
</head>
<body>
	<?php
		error_reporting(E_ALL ^ E_NOTICE);

		$admin = 'info@mediateq.ir';

		$name    = $_POST['name'];
		$email   = $_POST['email'];
		$text    = $_POST['txt'];
		
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
		}else{
			echo '<script type="text/javascript">
					alert("خطا! لطفا فیلدها را چک نمایید و مجددا تلاش کنید.");
				  </script>';
		}
	?>
</body>
</html>