<?php include_once $root.'/head.php';?>

<div class="card">
	<div class="card-header">
		<div class="card-tools">
			<form action="" method="get" class="form-inline">
				
				<input type="text" class="form-control" placeholder="기간" name="st_date">&nbsp;&nbsp;~&nbsp;&nbsp;
				<input type="text" class="form-control" placeholder="기간" name="ed_date">&nbsp;&nbsp;
				<button class="btn btn-info">1일</button>&nbsp;&nbsp;
				<button class="btn btn-info">1주일</button>&nbsp;&nbsp; 
				<button class="btn btn-info">1달</button>&nbsp;&nbsp;
				<button class="btn btn-primary" id="search_btn">검색</button>
			</form>
		</div>
	</div>
	<div class="card-body table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center">공정명</th>
                  <?php for($i=0; $i<count($process); $i++){?>
                   	<th class="text-center"><?php echo $process[$i]["name"];?></th>
                   	
                   	<?php }?>
        		</tr>
          
			</thead>
        	<tbody>
        		<?php for($i=0; $i<6; $i++){?>
                <tr>
                   	<th class="text-center">
                   		<?php if($i == 0){
                   		    echo "품목 수";
                   		}else if($i == 1){
                   		    echo "작업 시간";
                   		}else if($i == 2){
                   		    echo "대기 시간";
                   		}else if($i == 3){
                   		    echo "불량 수";
                   		}else if($i == 4){
                   		    echo "작업자 수";
                   		}else if($i == 5){
                   		    echo "설비 수";
                   		}
                   		    ?>
                   	</th>
                	 <?php for($j=0; $j<count($process); $j++){?>
                   		<td class="text-center"></td>
                   	
                   	<?php }?>
                </tr>
                <?php }?>
        	</tbody>
		</table>
	</div>
</div>

<?php include_once $root.'/footer.php';?>