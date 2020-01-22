<?php include_once $root.'/head.php';?>
<?php include_once $root.'/head_sub.php';?>
<div class="card">
<!--    <div class="card-header"></div>-->
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">자재명</th>
                    <th class="text-center">단가</th>
                    <th class="text-center">수량</th>
                    <th class="text-center">단위</th>
                    <th class="text-center">금액(원)</th>
                    <th class="text-center">거래처(매입처)</th>
                    <th class="text-center">입고일</th>
                    <th class="text-center">적정 재고</th>
                    <th class="text-center">최근 출고 일자</th>
                    <th class="text-center">최근 출고 수량</th>
                </tr>
            </thead>
            <tbody id="content"></tbody>
        </table>
        <div id="pagination" class="mt-3"></div>
    </div>
</div>

<script>
    $(function () {
        stockList(1, true);
    });
    function stockList(page, callback) {
        if(isEmpty(page)) {page = 1;}
        $.ajax({
            url: '/material/stock/info?page='+page,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                var html = "";
                if(response.result.length > 0) {
                    for (var i = 0; i < response.result.length; i++) {
                        html += "<tr>"
                            + "<td class='text-center'>"+response.result[i].material_name+"</td>"
                            + "<td class='text-center'>"+numberWithCommas(response.result[i].material_amount)+"</td>"
                            + "<td class='text-center'>"+response.result[i].material_count+"</td>"
                            + "<td class='text-center'>"+response.result[i].material_unit+"</td>"
                            + "<td class='text-center text-info'>"+numberWithCommas(response.result[i].material_amount * response.result[i].material_count)+"</td>"
                            + "<td class='text-center'>"+response.result[i].business_name+"</td>"
                            + "<td class='text-center'>"+moment(response.result[i].material_incoming_day).format('YYYY-MM-DD')+"</td>"
                            + "<td class='text-center'>"+response.result[i].apt_count+"</td>";
                        if(isEmpty(response.result[i].material_outcoming_day)) {
                            html += "<td class='text-center'>-</td>";
                        }else {
                            html += "<td class='text-center'>"+moment(response.result[i].material_outcoming_day).format('YYYY-MM-DD')+"</td>";
                        }
                        if(isEmpty(response.result[i].material_outcoming_count)) {
                            html += "<td class='text-center'>-</td>";
                        }else {
                            html += "<td class='text-center'>"+response.result[i].material_outcoming_count+"</td>";
                        }
                            html += "</tr>";
                    }
                }else {
                    html += "<tr><td colspan='10' class='text-center'>등록된 입고내역이 없습니다.</td></tr>";
                }
                $("#content").empty();
                $("#content").append(html);
                // pagenation
                if(callback) {
                    if(response.count % 25 == 0) {
                        var totalNum = (response.count / 25);
                    }else {
                        var totalNum = (response.count / 25) + 1;
                    }
                    $('#pagination').bootpag({
                        total: parseInt(totalNum),
                        page: 1,
                        maxVisible: 5
                    }).on('page', function (event, num) {
                        stockList(num, false);
                    });
                }

            },error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
</script>

<?php include_once $root.'/footer.php';?>