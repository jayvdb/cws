<?php 
include("form/navigasi.php") ;

$qry = mysql_query("SELECT SUM( IF( `sex`='M',  1 , 0 ) ) AS  `M`, SUM( IF( `sex`='F',  1 , 0 ) ) AS  `F` FROM  `person` ") or die( mysql_error());
$data=mysql_fetch_array($qry);
?>
<script src="<?php echo $URL ?>js/plugins/morris/raphael.min.js"></script>
<script src="<?php echo $URL ?>js/plugins/morris/morris.min.js"></script>
<script src="<?php echo $URL ?>js/plugins/morris/morris-data.js"></script>
<div id="page-wrapper">
<div class="row">
<div id="myfirstchart" style="height: 250px;"></div>
</div>
</div>
<script>
new Morris.Donut({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
	<?php
	echo "{ label: 'Male', value:".$data['M']."},";
	echo "{ label: 'Female', value:".$data['F']."}";
	
	?>
    //{ year: '2008', value: 20 },
    //{ year: '2009', value: 10 },
    //{ year: '2010', value: 5 },
    //{ year: '2011', value: 5 },
    //{ year: '2012', value: 20 }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'sex',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});
</script>
