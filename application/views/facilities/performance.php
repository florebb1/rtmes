<?php include_once $root . '/head.php'; ?>     <!-- 설비 가동 실적 -->
<?php include_once $root . '/head_sub.php'; ?>     <!-- 설비 가동 실적 -->
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <div class="mb-3">
                <input type="hidden" id="selectDate">
                <button class="btn btn-outline-primary mr-1 dateMenu" data-text="1">어제</button>
                <button class="btn btn-outline-primary mr-1 dateMenu" data-text="7">지난주</button>
                <button class="btn btn-outline-primary mr-1 dateMenu" data-text="30">지난달</button>

                <button class="btn btn-outline-primary mr-1 dateMenu" data-text="mo">월별 그래프</button>
                <button class="btn btn-outline-primary mr-1 dateMenu" data-text="ye">년도별 그래프</button>
            </div>
            <thead>
                <tr>
                    <th class="text-center">장비명</th>
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
            <tbody>
                <tr>
                    <td class="text-center">장비1</td>
                    <td class="text-center">1234abcd</td>
                    <td class="text-center">Abcd-111</td>
                    <td class="text-center">규격</td>
                    <td class="text-center">190811</td>
                    <td class="text-center">홍길동</td>
                    <td class="text-center">CAD</td>
                    <td class="text-center">3층 1번 기둥 옆</td>
                    <td class="text-center">111.11.111</td>
                    <td class="text-center">32</td>
                </tr>
                <tr>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                </tr>
            </tbody>
        </table>
    </table>

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
            var today = new Date();
            today = moment(today).format('YYYY-MM-DD');
            var menu = $(this).data('text');
            if(menu == "1") {
                var newDate = dateAddDel(today, -1, 'd');
                $("#selectDate").val(newDate);
                $(this).addClass('active');
            }else if(menu == "7") {
                var newDate = dateAddDel(today, -7, 'd');
                $("#selectDate").val(newDate);
                $(this).addClass('active');
            }else if(menu == "30") {
                var newDate = dateAddDel(today, -1, 'm');
                $("#selectDate").val(newDate);
                $(this).addClass('active');
            }else if(menu == "mo") {
                $(this).addClass('active');
                // 월별 그래프 호출 api
            }else if(menu == "ye") {
                $(this).addClass('active');
                // 년도 그래프 호출 api
            }
        });

        // 임시 그래프
        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        };

        var randomScalingFactor = function() {
            return (Math.random() > 0.5 ? 1.0 : 1.0) * Math.round(Math.random() * 100);
        };

        var line1 = [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), ];

        var line2 = [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), ];

        var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var config = {
            type: 'line',
            data: {
                labels: MONTHS,
                datasets: [{
                    label: "장비1",
                    backgroundColor: window.chartColors.gray,
                    borderColor: window.chartColors.gray,
                    data: line1,
                    fill: false,
                }, {
                    label: " ",
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: line2,
                }]
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
</script>
<?php include_once $root . '/footer.php'; ?>