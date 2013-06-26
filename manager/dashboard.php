<?php
    include_once("../config.php");
    include_once("../classes/database.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");		
		
	$db = Database::GetDatabase();
	$news = $db->SelectAll("news","*",null,"ndate");
	$row = array();
	$gdate = array();
	$count = array();
	foreach($news as $key => $val)
	{
	  $row[] = "'".ToJalali($val['ndate'],"Y-m-d")."'";
	  $gdate[] = "'".date("Y-m-d",strtotime($val['ndate']))."'";	  
	}
	//echo "count gdate is :",count($gdate);
	//foreach($gdate as $key => $val) echo $val."<br/>";
	$uniq = array_unique($row);
	$guniq = array_unique($gdate);
	//echo "count guniq is :",count($guniq);
	foreach($gdate as $key => $val)
	{
		$count[] = $db->CountOf("news","ndate = {$val}");
        //echo $db->cmd;		
	}
	$xAxis = implode(', ',$uniq);
	$series = implode(', ',$count);

 $html=<<<cd
 
 <script src="../lib/highcharts/js/highcharts.js"></script>
 <script src="../lib/highcharts/js/modules/exporting.js"></script>
 <script type="text/javascript">
 $(function () {
        $('#pnlnews').highcharts({
           chart: {		
				 type: 'spline',		   
				width: 800,
				height:600,
				zoomType: 'xy'
			},			
            title: {
                text: 'نمودار اخبار'
            },
            xAxis: {			 
                categories: [{$xAxis}]
            },
            credits: {
                enabled: false
            },
            series: [{
			    title: {
                    text: 'تعداد خبر'
                },
                name: 'تعداد خبر',
                data: [{$series}]
                }]
        });
    });
		
	</script>

 <div id="pnlnews" style="width: 400px; height: 400px; margin: 0 auto"></div>

cd;
 return $html;
?>