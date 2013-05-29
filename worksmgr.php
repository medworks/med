<?php
 include_once("../config.php");
 include_once("../classes/database.php"); 
  if ($_POST["mark"]="save")
 {
    $db = Database::getDatabase();
	if((!empty($_FILES["pic"])) && ($_FILES['pic']['error'] == 0))
   {
     //echo "enter to file if<br/>",
     $filename =strtolower(basename($_FILES['pic']['name']));
     $ext = substr($filename, strrpos($filename, '.') + 1);
     //$newfilename= md5(rand() * time());
	 $newfilename = $_POST['subject'];
	 
	 $ext=".".$ext;
     //Determine the path to which we want to save this file
     
     //$newfilename = $_FILES['pic']['name'];
     $newname = SITE_ROOT.'/workspics/'.$newfilename.$ext;
     if (move_uploaded_file($_FILES["pic"]["tmp_name"],$newname))
     {       
       //echo("عمليات آپلود با مشكل مواجه شد");      
     }	 
   }     
	$fields = array("`subject`","`image`","`body`","`sdate`","`fdate`");
	$values = array("'{$_POST[subject]}'","'{$newname}'","'{$_POST[detail]}'","'{$_POST[sdate]}'","'{$_POST[fdate]}'");
	$db->insertquery('works',$fields,$values);
	
 }
 else
 {
  echo "saving faild";
 }
  $html=<<<cd
   <form name="frmworksmgr"  action="" method="post" enctype="multipart/form-data" >
     <label>
       عنوان:   	 
       <input type="text" name="subject" />
	 </label>  
	 <br/>
	 <label>
       عکس:
       <input type="file" name="pic" />
	 </label>
	 <br/>
	 <label>
       توضیحات:
       <textarea cols="50" rows="10" name="detail"> </textarea>
	 </label>
	 <br/>
	 <label>
       تاریخ شروع :   	 
       <input type="text" name="sdate" />
	 </label>
	 <br/>
	 <label>
       تاریخ پایان :
       <input type="text" name="fdate" />
	 </label>  
	 <br/>
	 <input type="submit" value="ذخیره" />	 
	 <input type="hidden" name="mark" value="save" />
	 <input type="reset" value="پاک کردن" /> 	 	 
   </form>
cd;
 echo $html;
?>