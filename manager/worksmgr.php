<?php
    include_once("./config.php");
    include_once("./classes/database.php");
	include_once("./classes/messages.php");
	include_once("./classes/session.php");	
	include_once("./classes/functions.php");
	//$sess = Session::getSesstion();
    if ($_POST["mark"]=="saveworks")
	{
		$db = Database::getDatabase();
		$msg = Message::getMessage();
		$msgs = "";	
    
		if((empty($_FILES["pic"])) && ($_FILES['pic']['error'] != 0))
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
			$newname_os = OS_ROOT.'/workspics/'.$newfilename.$ext;
			$newname_site = SITE_ROOT.'/workspics/'.$newfilename.$ext;
			if (!move_uploaded_file($_FILES["pic"]["tmp_name"],$newname_os))
			{     
				//$msgs = $msg->ShowError("عمليات آپلود با مشكل مواجه شد");
				header('location:?item=worksmgr&act=do&msg=3');
				exit();
			}	 
		    else
			{			
  				$fields = array("`subject`","`image`","`body`","`sdate`","`fdate`");
  				$values = array("'{$_POST[subject]}'","'{$newname_site}'","'{$_POST[detail]}'","'{$_POST[sdate]}'","'{$_POST[fdate]}'");	
  				if (!$db->insertquery('works',$fields,$values)) 
  				{
  					//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
					header('location:?item=worksmgr&act=do&msg=2');
					exit();
  				} 	
  				else 
  				{  										
  					//$msgs = $msg->ShowSuccess("ثبت اطلاعات با موفقیت انجام شد");
					header('location:?item=worksmgr&act=do&msg=1');					
  				}  				 
			}
		}	
	}
	$msgs = getMessage($_GET['msg']);
$html=<<<cd

  <div class="title">
      <ul>
        <li><a href="#">پیشخوان</a></li>
        <li><a href="#">مدیریت کارها</a></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="content">
    <form name="frmworksmgr" class="worksmgr" action="" method="post" enctype="multipart/form-data" >
       <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
       <p>
         <label for="subject">عنوان </label>
         <span>*</span>  	 
         <input type="text" name="subject" class="subject" id="subject" />
       </p>
       <p>
    	   <label for="pic">عکس </label>
         <span>*</span>
         <input type="file" name="pic" class="pic" id="pic" />
       </p>
       <p>
  	     <label for="detail">توضیحات </label>
         <span>*</span>
         <textarea cols="50" rows="10" name="detail" class="detail" id="detail"> </textarea>		 
       </p>
       <p>
  	    <label for="sdate">تاریخ شروع </label>
        <span>*</span>  	 
        <input type="text" name="sdate" class="sdate" id="sdate" />
       </p>
       <p>
  	     <label for="fdate">تاریخ پایان </label>
         <span>*</span>
         <input type="text" name="fdate" class="fdate" id="fdate" />
       </p>
	   <div class="left" >{$msgs}</div>
       <p>
      	 <input type="submit" value="ذخیره" id="submit" class="submit" />	 
      	 <input type="hidden" id="mark" class="mark" name="mark" value="saveworks" />
      	 <input type="reset" value="پاک کردن" class="reset" /> 	 	 
       </p>
    </form>
    <div class="badboy"></div>
  </div>
cd;
 return $html
  
?>