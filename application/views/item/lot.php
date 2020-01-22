<?php include_once $root.'/head.php';?>
<div class="card">
	<div class="card-header">
		<div class="card-tools">
			<form action="" method="get" class="form-inline">
				
				<input type="text" class="form-control" placeholder="기간" name="st_date">&nbsp;&nbsp;~&nbsp;&nbsp;
				<input type="text" class="form-control" placeholder="기간" name="ed_date">&nbsp;&nbsp;
				<button class="btn btn-info">1일</button>&nbsp;&nbsp;
				<button class="btn btn-info">고객사</button>&nbsp;&nbsp; 
				<button class="btn btn-info">품목명</button>&nbsp;&nbsp;
				<button class="btn btn-primary" id="search_btn">검색</button>&nbsp;&nbsp;
				<button class="btn btn-primary">전표 발행</button>&nbsp;&nbsp;
				<button class="btn btn-primary">청구서 발행</button>
			</form>
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
    					<th class="text-center"></th>
    					<th class="text-center">의뢰번호</th>
    					<th class="text-center">고객사</th>
    					<th class="text-center">품번</th>
    					<th class="text-center">품목</th>
    					<th class="text-center">요구 납기(일)<br/>(입력/편집)</th>
    					<th class="text-center">실제 납기<br/>(접수/배송)</th>
    					<th class="text-center">접수 일시</th>
    					<th class="text-center">완료 일시<br/>(출하 대기)</th>
    					<th class="text-center">배송 시기</th>
    					<th class="text-center">납품 후기</th>
    					<th class="text-center">클레임 여부</th>                      
            		</tr>              
    			</thead>
            	<tbody>
            		<tr>
            			<td class="text-center"><input type="checkbox"></td>		
            			<td class="text-center">A123567</td>		
            			<td class="text-center">가치과</td>		
            			<td class="text-center">qew123</td>		
            			<td class="text-center">크라운</td>		
            			<td class="text-center">3.5일</td>		
            			<td class="text-center">3.1일</td>		
            			<td class="text-center">2019.12.31</td>		
            			<td class="text-center">2020.01.03</td>		
            			<td class="text-center">2020.01.04</td>		
            			<td class="text-center">포장 보완 요청</td>		
            			<td class="text-center"><input type="checkbox"></td>		
            					
            		</tr>	
            	</tbody>
    		</table>
		</div>
		
		
	</div>
</div>

<script type="text/javascript">

</script>

<?php include_once $root.'/footer.php';?>