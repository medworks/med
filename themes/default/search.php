<?php
$html=<<<cd
	<div class='content'>
		<div class='recent-works main-box'>
			<h2>جستجو</h2>
			<div class='line'></div>
			<div class='badboy'></div>
			<div class='contact box-right'>
				<form action="" id="searchfrm" method="post">
				   <p>
			         <label>عبارت مورد نظر </label>
			       </p>
			       <input type="text" name="searchtxt" class="subject" id="searchtxt"/>
				   <p>
			         <label>جستجو در </label>
			       </p>
			        <label class="right">اخبار</label>
			        	<input type="radio" name="category" class="subject" id="category" checked/>
			        <label class="right">کارهای ما</label>
			        	<input type="radio" name="category" class="subject" id="category"/>
			        <label class="right">مقالات</label>
			        	<input type="radio" name="category" class="subject" id="category"/>
			        <div class="badboy"></div>
			       <p>
			         <label>قسمت </label>
			       </p>    
			       <label class="right">عنوان</label>
			        	<input type="radio" name="subcat" class="subject" id="category" checked/>
			        <label class="right">توضیحات</label>
			        	<input type="radio" name="subcat" class="subject" id="category"/>
			       <div class="badboy"></div>
			       <p>
						<input type="submit" id="submit" class="submit" value="ارسال" />	 
						<input type="hidden" name="mark" value="savenews" />       
			      	 	<input type="reset" value="پاک کردن" class="reset" /> 	 	     
			       </p>
				</form>

			</div>
		</div>
	</div>
cd;
return $html;
?>