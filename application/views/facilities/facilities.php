<?php include_once $root.'/head.php';?>
<?php include_once $root.'/head_sub.php';?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b>설비등록</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <form id="facilitiesForm" method="post">
                            <tr>
                                <th>설비명</th>
                                <td><input type="text" id="equipment" name="facilities_name" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>시리얼넘버</th>
                                <td><input type="text" id="serial" name="facilities_serial_number" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>모델명</th>
                                <td><input type="text" id="model" name="facilities_model_name" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>규격</th>
                               <td><input type="text" id="standard" name="facilities_size" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>구입일</th>
                                <td><input type="text" id="purchase" name="facilities_buy_day" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>관리자</th>
                                <td><select id="manager" name="employee_id" class="form-control"></select></td>
                            </tr>
                            <tr>
                                <th>공정</th>
                                <td><select id="fair" name="process_id" class="form-control"></select></td>
                            </tr>
                            <tr>
                                <th>설치(위치)</th>
                                <td><input type="text" id="location" name="facilities_location" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>IP</th>
                                <td><input type="text" id="ip" name="facilities_ip" class="form-control"></td>
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
<!-- Modal2 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b>설비정보</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered border-0">
                    <tbody>
                        <form id="facilitiesForm2" method="post">
                            <input type="hidden" id="idx" name="facilities_id">
                            <tr>
                                <td class="align-middle border-0">설비명</td>
                                <td class="border-0"><input type="text" id="equipment2" name="facilities_name" class="form-control"></td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0">시리얼넘버</td>
                                <td class="border-0"><input type="text" id="serial2" name="facilities_serial_number" class="form-control"></td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0">모델명</td>
                                <td class="border-0"><input type="text" id="model2" name="facilities_model_name" class="form-control"></td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0">규격</td>
                                <td class="border-0"><input type="text" id="standard2" name="facilities_size" class="form-control"></td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0">구입일</td>
                                <td class="border-0"><input type="text" id="purchase2" name="facilities_buy_day" class="form-control"></td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0">관리자</td>
                                <td class="border-0"><select id="manager2" name="employee_id" class="form-control"></select></td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0">공정</td>
                                <td class="border-0"><select id="fair2" name="process_id" class="form-control"></td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0">설치(위치)</td>
                                <td class="border-0"><input type="text" id="location2" name="facilities_location" class="form-control"></td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0">IP</td>
                                <td class="border-0"><input type="text" id="ip2" name="facilities_ip" class="form-control"></td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" id="edit_btn">수정</button>
                <button type="button" class="btn btn-danger" id="delete_btn">삭제</button>
            </div>
        </div>
    </div>
</div>

<div class="card">
     <div class="card-header">
        <div class="card-tools">
            <button class="btn btn-primary" id="reg_btn" data-toggle="modal" data-target="#myModal">등록</button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
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
                </tr>
            </thead>
            <tbody id="content"></tbody>
        </table>
        <div id="pagination" class="mt-3"></div>
    </div>
</div>




