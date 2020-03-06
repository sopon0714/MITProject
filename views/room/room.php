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
                                    รายซื่อห้อง
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
                                            <div class="font-weight-bold  text-uppercase mb-1">จำนวนห้องทั้งหมด</div>
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

                            <div class="card border-left-primary card-color-info shadow h-100 py-2" style="cursor:pointer;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold  text-uppercase mb-1">จำนวนห้องที่ว่าง
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">1 ห้อง</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="material-icons icon-big">home</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- end card -->
                        <div class="col-xl-3 col-12 mb-4">
                            <div class="card border-left-primary card-color-add shadow h-100 py-2" style="cursor:pointer;" id="addRoom">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold  text-uppercase mb-1">เพิ่มห้อง
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">+1 ห้อง</div>
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
                            <div id="accordion">
                                <div class="card ">
                                    <!-- <div class="card-header header-background-color-filter" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style=" color:white;">
											การค้นหาขั้นสูง
										</div> -->

                                    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row mb-4">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                        <span>หมายเลขห้อง :</span>
                                                    </div>
                                                    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                        <input type="text" class="form-control" id="username__r" name="username__r" placeholder="กรุณากรอกเลขห้อง">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                        <span>ชื่อห้อง/span>
                                                    </div>
                                                    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                        <input type="text" class="form-control" id="username__n_r" name="username__n_r" placeholder="กรุณากรอกชื่อห้อง">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                        <span>ชื่อย่อห้อง :</span>
                                                    </div>
                                                    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                        <input type="text" class="form-control" id="username__n_r" name="username__n_r" placeholder="กรุณากรอกชื่อย่อ">
                                                    </div>
                                                </div>
                                                <div class="row mb-4 mt-4">
                                                    <div class="col-xl-3 col-12 text-right">
                                                        <span>สถานะห้อง :</span>
                                                    </div>
                                                    <div class="col-xl-9 col-12">
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" class="form-check-input" id="status1" name="status">
                                                            <label class="form-check-label" for="materialInline1">พร้อมใช้งาน</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" class="form-check-input" id="status2" name="status">
                                                            <label class="form-check-label" for="materialInline2">ไม่พร้อมใช้งาน</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4 mt-4">
                                                    <div class="col-xl-3 col-12 text-right">
                                                        <span>สถานะล็อคห้อง :</span>
                                                    </div>
                                                    <div class="col-xl-9 col-12">
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" class="form-check-input" id="status3" name="status2">
                                                            <label class="form-check-label" for="materialInline1">ล็อค</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" class="form-check-input" id="status4" name="status2">
                                                            <label class="form-check-label" for="materialInline2">ไม่ล็อค</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-info"><i class="fa fa-search"></i> ค้นหา</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ######################## end filter ######################## -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header card-header-table py-3">
                            <h6 class="m-0 font-weight-bold header-text-color">รายซื่อห้องในระบบ</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row center">
                                        <div class="col-sm-11">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr role="row">
                                                        <th rowspan="1" colspan="1">สถานะห้อง</th>
                                                        <th rowspan="1" colspan="1">หมายเลขห้อง</th>
                                                        <th rowspan="1" colspan="1">ค่าเช่าห้อง</th>
                                                        <th rowspan="1" colspan="1">ชื่อผู้เช่า</th>
                                                        <th rowspan="1" colspan="1">รายละเอียด</th>
                                                        <th rowspan="1" colspan="1">จัดการ</th>

                                                    </tr>
                                                </thead>
                                                <!-- <tfoot>
														<tr>
															<th rowspan="1" colspan="1">สถานะห้อง</th>
															<th rowspan="1" colspan="1">หมายเลขห้อง</th>
															<th rowspan="1" colspan="1">ค่าเช่าห้อง</th>
															<th rowspan="1" colspan="1">ค่าไฟ</th>
															<th rowspan="1" colspan="1">ค่านํ้า</th>
															<th rowspan="1" colspan="1">จัดการ</th>
														</tr> -->
                                                </tfoot>
                                                <tbody>
                                                    <tr role="row" class="odd">
                                                        <td style="text-align:center;">
                                                            <a class="btn btn-success btn-square btn-sm active" data-toggle="tooltip" title="" data-original-title="พร้อมใช้งาน" style="width:15px;height:20px">R</a>
                                                        </td>
                                                        <td class="sorting_1">001A</td>
                                                        <td>4900</td>
                                                        <td>นายซี ทรีวัน</td>
                                                        <td>ทีวี ตู้เย็น
                                                            <!-- <a href="inforoom.php"><button type="button" id="btn_info" class="btn btn-success btn-sm" data-toggle="tooltip" title="" data-original-title="ข้อมูลห้อง" style="width:15px;height:20px"><i class="fas fa-info"></i></button></a>
																<button type="button" onclick="picture()" class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="กดเพื่อดูรูป" style="width:15px;height:20px"><i class="fas fa-photo-video"></i></button>
																<a href="Usage_history.php?page=Usage_1"><button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" title="" data-original-title="ประวัติ" style="width:15px;height:20px"><i class="fas fa-file-alt"></i></button></a> -->
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <button type="button" class="btn btn-warning  btn-sm" data-toggle="tooltip" title="" style="width:15px;height:20px" data-original-title="แก้ไขข้อมูล"><i class="fas fa-edit" onclick="EditRoom()"></i></button>
                                                            <button type="button" onclick="delfunction('ห้อง','001A')" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" data-original-title="ลบห้อง" style="width:15px;height:20px"><i class="far fa-trash-alt"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr role="row" class="odd">
                                                        <td style="text-align:center;">
                                                            <a class="btn btn-success btn-square btn-sm active" data-toggle="tooltip" title="" data-original-title="พร้อมใช้งาน" style="width:15px;height:20px">R</a>
                                                        </td>
                                                        <td class="sorting_1">002A</td>
                                                        <td>4900</td>
                                                        <td>นายบี ทูวัน</td>
                                                        <td>ทีวี ตู้เย็น
                                                            <!-- <a href="inforoom.php"><button type="button" id="btn_info" class="btn btn-success btn-sm" data-toggle="tooltip" title="" data-original-title="ข้อมูลห้อง" style="width:15px;height:20px"><i class="fas fa-info"></i></button></a>
																<button type="button" onclick="picture()" class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="กดเพื่อดูรูป" style="width:15px;height:20px"><i class="fas fa-photo-video"></i></button>
																<a href="Usage_history.php?page=Usage_1"><button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" title="" data-original-title="ประวัติ" style="width:15px;height:20px"><i class="fas fa-file-alt"></i></button></a> -->
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <button type="button" class="btn btn-warning  btn-sm" data-toggle="tooltip" title="" style="width:15px;height:20px" data-original-title="แก้ไขข้อมูล"><i class="fas fa-edit" onclick="EditRoom()"></i></button>
                                                            <button type="button" onclick="delfunction('ห้อง','002A')" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" data-original-title="ลบห้อง" style="width:15px;height:20px"><i class="far fa-trash-alt"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr role="row" class="odd">
                                                        <td style="text-align:center;">
                                                            <a class="btn btn-success btn-square btn-sm active" data-toggle="tooltip" title="" data-original-title="พร้อมใช้งาน" style="width:15px;height:20px">R</a>
                                                        </td>
                                                        <td class="sorting_1">201B</td>
                                                        <td>5200</td>
                                                        <td>นายเอ วัน</td>
                                                        <td> ทีวี ตู้เย็น
                                                            <!-- <a href="inforoom.php"><button type="button" id="btn_info" class="btn btn-success btn-sm" data-toggle="tooltip" title="" data-original-title="ข้อมูลห้อง" style="width:15px;height:20px"><i class="fas fa-info"></i></button></a>
																<button type="button" onclick="picture()" class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="กดเพื่อดูรูป" style="width:15px;height:20px"><i class="fas fa-photo-video"></i></button>
																<a href="Usage_history.php?page=Usage_1"><button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" title="" data-original-title="ประวัติ" style="width:15px;height:20px"><i class="fas fa-file-alt"></i></button></a> -->
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <button type="button" class="btn btn-warning  btn-sm" data-toggle="tooltip" title="" style="width:15px;height:20px" data-original-title="แก้ไขข้อมูล"><i class="fas fa-edit" onclick="EditRoom()"></i></button>
                                                            <button type="button" onclick="delfunction('ห้อง','201B')" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" data-original-title="ลบห้อง" style="width:15px;height:20px"><i class="far fa-trash-alt"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr role="row" class="odd">
                                                        <td style="text-align:center;">
                                                            <a class="btn btn-success btn-dark btn-sm active" data-toggle="tooltip" title="" data-original-title="ไม่พร้อมใช้งาน" style="width:15px;height:20px">R</a>
                                                        </td>
                                                        <td class="sorting_1">202B</td>
                                                        <td>5200</td>
                                                        <td>-</td>
                                                        <td>ทีวี ตู้เย็น
                                                            <!-- <a href="inforoom.php"><button type="button" id="btn_info" class="btn btn-success btn-sm" data-toggle="tooltip" title="" data-original-title="ข้อมูลห้อง" style="width:15px;height:20px"><i class="fas fa-info"></i></button></a>
																<button type="button" onclick="picture()" class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="กดเพื่อดูรูป" style="width:15px;height:20px"><i class="fas fa-photo-video"></i></button>
																<a href="Usage_history.php?page=Usage_1"><button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" title="" data-original-title="ประวัติ" style="width:15px;height:20px"><i class="fas fa-file-alt"></i></button></a> -->
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <button type="button" class="btn btn-warning  btn-sm" data-toggle="tooltip" title="" style="width:15px;height:20px" data-original-title="แก้ไขข้อมูล"><i class="fas fa-edit" onclick="EditRoom()"></i></button>
                                                            <button type="button" onclick="delfunction('ห้อง','202B')" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" data-original-title="ลบห้อง" style="width:15px;height:20px"><i class="far fa-trash-alt"></i></button>
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
                    <!-- ########################################start Model delect#######################################-->

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
    <div id="modalAddRoom" class="modal fade">
        <form class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#3E49BB">
                    <h4 class="modal-title" style="color:white">เพิ่มห้องพัก</h4>
                </div>
                <div class="modal-body" id="addModalBody">
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>สถานะ :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <span>ว่าง<span>
                                    <input type="radio" name="status" value="ว่าง" />
                                    <span>ไม่ว่าง<span>
                                            <input type="radio" name="status" value="ไม่ว่าง" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>หมายเลขห้อง :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="username" value="" placeholder="กรุณากรอกหมายเลขห้อง" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ค่าเช่าห้อง:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="username" value="" placeholder="กรุณากรอกค่าเช่าห้อง" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ชื่อผู้เช่า:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="username" value="" placeholder="กรุณากรอกชื่อผู้เช่า" maxlength="100">
                            <!-- <div class="col-lg-auto col-md-9 col-sm-6 col-xs-6">
												<select class="custom-select  mb-3" id="course_e" name="course_e">
													<option>1 ปี</option>
													<option>2 ปี</option>
												</select> </div> -->
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>รายละเอียด:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="mail" value="" placeholder="กรุณากรอกรายละเอียด">
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
    <div id="modalEdit" class="modal fade">
        <form class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#3E49BB">
                    <h4 class="modal-title" style="color:white">แก้ไขห้อง</h4>
                </div>

                <div class="row mb-4">
                    <div class="col-xl-3 col-12 text-right">
                        <span>สถานะ :</span>
                    </div>
                    <div class="col-xl-8 col-12">
                        <span>ว่าง<span>
                                <input type="radio" name="status" value="ว่าง" />
                                <span>ไม่ว่าง<span>
                                        <input type="radio" name="status" value="ไม่ว่าง" />
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-3 col-12 text-right">
                        <span>หมายเลขห้อง :</span>
                    </div>
                    <div class="col-xl-8 col-12">
                        <input type="text" class="form-control" id="username" value="001A" placeholder="กรุณากรอกหมายเลขห้อง" maxlength="100">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-3 col-12 text-right">
                        <span>ค่าเช่าห้อง:</span>
                    </div>
                    <div class="col-xl-8 col-12">
                        <input type="text" class="form-control" id="username" value="4900" placeholder="กรุณากรอกค่าเช่าห้อง" maxlength="100">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-3 col-12 text-right">
                        <span>ชื่อผู้เช่า:</span>
                    </div>
                    <div class="col-xl-8 col-12">
                        <input type="text" class="form-control" id="username" value="นายคณา วันดี" placeholder="กรุณากรอกชื่อผู้เช่า" maxlength="100">
                        <!-- <div class="col-lg-auto col-md-9 col-sm-6 col-xs-6">
												<select class="custom-select  mb-3" id="course_e" name="course_e">
													<option>1 ปี</option>
													<option>2 ปี</option>
												</select> </div> -->
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-3 col-12 text-right">
                        <span>รายละเอียด:</span>
                    </div>
                    <div class="col-xl-8 col-12">
                        <input type="text" class="form-control" id="mail" value="ทีวี ตู้เย็น" placeholder="กรุณากรอกรายละเอียด">
                    </div>
                </div>
                <div class="modal-footer">
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

        $('.tt').tooltip({
            trigger: "hover"
        });

    });
    $(document).ready(function() {
        console.log("ready!");
        $("#addRoom").on('click', function() {
            $("#modalAddRoom").modal('show');
        });
        $('[data-toggle="tooltip"]').tooltip();
    });

    function EditRoom() {
        $("#modalEdit").modal('show');
    }
</script>