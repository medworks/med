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
                        case 'works':
                            if ($act=="do") return "works.php";
                        break;			          
                        case 'news':
                            if ($act=="do") return "news.php";
						break;
						case 'worksmgr':
                            if ($act=="do"or $act=="new" or $act=="mgr") return "../manager/worksmgr.php";
						break;
						case 'newsmgr':
                            if ($act=="do" or $act=="new" or $act=="mgr" or $act=="del" or $act=="edit") return "../manager/newsmgr.php";
						break;
						case 'usermgr':
                            if ($act=="do" or $act=="new" or $act=="mgr") return "../manager/usermgr.php";
						break;
		}
	}
	function GetMessage($msgid)
	{
		$msg = Message::getMessage();	
		switch($msgid)
		{
			case 1:
				return $msg->ShowSuccess("ثبت اطلاعات با موفقیت انجام شد");
			break;	
			case 2:
				return $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			break;	
            case 3:
				return $msg->ShowError("عمليات آپلود با مشكل مواجه شد");
			break;	
			case 4:
				return $msg->ShowError("لطفا فایل عکس را انتخاب کنید");
			break;	
			case 5:
				return $msg->ShowError("لطفا فیلد توضیحات را ثبت کنید");
			break;	
		}
	}
  
function Pagination($itemsCount, $maxItemsInPage,
		$currentPageNo, $maxPageNumberAtTime, $linkFormat = "%PN%")
         {
		$pageCount = ceil($itemsCount / $maxItemsInPage);
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
			$firstPage = '<td class="spriteimg" id="firstPage"><a href="' . $link . '" class="pagenumber"></a></td>';
			$link = str_replace("%PN%", $currentPageNo - 1, $linkFormat);
			$prevPage = '<td class="spriteimg" id="prevPage"><a href="' . $link . '" class="pagenumber"></a></td>';
		}
		if ($currentPageNo < $pageCount)
		{
			$link = str_replace("%PN%", $currentPageNo + 1, $linkFormat);
			$nextPage = '<td class="spriteimg" id="nextPage"><a href="' . $link . '" class="pagenumber"></a></td>';
			$link = str_replace("%PN%", $pageCount, $linkFormat);
			$lastPage = '<td class="spriteimg" id="lastPage"><a href="' . $link . '" class="pagenumber"></a></td>';
		}
		$code = '<center><table dir="ltr" border="0" style="padding-top:10px;padding-bottom:10px;"><tr>' . $firstPage . $prevPage;
		for($i = $left; $i <= $right; $i++)
		{
			if ($i == $currentPageNo)
			{
				$code .= '<td><span class="pagenumber_selected">' . $i . '</span></td>';
			}
			else
			{
				$link = str_replace("%PN%", $i, $linkFormat);
				$code .= '<td><a href="' . $link . '" class="pagenumber">' . $i . '</a></td>';
			}
		}
		$code .= $nextPage . $lastPage . "</tr></table></center>";
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
			for($i = 0, $p = 1; $i <= (($rowCount-1)/$itemsInPage); $i++, $p++)
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
?>