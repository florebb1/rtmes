<?php include_once $root.'/head.php';?>
<!-- FLOT CHARTS -->
<script src="<?php echo $base_url;?>plugins/flot/jquery.flot.js"></script>
<div class="card">
			  <div class="card-header">
                <h3 class="card-title" style="float: none;text-align: center;">
                	 <button type="button" class="btn btn-tool"><i class="fas fa-arrow-left"></i></button>
                2019-12
                	 <button type="button" class="btn btn-tool"><i class="fas fa-arrow-right"></i></button>
                </h3>
				<div class="card-tools" style="float: none;margin-right: 0;position: absolute;right: 15px;top: 3px;">
                  
                </div>
              </div>
              <div class="card-body">
                <div id="bar-chart" style="height: 300px;"></div>
 </div>
 <!-- /.card-body -->
</div>
<!-- /.card -->

<script type="text/javascript">
var bar_data = {
	      data : [[1,10], [2,8], [3,4], [4,13], [5,17], [6,9]],
	      bars: { show: true }
	    }
	    $.plot('#bar-chart', [bar_data], {
	      grid  : {
	        borderWidth: 1,
	        borderColor: '#eeeeee',
	        tickColor  : '#de5563;'
	      },
	      series: {
	         bars: {
	          show: true, barWidth: 0.5, align: 'center',
	        },
	      },
	      colors: ['#de5563'],
	      xaxis : {
	        ticks: [[1,'고객사 A'], [2,'고객사 B'], [3,'고객사 C'], [4,'고객사 D'], [5,'고객사 E'], [6,'고객사 F']]
	      }
	    })
	    /* END BAR CHART */
</script>
<?php include_once $root.'/footer.php';?>