<?php include_once $root.'/head.php';?>
<?php include_once $root.'/head_sub.php';?>
<div class="card">
    <!--    <div class="card-header"></div>-->
    <div class="card-body table-responsive">
        <div class="mb-3">
            <input type="text" id="startDate" name="st_date" class="datepicker" style="padding: .375rem .75rem;" placeholder="선택" readonly value="<?php echo $st_date;?>"> ~ <input type="text" id="endDate" name="ed_date" class="datepicker" style="padding: .375rem .75rem;" placeholder="선택" readonly value="<?php echo $ed_date;?>">
            <div class="d-inline-block mx-3">
                <button class="btn btn-outline-primary dateMenu" data-text="1">1일</button>
                <button class="btn btn-outline-primary dateMenu" data-text="7">7일</button>
                <button class="btn btn-outline-primary dateMenu" data-text="30">30일</button>
                <button class="btn btn-info" onclick="searchList();">조회</button>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">번호</th>
                    <th class="text-center">의뢰번호</th>
                    <th class="text-center">거래처</th>
                    <th class="text-center">납기일</th>
                    <th class="text-center">접수일(yyyy-mm-dd hh:mm:ss)</th>
                    <th class="text-center">완료일(yyyy-mm-dd hh:mm:ss)</th>
                </tr>
            </thead>
            <tbody>
            <?php if(count($list)> 0){?>
            <?php for($i=0; $i<count($list); $i++){?>
            <tr>
                <td class="text-center"><?php echo count($list)-$i;?></td>
                <td class="text-center"><?php echo $list[$i]["reception_number"];?></td>
                <td class="text-center"><?php echo $list[$i]["customer_name"];?></td>
                <td class="text-center"><?php echo $list[$i]["delivery_date"];?></td>
                <td class="text-center"><?php echo $list[$i]["reception_date"];?></td>
                <td class="text-center"><?php echo $list[$i]["complete_date"];?></td>
            </tr>
           
            <?php }?>
            <?php }else{?>
             <tr>
                <td class="text-center" colspan="6">리메이크 데이터가 없습니다.</td>
               
            </tr>
            <?php }?>   
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function () {
        // daterangepicker
        $('.datepicker').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        }, function (start, end) {
            $("#startDate").val(start.format('YYYY-MM-DD'));
            $("#endDate").val(end.format('YYYY-MM-DD'));
            $(".dateMenu").removeClass('active');
        });

        // date menu click event
        $(".dateMenu").click(function () {
            if ($(".dateMenu").hasClass('active')) {
                $(".dateMenu").removeClass('active');
            }
            $(this).addClass('active');
            var menuDate = $(this).data('text');
            var today = new Date();
            today = moment(today).format('YYYY-MM-DD');
            $("#endDate").val(moment(today).format('YYYY-MM-DD'));
            if(menuDate == "1") {
                $("#startDate").val(moment(today).format('YYYY-MM-DD'));
            }else if(menuDate == "7") {
                var newDate = dateAddDel(today, -7, 'd');
                $("#startDate").val(moment(newDate).format('YYYY-MM-DD'));
            } else if (menuDate == "30") {
                var newDate = dateAddDel(today, -1, 'm');
                $("#startDate").val(moment(newDate).format('YYYY-MM-DD'));
            }
        });
    });
    // searchButton click event
    function searchList() {
        var start = $("#startDate").val();
        var end = $("#endDate").val();
        if(isEmpty(start)) {
            alert('시작날짜를 선택해주세요.');
            $("#startDate").focus();
            return false;
        }else if(isEmpty(end)) {
            alert('종료날짜를 선택해주세요.');
            $("#endDate").focus();
            return false;
        }
        if(dateDiff(start, end) < 0) {
            alert('종료날짜는 시작날짜 이전값을 넣을 수 없습니다.');
            $("#startDate").focus();
            return false;
        }


		location.href="/quality/remake?st_date="+start+"&ed_date="+end;	
        // 클레임 관리 검색 api 로직...
    }
</script>
<?php include_once $root.'/footer.php';?>