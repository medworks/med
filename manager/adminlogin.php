<?php
include_once("./config.php");
include_once("./classes/database.php");
include_once("./classes/session.php");
include_once("./classes/login.php");
include_once("./classes/messages.php");
$login=Login::getLogin();
$msg=Message::getMessage();
$sess = Session::getSesstion();
$adminloginmsg = "";
if (isset ($_POST["mark"]) AND $_POST["mark"] == "adminlogin")
{
	if ($login->adminlogin($_POST['username'],$_POST['password']))
	{
	  echo "post is";
		header("location: ./manager/adminpanel.php");
	}	
	else
    {$adminloginmsg=$msg->ShowError("نام کاربری یا کلمه عبور اشتباه می باشد !");}	
}   

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
{$adminloginmsg}
</body>
</html>
cod;
echo $html; 
?>