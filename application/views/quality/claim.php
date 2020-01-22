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
                <th class="text-center">번호</th>
                <th class="text-center">의뢰번호</th>
                <th class="text-center">고객사</th>
                <th class="text-center">품번</th>
                <th class="text-center">품목</th>
                <th class="text-center">접수일(yyyy.mm.dd hh:mm)</th>
                <th class="text-center">완료 일시(yyyy.mm.dd hh:mm)</th>
            </tr>

            </thead>
            <tbody>
            <tr>
                <td class="text-center">1</td>
                <td class="text-center">2010A12B1</td>
                <td class="text-center">가 치과</td>
                <td class="text-center"><a class="text-primary">aaaA12B1</a></td>
                <td class="text-center">인레이</td>
                <td class="text-center">2019.11.10 10:30</td>
                <td class="text-center">2019.11.12 12:00</td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td class="text-center">2010A12C3</td>
                <td class="text-center">나 치과</td>
                <td class="text-center"><a class="text-primary">aaaA12B1</a></td>
                <td class="text-center">인레이</td>
                <td class="text-center">2019.11.10 10:30</td>
                <td class="text-center">2019.11.12 12:00</td>
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

        // 클레임 관리 검색 api 로직...
    }
</script>
<?php include_once $root.'/footer.php';?>