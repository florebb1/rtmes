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
                        <form id="materialForm" method="post">
                            <tr>
                                <th>자재명</th>
                                <td><input type="text" id="mtrlName" name="material_name" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>단위</th>
                                <td><input type="text" id="unit" name="material_unit" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>적정재고</th>
                                <td><input type="number" id="stock" name="material_count" class="form-control" onkeypress='return isNumberKey(event)'></td>
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
            <button class="btn btn-primary" id="reg_btn" data-toggle="modal" data-target="#myModal">등록</button>
            <button class="btn btn-danger" id="delete_btn">삭제</button>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center"></th>
                    <th class="text-center">자재명</th>
                    <th class="text-center">단위</th>
                    <th class="text-center">적정 재고</th>
                </tr>
            </thead>
            <tbody id="content"></tbody>
        </table>
        <div id="pagination" class="mt-3"></div>
    </div>
</div>

<script>
    $(function () {
        // page loading
        materialList(1, true);

        // modal saveButton click event
        $("#submit_btn").click(function () {
            var mtrlName = $("#mtrlName").val();
            var unit = $("#unit").val();
            var stock = $("#stock").val();
            if(isEmpty(mtrlName)) {
                alert('자재명을 입력해주세요.');
                $("#mtrlName").focus();
                return false;
            }else if(isEmpty(unit)) {
                alert('단위를 입력해주세요.');
                $("#unit").focus();
                return false;
            }else if(isEmpty(stock)) {
                alert('적정재고를 입력해주세요.');
                $("#stock").focus();
                return false;
            }else if(stock <= 0) {
                alert('적정재고는 0보다 작은값은 입력할 수 없습니다.');
                return false;
            }

            materialRegister();
        });

        // deleteButton click event
        $("#delete_btn").click(function () {
            if($("input[name='mtrlNum']:checked").length > 0) {
                if(confirm("해당 자재를 삭제하시겠습니까?") == true){
                    // 배열 변수 선언
                    var mtrlNum = new Array();
                    // 선택된 값 배열 추가
                    $("input[name=mtrlNum]:checked").each(function() {
                        mtrlNum.push($(this).val());
                    });
                    materialDelete(mtrlNum);
                }
            }else {
                alert('자제를 선택해주세요.');
                return false;
            }
        });
    });

    function materialList(page, callback) {
        if(isEmpty(page)) {
            page = 1;
        }
        $.ajax({
            url: '/material/material/info?page='+page,
            type: 'post',
            dataType: 'json',
            success: function(response) {
                var html = "";
                if(response.info.length > 0) {
                    for (var i = 0; i < response.info.length; i++) {
                        html += '<tr>'
                            + '<td class="text-center"><input type="checkbox" name="mtrlNum" value='+response.info[i].material_id+'></td>'
                            + '<td class="text-center">'+response.info[i].material_name+'</td>'
                            + '<td class="text-center">'+response.info[i].material_unit+'</td>'
                            + '<td class="text-center">'+response.info[i].material_count+'</td>'
                            + '</tr>';
                    }
                }else {
                    html += '<tr><td colspan="4" class="text-center">등록된 자재가 없습니다.</tr>';
                }
                $("#content").empty();
                $("#content").append(html);

                // pagenation
                if(callback) {
                    if(response.count % 25 == 0) {
                        var totalNum = (response.info.length / 25);
                    }else {
                        var totalNum = (response.info.length / 25) + 1;
                    }
                    $('#pagination').bootpag({
                        total: parseInt(totalNum),
                        page: 1,
                        maxVisible: 5
                    }).on('page', function (event, num) {
                        materialList(num, false);
                    });
                }
            },error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    function materialRegister() {
        var datas = $("#materialForm").serialize();
        $.ajax({
            url: '/material/material/insert',
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
    function materialDelete(arr) {
        $.ajax({
            url: '/material/material/delete?idx='+arr.toString(),
            type: 'post',
            data: {arrayData : arr},
            dataType: 'text',
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