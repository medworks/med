<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	if ($_GET['item']!="newslettermgr")	exit();
	$db = Database::GetDatabase();
	$msg = Message::GetMessage();
	if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت خبرنامه</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=newslettermgr&act=new">خبرنامه جدید
					<span class="add-user"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=newslettermgr&act=mgr" >حذف/ویرایش خبرنامه
					<span class="edit-user"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=newslettermgr&act=user" >مدیریت اعضا
					<span class="edit-user"></span>
				</a>
			  </li>			 
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}else
if ($_GET['act']=="new" or $_GET['act']=="edit")
{
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
<script type='text/javascript'>
	$(document).ready(function(){		
	$("#frmnewslettermgr").validationEngine();		 
    });	   
</script>	     
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
        <li><a href="#">مدیریت خبرنامه</a></li>
      </ul>
      <div class="badboy"></div>
  </div>  
  <div class="content">
    <form name="frmnewslettermgr" id= "frmnewslettermgr" class="usermgr" action="" method="post">
	  <div class="mes" id="message">{$msgs}</div>
       <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
       <p>
         <label for="subject">موضوع</label>
         <span>*</span>
       </p>  	 
       <input type="text" name="subject" class="validate[required] name" id="subject" value="{$row[subject]}" />
	   <p>
         <label for="body">متن خبر</label>
         <span>*</span>
       </p>  	 
       <input type="text" name="body" class="validate[required] family" id="body" value="{$row[body]}"/>       
         <label for="email">ایمیل</label>
         <span>*</span>
       </p>  	 
       <input type="text" name="email" class="validate[required,custom[email]] email ltr" id="email" value="{$row[email]}"/>       
       {$editorinsert}
      	 <input type="reset" value="پاک کردن" class="reset" /> 	 	 
       </p>
    </form>
    <div class="badboy"></div>
  </div>   
cd;
}
else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 			   
		$rows = $db->SelectAll(
				"users",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"id ASC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "usermgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=usermgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"users",
				"*",
				null,
				"id ASC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews" )?$db->CountAll("users"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		                       
					$rows[$i]["image"] ="<img src='{$rows[$i][image]}' alt='{$rows[$i][subject]}' width='40px' height='40px' />";				
					if ($i % 2==0)
					{
						$rowsClass[] = "datagridevenrow";
					}
					else
					{
						$rowsClass[] = "datagridoddrow";
					}				
				$rows[$i]["edit"] = "<a href='?item=usermgr&act=edit&uid={$rows[$i]["id"]}' class='edit-field'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این فعالیت اطمینان دارید؟',
				'?item=usermgr&act=del&pageNo={$_GET[pageNo]}&uid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
               }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode.= DataGrid(array( 
							"name"=>"نام",
							"family"=>"نام خانوادگی",
							"image"=>"عکس",
							"email"=>"ایمیل",
							"username"=>"نام کاربری",
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=usermgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("name"=>"نام",
              "family"=>"نام خانوادگی",
			  "username"=>"نام کاربری");              
$combobox = SelectOptionTag("cbsearch",$list,"name");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});		
	});
</script>	   
					<div class="title">
				      <ul>
				        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
					    <li><span> مدیریت آپلود</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=usermgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}							
									<input type="text" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  />
									<a href="?item=usermgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=usermgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhnews" /> 
								{$msgs}
								{$gridcode} 
							</form>
					   </center>
					</div>

edit;
$html = $code;
}	
	
return $html;
?>