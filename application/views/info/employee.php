<?php include_once $root.'/head.php';?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<b>사원 등록</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
        	<tbody>
        		<input type="hidden" class="form-control" name="w" id="w" value="">
        		<input type="hidden" class="form-control" name="employee_id" id="employee_id" value="">
        		<tr>
        			<th>사원명</th>
        			<td><input type="text" class="form-control" name="name" id="name"></td>
        		</tr>
        		<tr>
        			<th>사원번호</th>
        			<td><input type="text" class="form-control" name="employee_number" id="employee_number"></td>
        		</tr>
        		<tr>
        			<th>업무</th>
        			<td>
        				<select class="form-control" name="work_id" id="work_id">
        				<option value="0">-선택-</option>
        				<?php for($i=0; $i<count($work); $i++){?>
        				<option value="<?php echo $work[$i]["work_id"];?>"><?php echo $work[$i]["name"];?></option>
        				<?php }?>
        				</select>
        			</td>
        		</tr>
        		<tr>
        			<th>사업장명</th>
        			<td><input type="text" class="form-control" name="business" id="business"></td>
        		</tr>
        		<tr>
        			<th>부서</th>
        			<td><input type="text" class="form-control" name="department" id="department"></td>
        		</tr>
        		<tr>
        			<th>직급</th>
        			<td><input type="text" class="form-control" name="position" id="position"></td>
        		</tr>
        		<tr>
        			<th>공정</th>
        			<td id="td_process">
        				<div class="form-inline">
            				<select type="text" class="form-control process_id" name="process_id[]">
            					<option value="0">-선택-</option>
            					<?php for($i=0; $i<count($process); $i++){?>
                					<option value="<?php echo $process[$i]["process_id"];?>"><?php echo $process[$i]["name"];?></option>
                				<?php }?>
            				</select>&nbsp;&nbsp;&nbsp;
            				<button id="add_process" class="btn btn-info">+</button>
        				</div>
        			</td>
        		</tr>
        		<tr>
        			<th>전화번호</th>
        			<td><input type="text" class="form-control" name="tel" id="tel"></td>
        		</tr>
        		<tr>
        			<th>이메일</th>
        			<td><input type="text" class="form-control" name="email" id="email"></td>
        		</tr>
        		<tr>
        			<th>주소</th>
        			<td><input type="text" class="form-control" name="addr" id="addr"></td>
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
		<button class="btn btn-primary" id="reg_btn" data-toggle="modal" data-target="#myModal">등록</button>
		</div>
	</div>
	<div class="card-body table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
                    <th class="text-center">사원명</th>
                    <th class="text-center">사원 번호</th>
                    <th class="text-center">업무</th>
                    <th class="text-center">사업장명</th>
                    <th class="text-center">부서</th>
                    <th class="text-center">직급</th>
                    <th class="text-center">공정</th>
                    <th class="text-center">전화번호</th>
                    <th class="text-center">이메일</th>
                    <th class="text-center">주소</th>
        		</tr>
          
			</thead>
        	<tbody>
        		<?php for($i=0; $i<count($list); $i++){?>
        		<tr>
                    <td class="text-center"><a href="javascript:modifyinfo('<?php echo $list[$i]["employee_id"];?>');"><?php echo $list[$i]["name"];?></a></td>
                    <td class="text-center"><?php echo $list[$i]["employee_number"];?></td>
                    <td class="text-center"><?php echo $list[$i]["work_name"];?></td>
                    <td class="text-center"><?php echo $list[$i]["business"];?></td>
                    <td class="text-center"><?php echo $list[$i]["department"];?></td>
                    <td class="text-center"><?php echo $list[$i]["position"];?></td>
                    <td class="text-center">
                    <?php for($j=0; $j<count($list[$i]["process"]); $j++){?>
                    	<?php echo $list[$i]["process"][$j]["name"];?><br/>
                    <?php }?>
                    </td>
                    <td class="text-center"><?php echo $list[$i]["tel"];?></td>
                    <td class="text-center"><?php echo $list[$i]["email"];?></td>
                    <td class="text-center"><?php echo $list[$i]["addr"];?></td>
        		</tr>
        		<?php }?>
        	</tbody>
		</table>
	</div>
