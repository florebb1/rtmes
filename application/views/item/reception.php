<?php include_once $root.'/head.php';?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<b>고객사 등록</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
        	<tbody >
        		
        		<tr>
        			<th>의뢰번호</th>
        			<td><input type="text" class="form-control"  readonly="readonly"></td>
        		</tr>
        		<tr>
        			<th>거래처</th>
        			<td>
        				<select class="form-control">
        					<option value="0">-선택-</option>
        				</select>
        			</td>
        		</tr>
        		<tr>
        			<th>환자명</th>
        			<td><input type="text" class="form-control" name="representative" id="representative"></td>
        		</tr>
        		<tr>
        			<th>나이</th>
        			<td><input type="text" class="form-control" name="business_number" id="business_number"></td>
        		</tr>
        		<tr>
        			<th>성별</th>
        			<td>
        				<select class="form-control" name="sex" id="sex">
        					<option value="0">-선택-</option>
        					<option value="1">남</option>
        					<option value="2">여</option>
        				</select>
        			</td>
        		</tr>
        		<tr>
        			<th>납기일</th>
        			<td><input type="text" class="form-control" readonly="readonly"></td>
        		</tr>
        		<tr>
        			<th>의뢰 형태</th>
        			<td>
        				<select class="form-control">
        					<option value="0">-선택-</option>
        				</select>
        			</td>
        		</tr>
        		<tr>
        			<th>동볼물 지정</th>
        			<td>
        				<select class="form-control">
        					<option value="0">-선택-</option>
        				</select>
        			</td>
        		</tr>
        		<tr>
        			<th작업물</th>
        			<td></td>
        		</tr>
        		<tr>
        			<th>치식선택(선택)</th>
        			<td>
        				<select class="form-control">
        					<option value="0">-선택-</option>
        				</select>
        			</td>
        		</tr>
        		<tr>
        			<th>기공물 분류</th>
        			<td>
        				<select class="form-control">
        					<option value="0">-선택-</option>
        				</select>
        			</td>
        		</tr>
        		<tr>
        			<th>기공물 상세</th>
        			<td>
						<select class="form-control">
        					<option value="0">-선택-</option>
        				</select>
					</td>
        		</tr>
        		<tr>
        			<th>교합</th>
        			<td><select class="form-control">
        				<option value="0">-선택-</option>
        			</select>
        			</td>
        		</tr>
        		<tr>
        			<th>인접면</th>
        			<td><select class="form-control">
        				<option value="0">-선택-</option>
        			</select></td>
        		</tr>
        		<tr>
        			<th>쉐이드</th>
        			<td><select class="form-control">
        				<option value="0">-선택-</option>
        			</select></td>
        		</tr>
        		<tr>
        			<th>폰틱 디자인</th>
        			<td><select class="form-control">
        				<option value="0">-선택-</option>
        			</select></td>
        		</tr>
        		<tr>
        			<th>메탈 디자인</th>
        			<td>
        			<select class="form-control">
        				<option value="0">-선택-</option>
        			</select>
        			</td>
        		</tr>
        	</tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
        <button type="button" class="btn btn-primary" id="submit_btn">등록</button>
        <button type="button" class="btn btn-danger" id="delete_btn" style="display: none">삭제</button>
      </div>
    </div>
  </div>
</div>

<div class="card">
	<div class="card-header">
		<div class="card-tools">
		<button class="btn btn-primary" id="reg_btn" data-toggle="modal" data-target="#myModal">기공의뢰서 접수</button>
		</div>
	</div>
	<div class="card-body table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
                    <th class="text-center">의뢰번호</th>
                    <th class="text-center">거래처</th>
                    <th class="text-center">환자명</th>
                    <th class="text-center">나이</th>
                    <th class="text-center">성별</th>
                    <th class="text-center">납기일</th>
                    <th class="text-center">의뢰형태</th>
                    <th class="text-center">동봉물지정</th>
                    <th class="text-center">작업물</th>
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
                    <td class="text-center"></td>
                    <td class="text-center"></td>
        		</tr>
        		
        	</tbody>
		</table>
	</div>
</div>


<script>
$("#reg_btn").on("click",function(){
	clearRegForm();
	$('#submit_btn').text("등록");
});

</script>
<?php include_once $root.'/footer.php';?>