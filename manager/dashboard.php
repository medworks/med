<?php
    include_once("../config.php");
    include_once("../classes/database.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");		
		
	$db = Database::GetDatabase();
	$news = $db->SelectAll("news","*",null,"ndate");	
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
    $works = $db->SelectAll("works","*",null,"sdate");
    foreach($works as $key => $val)
	{
	  $row[] = "'".ToJalali($val['sdate'],"Y-m-d")."'";	
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
$list = array("area"=>"محیطی",
              "line"=>"خطی",
              "pie"=>"دایره ای",
			  "bar"=>"میله ای");
$combobox = SelectOptionTag("cbchart",$list,'area','GoUrl("adminpanel.php?item=dashboard&act=do")');	
 $html=<<<cd
 
 <script src="../lib/highcharts/js/highcharts.js"></script>
 <script src="../lib/highcharts/js/modules/exporting.js"></script>
 <script type="text/javascript">
 $(function () {
 alert($('#cbchart').val());
        $('#pnlnews').highcharts({
           chart: {		
				type: $('#cbchart').val(),
				width: 800,
				height:600,
				zoomType: 'xy'
			},			
            title: {
			style: {fontFamily: 'bmitra', fontWeight: 'bold', fontSize: '25px' },
             text: 'نمودار اخبار'
            },
            xAxis: {			   
			  style: {fontFamily: 'bmitra', fontWeight: 'bold', fontSize: '25px' },	
              categories: [{$xnAxis}]
            },
			yAxis: {
			  style: {fontFamily: 'bmitra', fontWeight: 'bold', fontSize: '25px' },
              title: {
                    text: 'تعداد خبر '
                }
            },
            credits: {
                enabled: false
            },			
            series: [{
			style: {fontFamily: 'bmitra', fontWeight: 'bold', fontSize: '25px' },
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
			style: {fontFamily: 'bmitra', fontWeight: 'bold', fontSize: '25px' },
                text: 'نمودار فعالیت های اخذ شده '
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
	<span>انتخاب نوع نمودار</span>
{$combobox}
<hr/>
 <div id="pnlnews" style="width: 400px; height: 400px; margin: 0;"></div>
 <hr/><br/>
 <div id="pnlworks" style="width: 400px; height: 400px; margin:200px 0;"></div>

cd;
 return $html;
?>