</div>

<script>
$("#reg_btn").on("click",function(){
	clearRegForm();
	$('#submit_btn').text("등록");
});

function clearRegForm(){
	$("#w").val("");
	$("#employee_id").val("");
	$("#name").val("");
	$("#employee_number").val("");
	$("#work_id").val(0).prop("selected",true);
	$("#business").val("");
	$("#department").val("");
	$("#position").val("");
	$("#tel").val("");
	$("#email").val("");
	$("#addr").val("");
	$("#delete_btn").hide();
	var len = $(".process_id").length;
	for(var i=1; i<len; i++){
		$(".process_id").eq(1).parent().remove();
	}
}

$("#add_process").on("click",function(){
	AddProcess(0);
});

function AddProcess(vax){
	var len = $(".process_id").length;
	var html = '<div class="form-inline" style="margin-top:10px;">';
		html += '<select type="text" class="form-control process_id" name="process_id[]">';
		html += '<option value="0">-선택-</option>';
	<?php for($i=0; $i<count($process); $i++){?>
		html += '<option value="<?php echo $process[$i]["process_id"];?>"><?php echo $process[$i]["name"];?></option>';
	<?php }?>
		html += '</select>';
		html += '&nbsp;&nbsp;&nbsp;<button class="btn btn-danger remove_process">-</button>';
		html += '</div>';
	$("#td_process").append(html);
	$(".remove_process").on("click",function(){
		$(this).parent().remove();
	});
	$(".process_id").eq(len).val(vax).prop("selected",true);
}

$("#submit_btn").on("click",function(){
	$.ajax({
        url: '/info/employee/edit',
        type: 'post',
        data: $('#w,#employee_id,#name, #employee_number, #work_id, #business, #department, #position,#tel,#email,#addr, .process_id'),
        dataType: 'json',
        beforeSend: function() {
        	$('#submit_btn').button('loading');
		},
        complete: function() {
			$('#submit_btn').button('reset');
        },
        success: function(json) {
            location.reload();
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

function modifyinfo(id){
	clearRegForm();
	$("#w").val("u");
	$("#employee_id").val(id);
		
	$.ajax({
        url: '/info/employee/info',
        type: 'post',
        data: $("#employee_id"),
        dataType: 'json',
        beforeSend: function() {
        	
		},
        complete: function() {
			
        },
        success: function(json) {
         	if(json["info"]){
				var info = json["info"];
				$("#name").val(info["name"]);
				$("#employee_number").val(info["employee_number"]);
				$("#work_id").val(info["work_id"]).prop("selected",true);
				$("#business").val(info["business"]);
				$("#department").val(info["department"]);
				$("#position").val(info["position"]);
				$("#tel").val(info["tel"]);
				$("#email").val(info["email"]);
				$("#addr").val(info["addr"]);
				for(var i=0; i<info["process"].length; i++){
					if(i==0){
						$(".process_id").eq(i).val(info["process"][i]["process_id"]).prop("selected",true);
					}else{
						AddProcess(info["process"][i]["process_id"]);
					}
				}
				$("#delete_btn").show();
				$('#submit_btn').text("수정");
				$('#myModal').modal('show');
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

$("#delete_btn").on("click",function(){
	if(confirm("해당 사원 정보를 삭제하시겠습니까?")){
		$.ajax({
	        url: '/info/employee/delete',
	        type: 'post',
	        data: $("#employee_id"),
	        dataType: 'json',
	        beforeSend: function() {
	        	$('#submit_btn').button('loading');
	        	$('#delete_btn').button('loading');
			},
	        complete: function() {
	        	$('#submit_btn').button('reset');
	        	$('#delete_btn').button('reset');
	        },
	        success: function(json) {
		       	alert("사원 정보가 삭제되었습니다.");
	        	location.reload();
	        },
	        error: function(xhr, ajaxOptions, thrownError) {
	            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        }
	    });
	}
});
</script>
<?php include_once $root.'/footer.php';?>