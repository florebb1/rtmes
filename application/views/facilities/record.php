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
                            <td>
                                <select id="facilities" class="form-control">
                                    <option value="" selected disabled hidden>선택</option>
                                    <option value="1">설비1</option>
                                    <option value="2">설비2</option>
                                    <option value="3">설비3</option>

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>이상명</th>
                            <td><input type="text" id="abnormal" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td><textarea class="form-control" name="name" id="contents"></textarea></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submit_btn">저장</button>
            </div>
        </div>
    </div>
</div>

    <!-- Modal2 -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b>보기 내용</b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered border-0">
                        <tbody>
                        <!--<tr>
                            <td class="align-middle border-0">내용</td>
                            <td class="border-0"><input type="textarea" id="content" name="content" class="form-control" ></td>
                        </tr>-->
                        <tr>
                            <th>내용</th>
                            <td><textarea class="form-control" name="content" id="content"></textarea></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                </div>

                    <!--                <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="edit_btn">수정</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                                        <button type="button" class="btn btn-danger" id="delete_btn">삭제</button>
                                    </div>-->
            </div>
        </div>
    </div>



<div class="card">
    <div class="card-header table-responsive mb-3">
        <div class="row">
            <div class="col-8">
                <input type="text" id="startDate" name="" class="datepicker" style="padding: .375rem .75rem;" placeholder="기간 선택" readonly> ~ <input type="text" id="endDate" name="" class="datepicker" style="padding: .375rem .75rem;" placeholder="기간 선택" readonly>
                <div class="d-inline-block mx-2">
                    <select name="situation" class="form-control">
                        <option selected disabled hidden>설비 선택</option>
                        <option value="situation1">설비테스트1</option>
                        <option value="situation2">설비테스트2</option>
                        <option value="situation3">설비테스트3</option>
                    </select>
                </div>
                <div class="d-inline-block mx-2">
                    <button class="btn btn-info" onclick="searchList();">검색</button>
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
        <tbody>
            <tr>
                <td class="text-center align-middle">지르코니아</td>
                <td class="text-center align-middle">190101</td>
                <td class="text-center align-middle">이상함2</td>
                <td class="text-center align-middle"><a data-toggle="modal" href="#myModal2" class="text-primary">보기</a></td>
                <td class="text-center align-middle">
                    <select name="situation" class="form-control">
                        <option selected disabled>선택</option>
                    </select>
                </td>
                <td class="text-center align-middle">헤드 고장 수리</td>
                <td class="text-center align-middle">190526</td>
                <td class="text-center align-middle">홍길동</td>
                <td class="text-center align-middle"></td>
            <tr>
                <td class="text-center">　</td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
            </tr>
            </tr>
        </tbody>
    </table>
</div>
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
            $("#startDate").val(start.format('MM/DD/YYYY'));
            $("#endDate").val(end.format('MM/DD/YYYY'));
            $(".dateMenu").removeClass('active');
        });


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

        // modal save button click event
        $("#submit_btn").click(function () {
            var facilities = $("#facilities").val();
            var abnormal = $("#abnormal").val();
            var contents = $("#contents").val();
            if(isEmpty(facilities)) {
                alert('설비명을 선택해주세요.');
                $("#facilities").focus();
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
        });
    });

    // searchButton click event
    function searchList() {
        var start = $("#startDate").val();
        var end = $("#endDate").val();
        if (isEmpty(start)) {
            alert('시작날짜를 선택해주세요.');
            $("#startDate").focus();
            return false;
        } else if (isEmpty(end)) {
            alert('종료날짜를 선택해주세요.');
            $("#endDate").focus();
            return false;
        }
        if (dateDiff(start, end) < 0) {
            alert('종료날짜는 시작날짜 이전값을 넣을 수 없습니다.');
            $("#startDate").focus();
            return false;
        }

        // 클레임 관리 검색 api 로직...
    }
</script>
<?php include_once $root . '/footer.php'; ?>