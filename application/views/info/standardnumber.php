<?php include_once $root.'/head.php';?>

<div class="card">
	<div class="card-header">
		<div class="card-tools">
			<button class="btn btn-primary" id="reg_btn" data-toggle="modal" data-target="#myModal">저장</button>
		</div>
	</div>
	<div class="card-body table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					
                    <th class="text-center">고객사</th>
                   	<?php for($i=0; $i<count($item); $i++){?>
                   	<th class="text-center"><?php echo $item[$i]["name"];?></th>
                   	<input type="hidden" name="item_id[]" class="item_id" value=<?php echo $item[$i]["item_id"]; ?>>
                   	<?php }?>
        		</tr>
          
			</thead>
        	<tbody>
        		<?php for($i=0; $i<count($customer); $i++){?>
                <tr>
                   	<th class="text-center">
                   		<?php echo $customer[$i]["name"];?>
                   		<input type="hidden" name="customer_id[]" class="customer_id" value=<?php echo $customer[$i]["customer_id"]; ?>>
                   	</th>
                	<?php for($j=0; $j<count($item); $j++){
                	
                	    $val = "0";
                	    if (array_key_exists($customer[$i]["customer_id"], $list)) {
                	        if (array_key_exists($item[$j]["item_id"], $list[$customer[$i]["customer_id"]])) {
                	            $val = $list[$customer[$i]["customer_id"]][$item[$j]["item_id"]];
                	        }
                	    }
                	    ?>
                   	<td>
                   		<input type="text" class="form-control standard_number_id" name="standard[<?php echo $customer[$i]["customer_id"]?>][<?php echo $item[$j]["item_id"]?>]" value="<?php echo $val;?>" style="text-align: right;">
                   	</td>
                   	<?php }?>
                </tr>
                <?php }?>
        	</tbody>
		</table>
	</div>
</div>

<script>
$("#reg_btn").on("click",function(){
	$.ajax({
        url: '/info/standardnumber/edit',
        type: 'post',
        data: $('.item_id,.customer_id, .standard_number_id'),
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
</script>


<?php include_once $root.'/footer.php';?>