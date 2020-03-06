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
                                <div class="card-header card-bg" style="background-color: white">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="link-active font-weight-bold" style="color:#006664;">บัญชีผู้ใช้</span>
                                            <span style="float:right;">
                                                <i class="fas fa-bookmark"></i>
                                                <a class="link-path" href="#">หน้าแรก</a>
                                                <span> > </span>
                                                <a class="link-path link-active" href="#" style="color:#006664;">บัญชีผู้ใช้</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-12 mb-4">
                            <div class="card">
                                <div class="card-header card-bg font-weight-bold" style="color:#006664;background-color: white;">
                                    รายละเอียดบัญชี
                                    <span style="float:right;">

                                        <button type="button" id="btn_info" class="btn btn-warning btn-sm tt" title='แก้ไขข้อมูลผู้ใช้'>
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" id="btn_email" class="btn btn-info btn-sm pass_edit tt" title='เปลี่ยนอีเมล'>
                                            <i class="fa fa-envelope-open"></i>
                                        </button>
                                        <button type="button" id="btn_pass" class="btn btn-success btn-sm pass_edit tt" title='เปลี่ยนรหัสผ่าน'>
                                            <i class="fa fa-cog"></i>
                                        </button>
                                    </span>
                                </div>

                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-xl-4 col-2 text-right">
                                            <span>username:</span>
                                        </div>
                                        <div class="col-xl-4 col-6 text-right">
                                            <input type="text" class="form-control" id="username" value="UR0101" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-xl-4 col-2 text-right">
                                            <span>คำนำหน้า:</span>
                                        </div>
                                        <div class="col-xl-4 col-6 text-right">
                                            <input type="text" class="form-control" id="title" value="นาย" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-xl-4 col-2 text-right">
                                            <span>ชื่อ:</span>
                                        </div>
                                        <div class="col-xl-4 col-6 text-right">
                                            <input type="text" class="form-control" id="fname" value="โสภณ" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-xl-4 col-2 text-right">
                                            <span>นามสกุล:</span>
                                        </div>
                                        <div class="col-xl-4 col-6 text-right">
                                            <input type="text" class="form-control" id="lname" value="โตใหญ่" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-xl-4 col-2 text-right">
                                            <span>เลขบัตรประชาชน:</span>
                                        </div>
                                        <div class="col-xl-4 col-6 text-right">
                                            <input type="text" class="form-control" id="formalId" value="1129900000000" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-xl-4 col-2 text-right">
                                            <span>อีเมล:</span>
                                        </div>
                                        <div class="col-xl-4 col-6 text-right">
                                            <input type="text" class="form-control" id="email" value="sopon0712@gmail.com" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-xl-4 col-2 text-right">
                                            <span>เบอร์โทร:</span>
                                        </div>
                                        <div class="col-xl-4 col-6 text-right">
                                            <input type="text" class="form-control" id="phoneNumber" value="0625424005" disabled>
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
    <!-- changeinfo -->
    <div class="modal fade" id="ChangeinfoModal" name="ChangeinfoModal" tabindex="-1" role="dialog" style="padding-top: 10%;">
        <div class="modal-dialog modal-lg" role="document" style="width: 50%">
            <div class="modal-content">
                <form method="post" id="Changeinfo" name="Changeinfo" action="manage.php">
                    <div class="Changeinfo">
                        <div class="modal-header header-modal">
                            <h4 class="modal-title">แก้ไขข้อมูลผู้ใช้</h4>
                        </div>
                        <div class="modal-body" id="ChangeModalBody">
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-xl-4 col-2 text-right textreq">
                                        <span>คำนำหน้า:</span>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="title" checked>นาย
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="title">นาง
                                        </label>
                                    </div>
                                    <div class="form-check-inline disabled">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="title">นางสาว
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xl-4 col-2 text-right textreq">
                                        <span>ชื่อ:</span>
                                    </div>
                                    <div class="col-xl-6 col-6 text-right">
                                        <input type="text" class="form-control" id="fnameEdit" name="fnameEdit" value="โสภณ" placeholder="กรุณากรอกชื่อ">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xl-4 col-2 text-right textreq">
                                        <span>นามสกุล:</span>
                                    </div>
                                    <div class="col-xl-6 col-6 text-right">
                                        <input type="text" class="form-control" id="lnameEdit" name="lnameEdit" value="โตใหญ่" placeholder="กรุณากรอกนามสกุล">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xl-4 col-2 text-right textreq">
                                        <span>เลขบัตรประชาชน:</span>
                                    </div>
                                    <div class="col-xl-6 col-6 text-right">
                                        <input type="text" class="form-control" id="formalIdEdit" name="formalIdEdit" value="1129900000000" placeholder="กรุณากรอกเลขบัตรประชาชน">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xl-4 col-2 text-right textreq">
                                        <span>เบอร์โทร:</span>
                                    </div>
                                    <div class="col-xl-6 col-6 text-right">
                                        <input type="text" class="form-control" id="phoneNumberEdit" name="phoneNumberEdit" value="0625424005" placeholder="กรุณากรอกเบอร์โทร">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" name="saveInfo" id="saveInfo" value="insert" class="btn btn-success save">ยืนยัน</button>
                            <button type="button" class="btn btn-danger cancel" id="a_cancelInfo" data-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- changeMail -->
    <div class="modal fade" id="ChangeEmailModal" name="ChangeinfoModal" tabindex="-1" role="dialog" style="padding-top: 10%;">
        <div class="modal-dialog modal-lg" role="document" style="width: 50%">
            <div class="modal-content">
                <form method="post" id="ChangeEmail" name="ChangeEmail" action="manage.php">
                    <div class="Changeinfo">
                        <div class="modal-header header-modal ">
                            <h4 class="modal-title">เปลี่ยนอีเมล</h4>
                        </div>
                        <div class="modal-body" id="ChangeModalBody">
                            <div class="container">

                                <div class="row mb-3">
                                    <div class="col-xl-3 col-2 text-right textreq">
                                        <span>อีเมลใหม่:</span>
                                    </div>
                                    <div class="col-xl-7 col-6 text-right">
                                        <input type="email" class="form-control" id="emailEdit" name="emailEdit" placeholder="กรุณากรอกอีกเมล">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" name="saveMail" id="saveMail" value="insert" class="btn btn-success save">ยืนยัน</button>
                            <button type="button" class="btn btn-danger cancel" id="a_cancelMail" data-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ChangePassword -->
    <div class="modal fade" id="ChangePasswordModal" name="ChangeinfoModal" tabindex="-1" role="dialog" style="padding-top: 10%;">
        <div class="modal-dialog modal-lg" role="document" style="width: 50%">
            <div class="modal-content">
                <form method="post" id="ChangePassword" name="ChangePassword" action="manage.php">
                    <div class="Changeinfo">
                        <div class="modal-header header-modal">
                            <h4 class="modal-title">เปลี่ยนรหัสผ่าน</h4>
                        </div>
                        <div class="modal-body" id="ChangeModalBody">
                            <div class="container">

                                <div class="row mb-3">
                                    <div class="col-xl-3 col-2 text-right textreq">
                                        <span>รหัสผ่านเก่า:</span>
                                    </div>
                                    <div class="col-xl-7 col-6 text-right">
                                        <input type="password" class="form-control" id="oldpass" name="oldpass" placeholder="กรุณากรอกรหัสผ่านเก่า">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xl-3 col-2 text-right textreq">
                                        <span>รหัสผ่านใหม่:</span>
                                    </div>
                                    <div class="col-xl-7 col-6 text-right">
                                        <input type="password" class="form-control" id="newpass" name="newpass" placeholder="กรุณากรอกรหัสผ่านใหม่">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xl-3 col-2 text-right textreq">
                                        <span>รหัสผ่านใหม่อีกครั้ง:</span>
                                    </div>
                                    <div class="col-xl-7 col-6 text-right">
                                        <input type="password" class="form-control" id="newpass2" name="newpass2" placeholder="กรุณากรอกรหัสผ่านใหม่อีกครั้ง">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" name="savepass" id="savepass" value="insert" class="btn btn-success save">ยืนยัน</button>
                            <button type="button" class="btn btn-danger cancel" id="a_cancelpass" data-dismiss="modal">ยกเลิก</button>
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

        $('.tt').tooltip({
            trigger: "hover"
        });
        $('.modal').on('hidden.bs.modal', function() {
            $(this).find('form').trigger('reset');
        })
        $('#btn_info').click(function() {
            $("#ChangeinfoModal").modal();
        });
        $('#btn_pass').click(function() {
            $("#ChangePasswordModal").modal();
        });
        $('#btn_email').click(function() {
            $("#ChangeEmailModal").modal();
        });
    });
</script>