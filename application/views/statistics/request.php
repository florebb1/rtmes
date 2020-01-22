<?php include_once $root.'/head.php';?>
<!-- ChartJS -->
<script src="<?php echo $base_url;?>plugins/chart.js/Chart.min.js"></script>
<div class="card">
			  <div class="card-header">
                <h3 class="card-title" style="float: none;text-align: center;">
                	 <button type="button" class="btn btn-tool"><i class="fas fa-arrow-left"></i></button>
                2019-12
                	 <button type="button" class="btn btn-tool"><i class="fas fa-arrow-right"></i></button>
                </h3>

              </div>
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
	      labels  : ['A 고객사','B 고객사','C 고객사','D 고객사','E 고객사','F 고객사'],
	      datasets: [
	        {
	          label               : '일반',
	          backgroundColor     : 'rgba(60,141,188,0.9)',
	          borderColor         : 'rgba(60,141,188,0.8)',
	          pointRadius          : false,
	          pointColor          : '#3b8bba',
	          pointStrokeColor    : 'rgba(60,141,188,1)',
	          pointHighlightFill  : '#fff',
	          pointHighlightStroke: 'rgba(60,141,188,1)',
	          data                : [30,35,23,15,23,19]
	        },
	        {
	          label               : '리메이크',
	          backgroundColor     : 'rgba(210, 214, 222, 1)',
	          borderColor         : 'rgba(210, 214, 222, 1)',
	          pointRadius         : false,
	          pointColor          : 'rgba(210, 214, 222, 1)',
	          pointStrokeColor    : '#c1c7d1',
	          pointHighlightFill  : '#fff',
	          pointHighlightStroke: 'rgba(220,220,220,1)',
	          data                : [20,10,25,43,30,11]
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