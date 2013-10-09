<?php
   include_once("./config.php");
   include_once("./classes/database.php");
   include_once("./classes/messages.php");
   
   $table = "";
   $field = "";   
   $db = Database::GetDatabase();
   if ($_POST["mark"]=="find")
  {
    $table = $_POST["category"];
    $field = $_POST["subcat"];
	$rows = $db->SelectAll(
				$table,
				"*",
				"{$field} LIKE '%{$_POST[searchtxt]}%'",
				"id DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{							
				header("Location:?item=search&act=do&msg=6");
			}
			else
			{
               //header("Location:?item=search&act=do");			
			   $success = count($rows);
			   switch($_POST["category"])
			   {
					case 'news':
					  foreach($rows as $key=>$val)
					  {
						 $row .= "<a target='_blank' href='?item=fullnews&act=do&wid={$val['id']}'>
						 {$val['subject']}</a> <br/>";
			          }
					break;
					case 'works':
					  foreach($rows as $key=>$val)
					  {
						 $row .= "<a target='_blank' href='?item=fullworks&act=do&wid={$val['id']}'>
						 {$val['subject']}</a> <br/>";
			          }
					break;
			   }
			   
			   $result=<<<rt
			     عبارت جستجو شده : {$_POST["searchtxt"]}
				 <br/>
				 تعداد نتایج یافت شده:{$success}
				 <br/>
				 {$row}				 
rt;
			}
	
 }	
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
	<div class='content'>
		<div class='recent-works main-box'>
			<h2>جستجو</h2>
			<div class='line'></div>
			<div class='badboy'></div>
			<div class='contact box-right'>
			<div class="mes" id="message">{$msgs}</div>
			<div id="result">{$result} </div>
				<form action="" id="searchfrm" method="post">
				   <p>
			         <label>عبارت مورد نظر </label>
			       </p>
			       <input type="text" name="searchtxt" class="subject" id="searchtxt"/>
				   <p>
			         <label>جستجو در </label>
			       </p>
			        <label class="right">اخبار</label>
			        	<input type="radio" name="category" class="subject" id="category" value="news" checked/>
			        <label class="right">کارهای ما</label>
			        	<input type="radio" name="category" class="subject" id="category" value="works" />
			        <label class="right">مقالات</label>
			        	<input type="radio" name="category" class="subject" id="category"
						value="articles" />
			        <div class="badboy"></div>
			       <p>
			         <label>قسمت </label>
			       </p>    
			       <label class="right">عنوان</label>
			        	<input type="radio" name="subcat" class="subject" id="category" value="subject" checked/>
			        <label class="right">توضیحات</label>
			        	<input type="radio" name="subcat" class="subject" id="category"
						value="body" />
			       <div class="badboy"></div>
			       <p>
					  <input type="submit" id="submit" class="submit" value="ارسال" />
			          <input type="hidden" name="mark" value="find" />	
			      	  <input type="reset" value="پاک کردن" class="reset" />
			       </p>
				</form>

			</div>
		</div>
	</div>
cd;
return $html;
?>