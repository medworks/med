<?php
    include_once("../config.php");
    include_once("../classes/functions.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/security.php");
	include_once("../classes/database.php");	
	include_once("../classes/login.php");
	$login = Login::GetLogin();	
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); //solve security bug
	}	
	$mes = Message::GetMessage();
	$sess = Session::GetSesstion();
	$name = $sess->Get("name").' '.$sess->Get("family");
	$user = $sess->Get("username");
	if ($_GET["item"] == "logout")
   {
	   if ($login->LogOut())
			header("Location: ../index.php");
	   else
		    echo $mes->ShowError("عملیات خروج با خطا مواجه شد، لطفا مجددا سعی نمایید.");
   }  
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta http-equiv="X-UA-Compatible" content="chrome=1">
	<meta charset="UTF-8">
	<title> پانل مدیریت</title>
	<link rel="stylesheet" type="text/css" href="../themes/default/1styles.css" />
	<link rel="stylesheet" type="text/css" href="../themes/default/validationEngine.css"/>
	<link rel="stylesheet" type="text/css" href="../themes/default/calendar-blue.css" />
	<link rel="stylesheet" type="text/css" href="../themes/default/adminpanel.css" />

	<script type="text/javascript" src="../lib/js/jquery.js"></script>  
	<script type="text/javascript" src="../lib/js/jalali.js"></script>  
	<script type="text/javascript" src="../lib/js/calendar.js"></script>  
	<script type="text/javascript" src="../lib/js/calendar-setup.js"></script>  
	<script type="text/javascript" src="../lib/js/calendar-fa.js"></script>	
	<script type="text/javascript" src="../lib/js/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="../lib/js/jquery.validationEngine.js"></script>	
  <script type="text/javascript" src="../lib/js/CFInstall.js"></script>
	<script type="text/javascript" src="../lib/js/jsfuncs.js"></script>	

	<!--[if lt IE 9]>
		<script src="./lib/js/html5shiv.js"></script>
	<![endif]-->
<?php
  $path = realpath(dirname(__FILE__));  
  /*
  include_once("./config.php");
  include_once("./classes/database.php"); 
 */
$html=<<<cd
  <script type='text/javascript'>
  
  /*
        $(document).ready(function(){
          $('#works').click(function(){
              // alert('test');
             $('#container').load('./manager/worksmgr.php');
             return false;
          });
		  $('#news').click(function(){
              // alert('test');
             $('#container').empty().load('./manager/newsmgr.php');
             return false;
          });
        });
		*/
    </script>

cd;
echo $html;

?>	
</head>
<body>
    <script>
       CFInstall.check({
         mode: "overlay",
         destination: "http://media.mediateq.ir"
       });
    </script>
    <header>
      <a href="../" class="logo" title="Mediateq" target="_blank">Mediateq website</a>
      <div id="mini-nav">
        <ul class="hidden-phone">
          <li><a href="#" >وظایف</a></li>
          <li><a href="#">ثبت نام ها <span id="newSignup">06</span></a></li>         
          <li><a href="?item=logout&act=do">خروج</a></li>		  
        </ul>
		نام :<?php echo $name?>
		نام کاربری : <?php echo $user?>
      </div>
    </header>
 <!-- <div id="top" class= "admin_top">top</div> -->
 <div id="clear" class="badboy"> </div>
 <div class="container">
 <div id="right" class="admin_right_panel"> 
	 <div id="mainnav" class="main-menu">
        <ul>
          <li>
            <a href="?item=dashboard&act=do&type=line">پیشخوان
               <span class="dashboard"></span>
            </a>
          </li>
          <li>
            <a href="?item=newsmgr&act=do" id="news" name="news">مدیریت اخبار
                <span class="news"></span>
            </a>
          </li>
          <li >            
            <a href="?item=worksmgr&act=do" id="works" name="works">مدیریت کار ها
                <span class="works"></span>
            </a>
          </li>
          <li>
            <a href="?item=slidesmgr&act=do">مدیریت اسلاید
                <span class="slidemgr"></span>
            </a>
          </li>
		  <li >            
            <a href="?item=usermgr&act=do" id="users" name="users">مدیریت کاربران
                <span class="users"></span>
            </a>
          </li>	
          <li >            
            <a href="?item=uploadmgr&act=do" id="users" name="users">مدیریت آپلود
                <span class="upload"></span>
            </a>
          </li>		  
          <li>
            <a href="#">خروج
                <span class="fs1"></span>
            </a>
          </li>
        </ul>
      </div>
 
 </div> 
 <div id="container"  class="admin_container">
    <?php
      if (isset($_GET['item']) and $_GET['item']!="logout")  
    	echo include_once GetPageName($_GET['item'],$_GET['act']); 
    ?>    
 </div>
 </div>
 <div class="badboy"></div>
 <footer>
   <p>پانل مدیرت مدیا تک</p>
 </footer>
</body>
</html>