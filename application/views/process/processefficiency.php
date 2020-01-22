<?php include_once $root.'/head.php';?>

<div class="card">
	<div class="card-header">
		<div class="card-tools">
			<form action="" method="get" class="form-inline">
				<select class="form-control">
					<option value="0">전체공정</option>
					<?php for($i=0; $i<count($process); $i++){?>
					<option value="<?php echo $process[$i]["process_id"]; ?>"><?php echo $process[$i]["name"]; ?></option>	
					<?php }?>
				</select>&nbsp;&nbsp;
				<input type="text" class="form-control" placeholder="기간">&nbsp;&nbsp;~&nbsp;&nbsp;
				<input type="text" class="form-control" placeholder="기간">&nbsp;&nbsp;
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
					<th class="text-center">이름</th>
					<th class="text-center">공정명</th>
					<th class="text-center">품목수</th>
					<th class="text-center">작업시간</th>
					<th class="text-center">대기시간</th>
					<th class="text-center">평균작업시간</th>
					<th class="text-center">평균대기시간</th>
        		</tr>
          		<tr>
          			<th class="text-center">합계</th>
					<th class="text-center"></th>
					<th class="text-center"></th>
					<th class="text-center"></th>
					<th class="text-center"></th>
					<th class="text-center"></th>
					<th class="text-center"></th>
          		</tr>
			</thead>
        	<tbody>
        		<tr>
          			<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
          		</tr>
        	</tbody>
		</table>
	</div>
</div>

<?php include_once $root.'/footer.php';?>