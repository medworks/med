<?php
 include_once("../config.php");
 include_once("../classes/database.php");
 include_once("../classes/messages.php");
 include_once("../classes/session.php");	
 include_once("../classes/functions.php");
 include_once("../lib/persiandate.php");
 if ($_GET['item']!="slidesmgr")	exit();
 $db = Database::GetDatabase();
 if (isset($_POST["mark"]))
 {
	 $filename = strtolower(basename($_FILES['pic']['name']));
	 $ext = substr($filename, strrpos($filename, '.') + 1);
	 $newfilename= md5(rand() * time());
	 //$newfilename = $_POST['subject'];	 
	 $ext=".".$ext;          
	 //$newfilename = $_FILES['pic']['name'];
	 $newname_os = OS_ROOT.'/slidespics/'.$newfilename.$ext;
	 $newname_site = SITE_ROOT.'/slidespics/'.$newfilename.$ext;
	 if (!move_uploaded_file($_FILES["pic"]["tmp_name"],$newname_os))
	 {       
		//$msgs = $msg->ShowError("عمليات آپلود با مشكل مواجه شد");
		header('location:?item=slidesmgr&act=new&msg=3');
		exit();
	 }
  } 	
 if ($_POST["mark"]=="saveslides")
 {						   				
	$fields = array("`image`","`subject`","`body`","`pos`");	
	$values = array("'{$newname_site}'","'{$_POST[subject]}'","'{$_POST[body]}'","'{$_POST[cbpos]}'");
	if (!$db->InsertQuery('slides',$fields,$values)) 
	{
		//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
		header('location:?item=slidesmgr&act=new&msg=2');
		exit();
	} 	
	else 
	{  										
		//$msgs = $msg->ShowSuccess("ثبت اطلاعات با موفقیت انجام شد");
		header('location:?item=slidesmgr&act=new&msg=1');					
		exit();
	 }
 }
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php">پیشخوان</a></li>
	        <li><span>مدیریت اسلاید</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=slidesmgr&act=new">درج عکس جدید
					<span class="add-slide"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=slidesmgr&act=mgr" id="news" name="news">
				  حذف/ویرایش عکس ها
					<span class="edit-slide"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}else
if ($_GET['act']=="new")
{
$msgs = GetMessage($_GET['msg']);
$list = array("1"=>"اسلاید بزرگ",
              "2"=>"اسلاید کوچک",
			  "3"=>"همه موارد");			  
$combobox = SelectOptionTag("cbpos",$list,"1");
$html=<<<cd
		<script type='text/javascript'>
			$(document).ready(function(){		
				$("#frmslidesmgr").validationEngine();			   
			});
		</script>
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php">پیشخوان</a></li>
	        <li><span>مدیریت اسلاید</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>	     
		{$msgs}
		<form name="frmslidesmgr" id="frmslidesmgr" class="" action="" method="post" enctype="multipart/form-data" > 
			<p>
				<label for="pic">عکس </label>
				<span>*</span>
			</p>
			<input type="file" name="pic" class="validate[required] pic" id="pic" OnChange="showPreview(this)" />  
			<div id="imgpreview">
				<img id="img" src="" alt="" />				
			</div>
			<p>
				<label for="subject">عنوان </label>
				<span>*</span>
			</p>
			<input type="text" name="subject" class="validate[required] subject" id="subject" />
			<p>
				<label for="subject">توضیحات </label>
				<span>*</span>
			</p>
			<input type="text" name="body" class="validate[required] subject" id="body" /> 
			<p>
				<label for="cbpos">نمایش عکس در </label>
				<span>*</span>
			</p>
			{$combobox}
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />
				<input type="reset" value="پاک کردن" class='reset' /> 
				<input type='hidden' name='mark' value='saveslides' />
			</p>
		</form>
cd;
}
else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 			   
		$rows = $db->SelectAll(
				"slides",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"id DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				$_GET['item'] = "slidesmgr";
				$_GET['act'] = "mgr";
				$_GET['msg'] = 6;				
				//header("Location:?item=worksmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"slides",
				"*",
				null,
				"id DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews" )?$db->CountAll("slides"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["subject"] =(mb_strlen($rows[$i]["subject"])>20)?mb_substr($rows[$i]["subject"],0,20,"UTF-8")."...":$rows[$i]["subject"];
                $rows[$i]["body"] =(mb_strlen($rows[$i]["body"])>30)?
                mb_substr(html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8"), 0, 30,"UTF-8") . "..." :
                html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8");               
                $rows[$i]["image"] ="<img src='{$rows[$i][image]}' alt='{$rows[$i][subject]}' width='40px' height='40px' />";			
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}				
				$rows[$i]["edit"] = "<a href='?item=slidesmgr&act=edit&sid={$rows[$i]["id"]}' " .
						"style='text-decoration:none;'><img src='../themes/default/images/admin/icons/edit.gif'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این فعالیت اطمینان دارید؟',
				'?item=slidesmgr&act=del&pageNo={$_GET[pageNo]}&sid=');"
				 style='text-decoration:none;'> <img src='../themes/default/images/admin/icons/delete.gif'></a>
del;
               }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode.= DataGrid(array( 
							"image"=>"عکس",
							"subject"=>"عنوان",
							"body"=>"توضیحات",
							"pos"=>"موقعیت نمایش",							
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=slidesmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",
              "body"=>"توضیحات" );
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
				        <li><a href="adminpanel.php">پیشخوان</a></li>
					    <li><span>مدیریت اسلاید</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=slidesmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>								
									<a href="?item=slidesmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=slidesmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhnews" /> 
								{$msgs}

								{$gridcode} 
															
							</form>
					   </center>
					</div>

edit;
$html = $code;
echo $html;
}	
return $html;
?>	