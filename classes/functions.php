<?php
/*
include_once("lib/persiandate.php");
include_once ("lib/class.phpmailer.php");
include_once("./classes/messages.php");
*/
  function GetPageName($func,$act)
	{
		switch($func)
		{
			case 'initial':
				return "index.php";
			break;
            case 'about':
                return "about.php";
			break;
			case 'contact':
                return "contact.php";
			break;
			case 'gallery':
                return "gallery.php";
			break;
			case 'dashboard':
				if ($act=="do") return "dashboard.php";
			break;	
            case 'works':
                if ($act=="do") return "works.php";
            break;
            case 'fullworks':
                if ($act=="do") return "single-works.php";
            break;			          
            case 'news':
                if ($act=="do") return "news.php";
			break;
			case 'fullnews':
                if ($act=="do") return "single-news.php";
			break;
			case 'uploadmgr':
              if ($act=="do" or $act=="new" or $act=="mgr" or $act=="del" or $act=="edit") return "../manager/uploadmgr.php";
			break;
			case 'worksmgr':
                if ($act=="do" or $act=="new" or $act=="mgr" or $act=="del" or $act=="edit") return "../manager/worksmgr.php";
			break;
			case 'newsmgr':
                if ($act=="do" or $act=="new" or $act=="mgr" or $act=="del" or $act=="edit") return "../manager/newsmgr.php";
			break;
			case 'usermgr':
                if ($act=="do" or $act=="new" or $act=="mgr" or $act=="del" or $act=="edit") return "../manager/usermgr.php";
			break;
			case 'slidesmgr':
                if ($act=="do" or $act=="new" or $act=="mgr" or $act=="del" or $act=="edit") return "../manager/slidesmgr.php";
			break;

		}
	}
	function GetMessage($msgid)
	{
		$msg = Message::GetMessage();
		$result = "";
		switch($msgid)
		{
			case 1:
				$result = $msg->ShowSuccess("ثبت اطلاعات با موفقیت انجام شد");
			break;	
			case 2:
				$result = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			break;	
            case 3:
				$result = $msg->ShowError("عمليات آپلود با مشكل مواجه شد");
			break;	
			case 4:
				$result = $msg->ShowError("لطفا فایل عکس را انتخاب نمایید");
			break;	
			case 5:
				$result = $msg->ShowError("لطفا فیلد توضیحات را تکمیل نمایید");
			break;	
			case 6:
				$result = $msg->ShowInfo("عبارت مورد نظر یافت نشد");
			break;	
		}
		$result .= <<<JAVA
		<script language="javascript">
			$("#message").delay(5000).fadeOut(500);
		</script>
JAVA;
		return $result;
	}
  
function Pagination($itemsCount, $maxItemsInPage,
		$currentPageNo, $maxPageNumberAtTime, $linkFormat = "%PN%")
         {
		$pageCount = ceil($itemsCount / $maxItemsInPage);
		if ($pageCount <= 1) return "";
		$half = floor($maxPageNumberAtTime / 2);
		$left = $currentPageNo - $half;
		$right = $currentPageNo + $half;
		$pseudoLeft = 1 - $left;
		$pseudoRight = $right - $pageCount;
		if ($pseudoLeft > 0)
		{
			$left = 1;
			if (($pageCount - $right) > $pseudoLeft)
				$right += $pseudoLeft;
			else
				$right = $pageCount;
		}
		if ($pseudoRight > 0)
		{
			$right = $pageCount;
			if (($left - 1) > $pseudoRight)
				$left -= $pseudoRight;
			else
				$left = 1;
		}
		$firstPage = $prevPage = $nextPage = $lastPage = '';
		if ($currentPageNo > 1)
		{
			$link = str_replace("%PN%", 1, $linkFormat);
			$firstPage = '<div class="firstPage"><a href="' . $link . '" class="pagenumber"></a></div>';
			$link = str_replace("%PN%", $currentPageNo - 1, $linkFormat);
			$prevPage = '<div class="prevPage"><a href="' . $link . '" class="pagenumber"></a></div>';
		}
		if ($currentPageNo < $pageCount)
		{
			$link = str_replace("%PN%", $currentPageNo + 1, $linkFormat);
			$nextPage = '<div class="nextPage"><a href="' . $link . '" class="pagenumber"></a></div>';
			$link = str_replace("%PN%", $pageCount, $linkFormat);
			$lastPage = '<div class="lastPage"><a href="' . $link . '" class="pagenumber"></a></div>';
		}
		$code = "<div class='pagination'> {$firstPage}{$prevPage}";
		for($i = $left; $i <= $right; $i++)
		{
			if ($i == $currentPageNo)
			{
				$code .= '<div><span class="pagenumber_selected"><p>' . $i . '</p></span></div>';
			}
			else
			{
				$link = str_replace("%PN%", $i, $linkFormat);
				$code .= '<div><a href="' . $link . '" class="pagenumber"><p>' . $i . '</p></a></div>';
			}
		}
		$code .= $nextPage . $lastPage . "<div class='badboy'></div></div>";
		return $code;
	}

         
