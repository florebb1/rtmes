<?php include_once $root.'/head.php';?>

<div class="card">
	<div class="card-header">
		<div class="card-tools">
			<button class="btn btn-primary" id="reg_btn" >저장</button>
		</div>
	</div>
	<div class="card-body table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center"></th>
                  <?php for($i=0; $i<count($process); $i++){?>
                   	<th class="text-center"><?php echo $process[$i]["name"];?></th>
                   	<input type="hidden" name="process_id[]" class="process_id" value=<?php echo $process[$i]["process_id"]; ?>>
                   	<?php }?>
        		</tr>
          
			</thead>
        	<tbody>
        		<?php for($i=0; $i<10; $i++){?>
                <tr>
                   	<th class="text-center">
                   		작업자<?php echo $i+1;?>
                   		
                   	</th>
                	<?php for($j=0; $j<count($process); $j++){
                	
                	    ?>
                   	<td>
                   		<select class="form-control" name="">
                   			<option value="0" >-선택-</option>
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
	/* $.ajax({
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
    }); */
});
</script>
<?php include_once $root.'/footer.php';?>