<?php
$html=<<<cd
   <script type='text/javascript'>
        $(document).ready(function(){
          $('#submit').click(function(){
             //  alert('test');
             //document.forms["frmworksmgr"].submit();
			 $.post("adminpanel.php", $("#frmworksmgr").serialize());
           //  return false;
          });
		 
        });
    </script>
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
    	 <input type="hidden" name="mark" value="saveworks" />
    	 <input type="reset" value="پاک کردن" class="reset" /> 	 	 
    </form>
    <div class="badboy"></div>
  </div>
cd;
 echo $html;
?>