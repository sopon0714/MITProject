// ***************************************Agreement****************************************************
$(document).ready(function () {
    console.log("ready!");
    $('[data-toggle="tooltip"]').tooltip();
});
$(document).ready(function () {
    console.log("ready!");
    $("#addAgreement").click(function () {
        $("#modalAddAgreement").modal();
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
// ***************************************Agreement****************************************************