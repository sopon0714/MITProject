<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <?php require_once('../../views/layout/MainCSS.php');
    include("../../dbConnect.php");

    $sql_TableAgreement = "SELECT * FROM `user` INNER JOIN agreement ON agreement.uid = user.uid
        INNER JOIN room ON room.rid = agreement.rid";
    $sql_NumAgreement = "SELECT COUNT(agreement.agreeId) AS numAgreement FROM agreement 
    INNER JOIN user ON user.uid = agreement.uid WHERE user.isDelete=0";

    $TableAgreement = selectData($sql_TableAgreement);
    $NumAgreement = selectData($sql_NumAgreement);
    //echo ($TableAgreement[2]['firstname']);
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
                                <div class="card-header card-bg  header-text-color">
                                    รายละเอียดสัญญา
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
                                            <div class="font-weight-bold  text-uppercase mb-1">จำนวนสัญญา </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $NumAgreement[1]['numAgreement'] ?> ห้อง</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="material-icons icon-big">home</i>
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
                                            <div class="font-weight-bold  text-uppercase mb-1">เพิ่มสัญญาการเช่า
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">+1 สัญญา</div>
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
                        <div class="card-header card-header-table py-3">
                            <h6 class="m-0 font-weight-bold header-text-color">สัญญาการเช่าทั้งหมด</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row center">
                                        <div class="col-sm-11">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr role="row">
                                                        <th rowspan="1" colspan="1">หมายเลขห้อง</th>
                                                        <th rowspan="1" colspan="1">ชื่อผู้เช่า</th>
                                                        <th rowspan="1" colspan="1">วันที่เริ่มสัญญา</th>
                                                        <th rowspan="1" colspan="1">วันที่สิ้นสุดสัญญา</th>
                                                        <th rowspan="1" colspan="1">รายละเอียด</th>
                                                        <th rowspan="1" colspan="1">จัดการ</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th rowspan="1" colspan="1">หมายเลขห้อง</th>
                                                        <th rowspan="1" colspan="1">ชื่อผู้เช่า</th>
                                                        <th rowspan="1" colspan="1">วันที่เริ่มสัญญา</th>
                                                        <th rowspan="1" colspan="1">วันที่สิ้นสุดสัญญา</th>
                                                        <th rowspan="1" colspan="1">รายละเอียด</th>
                                                        <th rowspan="1" colspan="1">จัดการ</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php for ($i = 0; $i < $TableAgreement[0]['numrow']; $i++) { ?>
                                                        <tr role="row" class="odd">
                                                            <td class="sorting_1"><?php echo $TableAgreement[$i + 1]['rnumber'] ?></td>
                                                            <td><?php echo $TableAgreement[$i + 1]['title'] ?> <?php echo $TableAgreement[$i + 1]['firstname'] ?> <?php echo $TableAgreement[$i + 1]['lastname'] ?></td>
                                                            <td><?php echo $TableAgreement[$i + 1]['startDate'] ?></td>
                                                            <td><?php echo $TableAgreement[$i + 1]['endDate'] ?></td>
                                                            <td style="text-align:center;">
                                                                <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title="" data-original-title="รายละเอียดสัญญา" style="width:15px;height:20px" onclick="detailAgreement()"><i class="fas fa-file-alt"></i></button>
                                                            </td>
                                                            <td style="text-align:center;">
                                                                <button type="button" class="btn btn-warning  btn-sm" data-toggle="tooltip" title="แก้ไขข้อมูล" style="width:15px;height:20px"><i class="fas fa-edit" onclick="EditAgreement(<?php $i ?>)"></i></button>
                                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" data-original-title="ลบสัญญา" style="width:15px;height:20px"><i class="far fa-trash-alt" onclick="delfunction('ห้อง511','555')"></i></button>
                                                            </td>
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
    <!-- เพิ่มสัญญาเช่า -->
    <div id="modalAddAgreement" class="modal fade">
        <form class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#3E49BB">
                    <h4 class="modal-title" style="color:white">เพิ่มสัญญาการเช่า</h4>
                </div>
                <div class="modal-body" id="addModalBody">
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เลขห้อง :</span>
                        </div>
                        <div class="col-lg-auto col-md-9 col-sm-6 col-xs-6">
                            <select class="custom-select  mb-3" id="course_e" name="course_e">
                                <option>ห้อง 511</option>
                                <option>ห้อง 512</option>
                                <option>ห้อง 513</option>
                                <option>ห้อง 514</option>
                            </select> </div>
                    </div>
                    <div class="row mb-4" style="margin:10px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>วันที่เข้า : </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="date" class="form-control" id="date" value="2020-03-07" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4" style="margin:10px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>วันที่ออก : </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="date" class="form-control" id="date" value="2020-03-07" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>คำนำหน้า :</span>
                        </div>
                        <div class="col-lg-auto col-md-9 col-sm-6 col-xs-6">
                            <select class="custom-select  mb-3" id="course_e" name="course_e">
                                <option>นาย</option>
                                <option>นาง</option>
                                <option>นางสาว</option>
                            </select> </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ชื่อผู้เข้าพักอาศัย :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="username" value="" placeholder="กรุณากรอกชื่อ" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>นามสกุล:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="username" value="" placeholder="กรุณากรอกนามสกุล" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>รหัสประจำตัวประชาชน:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="mail" value="" placeholder="กรุณากรอกเบอร์โทร">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เบอร์โทรติดต่อ:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="mail" value="" placeholder="กรุณากรอกเบอร์โทร">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>อีเมล์ :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="mail" value="" placeholder="กรุณากรอกอีเมล์">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">บันทึก</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- แก้ไขสัญญาเช่า -->
    <div id="modalEdit" class="modal fade">
        <form class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#3E49BB">
                    <h4 class="modal-title" style="color:white">แก้ไขสัญญาสัญญาการเช่า</h4>
                </div>
                <div class="modal-body" id="addModalBody">
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เลขห้อง :</span>
                        </div>
                        <div class="col-lg-auto col-md-9 col-sm-6 col-xs-6">
                            <select class="custom-select  mb-3" id="course_e" name="course_e">
                                <option value="" selected="">ห้อง 514</option>
                                <option>ห้อง 512</option>
                                <option>ห้อง 513</option>
                                <option>ห้อง 514</option>
                            </select> </div>
                    </div>
                    <div class="row mb-4" style="margin:10px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>วันที่เข้า: </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="date" class="form-control" id="date" value="2020-03-07" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4" style="margin:10px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>วันที่ออก: </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="date" class="form-control" id="date" value="2020-03-07" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>คำนำหน้า :</span>
                        </div>
                        <div class="col-lg-auto col-md-9 col-sm-6 col-xs-6">
                            <select class="custom-select  mb-3" id="course_e" name="course_e">
                                <option>นาย</option>
                                <option>นาง</option>
                                <option>นางสาว</option>
                            </select> </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ชื่อผู้เข้าพักอาศัย :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="username" value="ภาณุภัสส์" placeholder="กรุณากรอกชื่อ" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>นามสกุล:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="username" value="ธนัชญ์สุธาโชติ" placeholder="กรุณากรอกนามสกุล" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>รหัสประจำตัวประชาชน:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="mail" value="1100801270623" placeholder="กรุณากรอกเบอร์โทร">
                        </div>

                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เบอร์โทรติดต่อ:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="mail" value="0894118587" placeholder="กรุณากรอกเบอร์โทร">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>อีเมล์ :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="mail" value="ingcho007@gmail.com" placeholder="กรุณากรอกอีเมล์">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">บันทึก</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- รายละเอียดสัญญา -->
    <div id="modalDetailAgreement" class="modal fade">
        <form class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#3E49BB">
                    <h4 class="modal-title" style="color:white">รายละเอียดสัญญาการเช่า</h4>
                </div>
                <div class="modal-body" id="addModalBody">
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เลขห้อง :</span>
                        </div>
                        <div class="col-lg-auto col-md-9 col-sm-6 col-xs-6">
                            <select class="custom-select  mb-3" id="course_e" name="course_e">
                                <option>ห้อง 511</option>
                                <option>ห้อง 512</option>
                                <option>ห้อง 513</option>
                                <option>ห้อง 514</option>
                            </select> </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ชื่อผู้เข้าพักอาศัย :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="username" value="" placeholder="กรุณากรอกชื่อ" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>นามสกุล:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="username" value="" placeholder="กรุณากรอกนามสกุล" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ระยะสัญญา :</span>
                        </div>
                        <div class="col-lg-auto col-md-9 col-sm-6 col-xs-6">
                            <select class="custom-select  mb-3" id="course_e" name="course_e">
                                <option>1 ปี</option>
                                <option>2 ปี</option>
                            </select> </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เบอร์โทรติดต่อ:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="mail" value="" placeholder="กรุณากรอกเบอร์โทร">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>อีเมล์ :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="mail" value="" placeholder="กรุณากรอกอีเมล์">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">บันทึก</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
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