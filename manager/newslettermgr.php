<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	include_once("../lib/class.phpmailer.php");
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	if ($_GET['item']!="newslettermgr")	exit();
	$db = Database::GetDatabase();
	$msg = Message::GetMessage();
	if ($_POST["mark"]=="sendnews")
    {
	    echo "mark is ",$_POST["mark"];
		$News_Email=GetSettingValue("News_Email",1);
		$Email_Sender_Name = GetSettingValue("Email_Sender_Name",1);
		$Is_Smtp = GetSettingValue("Is_Smtp_Active",1);
		$rows = $db->SelectAll("usersnews","email");
		$news = $db->Select("news",NULL,"id={$_POST[select]}");		
		$emails = array();
		foreach ($rows as $row) $emails[] = $row["email"];
		if ($Is_Smtp == "yes")
		{
			$host = GetSettingValue("Smtp_Host",1);
			$username = GetSettingValue("Smtp_User_Name",1);
			$password = GetSettingValue("Smtp_Pass_Word",1);
			$port = GetSettingValue("Smtp_Port",1);

			$IsSend = SendSmtpEmail($News_Email, $Email_Sender_Name, $emails,$news["subject"],$news["body"], $host, $port, $username, $password);
      }
      else
      {
			$IsSend = SendEmail($News_Email,$Email_Sender_Name,$emails, $news["subject"], $news["body"]);
			echo "send situation is :",$IsSend;
      }
    }
    if ($IsSend)
    {
        $msgs=$msg->ShowSuccess("ارسال خبر انجام شد");
    }
    else
    {
        $msgs=$msg->ShowError("ارسال خبر با خطا مواجه شد");
    }
	
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
				<a href="?item=newslettermgr&act=new">ایجاد جدید
					<span class="add-newsletter"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=newslettermgr&act=mgr">آرشیو خبرنامه
					<span class="edit-newsletter"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=newslettermgr&act=user">اعضاء خبرنامه
					<span class="member-newsletter"></span>
				</a>
			  </li>			 
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}else
if ($_GET['act']=="mgr" or $_GET['act']=="new")
{
	if ($_POST["mark"]=="srhnews")
	{	 		
	    if ($_POST["cbsearch"]=="ndate")
		{
		   date_default_timezone_set('Asia/Tehran');		   
		   list($year,$month,$day) = explode("/", trim($_POST["txtsrh"]));		
		   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);		
		   $_POST["txtsrh"] = Date("Y-m-d",mktime(0, 0, 0, $gmonth, $gday, $gyear));
		}
		$rows = $db->SelectAll(
				"news",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"ndate DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "newslettermgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=newslettermgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"news",
				"*",
				null,
				"ndate DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews")?$db->CountAll("news"):Count($rows);				
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["subject"] =(mb_strlen($rows[$i]["subject"])>20)?mb_substr($rows[$i]["subject"],0,20,"UTF-8")."...":$rows[$i]["subject"];
                $rows[$i]["body"] =(mb_strlen($rows[$i]["body"])>30)?
                mb_substr(html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8"), 0, 30,"UTF-8") . "..." :
                html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8");               
                $rows[$i]["ndate"] = ToJalali($rows[$i]["ndate"]," l d F  Y ");
				$rows[$i]["select"] = "<input type='radio' name='select' value='{$rows[$i][id]}' > ";
				$rows[$i]["image"] ="<img src='{$rows[$i][image]}' alt='{$rows[$i][subject]}' width='40px' height='40px' />";                                            
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}
				$rows[$i]["username"]=GetUserName($rows[$i]["userid"]); 
				$rows[$i]["catid"] = GetCategoryName($rows[$i]["catid"]);				
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
					        "select"=>"انتخاب",
							"catid"=>"گروه",
							"subject"=>"عنوان",
							"image"=>"تصویر",
							"body"=>"توضیحات",
							"ndate"=>"تاریخ",
							"resource"=>"منبع",							
							"username"=>"کاربر",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=newslettermgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",
              "body"=>"توضیحات",
			  "ndate"=>"تاریخ",
			  "resource"=>"منبع");
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
					    <li><span>مدیریت خبرنامه</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=newslettermgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
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
									<a href="?item=newslettermgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=newslettermgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhnews" /> 
								{$msgs}

								{$gridcode}
								<br />
								<input type='submit' id='submit' value='ارسال' class='submit' />	 
			                    <input type='hidden' name='mark' value='sendnews' />
							</form>
					   </center>
					</div>

edit;
$html = $code;
}
else
if ($_GET['act']=="user")
{
$rows = $db->SelectAll(
				"usersnews",
				"*",
				null,
				"id ASC",
				$_GET["pageNo"]*10,
				10);
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews")?$db->CountAll("usersnews"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {								                                            
					if ($i % 2==0)
					 {
							$rowsClass[] = "datagridevenrow";
					 }
					else
					{
							$rowsClass[] = "datagridoddrow";
					}
					
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
                    $gridcode .= DataGrid(array( 
					        "email"=>"ایمیل",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=newslettermgr&act=user");
                    
            }

$html = $gridcode;
}
	
return $html;
?>