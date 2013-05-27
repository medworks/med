<?php

if (isset ($_POST["mark"]) AND $_POST["mark"] == "adminlogin")
{

}   
 else
 {
	//$adminloginmsg=$message->ShowError("نام کاربری یا کلمه عبور اشتباه می باشد !");
$html=<<<cod
<!DOCTYPE HTML>       
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
<title>بخش مديريت سايت</title>		
<link rel="stylesheet" type="text/css" href="./themes/default/adminlogin.css"></link>	
</head>
<body>
<form action="" method="post">
        <fieldset>
                <legend>Log in</legend>			
                <label for="user">نام کاربری :</label>
                <input type="text" id="user" name="username"/>			
                <label for="password">رمز عبور :</label>
                <input type="password" id="password" name="password"/>			
                <input type="submit"  class="button" name="login" value="ورود"/>
                <input type="hidden" name="mark" value="adminlogin" />    
        </fieldset>
</form>
{adminloginmsg}
</body>
</html>
cod;

echo $html;
  
}

?>


