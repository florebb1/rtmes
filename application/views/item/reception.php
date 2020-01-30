<?php include_once $root.'/head.php';?>

<div class="card">
	<div class="card-header">
		<div class="card-tools">
		<a class="btn btn-primary" href="/item/reception/edit" >기공의뢰서 접수</a>
		</div>
	</div>
	<div class="card-body table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
                    <th class="text-center">의뢰번호</th>
                    <th class="text-center">거래처</th>
                    <th class="text-center">환자명</th>
                    <th class="text-center">나이</th>
                    <th class="text-center">성별</th>
                    <th class="text-center">납기일</th>
                    <th class="text-center">의뢰형태</th>
                    <th class="text-center">동봉물지정</th>
                    <th class="text-center">작업물</th>
                    <th class="text-center"></th>
        		</tr>
          
			</thead>
        	<tbody>
        		 <?php if(count($list)> 0){?>
            <?php for($i=0; $i<count($list); $i++){?>
            <tr>
                <td class="text-center"><?php echo $list[$i]["reception_number"];?></td>
                <td class="text-center"><?php echo $list[$i]["customer_name"];?></td>
                <td class="text-center"><?php echo $list[$i]["patient_name"];?></td>
                <td class="text-center"><?php echo $list[$i]["age"];?></td>
                <td class="text-center"><?php echo $list[$i]["sex_name"];?></td>
                <td class="text-center"><?php echo $list[$i]["delivery_date"];?></td>
                <td class="text-center"><?php echo $list[$i]["request_form_name"];?></td>
                <td class="text-center"><?php echo $list[$i]["enclosure_name"];?></td>
                <td class="text-center"></td>
                <td class="text-center"><a href="" class="btn btn-primary">수정</a></td>
            </tr>
           
            <?php }?>
            <?php }else{?>
             <tr>
                <td class="text-center" colspan="10">접수 데이터가 없습니다.</td>
               
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

</script>
<?php include_once $root.'/footer.php';?>