function DataGrid($cols, $rows, $colsClass, $rowsClass, $itemsInPage, $pageNo, $keyName,
			$showKey, $showEdit, $showDelete, $rowCount,$address)
{
			$code = "<table width='100%' class='datagrid' border='0'><tr class='datagridheader'>";
			//if ($showEdit) $code .= "<td class='datagrid'></td>";
			$code .= "<th>ردیف</th>";
			$fields = array();
                        $DBase = new Database();
			foreach($cols as $key=>$value)
			{
				if (!$showKey && $key == $keyName) continue;
				$code .= "<th>$value</th>";
				$fields[] = $key;
			}
		//	if ($showDelete) $code .= "<td class='datagrid'></td>";
			$code .= "</tr>";
			$rowNo = 0;
			foreach($rows as $key=>$row)
			{
				$rowClass = ($rowsClass[$rowNo] == NULL) ? "datagridrow" : $rowsClass[$rowNo];
                                //$colClass = ($colsClass[$colNo] == NULL) ? "datagridcol" : $colsClass[$colNo];
                                $colClass ="";
				$code .= "<tr class='{$rowClass}'>";
				//if ($showEdit) $code .= "<td align='center' class='{$colClass}'><a href='?func=post&act=edition&pid={$row["id"]}'><img src='{$DBase->Site_Theme_Add}edit.gif' /></a></td>";
				$code .= "<td align='center' class='{$colClass}'>" . ($rowNo + ($pageNo*$itemsInPage) + 1) . "</td>";
				$colNo = 0;
				foreach($row as $key2=>$value)
				{
					if ($colNo >= Count($fields)) break;
					if (!$showKey && $key2 == $keyName) continue;
					$code .= "<td class='{$colClass}'>";
					$code .= $row[$fields[$colNo]];
					$code .= "</td>";
					$colNo++;
				}
				//if ($showDelete) $code .= "<td align='center' class='{$colClass}'><a href='?func=post&act=delete&pid={$row["id"]}&pageNo={$_GET["pageNo"]}'><img src='{$DBase->Site_Theme_Add}delete.gif' /></a></td>";
				$code .= "</tr>";
				$rowNo++;
				if ($rowNo >= $itemsInPage) break;
			}
			$code .= "<tr>";
		//	if ($showEdit) $colNo++;
		//	if ($showDelete) $colNo++;
			$colNo++;
			$code .= "<td colspan='{$colNo}' align='center' dir='rtl' class='page-num'>";
			for($i = 0, $p = 1; $i <= ($rowCount-1)/$itemsInPage; $i++, $p++)
			{
				$code .= "<a style='text-decoration:none' href='?{$address}&pageNo={$i}'> " . str_replace("-", "&nbsp;", str_pad($p, 5, "-", STR_PAD_BOTH))  . " </a>";
			}
			$code .= "</td>";
			$code .= "</tr>";
			$code .= "</table>";
			return $code;
		} 
function SendEmail($senderEmail, $senderName, $receivers, $subject, $message)
	{
		$mail = new PHPMailer();
		$senderName = "=?UTF-8?B?" . base64_encode($senderName) . "?=";
		$mail->SetFrom($senderEmail, $senderName);
		foreach($receivers as $key=>$r)
			$mail->AddAddress($r);
		$mail->Subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";
		//$mail->MsgHTML("=?UTF-8?B?" . base64_encode($message). "?=");
                $mail->CharSet = "utf-8";
                $mail->MsgHTML($message);
		$mail->Priority = 1;
                //$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		return $mail->Send();
	}
     function SendSmtpEmail($senderemail,$sendername,$receivers, $subject, $message,$host,$port,$username,$password)
      {
        $mail = new PHPMailer();
        $mail->Host       = "mail.tibacms.com";
        //$mail->SMTPDebug  = 2;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = $host;
        $mail->Port       = $port;
        $mail->Username   = $username;
        $mail->Password   = $password;
        $mail->SetFrom($senderemail, $sendername);

        //$mail->AddReplyTo($senderemail, $sendername);
        $mail->Subject = $subject;
        $mail->CharSet = "utf-8";
        $mail->MsgHTML($message);
        $mail->WordWrap = 50;
        foreach($receivers as $key=>$r) $mail->AddAddress($r);
        $mail->IsHTML(true);
        return $mail->Send();
      }
		
		function IntegerOptionTag($fnum,$tnum,$optionname,$selected=Null,$onchange=Null)
        {
            $option = "<select name='$optionname' id='$optionname' onchange='$onchange' >";
            for($i=$fnum;$i<=$tnum;$i++)
            {
               if ($selected == $i){ $select = "selected='1'";} else { $select="";}
                $option.="<option value='$i'{$select} >$i</option>";
            }
            $option.="</select>";

            return  $option;

        }

        function BooleanOptionTag($optionname,$trueval,$falseval,$selectedval=1)
        {
          if ($selectedval==1)  {$trueselected="selected"; $falseselected="";}
          else {$trueselected=""; $falseselected="selected";};
         $option="<select id='$optionname;' name='$optionname'>";
         $option.="<option {$trueselected} value='1'>$trueval</option>";
         $option.="<option {$falseselected} value='0'>$falseval</option>";
         $option.="</select>";
         return $option;
        }

        function SelectOptionTag($optionname,$arraydata,$selected=Null,$onchange=Null)
        {
            $option = "<select name='$optionname' id='$optionname' onchange='$onchange' >";
            foreach($arraydata as $key=>$val)
            {
               if ($selected == $key){ $select = "selected='1'";} else { $select="";}
                $option.="<option value='$key'{$select} >$val</option>";
            }
            $option.="</select>";
            //var_dump($option);
            return  $option;
        }
       function GetUserName($userid)
	   {
	      $db = Database::GetDatabase();
		  $row = $db ->Select("users","name,family","ID = '{$userid}'");
		  return ($row["name"]." ".$row["family"]);
	   }
?>