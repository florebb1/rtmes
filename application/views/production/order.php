<?php include_once $root.'/head.php';?>
<div class="card">
	<div class="card-header">
		<div class="card-tools form-inline">
				<input type="text" class="form-control" readonly="readonly" placeholder="날짜 선택">&nbsp;&nbsp;&nbsp; 
				<button class="btn btn-primary">청구서 발행</button>
		</div>
	</div>
	<div class="card-body">
		
		<div class="text-right" style="margin-bottom: 20px;">
			<button class="btn btn-primary" id="reg_btn">저장</button>
		</div>
		
		<div class="table-responsive">
    		<table class="table table-bordered">
    			<thead>
    				<tr>
    					<?php for($i=0; $i<10; $i++){?>
    					<th class="text-center">작업자 <?php echo $i+1;?></th>
    					<?php }?>
            		</tr>              
    				<tr>
    					<?php for($i=0; $i<10; $i++){?>
    					<th class="text-center">공정 <?php echo $i+1;?></th>
    					<?php }?>
            		</tr>              
    			</thead>
            	<tbody>
            		<tr>
    					<?php for($i=0; $i<10; $i++){?>
    					<td class="text-center">
    						<select class="form-control"> 
    							<option value="0">-품번 선택-</option>
    						</select>
    					</td>
    					<?php }?>
            		</tr>   

            	</tbody>
    		</table>
		</div>
		
		
	</div>
</div>

<script type="text/javascript">

</script>

<?php include_once $root.'/footer.php';?>