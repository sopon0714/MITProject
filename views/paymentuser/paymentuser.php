<?php
session_start();
require_once('../../dbConnect.php');
if (!isset($_SESSION['DATAUSER'])) {
    header("location:../../index.php?msg=กระบวนการเข้าเว็บไซต์ไม่ถูกต้อง");
}
// $DATAUSER = $_SESSION['DATAUSER'] ?? NULL;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <?php require_once('../../views/layout/MainCSS.php');
    $uid = $_SESSION['DATAUSER']['uid'];
    // queryการ์ดแสดงค่าห้องของuser
    $sql_commonf = "SELECT `commonf` FROM `payment` INNER JOIN agreement ON agreement.agreeId = payment.agreeId
    INNER JOIN user ON user.uid = agreement.uid WHERE user.uid = $uid GROUP BY payment.commonf";
    $commonf = selectDataOne($sql_commonf);
    // queryการ์ดแสดงค่าห้องค้างชำระของuser
    $sql_payall = "SELECT SUM(paymentAll) AS payall FROM `payment` INNER JOIN agreement ON agreement.agreeId = payment.agreeId
    INNER JOIN user ON user.uid = agreement.uid WHERE user.uid = 2 AND payment.status = 'ยังไม่ได้จ่าย'
    GROUP BY payment.pId";
    $payall = selectDataOne($sql_payall);
    // queryตารางการจ่ายของuser
    $sql_tbPayment = "SELECT  payment.pId,`timeSlip`,`timeConfirm`, `picPath`,date.year,date.month,payment.waterUnit,payment.elecUnit,payment.paymentAll,payment.uid FROM `payment` 
    INNER JOIN agreement ON agreement.agreeId = payment.agreeId
    INNER JOIN user ON user.uid = agreement.uid
    INNER JOIN date on date.dateId = payment.dateId WHERE user.uid =$uid ORDER BY `payment`.`dateId`  DESC";
    $tbPayment = selectData($sql_tbPayment);
    //print_r($tbPayment);
    $arrMonth = array("-", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    ?>
</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <?php
        if ($_SESSION['DATAUSER']['type'] == "ผู้ดูแลระบบ") {
            require_once('../../views/layout/SidebarAdmin.php');
        } else {
            require_once('../../views/layout/SidebarUser.php');
        }
        ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" style="background-color: #EBF5FB;">

                <!-- Topbar -->
                <?php require_once('../../views/layout/Topbar.php') ?>
                <!-- End of Topbar -->
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-12 mb-4">
                            <div class="card">
                                <div class="card-header card-bg" style="background-color: #bf4040">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="link-active "
                                                style="font-size: 15px; color:white;">การจัดการการชำระค่าเช่ารายเดือน</span>


                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-12 mb-4">
                            <div class="card border-left-primary card-color-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold  text-uppercase mb-1">
                                                ราคาห้อง</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $commonf['commonf'] ?>
                                                บาท</div>
                                        </div>
                                        <div class="col-auto">

                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-12 mb-4">
                            <div class="card border-left-primary card-color-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold  text-uppercase mb-1">ยอดค้างชำระ</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $payall['payall'] ?> บาท
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-vote-yea"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ######################## start filter ######################## -->
                    <div class="row center">
                        <div class="col-xl-12 col-12 mb-4 ">
                            <!-- <div class="card-header header-background-color-filter" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style=" color:white;">
                                            การค้นหาขั้นสูง  สัญญาการเช่าทั้งหมด
                                        </div> -->
                        </div>
                    </div>
                    <!-- ######################## end filter ######################## -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card">
                            <div class="card-header card-bg " style="background-color: #bf4040">
                                <span class="link-active "
                                    style="font-size: 15px; color:white;">สัญญาการเช่าทั้งหมด</span>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row center">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered" id="dataTable" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr role="row" style="text-align:center;">
                                                        <th rowspan="1" colspan="1">ปีพ.ศ</th>
                                                        <th rowspan="1" colspan="1">เดือน</th>
                                                        <th rowspan="1" colspan="1">ค่าไฟต่อหน่วย</th>
                                                        <th rowspan="1" colspan="1">ค่าน้ำต่อหน่วย</th>
                                                        <th rowspan="1" colspan="1">ราคารวมทั้งหมด</th>
                                                        <th rowspan="1" colspan="1">รายละเอียด</th>

                                                    </tr>
                                                </thead>

                                                <tbody style="text-align:center;">
                                                    <?php for ($i = 0; $i < $tbPayment[0]['numrow']; $i++) { ?>
                                                    <tr>
                                                        <td><?php echo $tbPayment[$i + 1]['year'] ?></td>
                                                        <td><?php echo $arrMonth[$tbPayment[$i + 1]['month']] ?></td>
                                                        <td><?php echo $tbPayment[$i + 1]['elecUnit'] ?></td>
                                                        <td><?php echo $tbPayment[$i + 1]['waterUnit'] ?></td>
                                                        <td><?php echo $tbPayment[$i + 1]['paymentAll'] ?></td>
                                                        <?php if (is_null($tbPayment[$i + 1]['timeSlip']) && is_null($tbPayment[$i + 1]['uid'])) { ?>
                                                        <td style="text-align:center;">
                                                            <a href="#" class="addPay"
                                                                paymentID=<?php echo $tbPayment[$i + 1]['pId'] ?>
                                                                year=<?php echo $tbPayment[$i + 1]['year'] ?>
                                                                month=<?php echo $arrMonth[$tbPayment[$i + 1]['month']] ?>>
                                                                <button type="button" class="btn btn-success btn-sm"
                                                                    data-toggle="tooltip" title='เพิ่มรายละเอียด'>
                                                                    <i class="fas fa-file-alt"></i>
                                                                </button>
                                                            </a>
                                                        </td>
                                                        <?php } else if (!is_null($tbPayment[$i + 1]['timeSlip']) && is_null($tbPayment[$i + 1]['uid'])) { ?>
                                                        <td style="text-align:center;">
                                                            <a href="#" class="editPay"
                                                                paymentID=<?php echo $tbPayment[$i + 1]['pId'] ?>
                                                                year=<?php echo $tbPayment[$i + 1]['year'] ?>
                                                                month=<?php echo $arrMonth[$tbPayment[$i + 1]['month']] ?>>
                                                                <button type="button" class="btn btn-warning btn-sm"
                                                                    data-toggle="tooltip" title='แก้ไขรายละเอียด'>
                                                                    <i class="fas fa-file-alt"></i>
                                                                </button>
                                                            </a>
                                                        </td>
                                                        <?php } else { ?>
                                                        <td style="text-align:center;">
                                                            <a href="#">
                                                                <button type="button" class="btn btn-info btn-sm"
                                                                    onclick="detailSlip(<?php echo $tbPayment[$i + 1]['pId'] ?> , 
                                                                    '<?php echo $arrMonth[$tbPayment[$i + 1]['month']] ?>' ,
                                                                    '<?php echo $tbPayment[$i + 1]['year'] ?>')"
                                                                    data-toggle="tooltip" title='รายละเอียด'>
                                                                    <i class="fas fa-file-alt"></i>
                                                                </button>
                                                            </a>
                                                        </td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php } ?>



                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!-- footer -->
<?php require_once('../../views/layout/MainJS.php') ?>
<!-- Start Modal -->
<div>
    <div id="modalAddPayment" class="modal fade">
        <form class="modal-dialog modal-lg " enctype="multipart/form-data" method="POST" action='manage.php'>
            <div class="modal-content">
                <div class="modal-header" style="background-color:#00ace6">

                    <h4 class="modal-title" style="color:white">เพิ่มรายละเอียดของผู้เช่า</h4>
                </div>
                <div class="modal-body" id="addModalBody">
                    <div class="row mb-4" style="margin:20px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ปีพ.ศ. : </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="text" class="form-control" id="e_year" name="e_year" maxlength="100"
                                disabled="">
                        </div>
                    </div>
                    <div class="row mb-4" style="margin:20px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เดือน : </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="text" class="form-control" id="e_month" name="e_month" maxlength="100"
                                disabled="">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เพิ่มรูปใบชำระเงิน :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <div class=" upload-content">
                                <div class="main-section">
                                    <div class="file-loading">
                                        <input id="file" type="file" name="file" multiple="" class="file"
                                            data-overwrite-initial="false" data-min-file-count="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="addPic">
                    <input type="hidden" name="e_pId" id="e_pId">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">บันทึก</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="modalEditPayment" class="modal fade">
        <form class="modal-dialog modal-lg " enctype="multipart/form-data" method="POST" action='manage.php'>
            <div class="modal-content">
                <div class="modal-header" style="background-color:#eecc0b">

                    <h4 class="modal-title" style="color:white">แก้ไขรายละเอียดของผู้เช่า</h4>
                </div>
                <div class="modal-body" id="addModalBody">
                    <div class="row mb-4" style="margin:20px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ปีพ.ศ. : </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="text" class="form-control" id="e_year" name="e_year" maxlength="100"
                                disabled="">
                        </div>
                    </div>
                    <div class="row mb-4" style="margin:20px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เดือน : </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="text" class="form-control" id="e_month" name="e_month" maxlength="100"
                                disabled="">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เพิ่มรูปใบชำระเงิน :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <div class=" upload-content">
                                <div class="main-section">
                                    <div class="file-loading">
                                        <input id="file" type="file" name="file" multiple="" class="file"
                                            data-overwrite-initial="false" data-min-file-count="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="addPic">
                    <input type="hidden" name="e_pId" id="e_pId">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">บันทึก</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="modalDetailSlip" class="modal fade">
        <form class="modal-dialog modal-lg " method="post" id="submit" name="submit" action="./manage.php">
            <div class="modal-content" id="contentModal">

            </div>
        </form>
    </div>
</div>
<!-- End Modal -->
<script>
$(document).ready(function() {
    console.log("ready!");
    $('[data-toggle="tooltip"]').tooltip();
});
$(".addPay").click(function() {
    var pId = $(this).attr('paymentID');
    var year = $(this).attr('year');
    var month = $(this).attr('month');
    //alert(month);

    $('#e_pId').val(pId);
    $('#e_year').val(year);
    $('#e_month').val(month);
    $("#modalAddPayment").modal();
});
$(".editPay").click(function() {
    var pId = $(this).attr('paymentID');
    var year = $(this).attr('year');
    var month = $(this).attr('month');
    //alert(month);

    $('#e_pId').val(pId);
    $('#e_year').val(year);
    $('#e_month').val(month);
    $("#modalEditPayment").modal();
});

function detailSlip(id, month, year) {
    //alert(id + " " + month + " " + year);
    $.ajax({
        type: "POST",

        data: {
            action: "detailslip",
            pId: id,
            monthS: month,
            yearS: year
        },
        url: "../../views/paymentuser/manage.php",
        async: false,
        success: function(result) {
            $("#contentModal").empty();
            $("#contentModal").append(result);
            console.log(result);
            $("#modalDetailSlip").modal('show');

        }
    });

}
$(document).ready(function() {
    console.log("ready!");
    $("#addPayment").click(function() {
        $.ajax({
            type: "POST",

            data: {
                action: "checkPayment"
            },
            url: "./manage.php",
            async: false,

            success: function(result) {
                console.log(result);
                if (result.type == 0) {
                    swal({
                        title: "คุณไม่สามารถทำรายการได้",
                        text: "คุณไม่สามารถทำได้เนื่องคุณได้ทำไปแล้ว",
                        icon: "error",
                        confirmButtonClass: "btn-danger",
                        dangerMode: true,
                    })
                } else {
                    $("#inputwater").empty();
                    $("#inputwater").append(
                        "<input type=\"text\" class=\"form-control\" id=\"inputwater\" name=\"inputwater\" value=\"" +
                        result.WaterBil + "\" readonly >");
                    $("#inputelec").empty();
                    $("#inputelec").append(
                        "<input type=\"text\" class=\"form-control\" id=\"inputelec\" name=\"inputelec\" value=\"" +
                        result.ElectricityBill + "\" readonly >");
                    $("#inputcomf").empty();
                    $("#inputcomf").append(
                        "<input type=\"text\" class=\"form-control\" id=\"inputcomf2\" name=\"inputcomf\" value=\"" +
                        result.CommonFee + "\" readonly >");
                    $("#iddate").empty();
                    $("#iddate").append(
                        "<input type=\"hidden\" class=\"form-control\" id=\"hiddeniddate\" name=\"hiddeniddate\" value=\"" +
                        result.iddate + "\" readonly >");
                    $("#addPaymentModal").modal();
                }

            }
        });

    });


});
</script>