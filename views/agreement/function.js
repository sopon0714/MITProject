// ***************************************agreement.php****************************************************
$(document).ready(function () {
    console.log("ready!");
    $('[data-toggle="tooltip"]').tooltip();
});
$(document).ready(function () {
    console.log("ready!");
    $("#addAgreement").click(function () {
        $("#modalAddAgreement").modal();
        swal({
            title: 'ยืนยัน Email',
            text: 'ได้ทำการส่งEmailไปที่:' + emailEdit + ' กรุณาเข้าไปยืนยัน',
            icon: 'success',
        });
        // $.ajax({
        //     type: "POST",

        //     data: {
        //         userid: iduser,
        //         action: "changeemail",
        //         emailEdit: emailEdit

        //     },
        //     url: "../../views/profile/manage.php",
        //     async: false,
        //     success: function(result) {
        //         console.log("5555");
        //         console.table(result);

        //     }
        // });
    });
});
$(".detailAgreement").click(function () {
    var rnumber = $(this).attr('rnumber');
    var firstname = $(this).attr('firstname');
    var lastname = $(this).attr('lastname');
    var startDate = $(this).attr('startDate');
    var endDate = $(this).attr('endDate');
    var phoneNumber = $(this).attr('phoneNumber');
    var email = $(this).attr('email');

    $('#e_rnumber').val(rnumber);
    $('#e_firstname').val(firstname);
    $('#e_lastname').val(lastname);
    $('#e_startDate').val(startDate);
    $('#e_endDate').val(endDate);
    $('#e_phoneNumber').val(phoneNumber);
    $('#e_email').val(email);

    $("#modalDetailAgreement").modal();
});
$(".EditAgreement").click(function () {
    var idAgree = $(this).attr('idAgree');
    var rnumber = $(this).attr('rnumber');
    var startDate = $(this).attr('startDate');
    var endDate = $(this).attr('endDate');
    // alert(idAgree);
    // alert(rnumber);
    // alert(startDate);
    // alert(endDate);
    $('#e_idAgree').val(idAgree);
    $('#e_rnumber').val(rnumber);
    $('#e_startDate').val(startDate);
    $('#e_endDate').val(endDate);

    $("#modalEdit").modal();
});
function delfunction(title, uid) {
    //alert(uid + " dddd")
    swal({
        title: "คุณต้องการลบ",
        text: title + "หรือไม่ ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                    buttons: false
                });
                delete_1(uid);
                setTimeout(function () {
                    location.reload();
                }, 1500);
            } else {
                swal("Your imaginary file is safe!");
            }
        });
}
function delete_1(uid1) {
    $.ajax({
        type: "POST",
        data: {
            uid: uid1,
            delete: "delete"
        },
        url: "./manage.php",
        async: false,
        success: function (result) {
        }
    });
}
// ***************************************AdminRead.php****************************************************
$(document).ready(function () {
    console.log("ready!");
    $('[data-toggle="tooltip"]').tooltip();
});
$(document).ready(function () {
    console.log("ready!");
    $("#addAdmin").click(function () {
        $("#modalAddAdmin").modal();
    });
});
$(".detailAdmin").click(function () {
    var firstname = $(this).attr('firstname');
    var lastname = $(this).attr('lastname');
    var formalId = $(this).attr('formalId');
    var phoneNumber = $(this).attr('phoneNumber');
    var email = $(this).attr('email');
    var username = $(this).attr('username');
    var password = $(this).attr('password');

    $('#e_firstname').val(firstname);
    $('#e_lastname').val(lastname);
    $('#e_formalId').val(formalId);
    $('#e_phoneNumber').val(phoneNumber);
    $('#e_email').val(email);
    $('#e_username').val(username);
    $('#e_password').val(password);

    $("#modalDetailAdmin").modal();
});

function delfunctionAdmin(title, uid) {
    alert(uid + " dddd")
    swal({
        title: "คุณต้องการลบ",
        text: title + "หรือไม่ ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                    buttons: false
                });
                delete_2(uid);
                setTimeout(function () {
                    location.reload();
                }, 1500);
            } else {
                swal("Your imaginary file is safe!");
            }
        });
}

function delete_2(uid) {
    //alert(55555555);
    $.ajax({
        type: "POST",
        data: {
            uid: uid,
            deleteAdmin: "deleteAdmin"
        },
        url: "./manage.php",
        async: false,
        success: function (result) { }
    });
}