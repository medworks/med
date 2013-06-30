<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	$login = Login::getLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	//$sess = Session::getSesstion();
    if ($_POST["mark"]=="saveuser")
	{
		$db = Database::GetDatabase();
		$msg = Message::GetMessage();
		$msgs = "";	
    
		if((empty($_FILES["pic"])) or ($_FILES['pic']['error'] != 0))
		{    
			//$msgs = $msg->ShowError("لطفا فایل عکس را انتخاب کنید");
			header('location:?item=worksmgr&act=do&msg=4');
			exit();
		}
    	else
		{
			$filename =strtolower(basename($_FILES['pic']['name']));
			$ext = substr($filename, strrpos($filename, '.') + 1);
			//$newfilename= md5(rand() * time());
			$newfilename = $_POST['subject'];	 
			$ext=".".$ext;          
			//$newfilename = $_FILES['pic']['name'];
			$newname_os = OS_ROOT.'/userspics/'.$newfilename.$ext;
			$newname_site = SITE_ROOT.'/userspics/'.$newfilename.$ext;
			if (!move_uploaded_file($_FILES["pic"]["tmp_name"],$newname_os))
			{     
				//$msgs = $msg->ShowError("عمليات آپلود با مشكل مواجه شد");
				header('location:?item=worksmgr&act=do&msg=3');
				exit();
			}	 
		    else
			{			
  				$fields = array("`name`","`family`","`image`","`email`","`username`","`password`");
  				$values = array("'{$_POST[name]}'","'{$_POST[family]}'","'{$newname_site}'","'{$_POST[email]}'","'{$_POST[username]}'","'{$_POST[password]}'");	
  				if (!$db->InsertQuery('users',$fields,$values)) 
  				{
  					//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
					header('location:?item=worksmgr&act=do&msg=2');
					exit();
  				} 	
  				else 
  				{  										
  					//$msgs = $msg->ShowSuccess("ثبت اطلاعات با موفقیت انجام شد");
					header('location:?item=worksmgr&act=do&msg=1');					
					exit();
					
  				}  				 
			}
		}	
	}

$msgs = GetMessage($_GET['msg']);
$html=<<<cd
<script type='text/javascript'>
	$(document).ready(function(){		
	$("#frmusermgr").validationEngine();	  
		$("#submit").click(function(){		    
			//alert("test");
			//$("#message").html('saeid hatami');
		//window.location.href="?item=worksmgr&act=do";
			//$("#message").fadeOut(5000,function (){
              //    window.location.href="?item=worksmgr&act=do"});
			 
          });		  
    });	   
</script>	     
  <div class="title">
      <ul>
        <li><a href="#">پیشخوان</a></li>
        <li><a href="#">مدیریت کاربران</a></li>
      </ul>
      <div class="badboy"></div>
  </div>  
  <div class="content">
    <form name="frmusermgr" id= "frmusermgr" class="usermgr" action="" method="post" enctype="multipart/form-data" >
	  <div class="mes" id="message">{$msgs}</div>
       <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
       <p>
         <label for="name">نام </label>
         <span>*</span>
       </p>  	 
       <input type="text" name="name" class="validate[required] name" id="name" />
	     <p>
         <label for="family">نام خانوادگی </label>
         <span>*</span>
       </p>  	 
       <input type="text" name="family" class="validate[required] family" id="family" />
       <p>
    	   <label for="pic">عکس </label>
         <span>*</span>
       </p>
       <p>
          <input type="text" name="selectpic" class="validate[required] selectpic" id="selectpic" value='{$row[image]}' />
          <input type="text" class="showadd" id="showadd" value='{$row[image]}' />
          <a class="filesbrowserbtn" id="filesbrowserbtn" name="newsmgr" title="گالری تصاویر">گالری تصاویر</a>
          <a class="selectbuttton" id="selectbuttton" title="انتخاب">انتخاب</a>
       </p>
       <div class="badboy"></div>
       <div id="filesbrowser"></div>
       <div class="badboy"></div>
       <p>
         <label for="email">ایمیل </label>
         <span>*</span>
       </p>  	 
       <input type="text" name="email" class="validate[required,custom[email]] email ltr" id="email" />
       <p>
         <label for="username">نام کاربری </label>
         <span>*</span>
       </p>  	 
       <input type="text" name="username" class="validate[required] username ltr" id="username" />
	   <p>
         <label for="password">رمز عبور </label>
         <span>*</span>
       </p>  	 
       <input type="password" name="password" class="validate[required] password ltr" id="password" />
	   <p>
         <label for="cpassword">تکرار رمز عبور </label>
         <span>*</span>
       </p>  	 
       <input type="password" name="cpassword" class="validate[required,equals[password]] cpassword ltr" id="cpassword" />       
       <p>
      	 <input type="submit" value="ذخیره" id="submit" class="submit" />	 
      	 <input type="hidden" id="mark" class="mark" name="mark" value="saveuser" />
      	 <input type="reset" value="پاک کردن" class="reset" /> 	 	 
       </p>
    </form>
    <div class="badboy"></div>
  </div>   
cd;
  
return $html;
?>