<script>
    $(function () {
        //page loading
        facilitiesList(1, true);

        // myModal open event
        $("#myModal").on('shown.bs.modal', function () {
            $.ajax({
                url: '/facilities/facilities/insertModal',
                type: 'post',
                dataType: 'json',
                success: function (response) {
                    if(response.employee.length > 0) {
                        var html = "<option selected disabled hidden>선택</option>";
                        for (var i = 0; i < response.employee.length; i++) {
                            html += "<option value='"+response.employee[i].employee_id+"'>"+response.employee[i].name+"</option>";
                        }
                        $("#manager").empty();
                        $("#manager").append(html);
                    }
                    if(response.process.length > 0) {
                        var html = "<option selected disabled hidden>선택</option>";
                        for (var i = 0; i < response.process.length; i++) {
                            html += "<option value='"+response.process[i].process_id+"'>"+response.process[i].name+"</option>";
                        }
                        $("#fair").empty();
                        $("#fair").append(html);
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });

        // insert button click event
        $("#submit_btn").click(function () {
            var equipment = $("#equipment").val();
            var serial = $("#serial").val();
            var model = $("#model").val();
            var standard = $("#standard").val();
            var purchase = $("#purchase").val();
            var manager = $("#manager").val();
            var fair = $("#fair").val();
            var location = $("#location").val();
            var ip = $("#ip").val();

            if(isEmpty(equipment)) {
                alert('설비명을 입력해주세요.');
                $("#equipment").focus();
                return false;
            }else if(isEmpty(serial)){
                alert('시리얼넘버를 입력해주세요.');
                $("#serial").focus();
                return false;
            }else if(isEmpty(model)) {
                alert('모델명을 입력해주세요.');
                $("#model").focus();
                return false;
            }else if(isEmpty(standard)) {
                alert('규격을 입력해주세요.');
                $("#standard").focus();
                return false;
            }else if(isEmpty(purchase)) {
                alert('구입일을 입력해주세요.');
                $("#purchase").focus();
                return false;
            }else if(isEmpty(manager)) {
                alert('관리자를 선택해주세요.');
                $("#manager").focus();
                return false;
            }else if(isEmpty(fair)) {
                alert('공정을 선택해주세요.');
                $("#fair").focus();
                return false;
            }else if(isEmpty(location)) {
                alert('설치(위치)를 입력해주세요.');
                $("#location").focus();
                return false;
            }else if(isEmpty(ip)) {
                alert('IP를 입력해주세요.');
                $("#ip").focus();
                return false;
            }

            // 설비등록 api 로직 추가
            facilitiesRegister();
        });

        // myModal2 save button click evnet
        $("#edit_btn").click(function () {
            var equipment = $("#equipment2").val();
            var serial = $("#serial2").val();
            var model = $("#model2").val();
            var standard = $("#standard2").val();
            var purchase = $("#purchase2").val();
            var manager = $("#manager2").val();
            var fair = $("#fair2").val();
            var location = $("#location2").val();
            var ip = $("#ip2").val();

            if(isEmpty(equipment)) {
                alert('설비명을 입력해주세요.');
                $("#equipment2").focus();
                return false;
            }else if(isEmpty(serial)){
                alert('시리얼넘버를 입력해주세요.');
                $("#serial2").focus();
                return false;
            }else if(isEmpty(model)) {
                alert('모델명을 입력해주세요.');
                $("#model2").focus();
                return false;
            }else if(isEmpty(standard)) {
                alert('규격을 입력해주세요.');
                $("#standard2").focus();
                return false;
            }else if(isEmpty(purchase)) {
                alert('구입일을 입력해주세요.');
                $("#purchase2").focus();
                return false;
            }else if(isEmpty(manager)) {
                alert('관리자를 선택해주세요.');
                $("#manager2").focus();
                return false;
            }else if(isEmpty(fair)) {
                alert('공정을 선택해주세요.');
                $("#fair2").focus();
                return false;
            }else if(isEmpty(location)) {
                alert('설치(위치)를 입력해주세요.');
                $("#location2").focus();
                return false;
            }else if(isEmpty(ip)) {
                alert('IP를 입력해주세요.');
                $("#ip2").focus();
                return false;
            }

            // 설비등록 api 실행 추가
            facilitiesUpdate();
        });

    });
    // facilitiese List
    function facilitiesList(page, callback) {
        if(isEmpty(page)) {page = 1;}
        $.ajax({
            url: '/facilities/facilities/info?page='+page,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                var html = "";
                if(response.info.length > 0) {
                    for (var i = 0; i < response.info.length; i++) {
                        html += "<tr>"
                            + "<td class='text-center text-primary'><a data-toggle='modal' data-target='#myModal2' data-idx="+response.info[i].facilities_id+" onclick='facilitiesSingleList("+response.info[i].facilities_id+")'>"+response.info[i].facilities_name+"</a></td>"
                            + "<td class='text-center'>"+response.info[i].facilities_serial_number+"</td>"
                            + "<td class='text-center'>"+response.info[i].facilities_model_name+"</td>"
                            + "<td class='text-center'>"+response.info[i].facilities_size+"</td>"
                            + "<td class='text-center'>"+response.info[i].facilities_buy_day+"</td>"
                            + "<td class='text-center'>"+response.info[i].employee_name+"</td>"
                            + "<td class='text-center'>"+response.info[i].process_name+"</td>"
                            + "<td class='text-center'>"+response.info[i].facilities_location+"</td>"
                            + "<td class='text-center'>"+response.info[i].facilities_ip+"</td>"
                            + "</tr>";
                    }
                }else {
                    html = "<tr><td colspan='9' class='text-center'>등록된 설비가 없습니다.</td></tr>"
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

            },error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    // modal1 save
    function facilitiesRegister() {
        var datas = $("#facilitiesForm").serialize();
        $.ajax({
            url: '/facilities/facilities/insert',
            type: 'post',
            data: datas,
            dataType: 'json',
            beforeSend: function() {
                $('#submit_btn').button('loading');
            },complete: function() {
                $('#submit_btn').button('reset');
            },success: function (response) {
                location.reload();
            },error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    // modal2 loading
    function facilitiesSingleList(idx) {
        // selectbox loading
        $.ajax({
            url: '/facilities/facilities/insertModal',
            type: 'post',
            dataType: 'json',
            success: function (response) {
                if(response.employee.length > 0) {
                    var html = "<option selected disabled hidden>선택</option>";
                    for (var i = 0; i < response.employee.length; i++) {
                        html += "<option value='"+response.employee[i].employee_id+"'>"+response.employee[i].name+"</option>";
                    }
                    $("#manager2").empty();
                    $("#manager2").append(html);
                }
                if(response.process.length > 0) {
                    var html = "<option selected disabled hidden>선택</option>";
                    for (var i = 0; i < response.process.length; i++) {
                        html += "<option value='"+response.process[i].process_id+"'>"+response.process[i].name+"</option>";
                    }
                    $("#fair2").empty();
                    $("#fair2").append(html);
                }
            }, error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
        // modal2 data loading
        $.ajax({
            url: '/facilities/facilities/singleInfo?idx='+idx,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                if (response.result.length > 0) {
                    $("#idx").val(response.result[0].facilities_id);
                    $("#equipment2").val(response.result[0].facilities_name);
                    $("#serial2").val(response.result[0].facilities_serial_number);
                    $("#model2").val(response.result[0].facilities_model_name);
                    $("#standard2").val(response.result[0].facilities_size);
                    $("#purchase2").val(response.result[0].facilities_buy_day);
                    $("#manager2").val(response.result[0].employee_id);
                    $("#fair2").val(response.result[0].process_id);
                    $("#location2").val(response.result[0].facilities_location);
                    $("#ip2").val(response.result[0].facilities_ip);
                    $("#delete_btn").attr('onclick', 'facilitiesDelete('+response.result[0].facilities_id+')');
                }
            },error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    // modal2 update
    function facilitiesUpdate() {
        var datas = $("#facilitiesForm2").serialize();
        $.ajax({
            url: '/facilities/facilities/update',
            type: 'post',
            data: datas,
            dataType: 'json',
            beforeSend: function () {
                $('#edit_btn').button('loading');
            }, complete: function () {
                $('#edit_btn').button('reset');
            }, success: function (response) {
                alert('수정되었습니다.');
                location.reload();
            }, error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    // modal2 delete
    function facilitiesDelete(idx) {
        if(confirm("정말 삭제하시겠습니까?") == true){
            $.ajax({
                url: '/facilities/facilities/delete?idx='+idx,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    $('#delete_btn').button('loading');
                }, complete: function () {
                    $('#delete_btn').button('reset');
                }, success: function (response) {
                    alert('삭제되었습니다.');
                    location.reload();
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    }
</script>
<?php include_once $root.'/footer.php';?>