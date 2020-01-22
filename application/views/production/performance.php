<?php include_once $root.'/head.php';?>
<?php include_once $root.'/head_sub.php';?>
<div class="card">
    <!--    <div class="card-header"></div>-->
    <div class="card-body table-responsive">
        <div class="mb-3">
            <input type="text" id="startDate" name="" class="datepicker" style="padding: .375rem .75rem;" placeholder="선택" readonly> ~ <input type="text" id="endDate" name="" class="datepicker" style="padding: .375rem .75rem;" placeholder="선택" readonly>
            <div class="d-inline-block mx-3">
                <button class="btn btn-outline-primary dateMenu" data-text="7">7일</button>
                <button class="btn btn-outline-primary dateMenu" data-text="30">30일</button>
                <button class="btn btn-info" onclick="searchList();">조회</button>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-center">인레이</th>
                    <th class="text-center">크라운</th>
                    <th class="text-center">비니어</th>
                    <th class="text-center">어뷰트먼트</th>
                    <th class="text-center">틀니</th>
                    <th class="text-center">기타</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">조회 기간 생산량</td>
                    <td class="text-center">38</td>
                    <td class="text-center">42</td>
                    <td class="text-center">49</td>
                    <td class="text-center">30</td>
                    <td class="text-center">43</td>
                    <td class="text-center">31</td>
                </tr>
            </tbody>
        </table>

        <!-- 그래프 -->
        <div class="mt-5">
            <canvas id="chart"></canvas>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        // daterangepicker
        $('.datepicker').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        },function(start, end) {
            $("#startDate").val(start.format('MM/DD/YYYY'));
            $("#endDate").val(end.format('MM/DD/YYYY'));
            $(".dateMenu").removeClass('active');
        });

        // date menu click event
        $(".dateMenu").click(function () {
            if($(".dateMenu").hasClass('active')) {
                $(".dateMenu").removeClass('active');
            }
            $(this).addClass('active');
            var menuDate = $(this).data('text');
            var today = new Date();
            today = moment(today).format('YYYY-MM-DD');
            $("#endDate").val(moment(today).format('MM/DD/YYYY'));
            if(menuDate == "7") {
                var newDate = dateAddDel(today, -7, 'd');
                $("#startDate").val(moment(newDate).format('MM/DD/YYYY'));
            }else if(menuDate == "30") {
                var newDate = dateAddDel(today, -1, 'm');
                $("#startDate").val(moment(newDate).format('MM/DD/YYYY'));
            }
        });
        
        // 임시 그래프
        Chart.plugins.register({
            afterDraw: function (chart, easing) {
                if (chart.config.options.showValue) {
                    var ctx = chart.chart.ctx;
                    var fontSize = chart.config.options.showValue.fontSize || "9";
                    var fontStyle = chart.config.options.showValue.fontStyle || "Arial";
                    ctx.font =  fontSize + "rem " + fontStyle;
                    ctx.textAlign = chart.config.options.showValue.textAlign || "center";
                    ctx.textBaseline = chart.config.options.showValue.textAlign || "bottom";

                    chart.config.data.datasets.forEach(function (dataset, i) {
                        ctx.fillStyle = dataset.fontColor || chart.config.options.showValue.textColor || "#000";
                        dataset.data.forEach(function (data, j) {
                            if(dataset.hideValue != true){
                                var txt = Math.round(data*100)/100;
                                var xCoordinate = dataset._meta[chart.id].data[j]._model.x;
                                var yCoordinate = dataset._meta[chart.id].data[j]._model.y;
                                var yCoordinateResult;

                                if(dataset.type == 'line'){
                                    yCoordinateResult = yCoordinate + 21 > chart.scales[chart.options.scales.xAxes[0].id].top ? chart.scales[chart.options.scales.xAxes[0].id].top :  yCoordinate + 21;
                                } else{
                                    yCoordinateResult = yCoordinate - 5;
                                }
                                ctx.fillText(txt, xCoordinate, yCoordinateResult);
                            }
                        });
                    });
                }
            }
        });


        var barChartData = {
            labels: ["인레이", "크라운", "비니어", "어뷰트먼트", "틀니", "기타"],
            datasets: [{
                backgroundColor: "#1E90FF",
                data: [38,42,49,30,43,31]
            }]
        };
        window.onload = function() {
            var ctx = $('#chart').get(0).getContext("2d");
            var max = barChartData.datasets[0].data.reduce( function (previous, current) {
                return previous > current ? previous:current;
            });
            max = parseInt(Math.ceil(max/10)*10)+parseInt(10);
            window.theChart = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 10,
                                max: max
                            }
                        }]
                    },
                    animation:false,
                    showValue: {
                        fontStyle: 'Helvetica', //Default Arial
                        fontSize: 1
                    }
                }
            });
        }
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

        // 생산 실적 검색 api 로직...
    }
</script>
<?php include_once $root.'/footer.php';?>