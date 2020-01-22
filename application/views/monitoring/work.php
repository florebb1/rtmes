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
	<div class="card-body">
		<h4>작업중</h4>
		<div class="table-responsive">
    		<table class="table table-bordered">
    			<thead>
    				<tr>
    					<th class="text-center">작업명</th>
                      <?php for($i=0; $i<5; $i++){?>
                       	<th class="text-center">공정<?php echo $i+1;?></th>
                       	
                       	<?php }?>
                       	<th class="text-center">현재 작업자</th>
                       	<th class="text-center">공정완료</th>
            		</tr>
              
    			</thead>
            	<tbody>
            		<?php for($i=0; $i<2; $i++){?>
                    <tr>
                       	<th class="text-center">
                       		로트 <?php echo $i+1;?>
                       	</th>
                    	 <?php for($j=0; $j<5; $j++){?>
                       		<td class="text-center">완료</td>
                       	<?php }?>
                       	<td>홍길동</td>
                       	<td>확인</td>
                    </tr>
                    <?php }?>
            	</tbody>
    		</table>
		</div>
		
		<h4>대기중</h4>
		<div class="table-responsive">
    		<table class="table table-bordered">
    			<thead>
    				<tr>
    					<th class="text-center">작업명</th>
                      <?php for($i=0; $i<5; $i++){?>
                       	<th class="text-center">공정<?php echo $i+1;?></th>
                       	
                       	<?php }?>
                       	<th class="text-center">현재 작업자</th>
                       	<th class="text-center">공정완료</th>
            		</tr>
              
    			</thead>
            	<tbody>
            		<?php for($i=0; $i<7; $i++){?>
                    <tr>
                       	<th class="text-center">
                       		로트 <?php echo $i+3;?>
                       	</th>
                    	 <?php for($j=0; $j<5; $j++){?>
                       		<td class="text-center"><a href="javascript:startprocess();">대기</a></td>
                       	<?php }?>
                       	<td></td>
                       	<td></td>
                    </tr>
                    <?php }?>
            	</tbody>
    		</table>
		</div>
		
	</div>
</div>

<script type="text/javascript">
function startprocess(){
	if(confirm("공정을 시작하겠습니까?")){

	}
}
</script>

<?php include_once $root.'/footer.php';?>