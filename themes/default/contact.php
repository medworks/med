<?php

$html="<div class='content'><div class='recent-works main-box'>
			<h2>تماس ما</h2>
			<div class='line'></div>
			<div class='badboy'></div>
			<div class='contact box-right'>";

$html.=<<<cd
				<script type='text/javascript'>
					$(document).ready(function(){	   
						$("#contactfrm").validationEngine();			
			    });
				</script>

				<div class="map">
					<iframe width="588" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?ie=UTF8&amp;hl=en&amp;oe=UTF8&amp;msa=0&amp;msid=203962002147300705700.0004e448a591f6f386335&amp;t=m&amp;ll=36.309506,59.568729&amp;spn=0.006052,0.012617&amp;z=16&amp;iwloc=0004e448a8492cc73b7ee&amp;output=embed"></iframe>
				</div>

				<form action="" id="contactfrm" method="post">
				   <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
				   <p>
			         <label for="pic">نام و نام خانوادگی </label>
			         <span>*</span>
			       </p>
			       <input type="text" name="family" class="validate[required] family" id="family" value='{$row[subject]}'/>
				   <p>
			         <label for="pic">ایمیل </label>
			         <span>*</span>
			       </p>
			       <input type="text" name="email" class="validate[required,custom[email]] ltr email" id="email" value='{$row[subject]}'/>
			       <p>
			         <label for="subject">عنوان </label>
			         <span>*</span>
			       </p>    
			       <input type="text" name="subject" class="validate[required] subject" id="subject" value='{$row[subject]}'/> 
				   <p>
				   	 <label for="subject">پیام </label>
			         <span>*</span>
				   </p>
			       <textarea name="message" class="validate[required]"></textarea>
			       <p>
						<input type="submit" id="submit" value="ارسال" class="submit">	 
						<input type="hidden" name="mark" value="savenews">       
			      	 	<input type="reset" value="پاک کردن" class="reset"> 	 	     
			       </p>
				</form>
			</div>
		</div></div>
cd;
return $html;
?>