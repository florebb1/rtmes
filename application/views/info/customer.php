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
        		<input type="hidden" class="form-control" name="w" id="w" value="">
        		<input type="hidden" class="form-control" name="customer_id" id="customer_id" value="">
        		<tr>
        			<th>고객사명</th>
        			<td><input type="text" class="form-control" name="name" id="name"></td>
        		</tr>
        		<tr>
        			<th>고객코드</th>
        			<td><input type="text" class="form-control" name="code" id="code"></td>
        		</tr>
        		<tr>
        			<th>대표자</th>
        			<td><input type="text" class="form-control" name="representative" id="representative"></td>
        		</tr>
        		<tr>
        			<th>사업자 번호</th>
        			<td><input type="text" class="form-control" name="business_number" id="business_number"></td>
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
        			<th>업태</th>
        			<td><input type="text" class="form-control" name="business" id="business"></td>
        		</tr>
        		<tr>
        			<th>팩스번호</th>
        			<td><input type="text" class="form-control" name="fax" id="fax"></td>
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
                    <th class="text-center">고객사명</th>
                    <th class="text-center">고객코드</th>
                    <th class="text-center">대표자</th>
                    <th class="text-center">사업자 번호</th>
                    <th class="text-center">전화번호</th>
                    <th class="text-center">이메일</th>
                    <th class="text-center">업태</th>
                    <th class="text-center">팩스번호</th>
                    <th class="text-center">주소</th>
        		</tr>
          
			</thead>
        	<tbody>
        		<?php for($i=0; $i<count($list); $i++){?>
        		<tr>
                    <td class="text-center"><a href="javascript:modifycustomer('<?php echo $list[$i]["customer_id"];?>');"><?php echo $list[$i]["name"];?></a></td>
                    <td class="text-center"><?php echo $list[$i]["code"];?></td>
                    <td class="text-center"><?php echo $list[$i]["representative"];?></td>
                    <td class="text-center"><?php echo $list[$i]["business_number"];?></td>
                    <td class="text-center"><?php echo $list[$i]["tel"];?></td>
                    <td class="text-center"><?php echo $list[$i]["email"];?></td>
                    <td class="text-center"><?php echo $list[$i]["business"];?></td>
                    <td class="text-center"><?php echo $list[$i]["fax"];?></td>
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
	$("#customer_id").val("");
	$("#name").val("");
	$("#code").val("");
	$("#representative").val("");
	$("#business_number").val("");
	$("#tel").val("");
	$("#email").val("");
	$("#business").val("");
	$("#fax").val("");
	$("#addr").val("");
	$("#delete_btn").hide();
}
$("#submit_btn").on("click",function(){
	if(checkform()){
	$.ajax({
        url: '/info/customer/edit',
        type: 'post',
        data: $('#w,#customer_id,#name, #code, #representative, #business_number, #tel, #email,#business,#fax,#addr'),
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
	}
});

function checkform(){
	
	var name = $("#name").val();
	if(name==""){
		alert("이름을 입력하세요.");
		return false;
	}
	var code = $("#code").val();
	if(code==""){
		alert("고객코드를 입력하세요.");
		return false;
	}

	if(!CheckCode(code)){
		alert("고객코드가 중복됩니다.");
		return false;
	}
	

	
	var representative = $("#representative").val();
	if(representative==""){
		alert("사업자 번호를 입력하세요.");
		return false;
	}
	var business_number = $("#business_number").val();
	if(business_number==""){
		alert("사업자번호를 입력하세요.");
		return false;
	}
	var tel = $("#tel").val();
	if(tel==""){
		alert("전화번호를 입력하세요.");
		return false;
	}
	var email = $("#email").val();
	if(email==""){
		alert("이메일을 입력하세요.");
		return false;
	}
	var business = $("#business").val();

	if(business==""){
		alert("업태를 입력하세요.");
		return false;
	}
	
	return true;
}

function CheckCode(code){
	var result = false;
	var send_data ={"code" : code};
	$.ajax({
        url: '/info/customer/chkcode',
        type: 'post',
        data: send_data,
        async: false,
        dataType: 'json',
        beforeSend: function() {
        	
		},
        complete: function() {
			
        },
        success: function(json) {
         	if(json["result"]){
         		result = true;
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });

    return result;
}


function modifycustomer(id){
	clearRegForm();
	$("#w").val("u");
	$("#customer_id").val(id);
		
	$.ajax({
        url: '/info/customer/info',
        type: 'post',
        data: $("#customer_id"),
        dataType: 'json',
        beforeSend: function() {
        	
		},
        complete: function() {
			
        },
        success: function(json) {
         	if(json["info"]){
				var info = json["info"];
				$("#name").val(info["name"]);
				$("#code").val(info["code"]);
				$("#representative").val(info["representative"]);
				$("#business_number").val(info["business_number"]);
				$("#tel").val(info["tel"]);
				$("#email").val(info["email"]);
				$("#business").val(info["business"]);
				$("#fax").val(info["fax"]);
				$("#addr").val(info["addr"]);
				$("#delete_btn").show();
				//$("#reg_btn").trigger("click");
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
	if(confirm("해당 고객사 정보를 삭제하시겠습니까?")){
		$.ajax({
	        url: '/info/customer/delete',
	        type: 'post',
	        data: $("#customer_id"),
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
		       	alert("고객사 정보가 삭제되었습니다.");
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