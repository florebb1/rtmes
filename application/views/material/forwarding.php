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
                    <th class="text-center">거래처</th>
                    <th class="text-center">입고일</th>
                    <th class="text-center">적정 재고</th>
                    <th class="text-center">출고처리</th>
                </tr>
            </thead>
            <tbody id="content"></tbody>
        </table>
        <div id="pagination" class="mt-3"></div>
    </div>
</div>

<script>
    $(function () {
        // page loading event
        incomingList(1, true);

        // outcoming_count input event
        $(document).on('change', '.outcomingText', function () {
            if(confirm("출고하시겠습니까?") == true){
                // sf_material_stock table idx field
                var idx = $(this).data("idx");
                // sf_material_stock table material_count field
                var quotient = $(this).data("quotient");
                // input value
                var value = $(this).val();

                // validation 입력된 숫자가 현재 재고랑 뺄셈 연산
                if(value <= 0) {
                    alert('출고수량은 0보다 작은값은 입력할 수 없습니다.');
                    return false;
                }else if((quotient - value).toFixed(12) < 0) {
                    alert('재고수량이 부족합니다.(잔여재고: '+quotient+')');
                    return false;
                }

                // sf_material_stock update
                var datas = {
                    idx : idx,
                    quotient : quotient,
                    value : value
                };

                $.ajax({
                    url: '/material/forwarding/update',
                    type: 'post',
                    data: datas,
                    dataType: 'json',
                    success: function () {
                        var page = $(".bootpag").find('.active').data("lp");
                        alert('출고되었습니다.');
                        incomingList(page, false);
                    }, error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }else {
                $(this).val("");
                return false;
            }
        });
    });
    // get incoming list function
    function incomingList(page, callback) {
        if(isEmpty(page)) {page = 1;}
        $.ajax({
            url: '/material/forwarding/info?page=' + page,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                var html = "";
                if(response.result.length > 0) {
                    for (var i = 0; i < response.result.length; i++) {
                        html += "<tr>"
                            + "<td class='text-center'>"+response.result[i].material_name+"</td>"
                            + "<td class='text-center'>"+numberWithCommas(response.result[i].material_amount)+"</td>"
                            + "<td class='text-center'>"+response.result[i].material_incoming_count+"</td>"
                            + "<td class='text-center'>"+response.result[i].material_unit+"</td>"
                            + "<td class='text-center text-info'>"+numberWithCommas(response.result[i].material_amount * response.result[i].material_incoming_count)+"</td>"
                            + "<td class='text-center'>"+response.result[i].business_name+"</td>"
                            + "<td class='text-center'>"+moment(response.result[i].material_incoming_day).format('YYYY-MM-DD')+"</td>"
                            + "<td class='text-center'>"+response.result[i].apt_count+"</td>"
                            + "<td class='text-center'><input type='number' class='form-control outcomingText' onkeypress='return isNumberKey(event)' data-idx='"+response.result[i].material_stock_id+"' data-quotient='"+response.result[i].material_count+"'></td>"
                            + "</tr>";
                    }
                }else {
                    html = "<tr><td colspan='9' class='text-center'>등록된 입고내역이 없습니다.</td></tr>"
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
                        incomingList(num, false);
                    });
                }
            }, error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    };
</script>

<?php include_once $root.'/footer.php';?>