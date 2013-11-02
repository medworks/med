<?php 
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	include_once("../lib/persiandate.php");	
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	$db = Database::GetDatabase();	
	$overall_error = false;
	if ($_GET['item']!="pollmgr")	exit();	
	if (!$overall_error && $_POST["mark"]=="savepoll")
	{	    
	    $regdate = date("Y-m-d H:i:s");
		$fields = array("`title`","`regedit`","`active`");
		$option=split("\n", $_POST["option"]);
		$values = array("'{$regdate}'","'{$_POST[question]}'","0");
		if (!$db->InsertQuery('polls',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=pollsmgr&act=new&msg=2');			
			//$_GET["item"] = "pollmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 2;
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو??قیت انجام شد");
		   $recid = $DBase->GetInsertedRecId();
		   foreach($option as $row)
		   {
			 $DBase->InsertIntoTable("polloptions","`pid`,`option`","'{$recid}','{$row}'");
		   }
			header('location:?item=pollsmgr&act=new&msg=1');		    
			//$_GET["item"] = "pollsmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 1;
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editpoll")
	{			    
		$values = array("`subject`"=>"'{$_POST[subject]}'",
			            "`image`"=>"'{$_POST[selectpic]}'",
						"`body`"=>"'{$_POST[detail]}'",
						"`ndate`"=>"'{$ndatetime}'",
						"`userid`"=>"'{$userid}'",
						"`resource`"=>"'{$_POST[res]}'",
						"`catid`"=>"'{$_POST[cbcat]}'");
			
        $db->UpdateQuery("news",$values,array("id='{$_GET[nid]}'"));
		header('location:?item=newsmgr&act=mgr');
		//$_GET["item"] = "newsmgr";
		//$_GET["act"] = "act";			
	}

	if ($_GET['act']=="new")
	{
		$editorinsert = "
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />	 
				<input type='hidden' name='mark' value='savepoll' />";
	}
	if ($_GET['act']=="edit")
	{
		$row=$db->Select("poll","*","id='{$_GET["pid"]}'",NULL);		
		$editorinsert = "
		<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editpoll' />";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("polls"," id",$_GET["pid"]);
		if ($db->CountAll("polls")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=pollmgr&act=mgr&pageNo={$_GET[pageNo]}");
	}
	if ($_GET['act']=="do")
	{
		$html=<<<ht
			<div class="title">
			  <ul>
				<li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
				<li><span>مدیریت نظر سنجی</span></li>
			  </ul>
			  <div class="badboy"></div>
			</div>
			<div class="sub-menu" id="mainnav">
				<ul>
				  <li>		  
					<a href="?item=pollmgr&act=new">درج نظرسنجی جدید
						<span class="add-news"></span>
					</a>
				  </li>
				  <li>
					<a href="?item=pollmgr&act=mgr" id="poll" name="poll">حذف/ویرایش نظرسنجی
						<span class="edit-news"></span>
					</a>
				  </li>
				 </ul>
				 <div class="badboy"></div>
			</div>		 
ht;
	}
	else
	if ($_GET['act']=="new" or $_GET['act']=="edit")
	{
	$html=<<<cd
	<form name="frmpollmgr" id="frmpollmgr" class="" action="" method="post" >
     <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
	 <div class="badboy"></div>
       <p>
         <label for="cbsection">سوال</label>
         <span>*</span>
       </p>   	
        <input type="text" name="question" value="" />
		<div class="badboy"></div>
       <p>
         <label for="cbsection">گزینه ها</label>
         <span>*</span>
       </p>   	         
         <textarea name="option" rows="10" cols="50"></textarea>         
         {$editorinsert}
	 </form>	 
cd;
	}
	return $html;
?>	