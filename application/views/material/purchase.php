<?php include_once $root.'/head.php';?>
<?php include_once $root.'/head_sub.php';?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b>자재 등록</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <form id="purchaseForm" method="post">
                            <tr>
                                <th>자재명</th>
                                <td>
                                    <select id="mtrlName" name="material_id" class="form-control"></select>
                                </td>
                            </tr>
                            <tr>
                                <th>단가</th>
                                <td><input type="number" id="price" name="material_amount" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>수량</th>
                                <td><input type="number" id="quantity" name="material_count" class="form-control" onkeypress='return isNumberKey(event)'></td>
                            </tr>
                            <tr>
                                <th>거래처</th>
                                <td>
                                    <select id="client" name="business_id" class="form-control"></select>
                                </td>
                            </tr>
                            <tr>
                                <th>입고일</th>
                                <td><input type="text" id="receivingDate" name="material_incoming_day" class="form-control bg-white" readonly></td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" id="submit_btn">등록</button>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-tools">
            <button class="btn btn-primary" id="reg_btn" data-toggle="modal" data-target="#myModal">입고</button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <div class="mb-3">
            <input type="text" id="startDate" class="datepicker" style="padding: .375rem .75rem;" placeholder="선택" readonly> ~ <input type="text" id="endDate" class="datepicker" style="padding: .375rem .75rem;" placeholder="선택" readonly>
            <div class="d-inline-block mx-3">
                <button class="btn btn-outline-primary dateMenu" data-text="1">1일</button>
                <button class="btn btn-outline-primary dateMenu" data-text="7">1주</button>
                <button class="btn btn-outline-primary dateMenu" data-text="30">1월</button>
                <button id="search_btn" class="btn btn-info" onclick="searchList(1, true);">검색</button>
            </div>
        </div>
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
                </tr>
            </thead>
            <tbody id="content">
                <tr><td colspan="8" class="text-center">조회기간을 선택하여 검색해주세요.</td></tr>
            </tbody>
        </table>

        <div id="pagination" class="mt-3"></div>
    </div>
</div>


<script>
    $(function () {
        // search daterangepicker
        $('.datepicker').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        },function(start, end) {
            $("#startDate").val(start.format('YYYY-MM-DD'));
            $("#endDate").val(end.format('YYYY-MM-DD'));
            $(".dateMenu").removeClass('active');
        });

        // modal daterangepicker
        $("#receivingDate").daterangepicker({
            singleDatePicker: true,
            maxDate: new Date(),
            locale: {
                cancelLabel: 'Clear',
                format: 'YYYY-MM-DD'
            }
        });

        // register modal open event
        $('#myModal').on('shown.bs.modal', function () {
            // material list loading
            $.ajax({
                url: '/material/purchase/modalInfo',
                type: 'post',
                dataType: 'json',
                success: function(response) {
                    // material selectbox option list
                    var html = "<option selected disabled hidden>선택</option>";
                    for (var i = 0; i < response.material.length; i++) {
                        html += "<option value='"+response.material[i].material_id+"'>"+response.material[i].material_name+"</option>";
                    }
                    $("#mtrlName").empty();
                    $("#mtrlName").append(html);

                    // business selectbox option list
                    var html = "<option selected disabled hidden>선택</option>";
                    for (var i = 0; i < response.business.length; i++) {
                        html += "<option value='"+response.business[i].business_id+"'>"+response.business[i].name+"</option>";
                    }
                    $("#client").empty();
                    $("#client").append(html);

                },error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });

        // modal saveButton click event
        $("#submit_btn").click(function () {
            if(isEmpty($("#mtrlName").val())) {
                alert('자재명을 선택해주세요.');
                $("#mtrlName").focus();
                return false;
            }else if(isEmpty($("#price").val())) {
                alert('단가를 입력해주세요.');
                $("#price").focus();
                return false;
            }else if($("#price").val() <= 0) {
                alert('단가는 0보다 작은값은 입력할 수 없습니다.');
                $("#price").focus();
                return false;
            }else if(isEmpty($("#quantity").val())) {
                alert('수량를 입력해주세요.');
                $("#quantity").focus();
                return false;
            }else if($("#quantity").val() <= 0) {
                alert('수량은 0보다 작은값은 입력할 수 없습니다.');
                $("#quantity").focus();
                return false;
            }else if(isEmpty($("#client").val())) {
                alert('거래처를 선택해주세요.');
                $("#client").focus();
                return false;
            }else if(isEmpty($("#receivingDate").val())) {
                alert('입고일를 입력해주세요.');
                $("#receivingDate").focus();
                return false;
            }
            // 자재입고 api 로직
            purchaseRegister();
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
            $("#endDate").val(today);
            if(menuDate == "1") {
                $("#startDate").val(today);
            }else if(menuDate == "7") {
                var newDate = dateAddDel(today, -7, 'd');
                $("#startDate").val(newDate);
            }else if(menuDate == "30") {
                var newDate = dateAddDel(today, -1, 'm');
                $("#startDate").val(newDate);
            }
        });
        
    });
    // searchButton click event
    function searchList(page, callback) {
        if(isEmpty(page)) {
            page = 1;
        }
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
        // 입고관리 api 호출
        var datas = {
            page : page,
            startDate : start,
            endDate : end
        };
        $.ajax({
            url: '/material/purchase/info',
            type: 'post',
            data: datas,
            dataType: 'json',
            beforeSend: function() {
                $('#search_btn').button('loading');
            },complete: function() {
                $('#search_btn').button('reset');
            },success: function(response) {
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
                            + "<td class='text-center'>"+response.result[i].apt_count+"</td>"
                            + "</tr>";
                    }
                }else {
                    html += "<tr><td colspan='8' class='text-center'>등록된 입고내역이 없습니다.</td></tr>";
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
                        searchList(num, false);
                    });
                }
            },error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    // modal submit button event
    function purchaseRegister() {
        var datas = $("#purchaseForm").serialize();
        $.ajax({
            url: '/material/purchase/insert',
            type: 'post',
            data: datas,
            dataType: 'json',
            beforeSend: function() {
                $('#submit_btn').button('loading');
            },complete: function() {
                $('#submit_btn').button('reset');
            },success: function(response) {
                location.reload();
            },error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
</script>
<?php include_once $root.'/footer.php';?>