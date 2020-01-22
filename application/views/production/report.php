<?php include_once $root.'/head.php';?>
<?php include_once $root.'/head_sub.php';?>
<div class="card">
    <!--    <div class="card-header"></div>-->
    <div class="card-body table-responsive">
        <div class="mb-3">
            <input type="hidden" id="toDay">
            <input type="text" id="datepicker" style="padding: .375rem .75rem;" placeholder="날짜 선택" readonly>
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
                <td class="text-center">일일 생산량</td>
                <td class="text-center">17</td>
                <td class="text-center">20</td>
                <td class="text-center">23</td>
                <td class="text-center">15</td>
                <td class="text-center">20</td>
                <td class="text-center">10</td>
            </tr>
            </tbody>
        </table>

        <!-- 그래프 -->
        <div class="mt-5">
            <h3 class="text-center" style="font-size: 1.1rem;">
                <button type="button" class="btn btn-tool moveDate" data-text="prev"><i class="fas fa-arrow-left"></i></button>
                <span id="selectDate"></span>
                <button type="button" class="btn btn-tool moveDate" data-text="next"><i class="fas fa-arrow-right"></i></button>
            </h3>
            <canvas id="chart"><i class="icon-checked"  ></canvas>
        </div>
    </div>
</div>



    <script type="text/javascript">
        $(function () {
            // page loading
            $("#selectDate").text(moment(new Date()).format('YY년 MM월 DD일'));

            // daterangepicker
            $('#datepicker').daterangepicker({
                singleDatePicker: true
            });

            $("#datepicker").change(function () {
                var selectDate = moment($(this).val()).format('YY년 MM월 DD일');
                $("#selectDate").text(selectDate);
                // 생산 일보 검색 api 로직...
            });

            // date arrow click event
            $(".moveDate").click(function () {
                var menu = $(this).data('text');
                var today = moment($("#datepicker").val()).format('YYYY-MM-DD');
                if(menu == "prev") {
                    // 이전날짜 선택
                    var newDate = dateAddDel(today, -1, "d");
                    newDate = moment(newDate).format('MM/DD/YYYY');
                    $("#datepicker").val(moment(newDate).format('MM/DD/YYYY'));
                    $("#selectDate").text(moment(newDate).format('YY년 MM월 DD일'));
                }else if(menu == "next") {
                    // 다음날짜 선택
                    var newDate = dateAddDel(today, 1, "d");
                    $("#datepicker").val(moment(newDate).format('MM/DD/YYYY'));
                    $("#selectDate").text(moment(newDate).format('YY년 MM월 DD일'));
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
                    data: [17,20,23,15,20,10]
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
                                    stepSize: 5,
                                    max: 30
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
    </script>
<?php include_once $root.'/footer.php';?>