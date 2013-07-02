<?php
$db = database::GetDatabase();
$slides= $db->SelectAll('slides',NULL,NULL," pos ASC");

$html="<div class='content'>
		<div class='recent-works main-box'>
			<h2>گالری تصاویر</h2>
			<div class='line'></div>
			<div class='badboy'></div>
			<div class='works box-right gallery-page'>";

$html.=<<<ct
				<ul>
ct;
					for($i=0 ; $i<count($slides) ; $i++){
$html.=<<<ct
						<li>
							<a href="{$slides[$i][image]}" rel="prettyphoto[gallery3]" title="{$slides[$i][subject]}">
								<img src="{$slides[$i][image]}" alt="{$slides[$i][subject]}">
							</a>
							<h2><a href="{$slides[$i][image]}" rel="prettyphoto[gallery3]" title="{$slides[$i][subject]}">{$slides[$i][subject]}</a></h2>
						</li>
ct;
					}
$html.=<<<ct
				</ul>
				<div class="badboy"></div>
			</div>
		</div>
	   </div>


ct;

return $html;
?>