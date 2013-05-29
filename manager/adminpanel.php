<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title> پانل مدیریت</title>
	<link rel="stylesheet" type="text/css" href="./themes/default/1styles.css" />
	<link rel="stylesheet" type="text/css" href="./themes/default/adminpanel.css" />
	
	<script type="text/javascript" src="./themes/default/js/jquery.js"></script>	
	<!--[if lt IE 9]>
		<script src="./themes/default/js/html5shiv.js"></script>
	<![endif]-->
<?php
 $path = realpath(dirname(__FILE__));
$html=<<<cd
  <script type='text/javascript'>
        $(document).ready(function(){
          $('#works').click(function(){
              // alert('test');
             $('#container').empty().load('./manager/worksmgr.php');
             return false;
          });
        });
    </script>
cd;
echo $html;

?>	
</head>
<body>
    <header>
      <a href="#" class="logo">Media Teq Admin Panel</a>
      <div id="mini-nav">
        <ul class="hidden-phone">
          <li><a href="#" >وظایف</a></li>
          <li><a href="#">ثبت نام ها <span id="newSignup">06</span></a></li>         
          <li><a href="login.html">خروج</a></li>
        </ul>
      </div>
    </header>
 <!-- <div id="top" class= "admin_top">top</div> -->
 <div id="clear" class="badboy"> </div>
 <div id="right" class="admin_right_panel"> 
	 <div id="mainnav" class="hidden-phone hidden-tablet">
        <ul>
          <li class="active">
		  <span class="current-arrow"></span>
            <a href="#">
              <div class="icon">
                <span class="fs1" aria-hidden="true" data-icon="&#x002b;"></span> <!-- &#x25c8; -->
              </div>
پیشخوان
            </a>
          </li>
          <li>
            <a href="#">
              <div class="icon">
                <span class="fs1" aria-hidden="true" data-icon="&#x231a;"></span>
              </div>
مدیریت اخبار
            </a>
          </li>
          <li >            
            <a href="" id="works" name="works">
              <div class="icon">
                <span class="fs1" aria-hidden="true" data-icon="&#x25c8;"></span>
              </div>
مدیریت کار ها
            </a>
          </li>
          <li>
            <a href="worksmgr.php">
              <div class="icon">
                <span class="fs1" aria-hidden="true" data-icon="&#x25ce;"></span>
              </div>
مدیریت اسلاید
            </a>
          </li>
          <li>
            <a href="#">
              <div class="icon">
                <span class="fs1" aria-hidden="true" data-icon="&#x2709;"></span>
              </div>
خروج
            </a>
          </li>
        </ul>
      </div>
 
 </div> 
 <div id="container"  class="admin_container">
 </div>
 </body>
</html>