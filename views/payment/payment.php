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
                            <div class="card border-left-primary card-color-add shadow h-100 py-2" id="addAgreement" style="cursor:pointer;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold  text-uppercase mb-1">เพิ่มการชำระ
                                            </div>
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
                                        <div class="col-sm-11">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr role="row">
                                                        <th rowspan="1" colspan="1">ปีพ.ศ</th>
                                                        <th rowspan="1" colspan="1">เดือน</th>
                                                        <th rowspan="1" colspan="1">ห้องที่ต้องชำระ</th>
                                                        <th rowspan="1" colspan="1">ห้องที่ยังไม่ชำระ</th>
                                                        <th rowspan="1" colspan="1">ห้องที่รอยืนยัน</th>
                                                        <th rowspan="1" colspan="1">ห้องที่ชำระเสร็จสมบูรณ์</th>
                                                        <th rowspan="1" colspan="1">รายละเอียด</th>

                                                    </tr>
                                                </thead>

                                                <tbody>
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



</div>
<!-- End Modal -->
<script>
    $(document).ready(function() {
        console.log("ready!");
        $('[data-toggle="tooltip"]').tooltip();
    });
    $(document).ready(function() {
        console.log("ready!");
        $("#addAgreement").click(function() {
            $("#modalAddAgreement").modal();
        });
    });
</script>