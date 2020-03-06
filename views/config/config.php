<?php
include("../dbConnect.php");

$query = "SELECT * FROM config";
$result = selectData($query);
//print_r($result);
$waterbill = $result[1]['config_value'];
$electricitybill = $result[2]['config_value'];
$account = $result[3]['config_value'];
$bank = $result[4]['config_value'];
$commonfee = $result[5]['config_value'];
$dormitoryname = $result[6]['config_value'];
$dormitorytel = $result[7]['config_value'];
$router = $result[8]['config_value'];
$email = $result[9]['config_value'];
$address = $result[10]['config_value'];


?>
<!DOCTYPE html>
<html>

<head>
    <!-- ########### header ########### -->
    <?php include("../main/header.php");

    ?>

</head>

<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!--start Sidebar -->
        <?php include("../main/sidebar.php"); ?>
        <!--end Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content" class="background-color-main">
                <!-- start Topbar -->
                <?php include("../main/topbar.php"); ?>
                <!-- end Topbar -->
                <!-- #################### start Content #################### -->
                <div class="container-fluid">
                    <div class="container ">
                        <div class="col-xl-center col-12 mb-4">
                            <div class="card ">

                                <div class="card-header card-bg font-weight-bold header-text-color">
                                    <div class="row">
                                        <div class="font-weight-bold header-text-color">
                                            <h5>ข้อมูลการจัดการหอพัก</h5>
                                        </div>
                                        <div class="col text-right"><button type="button" class="btn btn-info " onclick="editInfo()">แก้ไขข้อมูล</button></div>
                                    </div>
                                </div>
                                <div class="row mb-4" style="margin:20px;">
                                    <div class="col-xl-3 col-12 text-right">
                                        <span>ชื่อหอพัก : </span>

                                    </div>
                                    <div class="col-xl-5 col-12">
                                        <input type="text" class="form-control" id="semester" value="<?php echo $dormitoryname ?>" maxlength="100" disabled>
                                    </div>
                                </div>
                                <div class="row mb-4" style="margin:10px;">
                                    <div class="col-xl-3 col-12 text-right">
                                        <span>ที่อยู่ : </span>
                                    </div>
                                    <div class="col-xl-5 col-12">
                                        <textarea class="form-control" rows="5"><?php echo $address ?></textarea>
                                    </div>


                                </div>
                                <div class="row mb-4" style="margin:20px;">
                                    <div class="col-xl-3 col-12 text-right">
                                        <span>เบอร์โทร : </span>
                                    </div>
                                    <div class="col-xl-5 col-12">
                                        <input type="text" class="form-control" id="semester" value="<?php echo $dormitorytel ?>" maxlength="100" disabled>
                                    </div>
                                </div>
                                <div class="row mb-4" style="margin:20px;">
                                    <div class="col-xl-3 col-12 text-right">
                                        <span>Email : </span>
                                    </div>
                                    <div class="col-xl-5 col-12">
                                        <input type="text" class="form-control" id="semester" value="<?php echo $email ?>" maxlength="100" disabled>
                                    </div>
                                </div>
                                <div class="row mb-4" style="margin:20px;">
                                    <div class="col-xl-3 col-12 text-right">
                                        <span>ค่าน้ำหน่วยละ : </span>

                                    </div>
                                    <div class="col-xl-2 col-12">
                                        <input type="text" class="form-control" id="semester" value="<?php echo $waterbill ?>" maxlength="100" disabled>
                                    </div>
                                    บาท/ยูนิต
                                </div>
                                <div class="row mb-4" style="margin:20px;">
                                    <div class="col-xl-3 col-12 text-right">
                                        <span>ค่าไฟหน่วยละ : </span>

                                    </div>
                                    <div class="col-xl-2 col-12">
                                        <input type="text" class="form-control" id="semester" value="<?php echo $electricitybill ?>" maxlength="100" disabled>
                                    </div>
                                    บาท/ยูนิต
                                </div>
                                <div class="row mb-4" style="margin:20px;">
                                    <div class="col-xl-3 col-12 text-right">
                                        <span>ค่าเช่าเราท์เตอร์ : </span>
                                    </div>
                                    <div class="col-xl-2 col-12">
                                        <input type="text" class="form-control" id="semester" value="<?php echo $router ?>" maxlength="100" disabled>
                                    </div>
                                    บาท / ปี
                                </div>
                                <div class="row mb-4" style="margin:20px;">
                                    <div class="col-xl-3 col-12 text-right">
                                        <span>ค่าส่วนกลางและอื่นๆ: </span>
                                    </div>
                                    <div class="col-xl-2 col-12">
                                        <input type="text" class="form-control" id="semester" value="<?php echo $commonfee ?>" maxlength="100" disabled>
                                    </div>
                                    บาท / ปี
                                </div>
                                <div class="row mb-4" style="margin:20px;">
                                    <div class="col-xl-3 col-12 text-right">
                                        <span>เลขบัญชีธนาคาร: </span>
                                    </div>
                                    <div class="col-xl-2 col-12">
                                        <input type="text" class="form-control" id="semester" value="<?php echo $account ?>" maxlength="100" disabled>
                                    </div>
                                </div>
                                <div class="row mb-4" style="margin:20px;">
                                    <div class="col-xl-3 col-12 text-right">
                                        <span>ธนาคาร: </span>
                                    </div>
                                    <div class="col-xl-2 col-12">
                                        <input type="text" class="form-control" id="semester" value="<?php echo $bank ?>" maxlength="100" disabled>
                                    </div>
                                </div>


                                <!-- /.container-fluid -->
                            </div>

                            <!-- #################### end Content #################### -->
                        </div>

                        <!-- End of Main Content -->

                    </div>
                    <!-- Start Model EditInfo -->
                    <div id="editInfo" class="modal fade">
                        <form class="modal-dialog modal-lg " method="post" action="edit_room_type.php">
                            <div class="modal-content">
                                <div class="modal-header " style="background-color: #eecc0b;">
                                    <h4 class="modal-title" style="color:white">แก้ไขข้อมูลส่วนตัวหอพัก</h4>
                                </div>
                                <div class="modal-body" id="addModalBody">
                                    <div class="container">
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>ชื่อหอพัก <span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="username__r" name="username__r" placeholder="กรุณากรอกชื่อหอพัก">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>ที่อยู่ <span style="color:red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="username__n_r" name="username__n_r" placeholder="กรุณากรอกที่อยู่หอพัก">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>เบอร์โทร <span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="username__n_r" name="username__n_r" placeholder="กรุณากรอกเบอร์โทร">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>Email <span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="username__n_r" name="username__n_r" placeholder="กรุณากรอกตึกอีเมล">
                                            </div>
                                        </div>



                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" name="submitedit">ยืนยัน</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Model EditInfo -->

                    <!-- Start Model EditManage -->

                    <div id="editManage" class="modal fade">
                        <form class="modal-dialog modal-lg " method="post" action="edit_room_type.php">
                            <div class="modal-content">
                                <div class="modal-header " style="background-color: #eecc0b;">
                                    <h4 class="modal-title" style="color:white">แก้ไขข้อมูลการจัดการหอพัก</h4>
                                </div>
                                <div class="modal-body" id="addModalBody">
                                    <div class="container">
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>ค่าน้ำหน่วยละ <span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="username__r" name="username__r" placeholder="กรุณากรอกเลขหน่วยค่าน้ำ(บาท/ยูนิต))">
                                            </div>

                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>ค่าไฟหน่วยละ <span style="color:red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="username__n_r" name="username__n_r" placeholder="กรุณากรอกหน่วยค่าไฟ(บาท/ยูนิต)">
                                            </div>

                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>ค่าเช่าเราท์เตอร์<span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="username__n_r" name="username__n_r" placeholder="กรุณากรอกค่าเช่าเราท์เตอร์(บาท/ปี)">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>ค่าส่วนกลางและอื่นๆ <span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="username__n_r" name="username__n_r" placeholder="กรุณากรอกค่าส่วนกลางและอื่นๆ(บาท/ปี)">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>เลขบัญชีธนาคาร <span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="username__n_r" name="username__n_r" placeholder="กรุณากรอกเลขบัญชีธนาคาร">
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>ธนาคาร <span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="username__n_r" name="username__n_r" placeholder="กรุณากรอกชื่อธนาคาร">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" name="submitedit">ยืนยัน</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Model EditManage -->


                    <!-- End of Content Wrapper -->
                </div>
                <!-- #################### end Content #################### -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- ########### footer ########### -->
    <?php include("../main/footer.php"); ?>
</body>

</html>
<script type="text/javascript">
    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.visibility = 'visible';
        } else document.getElementById('ifYes').style.visibility = 'hidden';

    }
</script>
<script>
    $(document).ready(function() {
        console.log("ready!");
        $('[data-toggle="tooltip"]').tooltip();
    });

    function editInfo() {
        $("#editInfo").modal();
    }

    function editManage() {
        $("#editManage").modal();
    }

    function picture() {
        $("#picture").modal();
    }

    function lock() {
        $("#lock_all").modal();
    }

    function open_lock() {
        $("#open_all").modal();
    }
</script>