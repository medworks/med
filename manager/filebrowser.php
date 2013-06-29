<?php    	
    $pics = "";
	$dir = "";	
	if ($_GET['item']=="newsmgr")
	{	   
		$dir='../newspics';
	}	
	else
	if ($_GET['item']=="worksmgr")
	{	 
		$dir='../worksmgr';
	}		
    $handle=opendir($dir);
    while ($file = readdir($handle))
    {        
         if (!preg_match("/^[.]/",$file,$out, PREG_OFFSET_CAPTURE))
         {             
			 if(is_file("{$dir}/".$file))
			 {                              
					  $dirname = "{$dir}/".basename($file);
					  $filename = basename($file);
					  $exe = substr($filename, strrpos($filename, '.') + 1);
					  $name = substr($filename, 0, strrpos($filename, '.'));
					  $allowedExts = array('jpg','jpeg','png','bmp','gif');

					if(in_array($exe, $allowedExts)){
                      $pics.=<<<cd
					    <li>
							<div class="pic">
								<a class="select" title="انتخاب عکس {$name}">
									<img src="{$dirname}" alt="{$name}" />
									<div class="overlay"></div>
								</a>
							</div>
							<h2><span class="highlight">نام فایل: </span><span class="filename">{$name}</span></h2>
						</li>
cd;
					}
			  }
        }
    }
   
    closedir($handle);  
$html=<<<cd
	<div class="picmanager">
		<div class="prev right">
			<div class="pic">
				<img id="previmage" src="../themes/default/images/admin/imgprev.jpg" alt="">
			</div>
			<div class="detail">
				<h2><span class="highlight">نام فایل: </span><span id="namepreview">---</span></h2>
				<p><span class="highlight">پسوند: </span><span id="typepreview">---</span></p>
				<p><span class="highlight">سایز: </span><span id="sizepreview">---</span></p>
			</div>
			<a title="انتخاب عکس" class="button" id="select">انتخاب</a>
			<a title="خروج" class="button" id="exit">خروج</a>
		</div>
		<div class="files right">
			<div class="pics">
				<ul>
					{$pics}                    
				</ul>
				<div class="badboy"></div>
			</div>
		</div>
		<div class="badboy"></div>
	</div>
cd;
echo $html;
?>