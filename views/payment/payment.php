<?php
session_start();
require_once('../../dbConnect.php');
if (!isset($_SESSION['DATAUSER'])) {
    header("location:../../index.php?msg=กระบวนการเข้าเว็บไซต์ไม่ถูกต้อง");
}
$DATAUSER = $_SESSION['DATAUSER'] ?? NULL;
$sqlInfoPayment = "SELECT `date`.`dateId`,`date`.`year`,`date`.`month` ,COUNT(*) as roomAll ,COUNT(*) -COUNT(`payment`.`timeSlip`) as roomNotpay,COUNT(`payment`.`timeSlip`)-COUNT(`payment`.`timeConfirm`) as roomCommit ,COUNT(`payment`.`timeConfirm`) as Confirm
FROM `payment` 
INNER JOIN `date` ON `date`.`dateId` = `payment`.`dateId`
GROUP BY  `date`.`year`,`date`.`month`
ORDER BY `date`.`year` DESC ,`date`.`month` DESC";
$INFOPAYMENT = selectData($sqlInfoPayment);
$numberNotCommit  = 0;
$numberWait = 0;
for ($i = 1; $i <= $INFOPAYMENT[0]['numrow']; $i++) {
    $numberNotCommit  += $INFOPAYMENT[$i]['roomNotpay'];
    $numberWait  += $INFOPAYMENT[$i]['roomCommit'];
}
$arrMonth = array("-", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
$sqlpayRoom = "SELECT `agreement`.`agreeId`,`room`.`rnumber`,`user`.`title`,`user`.`firstname`,
`user`.`lastname`,`room`.`rent`,`user`.`email`
FROM `user` INNER JOIN `agreement` ON `user`.`uid` = `agreement`.`uid` 
INNER JOIN `room` ON `room`.`rid` = `agreement`.`rid`
WHERE `user`.`isDelete`=0 AND `room`.`isDelete`= 0
ORDER BY `room`.`rnumber`";
$INFOPAYROOM = selectData($sqlpayRoom);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <?php require_once('../../views/layout/MainCSS.php');

    ?>
</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <?php require_once('../../views/layout/SidebarAdmin.php') ?>
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
                                            <span class="link-active " style="font-size: 15px; color:white;">การจัดการการชำระค่าเช่ารายเดือน</span>


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
                                            <div class="font-weight-bold  text-uppercase mb-1">ห้องที่ยังไม่ได้ชำระค่าเช่า</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $numberNotCommit ?> ห้อง</div>
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
                                            <div class="font-weight-bold  text-uppercase mb-1">ห้องที่รอยืนยัน</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $numberWait ?> ห้อง</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-vote-yea"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-12 mb-4">

                            <div class="card border-left-primary card-color-info shadow h-100 py-2" id="addPayment" style="cursor:pointer;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold  text-uppercase mb-1">เพิ่มการชำระ</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">+1 การชำระ</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="material-icons icon-big">add_circle</i>
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
                                <span class="link-active " style="font-size: 15px; color:white;">สัญญาการเช่าทั้งหมด</span>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row center">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr role="row" style="text-align:center;">
                                                        <th rowspan="1" colspan="1">ปีพ.ศ</th>
                                                        <th rowspan="1" colspan="1">เดือน</th>
                                                        <th rowspan="1" colspan="1">ห้องที่ต้องชำระ</th>
                                                        <th rowspan="1" colspan="1">ห้องที่ยังไม่ชำระ</th>
                                                        <th rowspan="1" colspan="1">ห้องที่รอยืนยัน</th>
                                                        <th rowspan="1" colspan="1">ห้องที่ชำระเสร็จสมบูรณ์</th>
                                                        <th rowspan="1" colspan="1">รายละเอียด</th>

                                                    </tr>
                                                </thead>

                                                <tbody style="text-align:center;">
                                                    <?php
                                                    for ($i = 1; $i <= $INFOPAYMENT[0]['numrow']; $i++) {
                                                        echo "<tr>
                                                        <td>{$INFOPAYMENT[$i]['year']}</td>
                                                        <td>{$arrMonth[$INFOPAYMENT[$i]['month']]}</td>
                                                        <td>{$INFOPAYMENT[$i]['roomAll']}</td>
                                                        <td>{$INFOPAYMENT[$i]['roomNotpay']}</td>
                                                        <td>{$INFOPAYMENT[$i]['roomCommit']}</td>
                                                        <td>{$INFOPAYMENT[$i]['Confirm']}</td>
                                                        <td style=\"text-align:center;\">
                                                            <a href=\"../../views/payment/detailPayment.php?dateID={$INFOPAYMENT[$i]['dateId']}\">
                                                                <button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"tooltip\" title='รายละเอียด' >
                                                                    <i class=\"fas fa-file-alt\"></i>
                                                                </button>
                                                            </a>
                                                        </td>

                                                    </tr>";
                                                    }
                                                    ?>



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
    <div class="modal fade" id="addPaymentModal" name="addPaymentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document" style="width: 50%">
            <div class="modal-content">
                <form method="post" id="addPayment" name="addPayment" action="manage.php">
                    <div class="Changeinfo">
                        <div class="modal-header header-modal" style="background-color: #3E49BB;">
                            <h4 class="modal-title" style="color: white">เพิ่มรายการค่าเช่า</h4>
                        </div>
                        <div class="modal-body" id="addModalBody">
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-xl-4 col-2 text-right textreq">
                                        <span>เดือน:</span>
                                    </div>
                                    <div class="col-xl-5 col-6 text-right">
                                        <input type="text" class="form-control" id="addmonth" name="admonth" value="<?php echo $arrMonth[(int) (date("m", time()))] ?>" readonly>
                                        <input type="hidden" class="form-control" id="addmonthID" name="addmonthID" value="<?php echo (int) (date("m", time())) ?>" readonly>

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xl-4 col-2 text-right textreq">
                                        <span>ปีพุทธศักราช:</span>
                                    </div>
                                    <div class="col-xl-5 col-6 text-right">
                                        <input type="text" class="form-control" id="addyear" name="addyear" value="<?= (int) (date("Y", time()) + 543) ?>" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xl-4 col-2 text-right textreq">
                                        <span>ค่าน้ำ(บาท/ยูนิต):</span>
                                    </div>
                                    <div class="col-xl-5 col-6 text-right" id="inputwater">
                                        <input type="text" class="form-control" id="inputwater" name="inputwater" value="" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xl-4 col-2 text-right textreq">
                                        <span>ค่าไฟ(บาท/ยูนิต):</span>
                                    </div>
                                    <div class="col-xl-5 col-6 text-right" id="inputelec">
                                        <input type="text" class="form-control" id="inputelec" name="inputelec" value="" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xl-4 col-2 text-right textreq">
                                        <span>ค่าส่วนกลางและอื่นๆ(บาท):</span>
                                    </div>
                                    <div class="col-xl-5 col-6 text-right" id="inputcomf">
                                        <input type="text" class="form-control" id="inputcomf2" name="inputcomf" value="" readonly>
                                    </div>
                                </div>
                                <div id="iddate">
                                    <input type="text" class="form-control" id="hiddeniddate" name="hiddeniddate" value="" readonly>
                                </div>
                                <input type="hidden" class="form-control" name="action" value="addpayment">
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr role="row">
                                                    <th rowspan="1" colspan="1">ห้อง</th>
                                                    <th rowspan="1" colspan="1">ผู้เช่า</th>
                                                    <th rowspan="1" colspan="1">ค่าเช่าห้อง</th>
                                                    <th rowspan="1" colspan="1">ยูนิตน้ำ(ยูนิต)</th>
                                                    <th rowspan="1" colspan="1">ยูนิตไฟฟ้าที่ใช้(ยูนิต)</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                for ($i = 1; $i <= $INFOPAYROOM[0]['numrow']; $i++) {
                                                    echo " <input type=\"hidden\" class=\"form-control\" id=\"rname_$i\" name=\"rname[]\" value=\"{$INFOPAYROOM[$i]['rnumber']}\" >";
                                                    echo " <input type=\"hidden\" class=\"form-control\" id=\"pid_$i\" name=\"aid[]\" value=\"{$INFOPAYROOM[$i]['agreeId']}\" >";
                                                    echo " <input type=\"hidden\" class=\"form-control\" id=\"email_$i\" name=\"email[]\" value=\"{$INFOPAYROOM[$i]['email']}\" >";
                                                    echo "<tr>
                                                        <td>{$INFOPAYROOM[$i]['rnumber']}</td>
                                                        <td>{$INFOPAYROOM[$i]['title']} {$INFOPAYROOM[$i]['firstname']} {$INFOPAYROOM[$i]['lastname']}</td>
                                                        <td>{$INFOPAYROOM[$i]['rent']}</td>
                                                        <input type=\"hidden\"   min=\"0\" class=\"form-control\" id=\"rent_$i\"  name=\"rent[]\" value=\"{$INFOPAYROOM[$i]['rent']}\" >
                                                        <td><input type=\"number\"   min=\"0\" class=\"form-control\" id=\"water_$i\"  name=\"water[]\" value=\"\" ></td>
                                                        <td><input type=\"number\"   min=\"0\" class=\"form-control\" id=\"eclec$i\"   name=\"eclec[]\" value=\"\" ></td>
                                                    </tr>";
                                                }
                                                ?>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submitpayment" id="submitpayment" value="insert" class="btn btn-success save">ยืนยัน</button>
                                <button type="button" class="btn btn-danger cancel" id="a_cancelInfo" data-dismiss="modal">ยกเลิก</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
<script>
    $(document).ready(function() {
        console.log("ready!");
        $('[data-toggle="tooltip"]').tooltip();
    });
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
                        $("#inputwater").append("<input type=\"text\" class=\"form-control\" id=\"inputwater\" name=\"inputwater\" value=\"" + result.WaterBil + "\" readonly >");
                        $("#inputelec").empty();
                        $("#inputelec").append("<input type=\"text\" class=\"form-control\" id=\"inputelec\" name=\"inputelec\" value=\"" + result.ElectricityBill + "\" readonly >");
                        $("#inputcomf").empty();
                        $("#inputcomf").append("<input type=\"text\" class=\"form-control\" id=\"inputcomf2\" name=\"inputcomf\" value=\"" + result.CommonFee + "\" readonly >");
                        $("#iddate").empty();
                        $("#iddate").append("<input type=\"hidden\" class=\"form-control\" id=\"hiddeniddate\" name=\"hiddeniddate\" value=\"" + result.iddate + "\" readonly >");
                        $("#addPaymentModal").modal();
                    }

                }
            });

        });


    });
</script>