<?php 
    include_once("./config.php");
    include_once("./classes/database.php");
	if ($_POST["mark"]=="savenews")
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
			$newname_os = OS_ROOT.'/newspics/'.$newfilename.$ext;
			$newname_site = SITE_ROOT.'/newspics/'.$newfilename.$ext;
			if (move_uploaded_file($_FILES["pic"]["tmp_name"],$newname_os))
			{       
				//echo("عمليات آپلود با مشكل مواجه شد");      
			}	 
		}     
	$fields = array("`subject`","`image`","`body`","`ndate`","`userid`","`resource`");
	$values = array("'{$_POST[subject]}'","'{$newname_site}'","'{$_POST[detail]}'","'{$_POST[ndate]}'","'1'","'{$_POST[res]}'");		
	$db->insertquery('news',$fields,$values);	
	header('location:?item=newsmgr&act=do');
	}
$html=<<<cd
       <div class="title">
      <ul>
        <li><a href="#">پیشخوان</a></li>
        <li><a href="#">مدیریت اخبار</a></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class='content'>
	<form name="frmnewsmgr" class="" action="" method="post" enctype="multipart/form-data" >  
       <label>
         عنوان:   	 
         <input type="text" name="subject" class='subject' />
  	   </label>
       <span class='badboy'></span>  
  	   <label>
         عکس:
         <input type="file" name="pic" class='pic' />
  	   </label>
       <span class='badboy'></span>  
  	   <label>
         توضیحات:
         <textarea cols="50" rows="10" name="detail" class='detail'> </textarea>
  	   </label>
       <span class='badboy'></span> 
  	   <label>
          تاریخ :   	 
         <input type="text" name="ndate" class='ndate' />
  	   </label>       
	   <span class='badboy'></span> 
  	   <label>
          منبع خبر :   	 
         <input type="text" name="res" class='' />
  	   </label>       
       <span class='badboy'></span>  
    	 <input type="submit" id="submit" value="ذخیره" class='submit' />	 
    	 <input type="hidden" name="mark" value="savenews" />
    	 <input type="reset" value="پاک کردن" class='reset' /> 	 	     
	</form>
	<div class='badboy'></div>	
  </div>  
cd;
echo $html;

?>
