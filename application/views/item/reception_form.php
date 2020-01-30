<?php include_once $root.'/head.php';?>
<link rel="stylesheet" href="<?php echo $base_url;?>plugins/jquery-ui/jquery-ui.css">
<script src="<?php echo $base_url;?>plugins/jquery-ui/jquery-ui.js"></script>

<style>
#detail_list{width: 100%;position: relative;}
.details{margin-bottom: 20px;}
</style>

<div class="card">
	<form name="fwrite" id="fwrite" action="/item/reception/update" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" >
	<input type="hidden" name="w" id="w" value="">
	<div class="card-header">
		<div class="card-tools">
			<button type="submit" class="btn btn-primary" id="reg_btn">저장</button>
		</div>
	</div>
	<div class="card-body ">
		 <div class="form-horizontal">
			  <div class="row">	
				 <div class="col-sm-6 form-group row">
                      <label for="customer_id" class="col-sm-2 col-form-label">거래처</label>
                      <div class="col-sm-10">
                        <select class="form-control" id="customer_id" name="customer_id" >
            				<option value="0">-선택-</option>
            				<?php for($i=0; $i<count($customers); $i++){?>
            				<option value="<?php echo $customers[$i]["customer_id"];?>"><?php echo $customers[$i]["name"];?></option>
            				<?php }?>
            			</select>
                      </div>  
                  </div>
                  <div class="col-sm-6 form-group row">
                  		<label for="patient_name" class="col-sm-2 col-form-label">환자명</label>
                        <div class="col-sm-10">
                          	<input type="text" class="form-control" name="patient_name" id="patient_name">
                        </div>
                  </div>
                  <div class="col-sm-6 form-group row">
                  		<label for="age" class="col-sm-2 col-form-label">나이</label>
                        <div class="col-sm-10">
                          	<input type="text" class="form-control" name="age" id="age">
                        </div>
                  </div>
                  <div class="col-sm-6 form-group row">
                  		<label for="inputEmail3" class="col-sm-2 col-form-label">성별</label>
                        <div class="col-sm-10">
                          	<select class="form-control" name="sex_id" id="sex_id">
        					<option value="0">-선택-</option>
        					<?php for($i=0; $i<count($sexs); $i++){?>
            				<option value="<?php echo $sexs[$i]["sex_id"];?>"><?php echo $sexs[$i]["name"];?></option>
            				<?php }?>
        				</select>
                        </div>
                  </div>
                  <div class="col-sm-6 form-group row">
                  		<label for="delivery_date" class="col-sm-2 col-form-label">납기일</label>
                        <div class="col-sm-10">
                          	<input type="text" class="form-control input-date" readonly="readonly" name="delivery_date" id="delivery_date">
                        </div>
                  </div>
                  <div class="col-sm-6 form-group row">
                  		<label for="request_form_id" class="col-sm-2 col-form-label">의뢰 형태</label>
                        <div class="col-sm-10">
                          	<select class="form-control" id="request_form_id" name="request_form_id">
        						<option value="0">-선택-</option>
        						<?php for($i=0; $i<count($requestform); $i++){?>
                				<option value="<?php echo $requestform[$i]["request_form_id"];?>"><?php echo $requestform[$i]["name"];?></option>
                				<?php }?>
        					</select>
                        </div>
                  </div>
                  <div class="col-sm-6 form-group row">
                  		<label for="enclosure_id" class="col-sm-2 col-form-label">동볼물 지정</label>
                        <div class="col-sm-10">
                          	<select class="form-control" id="enclosure_id" name="enclosure_id">
        						<option value="0">-선택-</option>
        						<?php for($i=0; $i<count($enclosures); $i++){?>
                				<option value="<?php echo $enclosures[$i]["enclosure_id"];?>"><?php echo $enclosures[$i]["name"];?></option>
                				<?php }?>
        					</select>
                        </div>
                  </div>
                  <div class="col-sm-6 form-group row">
                  		<label for="inputEmail3" class="col-sm-2 col-form-label">작업물 추가</label>
                        <div class="col-sm-10">
                          	<button type="button" class="btn btn-info" id="add_detail">추가</button>
                        </div>
                  </div>
                  
                   <div id="detail_list">
                   	 
                   </div>
            </div>      
		</div>
	</div>
	</form>
</div>

<script type="text/javascript">
$( ".input-date" ).datepicker({
	  dateFormat: "yy-mm-dd"
	});
$("#add_detail").on("click",function(){
	//폼추가
	addform();
});

function addform(){
	var send_data={"w":""};
	$.ajax({
        url: '/item/reception/addform',
        type: 'post',
        data: send_data,
        dataType: 'html',
        beforeSend: function() {
       // 	$('#add_detail').button('loading');
		},
        complete: function() {
		//	$('#add_detail').button('reset');
        },
        success: function(json) {
           $("#detail_list").append(json);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}


$(document).on("change",".item_category_id",function(){
	var item_category_id = $(this).val();
	var item_id = $(this).parent().parent().parent().find(".item_id");
	if(item_category_id !=0){
		var send_data = {"item_category_id" : item_category_id};
		$.ajax({
	        url: '/item/reception/loaditems',
	        type: 'post',
	        data: send_data,
	        dataType: 'html',
	        beforeSend: function() {
	       // 	$('#add_detail').button('loading');
			},
	        complete: function() {
			//	$('#add_detail').button('reset');
	        },
	        success: function(json) {
	           //console.log(json);
	           item_id.html('<option value="0">-선택-</option>');
	           var jj = JSON.parse(json);
	           for(var i=0; i<jj.length; i++){
				var html = 	'<option value="'+jj[i]["item_id"]+'">'+jj[i]["name"]+'</option>';
				item_id.append(html);
			   }
	        },
	        error: function(xhr, ajaxOptions, thrownError) {
	            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        }
	    });
	}
});
$(document).on("click",".details_remove",function(){
	$(this).parent().parent().parent().remove();
});


function fwrite_submit(f){
	return true;
}

</script>

<?php include_once $root.'/footer.php';?>