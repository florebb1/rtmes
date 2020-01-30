<?php include_once $root . '/head.php'; ?>     <!-- 설비 가동 실적 -->
<?php include_once $root . '/head_sub.php'; ?>     <!-- 설비 가동 실적 -->
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <input type="hidden" id="startDate" name="startDate">
            <input type="hidden" id="endDate" name="endDate">
            <div class="mb-3">
                <button class="btn btn-outline-primary mr-1 dateMenu" data-text="1">어제</button>
                <button class="btn btn-outline-primary mr-1 dateMenu" data-text="7">지난주</button>
                <button class="btn btn-outline-primary mr-1 dateMenu" data-text="30">지난달</button>

                <button class="btn btn-outline-primary mr-1 graphMenu" data-text="m">월별 그래프</button>
                <button class="btn btn-outline-primary mr-1 graphMenu" data-text="y">년도별 그래프</button>
            </div>
            <thead>
                <tr>
                    <th class="text-center">설비명</th>
                    <th class="text-center">시리얼넘버(ID)</th>
                    <th class="text-center">모델명</th>
                    <th class="text-center">규격</th>
                    <th class="text-center">구입일</th>
                    <th class="text-center">관리자</th>
                    <th class="text-center">공정</th>
                    <th class="text-center">설치(위치)</th>
                    <th class="text-center">IP</th>
                    <th class="text-center">사용시간(h)</th>
                </tr>
            </thead>
            <tbody id="content">
                <tr><td colspan="10" class="text-center">조회기간을 선택하여 검색해주세요.</td></tr>
            </tbody>
        </table>
        <div id="pagination" class="mt-3"></div>
    </div>

    <!-- 그래프 -->
    <div class="mt-5">
        <canvas id="canvas"></canvas>
    </div>
</div>

<script>
    $(function () {
        // date menu click event
        $(".dateMenu").click(function () {
            $('.dateMenu').removeClass('active');
            var menu = $(this).data('text'); // 월,년 구분
            var end = moment(new Date()).format('YYYY-MM-DD'); // 오늘날짜
            $("#endDate").val(end);

            if(menu == "1") { // 하루전
                var start = dateAddDel(end, -1, 'd');
                $("#startDate").val(start);
                $(this).addClass('active');
            }else if(menu == "7") { // 7일전
                var start = dateAddDel(end, -7, 'd');
                $("#startDate").val(start);
                $(this).addClass('active');
            }else if(menu == "30") { // 1달전
                var start = dateAddDel(end, -1, 'm');
                $("#startDate").val(start);
                $(this).addClass('active');
            }

            performanceList(1, true);
        });

        // graph button click event
        $(".graphMenu").click(function () {
            $(".graphMenu").removeClass('active');
            $(this).addClass('active');
            var menu = $(this).data('text');
            if(menu == "y") {
                // 년별 조회 api 호출
                var standard = ["2017", "2018", "2019", "2020"];
                // 임시 내용
                var randomScalingFactor = function() {
                    return (Math.random() > 0.5 ? 1.0 : 1.0) * Math.round(Math.random() * 100);
                };
                var line1 = [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()];
                var line2 = [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()];
            }else {
                // 년별 조회 api 호출
                var standard = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                // 임시 내용
                var randomScalingFactor = function() {
                    return (Math.random() > 0.5 ? 1.0 : 1.0) * Math.round(Math.random() * 100);
                };
                var line1 = [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()];
                var line2 = [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()];
            }

            // 임시 그래프 처리(각 api 호출 후 ajax 안에서 반복문돌려서 처리할것)

            // 랜덤 색상 값
            var colorCode1 = "#" + Math.round(Math.random() * 0xFFFFFF).toString(16);
            var colorCode2 = "#" + Math.round(Math.random() * 0xFFFFFF).toString(16);

            var config = {
                type: 'line',
                data: {
                    labels: standard,
                    datasets: [
                        {
                            label: "설비1",
                            backgroundColor: colorCode1,
                            borderColor: colorCode1,
                            data: line1,
                            fill: false,
                        },
                        {
                            label: "설비2",
                            fill: false,
                            backgroundColor: colorCode2,
                            borderColor: colorCode2,
                            data: line2,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    title:{
                        display: false,
                        text:'Chart.js Line Chart'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: false,
                            },
                        }]
                    }
                }
            };

            var ctx = document.getElementById("canvas").getContext("2d");
            var myLine = new Chart(ctx, config);
        });
        function performanceList(page, callback) {
            var datas = {
                page : page,
                startDate : $("#startDate").val(),
                endDate : $("#endDate").val()
            };
            $.ajax({
                url: '/facilities/performance/info',
                type: 'post',
                data: datas,
                dataType: 'json',
                success: function (response) {
                    // console.log(response);
                    var html = "";
                    if(response.result.length > 0) {
                        for (var i = 0; i < response.result.length; i++) {
                            html += '<tr>'
                                + '<td class="text-center">'+response.result[i].facilities_name+'</td>'
                                + '<td class="text-center">'+response.result[i].facilities_serial_number+'</td>'
                                + '<td class="text-center">'+response.result[i].facilities_model_name+'</td>'
                                + '<td class="text-center">'+response.result[i].facilities_size+'</td>'
                                + '<td class="text-center">'+response.result[i].facilities_buy_day+'</td>'
                                + '<td class="text-center">'+response.result[i].employee_name+'</td>'
                                + '<td class="text-center">'+response.result[i].process_name+'</td>'
                                + '<td class="text-center">'+response.result[i].facilities_location+'</td>'
                                + '<td class="text-center">'+response.result[i].facilities_ip+'</td>'
                                + '<td class="text-center"></td>'
                                + '</td>'
                        }
                        $("#content").empty();
                        $("#content").append(html);
                        // pagenation
                        if(callback) {
                            if(response.count % 10 == 0) {
                                var totalNum = (response.result.length / 10);
                            }else {
                                var totalNum = (response.result.length / 10) + 1;
                            }
                            $('#pagination').bootpag({
                                total: parseInt(totalNum),
                                page: 1,
                                maxVisible: 5
                            }).on('page', function (event, num) {
                                performanceList(num, false);
                            });
                        }
                    }else {
                        html += '<td colspan="10" class="text-center">설비 가동 실적이 없습니다.</td>';
                        $("#content").empty();
                        $("#content").append(html);
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    });
</script>
<?php include_once $root . '/footer.php'; ?>