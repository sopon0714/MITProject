<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <?php require_once('../../views/layout/MainCSS.php') ?>
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
                                            <div class="font-weight-bold  text-uppercase mb-1">จำนวนห้อง</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">4 ห้อง</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="material-icons icon-big">home</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-12 mb-4">
                            <a href='addroom.php' style="text-decoration: none">
                                <div class="card border-left-primary card-color-add shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="font-weight-bold  text-uppercase mb-1">จำนวนห้องที่ว่าง
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">20/100</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="material-icons icon-big">home</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
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
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">514</td>
                                                        <td>นาย ภาณุภัสส์ ธนัชญ์สุธาโชติ</td>
                                                        <td>01/01/2563</td>
                                                        <td>01/01/2565</td>
                                                        <td style="text-align:center;">
                                                            <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title="" data-original-title="รายละเอียดสัญญา" style="width:15px;height:20px" onclick="detailAgreement()"><i class="fas fa-file-alt"></i></button>
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <button type="button" class="btn btn-warning  btn-sm" data-toggle="tooltip" title="แก้ไขข้อมูล" style="width:15px;height:20px"><i class="fas fa-edit" onclick="EditAgreement()"></i></button>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" data-original-title="ลบสัญญา" style="width:15px;height:20px"><i class="far fa-trash-alt"></i></button>
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
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ระยะสัญญา :</span>
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
    <div id="modalEditAgreement" class="modal fade">
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
    <div id="modalDetailAgreement" class="modal fade">
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
        $("#modalEditAgreement").modal('show');
    }
</script>