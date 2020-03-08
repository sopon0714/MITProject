<?php
session_start();
$DATAUSER = $_SESSION['DATAUSER'] ?? NULL;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <?php require_once('../../views/layout/MainCSS.php');
    include("../../dbConnect.php");
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
                                <div class="card-header card-bg" style="background-color: white">
                                    <div class="row">
                                        <div class="col-12">

                                            <span class="link-active font-weight-bold" style="color:#006664;">การจัดการการชำระค่าเช่ารายเดือน</span>

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
                                            <div class="font-weight-bold  text-uppercase mb-1">จำนวนห้องที่ยังไม่ได้ชำระค่าเช่า(เดือนล่าสุด)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">5 ห้อง</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="material-icons icon-big">home</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-12 mb-4">
                            <a href="../../views/payment/addPayment.php">
                                <div class="card border-left-primary card-color-add shadow h-100 py-2" id="addPayment" style="cursor:pointer;">
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
                            </a>
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
                            <div class="card-header card-bg font-weight-bold" style="color:#006664;background-color: white;">
                                สัญญาการเช่าทั้งหมด

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
                                                        <th rowspan="1" colspan="1">ปี</th>
                                                        <th rowspan="1" colspan="1">เดือน</th>
                                                        <th rowspan="1" colspan="1">ห้องที่ต้องชำระ(ห้อง)</th>
                                                        <th rowspan="1" colspan="1">ห้องที่ชำระแล้ว(ห้อง)</th>
                                                        <th rowspan="1" colspan="1">รายละเอียด</th>

                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th rowspan="1" colspan="1">ปี</th>
                                                        <th rowspan="1" colspan="1">เดือน</th>
                                                        <th rowspan="1" colspan="1">ห้องที่ต้องชำระ(ห้อง)</th>
                                                        <th rowspan="1" colspan="1">ห้องที่ชำระแล้ว(ห้อง)</th>
                                                        <th rowspan="1" colspan="1">รายละเอียด</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>

                                                    <tr>
                                                        <td>2563</td>
                                                        <td>1</td>
                                                        <td>2</td>
                                                        <td>3</td>
                                                        <td style="text-align:center;">
                                                            <a href="../../views/payment/detailPayment.php">
                                                                <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title='รายละเอียด' onclick="detailPayment()">
                                                                    <i class="fas fa-file-alt"></i>
                                                                </button>
                                                            </a>

                                                        </td>

                                                    </tr>

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

    function detailAgreement() {
        $("#modalDetailAgreement").modal('show');
    }

    function EditAgreement() {
        $("#modalEdit").modal('show');
    }
</script>