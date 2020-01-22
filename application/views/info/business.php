<?php include_once $root.'/head.php';?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<b>사업장 등록</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
        	<tbody >
        		<tr>
        			<input type="hidden" class="form-control" name="w" id="w" value="">
        			<input type="hidden" class="form-control" name="business_id" id="business_id" value="">
        			<th>사업장명</th>
        			<td><input type="text" class="form-control" name="name" id="name"></td>
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
        			<th>종목</th>
        			<td><input type="text" class="form-control" name="item" id="item"></td>
        		</tr>
        		<tr>
        			<th>업태</th>
        			<td><input type="text" class="form-control" name="business" id="business"></td>
        		</tr>
        		<tr>
        			<th>전화번호</th>
        			<td><input type="text" class="form-control" name="tel" id="tel"></td>
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
                    <th class="text-center">사업장명</th>
                    <th class="text-center">대표자</th>
                    <th class="text-center">사업자 번호</th>
                    <th class="text-center">종목</th>
                    <th class="text-center">업태</th>
                    <th class="text-center">전화번호</th>
                    <th class="text-center">팩스번호</th>
                    <th class="text-center">주소</th>
        		</tr>
			</thead>
        	<tbody>
        		<?php for($i=0; $i<count($list); $i++){?>
        		<tr>
                    <td class="text-center"><a href="javascript:modifyinfo('<?php echo $list[$i]["business_id"];?>');"><?php echo $list[$i]["name"];?></a></td>
                    <td class="text-center"><?php echo $list[$i]["representative"];?></td>
                    <td class="text-center"><?php echo $list[$i]["business_number"];?></td>
                    <td class="text-center"><?php echo $list[$i]["item"];?></td>
                    <td class="text-center"><?php echo $list[$i]["business"];?></td>
                    <td class="text-center"><?php echo $list[$i]["tel"];?></td>
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
	$("#business_id").val("");
	$("#name").val("");
	$("#representative").val("");
	$("#business_number").val("");
	$("#item").val("");
	$("#business").val("");
	$("#tel").val("");
	$("#fax").val("");
	$("#addr").val("");
}

$("#submit_btn").on("click",function(){
	$.ajax({
        url: '/info/business/edit',
        type: 'post',
        data: $('#w,#business_id,#name, #representative, #business_number, #item,  #business, #tel, #fax, #addr'),
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
	$("#business_id").val(id);
		
	$.ajax({
        url: '/info/business/info',
        type: 'post',
        data: $("#business_id"),
        dataType: 'json',
        beforeSend: function() {
        	
		},
        complete: function() {
			
        },
        success: function(json) {
         	if(json["info"]){
				var info = json["info"];
				$("#name").val(info["name"]);
				$("#representative").val(info["representative"]);
				$("#business_number").val(info["business_number"]);
				$("#item").val(info["item"]);
				$("#business").val(info["business"]);
				$("#tel").val(info["tel"]);
				$("#fax").val(info["fax"]);
				$("#addr").val(info["addr"]);
				$('#submit_btn').text("수정");
				$('#myModal').modal('show');
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

</script>


<?php include_once $root.'/footer.php';?>