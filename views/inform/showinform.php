<?php
session_start();
if (!isset($_SESSION['DATAUSER'])) {
    header("location:../../index.php?msg=กระบวนการเข้าเว็บไซต์ไม่ถูกต้อง");
}
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
                                <div class="card-header card-bg" style="background-color: #bf4040"">
                                    <div class=" row">
                                    <div class="col-12">
                                        <span class="link-active " style="font-size: 15px; color:white;">แสดงคำร้อง</span>

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
                                        <div class="font-weight-bold  text-uppercase mb-1">คำร้องทั้งหมด</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">2 คำร้อง</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="material-icons icon-big">home</i>
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
                                            การค้นหาขั้นสูง  แสดงคำร้องทั้งหมด
                                        </div> -->
                    </div>
                </div>
                <!-- ######################## end filter ######################## -->
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card">
                        <div class="card-header card-bg " style="background-color: #bf4040">
                            <span class="link-active " style="font-size: 15px; color:white;">แสดงคำร้องทั้งหมด</span>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row center">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr role="row">
                                                    <th rowspan="1" colspan="1">เวลา</th>
                                                    <th rowspan="1" colspan="1">วันที่</th>
                                                    <th rowspan="1" colspan="1">หมายเลขห้อง</th>
                                                    <th rowspan="1" colspan="1">ปัญหา</th>
                                                    <th rowspan="1" colspan="1">จัดการ</th>

                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">เวลา</th>
                                                    <th rowspan="1" colspan="1">วันที่</th>
                                                    <th rowspan="1" colspan="1">หมายเลขห้อง</th>
                                                    <th rowspan="1" colspan="1">ปัญหา</th>
                                                    <th rowspan="1" colspan="1">จัดการ</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>

                                                <tr>
                                                    <td>15.33</td>
                                                    <td>8/3/2563</td>
                                                    <td>101</td>
                                                    <td style="text-align:center;">
                                                        <a href="../../views/payment/detailPayment.php">
                                                            <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title='รายละเอียด' onclick="detailPayment()">
                                                                <i class="fas fa-file-alt"></i>
                                                            </button>
                                                        </a>

                                                    </td>
                                                    <td style="text-align:center;">
                                                        <button type="button" onclick="delfunction('ห้อง','001A')" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" data-original-title="ลบรายการ"><i class="far fa-trash-alt"></i></button>
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