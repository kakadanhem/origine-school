function getDistrict(selectedValue){
//call  ajax method to get data from database
    $.ajax({
        type: "POST",
        url: "index.php?r=address/list-district&pid=" + selectedValue,
        dataType: "json",
        async: false,
        success: function (data) {

            $('select#address-district_id').empty();
            $('select#address-district_id').select2({
                data: data,
                theme: "krajee",
                width: "100%",
                allowClear: true,
            });
        },
    });
}
function getCommune(selectedValue){
//call  ajax method to get data from database
    $.ajax({
        type: "POST",
        url: "index.php?r=address/list-commune&did=" + selectedValue,
        dataType: "json",
        async: false,
        success: function (data) {

            $('select#address-commune_id').empty();
            $('select#address-commune_id').select2({
                data: data,
                theme: "krajee",
                width: "100%",
                allowClear: true,
            });
        },
    });
}
function getVillage(selectedValue){
//call  ajax method to get data from database
    $.ajax({
        type: "POST",
        url: "index.php?r=address/list-village&vid=" + selectedValue,
        dataType: "json",
        async: false,
        success: function (data) {

            $('select#address-village_id').empty();
            $('select#address-village_id').select2({
                data: data,
                theme: "krajee",
                width: "100%",
                allowClear: true,
            });
        },
    });
}

function getGrades(selectedValue){
//call  ajax method to get data from database
    $.ajax({
        type: "POST",
        url: "index.php?r=program/list-grade&pid=" + selectedValue,
        dataType: "json",
        async: false,
        success: function (data) {

            $('select#enrollmentsearch-searchgrade_id').empty();
            $('select#enrollmentsearch-searchgrade_id').select2({
                data: data,
                theme: "krajee",
                width: "100%",
                allowClear: true,
            });
        },
    });
}

function getfee(selectedValue){
    $('#enrollmentfee-0-amount').html(selectedValue);
//call  ajax method to get data from database
/*    $.ajax({
        type: "POST",
        url: "index.php?r=fee/single-fee&vid=" + selectedValue,
        dataType: "json",
        async: false,
        success: function (data) {

            $('select#address-village_id').empty();
            $('select#address-village_id').select2({
                data: data,
                theme: "krajee",
                width: "100%",
                allowClear: true,
            });
        },
    });*/
}