<?php include_once $root.'/head.php';?>
<!-- ChartJS -->
<script src="<?php echo $base_url;?>plugins/chart.js/Chart.min.js"></script>
<div class="card">
			  <div class="card-header">
                <h3 class="card-title" style="float: none;text-align: center;">
                	 <a href="/statistics/request?type=<?php echo $type?>&date=<?php echo $prev_date;?>"><i class="fas fa-arrow-left"></i></a>
                	 &nbsp;&nbsp;<?php echo $current_date;?>&nbsp;&nbsp;
                	 <a href="/statistics/request?type=<?php echo $type?>&date=<?php echo $next_date;?>"><i class="fas fa-arrow-right"></i></a>
                </h3>
				<div class="card-tools" style="float: none;margin-right: 0;position: absolute;right: 15px;top: 3px;">
				  <div class="form-inline">	
                  	
                  	<input type="button" value="월별"  class="searh-btn btn <?php if($type == 1){?>btn-primary<?php }?>">
                  	<input type="button" value="년도별" class="searh-btn btn <?php if($type == 2){?>btn-primary<?php }?>">
                  </div> 	
                </div>
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

$(".searh-btn").on("click",function(){
	if($(this).val() == "월별"){
		location.href= "/statistics/request?type=1";
	}else{
		location.href= "/statistics/request?type=2";
	}
});

var areaChartData = {
	//      labels  : ['A 고객사','B 고객사','C 고객사','D 고객사','E 고객사','F 고객사'],
	      labels  : [
	    	  <?php for($i=0; $i<count($list); $i++){ ?>
			  <?php if($i== count($list)-1){?>
			  	'<?php echo $list[$i]["name"]; ?>'
			  <?php }else{?>
			  	'<?php echo $list[$i]["name"]; ?>',
			  <?php }?>
			  <?php }?>
		      ],
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
//	          data                : [30,35,23,15,23,19]
	          data                : [ <?php for($i=0; $i<count($list); $i++){ ?>
			  <?php if($i== count($list)-1){?>
			  	<?php echo $list[$i]["normal_total"]; ?>
			  <?php }else{?>
			  	<?php echo $list[$i]["normal_total"]; ?>,
			  <?php }?>
			  <?php }?>]
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
//	          data                : [20,10,25,43,30,11]
	          data                : [
		          <?php for($i=0; $i<count($list); $i++){ ?>
			  <?php if($i== count($list)-1){?>
			  	<?php echo $list[$i]["remake_total"]; ?>
			  <?php }else{?>
			  	<?php echo $list[$i]["remake_total"]; ?>,
			  <?php }?>
			  <?php }?>]
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