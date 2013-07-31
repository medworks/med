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
	$userid = $sess->Get("userid");
	$overall_error = false;
	if ($_GET['item']!="catmgr")	exit();
	if (!$overall_error && $_POST["mark"]=="savecat")
	{	    
		$fields = array("`catname`","`urlname`","`describe`");
		//$_POST["detail"] = addslashes($_POST["detail"]);
		$values = array("'{$_POST[catname]}'","'{$_POST[urlname]}'","'{$_POST[describe]}'");		
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
		$values = array("`catname`"=>"'{$_POST[catname]}'",
						 "`urlname`"=>"'{$_POST[urlname]}'",
						 "`describe`"=>"'{$_POST[describe]}'",
						 "`userid`"=>"'{$userid}'");		
        $db->UpdateQuery("category",$values,array("id='{$_GET[nid]}'"));
		header('location:?item=catmgr&act=mgr');
	}

	if ($overall_error)
	{
		$row = array("catname"=>$_POST['subject'],
					 "urlname"=>$_POST['urlname'],
					 "describe"=>$_POST['describe'],
					 "userid"=>$userid);
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
	$row=$db->Select("category","*","id='{$_GET["nid"]}'",NULL);
	$editorinsert = "
	<p>
      	 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
      	 <input type='hidden' name='mark' value='editcat' />";
}
if ($_GET['act']=="del")
{
	$db->Delete("category"," id",$_GET["nid"]);
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
			<ul>
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
       <input type="text" name="catname" class="validate[required] catname" id="catname" value='{$row[catname]}'/>
       <p>
         <label for="urlname">لینک اینترنتی </label>
         <span>*</span>
       </p>    
       <input type="text" name="urlname" class="validate[required] urlname" id="urlname" value='{$row[urlname]}'/>
       <p>
         <label for="describe">توضیحات </label>
         <span>*</span>
       </p>    
       <input type="text" name="describe" class="validate[required] describe" id="describe" value='{$row[describe]}'/>
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
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="editcat")?$db->CountAll("category"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["catname"] =(mb_strlen($rows[$i]["catname"])>20)?mb_substr($rows[$i]["catname"],0,20,"UTF-8")."...":$rows[$i]["catname"];
		        $rows[$i]["urlname"] =(mb_strlen($rows[$i]["urlname"])>20)?mb_substr($rows[$i]["urlname"],0,20,"UTF-8")."...":$rows[$i]["urlname"];
		        $rows[$i]["describe"] =(mb_strlen($rows[$i]["describe"])>50)?mb_substr($rows[$i]["describe"],0,50,"UTF-8")."...":$rows[$i]["describe"];
                              
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}
				$rows[$i]["username"]=GetUserName($rows[$i]["userid"]); 
				$rows[$i]["edit"] = "<a href='?item=catmgr&act=edit&nid={$rows[$i]["id"]}' " .
						"style='text-decoration:none;'><img src='../themes/default/images/admin/icons/edit.gif'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این گروه اطمینان دارید؟',
				'?item=catmgr&act=del&pageNo={$_GET[pageNo]}&nid=');"
				 style='text-decoration:none;'><img src='../themes/default/images/admin/icons/delete.gif'></a>
del;
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
							"catname"=>"نام گروه",
							"urlname"=>"لینک اینترنتی",
							"describe"=>"توضیحات",
							"username"=>"کاربر",
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=catmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("catname"=>"نام گروه",
			  "urlname"=>"لینک اینترنتی",
			  "describe"=>"توضیحات");
$combobox = SelectOptionTag("cbsearch",$list,"subject");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});
		$('#cbsearch').change(function(){
			$("select option:selected").each(function(){
	            if($(this).val()=="ndate"){
	            	$('.cal-btn').css('display' , 'inline-block');
	            	return false;
	            }else{
	            	$('.cal-btn').css('display' , 'none');
	            }
  			});
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
									<img src="../themes/default/images/admin/cal.png" class="cal-btn" id="date_btn_2" alt="cal-pic">
							         <script type="text/javascript">
							          Calendar.setup({
							            inputField  : "date_input_1",   // id of the input field
							            button      : "date_btn_2",   // trigger for the calendar (button ID)
							                ifFormat    : "%Y/%m/%d",       // format of the input field
							                showsTime   : false,
							                dateType  : 'jalali',
							                showOthers  : true,
							                langNumbers : true,
							                weekNumbers : true
							          });
							        </script>
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