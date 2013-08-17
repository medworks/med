<?php 
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	include_once("../lib/persiandate.php");	
	$login = Login::getLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	$db = Database::GetDatabase();
	$sess = Session::GetSesstion();
	$overall_error = false;
	if ($_GET['item']!="catmgr")	exit();
	if (!$overall_error && $_POST["mark"]=="savecat")
	{	    
		$fields = array("`secid`","`catname`","`latinname`","`describe`");		
		$values = array("'{$_POST[cbsec]}'","'{$_POST[catname]}'","'{$_POST[latinname]}'","'{$_POST[describe]}'");		
		if (!$db->InsertQuery('category',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=catmgr&act=new&msg=2');
			exit();
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو??قیت انجام شد");
			header('location:?item=catmgr&act=new&msg=1');
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editcat")
	{		
	    //$_POST["detail"] = addslashes($_POST["detail"]);
		$values = array("`secid`"=>"'{$_POST[cbsec]}'",
		                "`catname`"=>"'{$_POST[catname]}'",
						"`latinname`"=>"'{$_POST[latinname]}'",
						"`describe`"=>"'{$_POST[describe]}'");		
        $db->UpdateQuery("category",$values,array("id='{$_GET[cid]}'"));
		header('location:?item=catmgr&act=mgr');
	}

	if ($overall_error)
	{
		$row = array("secid"=>$_POST['cbsec'],
		             "catname"=>$_POST['subject'],
					 "latinname"=>$_POST['latinname'],
					 "describe"=>$_POST['describe']);
	}
	
	
if ($_GET['act']=="new")
{
	$editorinsert = "
		<p>
			<input type='submit' id='submit' value='ذخیره' class='submit' />	 
			<input type='hidden' name='mark' value='savecat' />";
}
if ($_GET['act']=="edit")
{
	$row=$db->Select("category","*","id='{$_GET["cid"]}'",NULL);
	$editorinsert = "
	<p>
      	 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
      	 <input type='hidden' name='mark' value='editcat' />";
}
if ($_GET['act']=="del")
{
	$db->Delete("category"," id",$_GET["cid"]);
	if ($db->CountAll("category")%10==0) $_GET["pageNo"]-=1;		
	header("location:?item=catmgr&act=mgr&pageNo={$_GET[pageNo]}");
}
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت گروه ها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul class="two-column">
			<li>		  
				<a href="?item=secmgr&act=new">سرگروه جدید
					<span class="add-headline"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=secmgr&act=mgr">حذف/ویرایش سرگروه
					<span class="edit-headline"></span>
				</a>
			  </li>
			  <li>		  
				<a href="?item=catmgr&act=new">گروه جدید
					<span class="add-cat"></span>
				</a>
			  </li>
			  
			  <li>
				<a href="?item=catmgr&act=mgr">حذف/ویرایش گروه ها
					<span class="edit-cat"></span>
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
$sections = $db->SelectAll("section","*",null,"secname ASC");
if ($_GET['act']=="edit")
	$cbsection = DbSelectOptionTag("cbsec",$sections,"secname","{$row[secid]}",null,"select");
else
	$cbsection = DbSelectOptionTag("cbsec",$sections,"secname",null,null,"select");	
$html=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){	   
			$("#frmcatmgr").validationEngine();			
    });
	</script>	   
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	    <li><span>مدیریت گروه ها</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmcatmgr" id="frmcatmgr" class="" action="" method="post" >  
       <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
       <p>
         <label for="catname">نام گروه </label>
         <span>*</span>
       </p>    
       <input type="text" name="catname" class="validate[required] catname family" id="catname" value='{$row[catname]}'/>
       <p>
         <label for="latinname">نام لاتین </label>
         <span>*</span>
       </p>    
       <input type="text" name="latinname" class="validate[required] latinname family ltr" id="latinname" value='{$row[latinname]}'/>
       <p>
         <label for="describe">توضیحات </label>
         <span>*</span>
       </p>    
       <input type="text" name="describe" class="validate[required] describe subject" id="describe" value='{$row[describe]}'/>
       <p>
         <label for="detail">انتخاب گروه مادر </label>
       </p>
       {$cbsection}
	   <div class="badboy"></div>
       <p>
	   {$editorinsert}       
      	 <input type="reset" value="پاک کردن" class='reset' /> 	 	     
       </p>  
	</form>
	<div class='badboy'></div>	
  </div>  
   
cd;
} else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhcat")
	{	 		
	   $rows = $db->SelectAll(
				"category",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"catname ASC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				$_GET['item'] = "catmgr";
				$_GET['act'] = "mgr";
				$_GET['msg'] = 6;				
				//header("Location:?item=newsmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"category",
				"*",
				null,
				"catname ASC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhcat")?$db->CountAll("category"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["catname"] =(mb_strlen($rows[$i]["catname"])>20)?mb_substr($rows[$i]["catname"],0,20,"UTF-8")."...":$rows[$i]["catname"];
		        $rows[$i]["latinname"] =(mb_strlen($rows[$i]["latinname"])>20)?mb_substr($rows[$i]["latinname"],0,20,"UTF-8")."...":$rows[$i]["latinname"];
		        $rows[$i]["describe"] =(mb_strlen($rows[$i]["describe"])>50)?mb_substr($rows[$i]["describe"],0,50,"UTF-8")."...":$rows[$i]["describe"];
                              
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}
				$rows[$i]["secid"] = GetSectionName($rows[$i]["secid"]);
				$rows[$i]["edit"] = "<a href='?item=catmgr&act=edit&cid={$rows[$i]["id"]}' class='edit-field' " .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این گروه اطمینان دارید؟',
				'?item=catmgr&act=del&pageNo={$_GET[pageNo]}&cid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array(
					        "secid"=>"سر گروه",
							"catname"=>"نام گروه",
							"latinname"=>"نام لاتین",
							"describe"=>"توضیحات",							
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=catmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("catname"=>"نام گروه",
			  "latinname"=>"نام لاتین",
			  "describe"=>"توضیحات" );
$combobox = SelectOptionTag("cbsearch",$list,"subject");
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
					    <li><span>مدیریت گروه ها</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=catmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>

								<p class="search-form">
									<input type="text" id="date_input_1" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  /> 
									<a href="?item=catmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=catmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhcat" /> 
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