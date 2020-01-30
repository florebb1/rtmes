<?php include_once $root . '/head.php'; ?>
<?php include_once $root . '/head_sub.php'; ?>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b>이상 등록</b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>설비명</th>
                            <td><select id="facilitiesName" name="record_id" class="form-control"></select></td>
                        </tr>
                        <tr>
                            <th>이상명</th>
                            <td><input type="text" id="abnormal" name="strange_name" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td><textarea id="contents" name="record_content" class="form-control"></textarea></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                    <button type="button" class="btn btn-primary" onclick="insertList();">저장</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header table-responsive mb-3">
            <div class="row">

                <div class="col-8">
                    <form action="" method="get" class="form-inline" >
                        <input type="text" id="startDate" name="" class="datepicker" style="padding: .375rem .75rem;"
                               placeholder="기간 선택" readonly>&nbsp; ~ &nbsp;<input type="text" id="endDate" name=""
                                                                                  class="datepicker" style="padding: .375rem .75rem;" placeholder="기간 선택" readonly>&nbsp;&nbsp;
                        <!-- <div class="form-control">-->
                        <select class="form-control" name="customer" id="situation">
                            <option selected disabled hidden value="0" >설비 선택</option>
                            <?php for($i=0; $i<count($customers); $i++){?>
                                <option value="<?php echo $customers[$i]["customer_id"];?>" <?php if($customer == $customers[$i]["customer_id"]){?> selected="selected" <?php }?>><?php echo $customers[$i]["name"];?></option>
                            <?php }?>
                        </select>
                        <!--</div>-->
                        <div class="d-inline-block mx-2">
                            <button class="btn btn-info" id="search_btn" onclick="searchList(1, true);">검색</button>
                        </div>
                </div>
                <div class="col-4 text-right">
                    <button class="btn btn-secondary" id="reg_btn" data-toggle="modal" data-target="#myModal">등록</button>
                    <button class="btn btn-primary" id="save_btn">저장</button>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-center align-middle">설비명</th>
                <th class="text-center align-middle">구입일</th>
                <th class="text-center align-middle">이상명</th>
                <th class="text-center align-middle">내용</th>
                <th class="text-center align-middle">이상 유무</th>
                <th class="text-center align-middle">수리 이력</th>
                <th class="text-center align-middle">조치 일자</th>
                <th class="text-center align-middle">관리자</th>
                <th class="text-center align-middle">관리</th>
            </tr>
            </thead>
            <tbody id="content">
            <tr><td colspan="8" class="text-center">조회기간을 선택하여 검색해 주세요.</td>
            </tr>

            <tr>
                <td class="text-center align-middle">지르코니아</td>
                <td class="text-center align-middle">190101</td>
                <td class="text-center align-middle">이상함2</td>
                <td class="text-center align-middle"><a data-toggle="modal" href="#myModal2" class="text-primary" data-id="1" data-name="abc" data-text="abcd1234">보기</a></td>
                <td class="text-center align-middle">
                    <select name="situation" class="form-control">
                        <option selected disabled>선택</option>
                        <option value="y">유</option>
                        <option value="n">무</option>
                    </select>
                </td>
                <td class="text-center align-middle"><input type="text" class="a"></td>
                <td class="text-center align-middle"><input type="text" class="b"></td>
                <td class="text-center align-middle"><input type="text" class="c"></td>
                <td class="text-center align-middle"><button class="btn btn-danger">삭제</button></td>
            </tr>
            </tbody>
        </table>
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
                $("#startDate").val(start.format('YYYY-MM-DD'));
                $("#endDate").val(end.format('YYYY-MM-DD'));
                $(".dateMenu").removeClass('active');
            });
            console.log("1");
            // modal daterangepicker ????????????????
            $("#receivingDate").daterangepicker({
                singleDatePicker: true,
                maxDate: new Date(),
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY-MM-DD'
                }
            });
            console.log("2");


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
                            if (menuDate == "1") {
                                $("#startDate").val(moment(today).format('MM/DD/YYYY'));
                            } else if (menuDate == "7") {
                                var newDate = dateAddDel(today, -7, 'd');
                                $("#startDate").val(moment(newDate).format('MM/DD/YYYY'));
                            } else if (menuDate == "30") {
                                var newDate = dateAddDel(today, -1, 'm');
                                $("#startDate").val(moment(newDate).format('MM/DD/YYYY'));
                            }
                        });
            console.log("1004");

            //page loading event
            situationList();
            console.log("3");

            // myModal open event
            $('#myModal').on('show.bs.modal', function () {
                $.ajax({
                    url: '/facilities/record/getFacilities',
                    type: 'post',
                    dataType: 'json',
                    success: function (response) {
                        if(response.result.length > 0) {
                            var html = "<option selected disabled hidden>선택</option>";
                            for (var i = 0; i < response.result.length; i++) {
                                html += "<option value='"+response.result[i].record_id+"'>"+response.result[i].
                                    facilities_name+"</option>";
                            }
                            $("#facilitiesName").empty();
                            $("#facilitiesName").append(html);
                        }
                    }
                });
            });
        });
        console.log("4");
        // facilities listButton click event
        function situationList() {
            $.ajax({
                url: '/facilities/record/getFacilities',
                type: 'post',
                dataType: 'json',
                success: function (response) {
                    if(response.result.length > 0) {
                        var html = "<option selected disabled hidden>선택</option>";
                        for (var i = 0; i < response.result.length; i++) {
                            html += "<option value='"+response.result[i].record_id+"'>"+response.result[i].facilities_name+"</option>";
                        }
                        $("#situation").empty();
                        $("#situation").append(html);
                    }
                }
            });
        }
        console.log("5");
        // record saveButton click event
        function insertList() {
            var facilities = $("#facilitiesName").val();
            var abnormal = $("#abnormal").val();
            var contents = $("#contents").val();
            if(isEmpty(facilities)) {
                alert('설비명을 선택해주세요.');
                $("#facilitiesName").focus();
                return false;
            }else if(isEmpty(abnormal)){
                alert('이상명을 입력해주세요.');
                $("#abnormal").focus();
                return false;
            }else if(isEmpty(contents)) {
                alert('내용을 입력해주세요.');
                $("#contents").focus();
                return false;
            }
            console.log("6");
            // 보존 이력 등록 api 추가
            var datas = {
                facilities_id : facilities,
                failure_comment : abnormal,
                failure_content : contents
            };
            $.ajax({
                url: '/facilities/record/insert',
                type: 'post',
                data: datas,
                dataType: 'json',
                success: function (response) {
                    alert('등록되었습니다.');
                    location.reload();
                }
            });
        }
        console.log("7");


        $("#reg_btn").click(function(){ //btnAdd라는 버튼을 눌렀을때 ->이벤트 등록
            // var inputString = prompt('테스트', '복잡해~~~~~~~'); //텍스트 대입

            // var html = '<tr><td>' + inputString + '</td>'; //tr, td를 열고 + 문자열로 바꾸고 +td 닫기
            // html += '<td><button type="button" class="btn btn-danger">삭제</button>'; //html변수에 삭제버튼을 대입
            // html += '</td></tr>';

            var html = "";
            html += '<tr>'
                + '<td class="text-center align-middle">지르코니아</td>'
                + '<td class="text-center align-middle">190101</td>'
                + '<td class="text-center align-middle">이상함2</td>'
                + '<td class="text-center align-middle"><a data-toggle="modal" href="#myModal2" class="text-primary" data-id="1" data-name="abc" data-text="abcd1234">보기</a></td>'
                + '<td class="text-center align-middle">'
                + '<select name="situation" class="form-control">'
                + '<option selected disabled>선택</option>'
                + '<option value="y">유</option>'
                + '<option value="n">무</option>'
                + '</select>'
                + '</td>'
                + '<td class="text-center align-middle"><input type="text" class="a"></td>'
                + '<td class="text-center align-middle"><input type="text" class="b"></td>'
                + '<td class="text-center align-middle"><input type="text" class="c"></td>'
                + '<td class="text-center align-middle"><button class="btn btn-danger">삭제</button></td>'
                + '</tr>';
            $("#content").append(html); //list라는 아이디에 html을 추가해라
        });
        console.log("8");
        // record searchButton click event
        function searchList(page, callback) {
            var start = $("#startDate").val();
            var end = $("#endDate").val();
            var facilities = $("#situation").val();
            if (isEmpty(start)) {
                alert('시작날짜를 선택해주세요.');
                $("#startDate").focus();
                return false;
            }else if(isEmpty(end)) {
                alert('종료날짜를 선택해주세요.');
                $("#endDate").focus();
                return false;
            }else if(dateDiff(start, end) < 0) {
                alert('종료날짜는 시작날짜 이전값을 넣을 수 없습니다.');
                $("#startDate").focus();
                return false;
            }else if(isEmpty(facilities)) {
                facilities = 0;
            }
            console.log("9");


            // 보전이력 검색 api 추가...
            var datas = {
                startDate : start,
                endDate : end,
                facilities : facilities
            };
            $.ajax({
                url: '/facilities/record/info',
                type: 'post',
                data: datas,
                dataType: 'json',
                beforeSend: function() {
                    $('#search_btn').button('loading');
                },complete: function() {
                    $('#search_btn').button('reset');
                },success: function (response) {
                    // console.log(response);
                    var html = "";
                    if(response.result.length > 0) {
                        for (var i = 0; i < response.result.length; i++) {
                            html += "<tr>"
                                + "<td class='text-center'>"+response.result[i].facilities_name+"</td>"
                                + "<td class='text-center'>"+response.result[i].material_amount+"</td>"
                                + "<td class='text-center'>"+response.result[i].strange_name+"</td>"
                                + "<td class='text-center text-primary'>"+보기+"</td>"
                                + "<td class='text-center'>"+response.result[i].material_amountt+"</td>"
                                + "<td class='text-center'>"+response.result[i].business_name+"</td>"
                                + "<td class='text-center'>"+response.result[i].apt_count+"</td>"
                                + "<td class='text-center'>"+response.result[i].apt_count+"</td>"
                                + "</tr>";
                        }
                    }else {
                        html += "<tr><td colspan='8' class='text-center'>등록된 설비 보전 이력이 없습니다.</td></tr>";
                    }
                    $("#content").empty();
                    $("#content").append(html);
                },error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }console.log("10");

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
        }console.log("11");
    </script>
<?php include_once $root . '/footer.php'; ?>