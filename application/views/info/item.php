<?php include_once $root.'/head.php';?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<b>품목 등록</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
        	<tbody >
        		<input type="hidden" class="form-control" name="w" id="w" value="">
        		<input type="hidden" class="form-control" name="item_id" id="item_id" value="">
        		<tr>
        			<th>품목명</th>
        			<td><input type="text" class="form-control" name="name" id="name"></td>
        		</tr>
        		<tr>
        			<th>품목구분</th>
        			<td>
        				<select class="form-control" name="item_category_id" id="item_category_id">
        				 <option value="0">-선택-</option>
        				 <?php for($i=0; $i<count($categorys); $i++){?>
        				 <option value="<?php echo $categorys[$i]["item_category_id"]?>"><?php echo $categorys[$i]["name_ko"]?></option>
        				 <?php }?>
        				</select>	
        			</td>
        		</tr>
        		<tr>
        			<th>매입처명</th>
        			<td>
        				<select class="form-control" name="purchase_id" id="purchase_id">
        				 <option value="0">-선택-</option>
        				 <?php for($i=0; $i<count($purchases); $i++){?>
        				 <option value="<?php echo $purchases[$i]["purchase_id"]?>"><?php echo $purchases[$i]["name"]?></option>
        				 <?php }?>
        				</select>
        			</td>
        		</tr>
        		<tr>
        			<th>규격</th>
        			<td><input type="text" class="form-control" name="standard" id="standard"></td>
        		</tr>
        		<tr>
        			<th>단위</th>
        			<td><input type="text" class="form-control" name="unit" id="unit"></td>
        		</tr>
        		<tr>
        			<th>재질</th>
        			<td><input type="text" class="form-control" name="material" id="material"></td>
        		</tr>
        		<tr>
        			<th>중량</th>
        			<td><input type="text" class="form-control" name="weight" id="weight"></td>
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
                    <th class="text-center">품목명</th>
                    <th class="text-center">품목구분</th>
                    <th class="text-center">매입처명</th>
                    <th class="text-center">규격</th>
                    <th class="text-center">단위</th>
                    <th class="text-center">재질</th>
                    <th class="text-center">중량</th>
                </tr>  
        	</thead>
            <tbody>
            	<?php for($i=0; $i<count($list); $i++){?>
        		<tr>
                    <td class="text-center"><a href="javascript:modifyinfo('<?php echo $list[$i]["item_id"];?>');"><?php echo $list[$i]["name"];?></a></td>
                    <td class="text-center"><?php echo $list[$i]["name_ko"];?></td>
                    <td class="text-center"><?php echo $list[$i]["purchase_name"];?></td>
                    <td class="text-center"><?php echo $list[$i]["standard"];?></td>
                    <td class="text-center"><?php echo $list[$i]["unit"];?></td>
                    <td class="text-center"><?php echo $list[$i]["material"];?></td>
                    <td class="text-center"><?php echo $list[$i]["weight"];?></td>
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
	$("#item_id").val("");
	$("#name").val("");
	$("#item_category_id").val("0").prop("selected",true);
	$("#purchase_id").val("0").prop("selected",true);
	$("#standard").val("");
	$("#unit").val("");
	$("#material").val("");
	$("#weight").val("");
	$("#delete_btn").hide();
}
$("#submit_btn").on("click",function(){
	$.ajax({
        url: '/info/item/edit',
        type: 'post',
        data: $('#w,#item_id,#name, #item_category_id, #purchase_id, #standard, #unit, #material,#weight'),
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
	$("#item_id").val(id);
		
	$.ajax({
        url: '/info/item/info',
        type: 'post',
        data: $("#item_id"),
        dataType: 'json',
        beforeSend: function() {
        	
		},
        complete: function() {
			
        },
        success: function(json) {
         	if(json["info"]){
				var info = json["info"];
				$("#name").val(info["name"]);
				$("#item_category_id").val(info["item_category_id"]).prop("selected",true);
				$("#purchase_id").val(info["purchase_id"]).prop("selected",true);
				$("#standard").val(info["standard"]);
				$("#unit").val(info["unit"]);
				$("#material").val(info["material"]);
				$("#weight").val(info["weight"]);
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
	if(confirm("해당 품목을 삭제하시겠습니까?")){
		$.ajax({
	        url: '/info/item/delete',
	        type: 'post',
	        data: $("#item_id"),
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
		       	alert("품목이 삭제되었습니다.");
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