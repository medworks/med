<?php
    include_once("../config.php");
    include_once("../classes/database.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");		
		
	$db = Database::GetDatabase();
	$news = $db->SelectAll("news","*",null,"ndate");
	$works = $db->SelectAll("works","*",null,"fdate");
	$row = array();
	$itemcount = array();
	$count = array();
	foreach($news as $key => $val)
	{
	  $row[] = "'".ToJalali($val['ndate'],"Y-m-d")."'";	
	}	
	$uniq = array_unique($row);	
	$itemcount = array_count_values($row);	
	foreach($itemcount as $key => $val)
	{
		$count[] = $val;        
	}
	$xnAxis = implode(', ',$uniq);
	$nseries = implode(', ',$count);
	unset($row);
	unset($itemcount);
	unset($count);
//*************************************************************
    foreach($works as $key => $val)
	{
	  $row[] = "'".ToJalali($val['fdate'],"Y-m-d")."'";	
	}	
	$uniq = array_unique($row);	
	$itemcount = array_count_values($row);	
	foreach($itemcount as $key => $val)
	{
		$count[] = $val;        
	}
	$xwAxis = implode(', ',$uniq);
	$wseries = implode(', ',$count);	
    unset($row);
	unset($itemcount);
	unset($count);
 $html=<<<cd
 
 <script src="../lib/highcharts/js/highcharts.js"></script>
 <script src="../lib/highcharts/js/modules/exporting.js"></script>
 <script type="text/javascript">
 $(function () {
        $('#pnlnews').highcharts({
           chart: {		
				 type: 'area',		   
				width: 800,
				height:600,
				zoomType: 'xy'
			},			
            title: {
                text: 'نمودار اخبار'
            },
            xAxis: {
				style: {
                    font: 'bold 15px bmira,tahoma'
                },			
                categories: [{$xnAxis}]
            },
			yAxis: {
                title: {
                    text: 'تعداد خبر '
                }
            },
            credits: {
                enabled: false
            },
			
            series: [{
			    title: {
                    text: 'تعداد'
                },
                name: 'تعداد اخبار ',
				color: '#8bbc21',
                data: [{$nseries}]
                }]
        });
    });
	$(function () {
        $('#pnlworks').highcharts({
           chart: {		
				 type: 'area',		   
				width: 800,
				height:600,
				zoomType: 'xy'
			},			
            title: {
                text: 'نمودار فعالیت های انجام شده'
            },
            xAxis: {			 
                categories: [{$xwAxis}]
            },
			yAxis: {
                title: {
                    text: 'تعداد فعالیت '
                }
            },
            credits: {
                enabled: false
            },
			
            series: [{
			    title: {
                    text: 'تعداد'
                },
                name: 'تعداد فعالیت ',
                data: [{$wseries}]
                }]
        });
    });

	</script>

 <div id="pnlnews" style="width: 400px; height: 400px; margin: 0;"></div>
 <hr/><br/>
 <div id="pnlworks" style="width: 400px; height: 400px; margin:650px 0;"></div>

cd;
 return $html;
?>