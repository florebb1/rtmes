<?php include_once $root.'/head.php';?>
<link rel="stylesheet" href="<?php echo $base_url;?>plugins/jquery-ui/jquery-ui.css">
<script src="<?php echo $base_url;?>plugins/jquery-ui/jquery-ui.js"></script>
<!-- FLOT CHARTS -->
<script src="<?php echo $base_url;?>plugins/flot/jquery.flot.js"></script>

<div class="card">
			  <div class="card-header">
                <h3 class="card-title" style="float: none;text-align: center;">
                	 <a href="/statistics/reception?date=<?php echo $prev_date;?>"><i class="fas fa-arrow-left"></i></a>
                	 &nbsp;&nbsp;<?php echo $current_date;?>&nbsp;&nbsp;
                	 <a href="/statistics/reception?date=<?php echo $next_date;?>"><i class="fas fa-arrow-right"></i></a>
                </h3>
				<div class="card-tools" style="float: none;margin-right: 0;position: absolute;right: 15px;top: 3px;">
				  <div class="form-inline">	
                  <input type="text" class="form-control" readonly="readonly" placeholder="날짜 선택" id="input-date" name = "input-date" value="<?php echo $current_date;?>">&nbsp;&nbsp;
                  <input type="button" value="검색" id="search-btn" class="btn btn-primary">
                  </div> 	
                </div>
              </div>
              <div class="card-body">
                <div id="bar-chart" style="height: 300px;"></div>
 </div>
 <!-- /.card-body -->
</div>
<!-- /.card -->

<script type="text/javascript">
$( "#input-date" ).datepicker({
  dateFormat: "yy-mm-dd"
});
$("#search-btn").on("click",function(){
	var date = $("#input-date").val();
	if(date == ""){
		alert("검색할 날짜를 선택하세요."); 
	}else{
		location.href= "/statistics/reception?date="+date;
	}
});
var bar_data = {
	      data : 
			  [		
               <?php for($i=0; $i<count($list); $i++){ ?>
			  <?php if($i== count($list)-1){?>
			  	[<?php echo $i+1; ?>,<?php echo $list[$i]["total"]; ?>]
			  <?php }else{?>
			  		[<?php echo $i+1; ?>,<?php echo $list[$i]["total"]; ?>],
			  <?php }?>
			  <?php }?>
			  ],
	      bars: { show: true }
	    }
	    $.plot('#bar-chart', [bar_data], {
	      grid  : {
	        borderWidth: 1,
	        borderColor: '#dedede',
	        tickColor  : '#f3f3f3'
	      },
	      series: {
	         bars: {
	          show: true, barWidth: 0.5, align: 'center',
	        },
	      },
	      colors: ['#3c8dbc'],
	      xaxis : {
	        ticks: [<?php for($i=0; $i<count($list); $i++){ ?>
			  <?php if($i== count($list)-1){?>
			  	[<?php echo $i+1; ?>,'<?php echo $list[$i]["name"]; ?>']
			  <?php }else{?>
			  		[<?php echo $i+1; ?>,'<?php echo $list[$i]["name"]; ?>'],
			  <?php }?>
			  <?php }?>]
	      }
	    })
   
	    /* END BAR CHART */
<?php /* ?>
var bar_data = {
	      data : 
				
		      [[1,10], [2,8], [3,4], [4,13], [5,17], [6,9]],
	      bars: { show: true }
	    }
	    $.plot('#bar-chart', [bar_data], {
	      grid  : {
	        borderWidth: 1,
	        borderColor: '#dedede',
	        tickColor  : '#f3f3f3'
	      },
	      series: {
	         bars: {
	          show: true, barWidth: 0.5, align: 'center',
	        },
	      },
	      colors: ['#3c8dbc'],
	      xaxis : {
	        ticks: [[1,'고객사 A'], [2,'고객사 B'], [3,'고객사 C'], [4,'고객사 D'], [5,'고객사 E'], [6,'고객사 F']]
	      }
	    })
	    <?php */ ?>	 

</script>
<?php include_once $root.'/footer.php';?>