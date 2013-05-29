<?php 
$html=<<<cd
<script type='text/javascript'>
        $(document).ready(function(){
          $('#submit').click(function(){
             //  alert('test');
             //document.forms["frmnewsmgr"].submit();
			 $.post("adminpanel.php", $("#frmnewsmgr").serialize());
           //  return false;
          });
		 
        });
    </script>
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
