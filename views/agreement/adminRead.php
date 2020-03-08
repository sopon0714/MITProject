<?php
session_start();
$DATAUSER = $_SESSION['DATAUSER'] ?? NULL;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>การจัดการผู้ดูแล</title>
    <?php require_once('../../views/layout/MainCSS.php');
    include("../../dbConnect.php");

    $sql_TableAdmin = "SELECT * FROM `user` WHERE user.type = 'ผู้ดูแลระบบ' && user.isDelete =0";
    $sql_NumAdmin = "SELECT COUNT(user.uid) as admin FROM `user` WHERE user.type = 'ผู้ดูแลระบบ'";

    $TableAdmin = selectData($sql_TableAdmin);
    $NumAdmin = selectData($sql_NumAdmin);

    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css.map">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
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

                                <div class="card-header card-bg " style="background-color: #bf4040">
                                    <span class="link-active "
                                        style="font-size: 15px; color:white;">การจัดการผู้ดูแล</span>
                                </div>

                                </span>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-12 mb-4">
                            <div class="card border-left-primary card-color-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold  text-uppercase mb-1">จำนวนผู้ดูแล</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $NumAdmin[1]['admin'] ?> คน</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="material-icons icon-big">home</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-12 mb-4">
                            <div class="card border-left-primary card-color-add shadow h-100 py-2" id="addAdmin"
                                style="cursor:pointer;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold  text-uppercase mb-1">เพิ่มผู้ดูแล
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">+1 คน</div>
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
                        </div>
                    </div>
                    <!-- ######################## end filter ######################## -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card">
                            <div class="card-header card-bg " style="background-color: #bf4040">
                                <span class="link-active " style="font-size: 15px; color:white;">ผู้ดูแลทั้งหมด</span>


                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row center">
                                        <table WIDTH=50%>
                                            <div class="col-sm-11" id="Agreement_table">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr role="row" style="text-align:center;">
                                                            <th rowspan="1" colspan="1">ชื่อผู้ดูแล</th>
                                                            <th rowspan="1" colspan="1">เบอร์โทรติดต่อ</th>
                                                            <th rowspan="1" colspan="1">อีเมล</th>
                                                            <th rowspan="1" colspan="1">จัดการ</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php for ($i = 0; $i < $TableAdmin[0]['numrow']; $i++) { ?>
                                                        <tr role="row" class="odd" style="text-align:center;">
                                                            <td><?php echo $TableAdmin[$i + 1]['title'] ?>
                                                                <?php echo $TableAdmin[$i + 1]['firstname'] ?>
                                                                <?php echo $TableAdmin[$i + 1]['lastname'] ?></td>
                                                            <td><?php echo $TableAdmin[$i + 1]['phoneNumber'] ?></td>
                                                            <td><?php echo $TableAdmin[$i + 1]['email'] ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="#" class="detailAdmin"
                                                                    firstname="<?php echo $TableAdmin[$i + 1]['firstname']; ?>"
                                                                    lastname="<?php echo $TableAdmin[$i + 1]['lastname']; ?>"
                                                                    formalId="<?php echo $TableAdmin[$i + 1]['formalId']; ?>"
                                                                    phoneNumber="<?php echo $TableAdmin[$i + 1]['phoneNumber']; ?>"
                                                                    email="<?php echo $TableAdmin[$i + 1]['email']; ?>"
                                                                    username="<?php echo $TableAdmin[$i + 1]['username']; ?>"
                                                                    password="<?php echo $TableAdmin[$i + 1]['password']; ?>">
                                                                    <button type="button" class="btn btn-info btn-sm"
                                                                        data-toggle="tooltip" title='รายละเอียดแอดมิน'>
                                                                        <i class="fas fa-file-alt"></i>
                                                                    </button>
                                                                </a>
                                                                <button
                                                                    onclick="delfunctionAdmin('<?php echo $TableAdmin[$i + 1]['firstname'] ?>','<?php echo $TableAdmin[$i + 1]['uid'] ?>')"
                                                                    type='button' id='btn_delete'
                                                                    class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                                    title="" data-original-title="ลบผู้ดูแลระบบ"><i
                                                                        class="far fa-trash-alt"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
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
</body>

</html>
<!-- footer -->
<?php require_once('../../views/layout/MainJS.php') ?>
<!-- Start Modal -->
<div>
    <!-- เพิ่มแอดมิน -->
    <?php $sql_room = "SELECT * FROM `room` WHERE room.status = 'ว่าง' && room.isDelete LIKE 0";
    $room = selectData($sql_room); ?>
    <div id="modalAddAdmin" class="modal fade">
        <form class="modal-dialog modal-lg " method="POST" action='manage.php'>
            <div class="modal-content">
                <div class="modal-header" style="background-color:#3E49BB">
                    <h4 class="modal-title" style="color:white">เพิ่มผู้ดูแลระบบ</h4>
                </div>
                <div class="modal-body" id="addModalBody">
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>คำนำหน้า :</span>
                        </div>
                        <div class="col-lg-auto col-md-9 col-sm-6 col-xs-6">
                            <select class="custom-select  mb-3" id="title" name="title">
                                <option>นาย</option>
                                <option>นาง</option>
                                <option>นางสาว</option>
                            </select> </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ชื่อผู้ดูแลระบบ :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="firstname" name="firstname" value=""
                                placeholder="กรุณากรอกชื่อ" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>นามสกุล:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="lastname" name="lastname" value=""
                                placeholder="กรุณากรอกนามสกุล" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>รหัสประจำตัวประชาชน:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="formalId" name="formalId" value=""
                                placeholder="กรุณากรอกรหัสประจำตัวประชาชน">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เบอร์โทรติดต่อ:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value=""
                                placeholder="กรุณากรอกเบอร์โทร">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>อีเมล์ :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="email" name="email" value=""
                                placeholder="กรุณากรอกอีเมล์">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>username :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="username" name="username" value=""
                                placeholder="กรุณากรอกusername">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>password :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="password" name="password" value=""
                                placeholder="กรุณากรอกpassword">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ยืนยัน password :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="password2" name="password2" value=""
                                placeholder="กรุณากรอกpassword">
                        </div>
                    </div>

                    <input type="hidden" name="addAdmin">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">บันทึก</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>

    <!-- รายละเอียดแอดมิน -->
    <div id="modalDetailAdmin" class="modal fade">
        <form class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#00ace6">

                    <h4 class="modal-title" style="color:white">รายละเอียดผู้ดูแลระบบ</h4>
                </div>
                <div class="modal-body" id="addModalBody">
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ชื่อผู้ดูแลระบบ :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_firstname" name="e_firstname" value=""
                                maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>นามสกุล:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_lastname" name="e_lastname" value=""
                                placeholder="กรุณากรอกนามสกุล" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>รหัสประจำตัวประชาชน:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_formalId" name="e_formalId" value=""
                                placeholder="กรุณากรอกเบอร์โทร">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เบอร์โทรติดต่อ:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_phoneNumber" name="e_phoneNumber" value=""
                                placeholder="กรุณากรอกเบอร์โทร">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>อีเมล์ :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_email" name="e_email" value=""
                                placeholder="กรุณากรอกอีเมล์">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>username :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_username" name="e_username" value=""
                                placeholder="กรุณากรอกusername">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>password :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_password" name="e_password" value=""
                                placeholder="กรุณากรอกpassword">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Modal -->
<script src="function.js"></script>