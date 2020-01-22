$(function () {
    // modal reset
    $('.modal').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
    });
});
function dateAddDel(sDate, nNum, type) {
    var yy = parseInt(sDate.substr(0, 4), 10);
    var mm = parseInt(sDate.substr(5, 2), 10);
    var dd = parseInt(sDate.substr(8), 10);

    if (type == "d") {
        d = new Date(yy, mm - 1, dd + nNum);
    }
    else if (type == "m") {
        d = new Date(yy, mm - 1, dd + (nNum * 31));
    }
    else if (type == "y") {
        d = new Date(yy + nNum, mm - 1, dd);
    }

    yy = d.getFullYear();
    mm = d.getMonth() + 1; mm = (mm < 10) ? '0' + mm : mm;
    dd = d.getDate(); dd = (dd < 10) ? '0' + dd : dd;

    return '' + yy + '-' +  mm  + '-' + dd;
}

function dateDiff(_date1, _date2) {
    var diffDate_1 = new Date(_date1);
    var diffDate_2 = new Date(_date2);

    diffDate_1 =new Date(diffDate_1.getFullYear(), diffDate_1.getMonth()+1, diffDate_1.getDate());
    diffDate_2 =new Date(diffDate_2.getFullYear(), diffDate_2.getMonth()+1, diffDate_2.getDate());

    var diff = diffDate_2.getTime() - diffDate_1.getTime();
    diff = Math.ceil(diff / (1000 * 3600 * 24));

    return diff;
}

function isEmpty(str){
    if(typeof str == "undefined" || str == null || str == "" || str == "NaN")
        return true;
    else
        return false ;
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    // Textbox value
    var _value = event.srcElement.value;

    // 소수점(.)이 두번 이상 나오지 못하게
    var _pattern0 = /^\d*[.]\d*$/; // 현재 value값에 소수점(.) 이 있으면 . 입력불가
    if (_pattern0.test(_value)) {
        if (charCode == 46) {
            return false;
        }
    }
    // // 1000 이하의 숫자만 입력가능
    // var _pattern1 = /^\d{3}$/; // 현재 value값이 3자리 숫자이면 . 만 입력가능
    // if (_pattern1.test(_value)) {
    //     if (charCode != 46) {
    //         alert("1000 이하의 숫자만 입력가능합니다");
    //         return false;
    //     }
    // }
    //
    // // 소수점 둘째자리까지만 입력가능
    // var _pattern2 = /^\d*[.]\d{2}$/; // 현재 value값이 소수점 둘째짜리 숫자이면 더이상 입력 불가
    // if (_pattern2.test(_value)) {
    //     alert("소수점 둘째자리까지만 입력가능합니다.");
    //     return false;
    // }
    return true;
}