<?php
  include_once("./config.php");
  include_once("./classes/database.php
    if ($_POST["mark"]=="saveworks")
  {
    $db = Database::getDatabase();
	if((!empty($_FILES["pic"])) && ($_FILES['pic']['error'] == 0))
   {
     
     $filename =strtolower(basename($_FILES['pic']['name']));
     $ext = substr($filename, strrpos($filename, '.') + 1);
     //$newfilename= md5(rand() * time());
	 $newfilename = $_POST['subject'];	 
	 $ext=".".$ext;          
     //$newfilename = $_FILES['pic']['name'];
     $newname_os = OS_ROOT.'/workspics/'.$newfilename.$ext;
     $newname_site = SITE_ROOT.'/workspics/'.$newfilename.$ext;
          if (move_uploaded_file($_FILES["pic"]["tmp_name"],$newname_os))
     {       
       //echo("عمليات آپلود با مشكل مواجه شد");      
     }	 
   }     
	$fields = array("`subject`","`image`","`body`","`sdate`","`fdate`");
	$values = array("'{$_POST[subject]}'","'{$newname_site}'","'{$_POST[detail]}'","'{$_POST[sdate]}'","'{$_POST[fdate]}'");	
	$db->insertquery('works',$fields,$values);
	header('location:?item=worksmgr&act=do');
 }
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
       <label>
         عنوان:   	 
         <input type="text" name="subject" class="subject" />
  	   </label>
       <span class="badboy"></span>  
  	   <label>
         عکس:
         <input type="file" name="pic" class="pic" />
  	   </label>
       <span class="badboy"></span>  
  	   <label>
         توضیحات:
         <textarea cols="50" rows="10" name="detail" class="detail"> </textarea>
  	   </label>
       <span class="badboy"></span> 
  	   <label>
         تاریخ شروع :   	 
         <input type="text" name="sdate" class="sdate" />
  	   </label>
       <span class="badboy"></span>
  	   <label>
         تاریخ پایان :
         <input type="text" name="fdate" class="fdate" />
  	   </label>
       <span class="badboy"></span>  
    	 <input type="submit" value="ذخیره" id="submit" class="submit" />	 
    	 <input type="hidden" id="mark" name="mark" value="saveworks" />
    	 <input type="reset" value="پاک کردن" class="reset" /> 	 	 
    </form>
    <div class="badboy"></div>
  </div>
cd;
 echo $html;
?>