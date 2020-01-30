<?php include_once $root.'/head.php';?>
<link rel="stylesheet" href="<?php echo $base_url;?>plugins/jquery-ui/jquery-ui.css">
<script src="<?php echo $base_url;?>plugins/jquery-ui/jquery-ui.js"></script>
<style>
.table tbody tr td{vertical-align: middle;}
</style>
<div class="card">
	<div class="card-header">
		<div class="card-tools">
			<form action="" method="get" class="form-inline">
				
				<input type="text" class="form-control input-date" placeholder="기간" name="st_date" id="st_date" value="<?php echo $st_date;?>" readonly="readonly">&nbsp;&nbsp;~&nbsp;&nbsp;
				<input type="text" class="form-control input-date" placeholder="기간" name="ed_date" id="ed_date" value="<?php echo $ed_date;?>" readonly="readonly">&nbsp;&nbsp;
				<button type="button" class="btn btn-info" id="1day-btn">1일</button>&nbsp;&nbsp;
				<select class="form-control" name="customer">
					<option value="0">고객사 선택</option>
				<?php for($i=0; $i<count($customers); $i++){?>
            		<option value="<?php echo $customers[$i]["customer_id"];?>" <?php if($customer == $customers[$i]["customer_id"]){?> selected="selected" <?php }?>><?php echo $customers[$i]["name"];?></option>
            	<?php }?>
				</select>&nbsp;&nbsp; 
				<?php /*?>
				<button class="btn btn-info">품목명</button>&nbsp;&nbsp;
				<?php */?>
				<button type="submit" class="btn btn-primary" id="search_btn">검색</button>&nbsp;&nbsp;
				<button type="button" class="btn btn-primary">전표 발행</button>&nbsp;&nbsp;
				<button type="button" class="btn btn-primary">청구서 발행</button>
			</form>
		</div>
	</div>
	<div class="card-body">
	<form action="/item/lot/update" method="post">	
	<input type="hidden" name="st_date" value="<?php echo $st_date;?>">
	<input type="hidden" name="ed_date"  value="<?php echo $ed_date;?>">
	<input type="hidden" name="customer"  value="<?php echo $customer;?>">
		
		<div class="text-right" style="margin-bottom: 20px;">
			<button type="submit" class="btn btn-primary" id="reg_btn">저장</button>
		</div>
		
				
		<div class="table-responsive">
    		<table class="table table-bordered">
    			<thead>
    				<tr>
    					<th class="text-center"></th>
    					<th class="text-center">의뢰번호</th>
    					<th class="text-center">고객사</th>
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
            		<?php for($i=0; $i<count($list); $i++){?>
            		<tr>
            			<td class="text-center"><input type="checkbox" name="lot_check[]" value="<?php echo $list[$i]["reception_id"];?>"></td>		
            			<td class="text-center"><?php echo $list[$i]["reception_number"];?></td>		
            			<td class="text-center"><?php echo $list[$i]["customer_name"];?></td>			
            			<td class="text-center"><input type="text" class="form-control" name="request_shipping_<?php echo $list[$i]["reception_id"];?>" value="<?php echo $list[$i]["request_shipping"];?>" ></td>		
            			<td class="text-center"><?php if($list[$i]["real_shipping"] > 0){ echo $list[$i]["real_shipping"]."일"; }?></td>		
            			<td class="text-center"><?php echo $list[$i]["reception_date2"]; ?></td>		
            			<td class="text-center"><?php echo $list[$i]["complete_date2"]; ?></td>		
            			<td class="text-center"><?php echo $list[$i]["shipping_date2"]; ?></td>		
            			<td class="text-center" style="padding: 4px;"><textarea rows="3" cols="2" class="form-control" name="review_<?php echo $list[$i]["reception_id"];?>" style="min-width: 200px;">
            			<?php echo $list[$i]["review"]; ?>
            			</textarea></td>		
            			<td class="text-center"><input type="checkbox" name="claim_chk_<?php echo $list[$i]["reception_id"];?>" value="1" <?php if($list[$i]["claim_chk"] == 1){?>checked="checked" <?php }?>></td>		
            					
            		</tr>	
            		<?php }?>
            	</tbody>
    		</table>
		</div>
		</form>
		
	</div>
</div>

<script type="text/javascript">
$( ".input-date" ).datepicker({
	  dateFormat: "yy-mm-dd"
});

$("#1day-btn").on("click",function(){
	var d = new Date();
	var ed_date = getDateStr(d);
	var dayofMonth = d.getDate();
	d.setDate(dayofMonth - 1);
	var st_date =getDateStr(d);
	console.log(st_date);
	$("#st_date").val(st_date);
	$("#ed_date").val(ed_date);
});

function getDateStr(myDate){
	return myDate.getFullYear() + '-' + ("0"+(myDate.getMonth() + 1)).slice(-2) + '-' + ("0"+myDate.getDate()).slice(-2);
}
</script>

<?php include_once $root.'/footer.php';?>