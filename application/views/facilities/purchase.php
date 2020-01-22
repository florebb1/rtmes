<?php include_once $root.'/head.php';?>     <!-- 설비 작업 현황 -->

    <div class="card">
         <div class="card-header">
             <div class="row justify-content-end">
                 <div class="col-2">
                    <select name="situation" class="form-control" >
                        <option selected disabled hidden>동작상태</option>
                        <option value="produce">작업중</option>
                        <option value="standBy">대기중</option>
                        <option value="complete">작업완료</option>
                        <option value="Unable">작업불가</option>
                    </select>
                 </div>

                 <div class="col-2">
                    <select name="situation" class="form-control" >
                        <option selected disabled hidden>작업자</option>
                        <option value="produce">김치공</option>
                        <option value="standBy">나치공</option>
                        <option value="complete">홍길동</option>
                        <option value="Unable">김철수</option>
                    </select>
                </div>
             </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center align-middle">설비명</th>
                        <th class="text-center align-middle">시리얼넘버(ID)</th>
                        <th class="text-center align-middle">IP</th>
                        <th class="text-center align-middle">공정</th>
                        <th class="text-center align-middle">작업물(로드번호)</th>
                        <th class="text-center align-middle">동작상태</th>
                        <th class="text-center align-middle">작업자</th>
                    </tr>

                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center align-middle">지르코니아<br>밀링1</td>
                        <td class="text-center align-middle">Z001M</td>
                        <td class="text-center align-middle">111.11.111</td>
                        <td class="text-center align-middle">밀링</td>
                        <td class="text-center align-middle text-success">C0002T190917113215D0002O<br>C0011T190916002403B0002O<br>C0004T190917104755D0002R</td>
                        <td class="text-center align-middle">작업중</td>
                        <td class="text-center align-middle">김치공</td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">지르코니아<br>밀링2</td>
                        <td class="text-center align-middle">Z002M</td>
                        <td class="text-center align-middle">111.11.111</td>
                        <td class="text-center align-middle">밀링</td>
                        <td class="text-center align-middle"></td>
                        <td class="text-center align-middle">대기중</td>
                        <td class="text-center align-middle">김치공</td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">메탈 밀링</td>
                        <td class="text-center align-middle">M001M</td>
                        <td class="text-center align-middle">111.11.111</td>
                        <td class="text-center align-middle">밀링</td>
                        <td class="text-center align-middle text-success">C0031T190916114312C0002O</td>
                        <td class="text-center align-middle">작업중</td>
                        <td class="text-center align-middle">나치공</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <script>

    </script>

<?php include_once $root.'/footer.php';?>