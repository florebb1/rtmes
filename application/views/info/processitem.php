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
					<th class="text-center">품목</th>
                  <?php for($i=0; $i<count($process); $i++){?>
                   	<th class="text-center"><?php echo $process[$i]["name"];?></th>
                   	<input type="hidden" name="process_id[]" class="process_id" value=<?php echo $process[$i]["process_id"]; ?>>
                   	<?php }?>
        		</tr>
          
			</thead>
        	<tbody>
        		<?php for($i=0; $i<count($item); $i++){?>
                <tr>
                   	<th class="text-center">
                   		<?php echo $item[$i]["name"];?>
                   		<input type="hidden" name="item_id[]" class="item_id" value=<?php echo $item[$i]["item_id"]; ?>>
                   	</th>
                	<?php for($j=0; $j<count($process); $j++){
                	
                	    $val = "0";
                	    if (array_key_exists($item[$i]["item_id"], $list)) {
                	        if (array_key_exists($process[$j]["process_id"], $list[$item[$i]["item_id"]])) {
                	            $val = $list[$item[$i]["item_id"]][$process[$j]["process_id"]];
                	        }
                	    }
                	    ?>
                   	<td>
                   		<select class="form-control process_item_id" name="process_item_id[<?php echo $item[$i]["item_id"]?>][<?php echo $process[$j]["process_id"]?>]" value="<?php echo $val;?>">
                   			<option value="0" <?php if($val == 0){?> selected="selected"<?php }?>>N</option>
                   			<option value="1" <?php if($val == 1){?> selected="selected"<?php }?>>Y</option>
                   		</select>
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
        url: '/info/processitem/edit',
        type: 'post',
        data: $('.item_id,.process_id, .process_item_id'),
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