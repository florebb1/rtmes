<?php include_once $root.'/head.php';?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<b>공정 등록</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="max-height: 600px;overflow: auto;">
        <table class="table table-bordered">
        	<tbody >
        		<tr>
        			<input type="hidden" class="form-control" name="w" id="w" value="">
        		<input type="hidden" class="form-control" name="process_id" id="process_id" value="">
        			<th>공정명</th>
        			<td><input type="text" class="form-control" name="name" id="name"></td>
        		</tr>
        		<tr>
        			<th>공정내용</th>
        			<td><input type="text" class="form-control" name="content" id="content"></td>
        		</tr>
        		<tr>
        			<th>공정조건 추가</th>
        			<td><button id="add_condition" class="btn btn-info">추가</button></td>
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
		<button class="btn btn-primary" id="reg_btn"  data-toggle="modal" data-target="#myModal">등록</button>
		</div>
	</div>
	<div class="card-body table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
                    <th class="text-center">공정명</th>
                    <th class="text-center">공정내용</th>
                    <?php for($i=0; $i<$condition_count; $i++){?>
                    <th class="text-center">조건 <?php echo $i+1;?></th>
                    <?php }?>
        		</tr>
			</thead>
        	<tbody>
        		<?php for($i=0; $i<count($list); $i++){?>
        		<tr>
                    <td class="text-center"><a href="javascript:modifyinfo('<?php echo $list[$i]["process_id"];?>');"><?php echo $list[$i]["name"];?></a></td>
                    <td class="text-left"><?php echo $list[$i]["content"];?></td>
                    <?php for($j=0; $j<count($list[$i]["condition"]); $j++){?>
                    <td class="text-left"><?php echo $list[$i]["condition"][$j]["content"];?></td>
                    <?php }?>
                    <?php if($condition_count > count($list[$i]["condition"])){?>
                     <?php for($j=0; $j<($condition_count -count($list[$i]["condition"])); $j++){?>
                    	<td class="text-left"></td>
                     <?php }?>
                    <?php }?>
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
	$("#process_id").val("");
	$("#name").val("");
	$("#content").val("");
	$(".modal-body .table tbody .tr_condition").remove();
}

$("#add_condition").on("click",function(){
	var len = $(".tr_condition").length;
	if(len <24){
	var html = '<tr class="tr_condition">';
		html +='<th>작업조건 <btton class="btn btn-danger remove_condition">X</button></th>';
		html +='<td><input type="text" class="form-control condition" name="condition[]"></td>';
		html +='</tr>';
		$(".modal-body .table tbody").append(html);	
		$(".remove_condition").on("click",function(){
			$(this).parent().parent().remove();
		});
	}else{
		alert("작업조건은 24개가 최대압니다.");
	}

	
	
	
});

$("#submit_btn").on("click",function(){
	$.ajax({
        url: '/info/process/edit',
        type: 'post',
        data: $('#w,#process_id,#name, #content, .condition'),
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
	$("#process_id").val(id);
		
	$.ajax({
        url: '/info/process/info',
        type: 'post',
        data: $("#process_id"),
        dataType: 'json',
        beforeSend: function() {
        	
		},
        complete: function() {
			
        },
        success: function(json) {
         	if(json["info"]){
				var info = json["info"];
				$("#name").val(info["name"]);
				$("#content").val(info["content"]);

				for(var i=0; i<info["condition"].length; i++){
					var html = '<tr class="tr_condition">';
					html +='<th>작업조건 <btton class="btn btn-danger remove_condition">X</button></th>';
					html +='<td><input type="text" class="form-control condition" name="condition[]" value="'+info["condition"][i]["content"]+'"></td>';
					html +='</tr>';
					$(".modal-body .table tbody").append(html);	
					$(".remove_condition").on("click",function(){
						$(this).parent().parent().remove();
					});
				}
				
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