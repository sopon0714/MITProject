<?php
session_start();
include("../../dbConnect.php");
if (!isset($_SESSION['DATAUSER']) || !isset($_GET['dateID'])) {
    header("location:../../index.php?msg=กระบวนการเข้าเว็บไซต์ไม่ถูกต้อง");
}
$DATAUSER = $_SESSION['DATAUSER'] ?? NULL;
$dateID = $_GET['dateID'];
$sqlDate = "SELECT * FROM `date` WHERE dateId= $dateID";
$sqlDetail = "SELECT `payment`.`pId`,`room`.`rnumber`,`payment`.`waterb`*`payment`.`waterUnit` as costWater,
`payment`.`elecb`*`payment`.`elecUnit` as costElect,`payment`.`commonf`,`payment`.`paymentAll`,`payment`.`status`
FROM `payment` 
INNER JOIN `date` ON `date`.`dateId` = `payment`.`dateId`
INNER JOIN `agreement` ON `agreement`.`agreeId` = `payment`.`agreeId`
INNER JOIN `room` ON `room`.`rid` = `agreement`.`rid`
WHERE `date`.`dateId`= $dateID";
$sqlInfoPayment = "SELECT `date`.`dateId`,`date`.`year`,`date`.`month` ,COUNT(*) as roomAll ,COUNT(*) -COUNT(`payment`.`timeSlip`) as roomNotpay,COUNT(`payment`.`timeSlip`)-COUNT(`payment`.`timeConfirm`) as roomCommit ,COUNT(`payment`.`timeConfirm`) as Confirm
FROM `payment` 
INNER JOIN `date` ON `date`.`dateId` = `payment`.`dateId`
WHERE `date`.`dateId`=$dateID
GROUP BY  `date`.`year`,`date`.`month`
ORDER BY `date`.`year` DESC ,`date`.`month` DESC";
$INFOPAYMENT = selectDataOne($sqlInfoPayment);
$DATAINFO = selectDataOne($sqlDate);
$DATADETAIL = selectData($sqlDetail);
$arrMonth = array("-", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
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
                                            <span class="link-active " style="font-size: 15px; color:white;">การจัดการการชำระค่าเช่ารายเดือน</span>
                                            <span style="float:right;">
                                                <a href="./payment.php">
                                                    <button type="button" id="btn_info" class="btn btn-warning btn-sm tt">
                                                        ย้อนกลับ
                                                    </button>
                                                </a>
                                            </span>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $INFOPAYMENT['roomNotpay'] ?> ห้อง</div>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $INFOPAYMENT['roomCommit'] ?> ห้อง</div>
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
                                <span class="link-active " style="font-size: 15px; color:white;">รายละเอียดการชำระค่าเช่ารายเดือน</span>
                            </div>
                        </div>



                        <div class="row mb-2" style="margin:20px;">
                            <div class="col-xl-5  text-left" style="font-size:130%">
                                <span>ข้อมูลของเดือน <?= $arrMonth[$DATAINFO['month']] ?> ปีพุทธศักราช <?= $DATAINFO['year'] ?> </span>
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
                                                        <th rowspan="1" colspan="1">ห้อง</th>
                                                        <th rowspan="1" colspan="1">ค่าน้ำ</th>
                                                        <th rowspan="1" colspan="1">ค่าไฟ</th>
                                                        <th rowspan="1" colspan="1">ค่าเช่าห้อง+ค่าอื่นๆ</th>
                                                        <th rowspan="1" colspan="1">ยอดที่ต้องชำระ</th>
                                                        <th rowspan="1" colspan="1">สถานะ</th>
                                                        <th rowspan="1" colspan="1">รายละเอียด</th>


                                                    </tr>
                                                </thead>
                                                <tbody style="text-align:center;">
                                                    <?php
                                                    for ($i = 1; $i <= $DATADETAIL[0]['numrow']; $i++) {
                                                        echo "<tr>
                                                        <td>{$DATADETAIL[$i]['rnumber']}</td>
                                                        <td>{$DATADETAIL[$i]['costWater']}</td>
                                                        <td>{$DATADETAIL[$i]['costElect']}</td>
                                                        <td>{$DATADETAIL[$i]['commonf']}</td>
                                                        <td>{$DATADETAIL[$i]['paymentAll']}</td>
                                                        <td>{$DATADETAIL[$i]['status']}</td>
                                                        <td style=\"text-align:center;\">";
                                                        if ($DATADETAIL[$i]['status'] != 'ยังไม่ได้จ่าย') {
                                                            echo "<button type=\"button\" class=\"btn btn-info btn-sm tt\" title='รายละเอียด' onclick=\"detailSlip({$DATADETAIL[$i]['pId']},'{$arrMonth[$DATAINFO['month']]}','{$DATAINFO['year']}')\">
                                                                <i class=\"fas fa-file-alt\"></i>
                                                            </button>";
                                                        } else {
                                                            echo "-";
                                                        }

                                                        echo "</td>

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
<!-- รายละเอียดสัญญา -->
<div id="modalDetailSlip" class="modal fade">
    <form class="modal-dialog modal-lg " method="post" id="submit" name="submit" action="./manage.php">
        <div class="modal-content" id="contentModal">
            <div class="modal-header" style="background-color:#00ace6">
                <h4 class="modal-title" style="color:white">รายละเอียดการชำระค่าเช่า</h4>
            </div>
            <div class="modal-body" id="addModalBody" style="font-size:25px">

                <div class="row mb-3">
                    <div class="col-xl-4 col-2 text-right ">
                        <span>ห้อง:</span>
                    </div>
                    <div class="col-xl-6 col-6 ">
                        <span>101</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-4 col-2 text-right ">
                        <span>เดือนที่ชำระ:</span>
                    </div>
                    <div class="col-xl-6 col-6 ">
                        <span>ปี 2563 เดือนที่ 1</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-4 col-2 text-right ">
                        <span>ค่าน้ำ:</span>
                    </div>
                    <div class="col-xl-6 col-6 ">
                        <span>2 (บาท) x 25 (ยูนิต) = 50 บาท</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-4 col-2 text-right ">
                        <span>ค่าไฟ:</span>
                    </div>
                    <div class="col-xl-6 col-6 ">
                        <span>7 (บาท) x100 (ยูนิต) = 700 บาท</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-4 col-2 text-right ">
                        <span>ค่าห้องและค่าอื่นๆ:</span>
                    </div>
                    <div class="col-xl-6 col-6 ">
                        <span>4000 บาท</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-4 col-2 text-right ">
                        <span>ยอดที่ต้องชำระ:</span>
                    </div>
                    <div class="col-xl-6 col-6 ">
                        <span>4700 บาท</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-4 col-2 text-right ">
                        <span>วันเวลาที่ส่งสลิป:</span>
                    </div>
                    <div class="col-xl-6 col-6 ">
                        <span>15:00:00 11/2/2563</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-4 col-2 text-right ">
                        <span>วันเวลาที่ยันยืน:</span>
                    </div>
                    <div class="col-xl-6 col-6 ">
                        <span>15:00:00 11/2/2563</span>
                    </div>
                </div>


                <div class="row mb-4">

                    <div ALIGN="center">
                        <img src="../../img/slip.jpg" style="width:50%">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">บันทึก</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </form>
</div>
<!-- End Modal -->
<script>
    $(document).ready(function() {

        $('.tt').tooltip({
            trigger: "hover"
        });

        $('[data-toggle="tooltip"]').tooltip();
        $("#addAgreement").click(function() {
            $("#modalAddAgreement").modal();
        });
    });

    function detailSlip(id, month, year) {
        $.ajax({
            type: "POST",

            data: {
                action: "detailslip",
                pId: id,
                monthS: month,
                yearS: year
            },
            url: "../../views/payment/manage.php",
            async: false,
            success: function(result) {
                $("#contentModal").empty();
                $("#contentModal").append(result);
                console.log(result);
                $("#modalDetailSlip").modal('show');

            }
        });

    }
</script>