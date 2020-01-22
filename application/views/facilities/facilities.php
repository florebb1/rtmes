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
                        <tr>
                            <th>설비명</th>
                            <td><input type="text" id="equipment" name="" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>시리얼넘버</th>
                            <td><input type="text" id="serial" name="" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>모델명</th>
                            <td><input type="text" id="model" name="" class="form-control"></td>
                        </tr>
                       <tr>
                            <th>규격</th>
                           <td><input type="text" id="standard" name="" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>구입일</th>
                            <td><input type="text" id="purchase" name="" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>관리자</th>
                            <td>
                                <select id="manager" name="" class="form-control">
                                    <option selected disabled hidden>선택</option>
                                     <option value="manager1">홍길동</option>
                                     <option value="manager2">가길동</option>
                                     <option value="manager3">나길동</option>
                                </select>
                            </td>
                        </tr>
                            <th>공정</th>
                        <td>
                            <select id="fair" name="" class="form-control">
                                <option selected disabled hidden>선택</option>
                                     <option value="fair1">CAD</option>
                                     <option value="fair2">공정테스트2</option>
                                     <option value="fair3">공정테스트3</option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                            <th>설치(위치)</th>
                            <td><input type="text" id="location" name="" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>IP</th>
                            <td><input type="text" id="ip" name="" class="form-control"></td>
                        </tr>
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
                    <tr>
                        <td class="align-middle border-0">설비명</td>
                        <td class="border-0"><input type="text" id="equipment2" name="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="align-middle border-0">시리얼넘버</td>
                        <td class="border-0"><input type="text" id="serial2" name="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="align-middle border-0">모델명</td>
                        <td class="border-0"><input type="text" id="model2" name="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="align-middle border-0">규격</td>
                        <td class="border-0"><input type="text" id="standard2" name="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="align-middle border-0">구입일</td>
                        <td class="border-0"><input type="text" id="purchase2" name="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="align-middle border-0">관리자</td>
                        <td class="border-0"><input type="text" id="manager2" name="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="align-middle border-0">공정</td>
                        <td class="border-0"><input type="text" id="fair2" name="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="align-middle border-0">설치(위치)</td>
                        <td class="border-0"><input type="text" id="location2" name="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="align-middle border-0">IP</td>
                        <td class="border-0"><input type="text" id="ip2" name="" class="form-control"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="edit_btn">수정</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
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
            <tbody>
            <tr>
                <td class="text-center"><a data-toggle="modal" href="#myModal2">지르코니아</a></td>
                <td class="text-center">1234abcd</td>
                <td class="text-center">Abcd-111</td>
                <td class="text-center">1</td>
                <td class="text-center">190811</td>
                <td class="text-center">홍길동</td>
                <td class="text-center">CAD</td>
                <td class="text-center">3층 1번 기둥 옆</td>
                <td class="text-center">111.11.111</td>
            </tr>
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
            </tbody>
        </table>
    </div>
</div>



<script>
$(function () {
    // 등록 모달 저장버튼 클릭 이벤트
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
    });

    // 장비 정보 모달 저장버튼 클릭 이벤트
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
            alert('관리자를 입력해주세요.');
            $("#manager2").focus();
            return false;
        }else if(isEmpty(fair)) {
            alert('공정을 입력해주세요.');
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
    });

    // 장비 정보 모달 삭제버튼 클릭 이벤트
    $("#delete_btn").click(function () {
        if(confirm("정말 삭제하시겠습니까?") == true){
            // 삭제 api 실행
        }
    });


});
</script>
<?php include_once $root.'/footer.php';?>