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

                        <div class="row mb-2" style="margin:20px;">
                            <div class="col-xl-5  text-left" style="font-size:130%">
                                <span>ข้อมูลของปี 2563 เดือนที่ 1</span>
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
                                                        <th rowspan="1" colspan="1">ห้อง</th>
                                                        <th rowspan="1" colspan="1">ยอดที่ต้องชำระ</th>
                                                        <th rowspan="1" colspan="1">สถานะ</th>
                                                        <th rowspan="1" colspan="1">รายละเอียด</th>


                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th rowspan="1" colspan="1">ห้อง</th>
                                                        <th rowspan="1" colspan="1">ยอดที่ต้องชำระ</th>
                                                        <th rowspan="1" colspan="1">สถานะ</th>
                                                        <th rowspan="1" colspan="1">รายละเอียด</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>

                                                    <tr>
                                                        <td>101</td>
                                                        <td>3500</td>
                                                        <td>จ่ายแล้ว</td>
                                                        <td style="text-align:center;">
                                                            <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title='รายละเอียด' onclick="detailSlip()">
                                                                <i class="fas fa-file-alt"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>102</td>
                                                        <td>3500</td>
                                                        <td>จ่ายแล้ว</td>
                                                        <td style="text-align:center;">
                                                            <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title='รายละเอียด' onclick="detailSlip()">
                                                                <i class="fas fa-file-alt"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>103</td>
                                                        <td>3500</td>
                                                        <td>จ่ายแล้ว</td>
                                                        <td style="text-align:center;">
                                                            <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title='รายละเอียด' onclick="detailSlip()">
                                                                <i class="fas fa-file-alt"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>104</td>
                                                        <td>3500</td>
                                                        <td>ยังไม่จ่าย</td>
                                                        <td style="text-align:center;">
                                                            <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title='รายละเอียด' onclick="detailSlip()">
                                                                <i class="fas fa-file-alt"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>105</td>
                                                        <td>3500</td>
                                                        <td>ยังไม่จ่าย</td>
                                                        <td style="text-align:center;">
                                                            <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title='รายละเอียด' onclick="detailSlip()">
                                                                <i class="fas fa-file-alt"></i>
                                                            </button>
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
<!-- รายละเอียดสัญญา -->
<div id="modalDetailSlip" class="modal fade">
    <form class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00ace6">

                <h4 class="modal-title" style="color:white">รายละเอียดสัญญาการเช่า</h4>
            </div>
            <div class="modal-body" id="addModalBody">
                <div class="row mb-4">
                    <div class="col-xl-12 col-12 " style="font-size:25px">
                        <span>ห้อง : 101 ปี 2563 เดือนที่ 1</span>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-xl-12 col-12 " style="font-size:25px">
                        <span>หลักฐานการโอน เวลา 22:59:00 น. วันที่ 07-03-63</span>
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
        console.log("ready!");
        $('[data-toggle="tooltip"]').tooltip();
    });
    $(document).ready(function() {
        console.log("ready!");
        $("#addAgreement").click(function() {
            $("#modalAddAgreement").modal();
        });
    });

    function detailSlip() {
        $("#modalDetailSlip").modal('show');
    }
</script>