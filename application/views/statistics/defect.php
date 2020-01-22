<?php include_once $root.'/head.php';?>
<!-- ChartJS -->
<script src="<?php echo $base_url;?>plugins/chart.js/Chart.min.js"></script>
<div class="card">

              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
 </div>
 <!-- /.card-body -->
</div>
<!-- /.card -->

<script type="text/javascript">
var areaChartData = {
	      labels  : ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
	      datasets: [
	        {
	          label               : '2018년 제조불량률',
	          backgroundColor     : 'rgba(60,141,188,0.9)',
	          borderColor         : 'rgba(60,141,188,0.8)',
	          pointRadius          : false,
	          pointColor          : '#3b8bba',
	          pointStrokeColor    : 'rgba(60,141,188,1)',
	          pointHighlightFill  : '#fff',
	          pointHighlightStroke: 'rgba(60,141,188,1)',
	          data                : [28, 48, 40, 19, 86, 27, 90,10,20,33,15,2]
	        },
	        {
	          label               : '2019년 제조불량률',
	          backgroundColor     : 'rgba(210, 214, 222, 1)',
	          borderColor         : 'rgba(210, 214, 222, 1)',
	          pointRadius         : false,
	          pointColor          : 'rgba(210, 214, 222, 1)',
	          pointStrokeColor    : '#c1c7d1',
	          pointHighlightFill  : '#fff',
	          pointHighlightStroke: 'rgba(220,220,220,1)',
	          data                : [65, 59, 80, 81, 56, 55, 40,5,14,23,60,10]
	        },
	      ]
	    }
//-------------
//- BAR CHART -
//-------------
var barChartCanvas = $('#barChart').get(0).getContext('2d')
var barChartData = jQuery.extend(true, {}, areaChartData)
var temp0 = areaChartData.datasets[0]
var temp1 = areaChartData.datasets[1]
barChartData.datasets[0] = temp1
barChartData.datasets[1] = temp0

var barChartOptions = {
  responsive              : true,
  maintainAspectRatio     : false,
  datasetFill             : false
}

var barChart = new Chart(barChartCanvas, {
  type: 'bar', 
  data: barChartData,
  options: barChartOptions
})
</script>
<?php include_once $root.'/footer.php';?>