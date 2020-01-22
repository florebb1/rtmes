<?php include_once $root.'/head.php';?>
<?php include_once $root.'/head_sub.php';?>
<div class="card">
<!--    <div class="card-header"></div>-->
    <div class="card-body table-responsive">
        <div class="mb-3">
            <input type="text" id="startDate" name="" class="datepicker" style="padding: .375rem .75rem;" placeholder="선택" readonly> ~ <input type="text" id="endDate" name="" class="datepicker" style="padding: .375rem .75rem;" placeholder="선택" readonly>
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
                    <th class="text-center">공정</th>
                    <th class="text-center">날짜</th>
                    <th class="text-center">작업자</th>
                    <th class="text-center">품목번호</th>
                    <th class="text-center">불량내용</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">CAD</td>
                    <td class="text-center">191224</td>
                    <td class="text-center">홍길동</td>
                    <td class="text-center">AAA12345</td>
                    <td class="text-center">문제가 발생해서 결과물이 이상함.</td>
                </tr>
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
            $("#startDate").val(start.format('MM/DD/YYYY'));
            $("#endDate").val(end.format('MM/DD/YYYY'));
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
            $("#endDate").val(moment(today).format('MM/DD/YYYY'));
            if(menuDate == "1") {
                $("#startDate").val(moment(today).format('MM/DD/YYYY'));
            }else if(menuDate == "7") {
                var newDate = dateAddDel(today, -7, 'd');
                $("#startDate").val(moment(newDate).format('MM/DD/YYYY'));
            } else if (menuDate == "30") {
                var newDate = dateAddDel(today, -1, 'm');
                $("#startDate").val(moment(newDate).format('MM/DD/YYYY'));
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

        // 공정 불량 관리 검색 api 로직...
    }
</script>
<?php include_once $root.'/footer.php';?>