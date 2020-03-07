<?php
include("../../dbConnect.php");
session_start();
$DATAUSER = $_SESSION['DATAUSER'] ?? NULL;
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
$accountname = $result[11]['config_value'];

?>
<!DOCTYPE html>
<html>


<head>
    <!-- ########### header ########### -->
    <?php include("../layout/MainCSS.php");

    ?>

</head>

<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!--start Sidebar -->
        <?php include("../layout/SidebarAdmin.php"); ?>
        <!--end Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content" class="background-color-main">
                <!-- start Topbar -->
                <?php include("../layout/Topbar.php"); ?>
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
                                        <div class="col text-right"><button type="button" class="btn btn-info " id="btn_edit">แก้ไขข้อมูล</button></div>
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
                                        <textarea class="form-control" rows="5" disabled><?php echo $address ?> </textarea>
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
                                    บาท / เดือน
                                </div>
                                <div class="row mb-4" style="margin:20px;">
                                    <div class="col-xl-3 col-12 text-right">
                                        <span>ค่าส่วนกลางและอื่นๆ: </span>
                                    </div>
                                    <div class="col-xl-2 col-12">
                                        <input type="text" class="form-control" id="semester" value="<?php echo $commonfee ?>" maxlength="100" disabled>
                                    </div>
                                    บาท / เดือน
                                </div>
                                <div class="row mb-4" style="margin:20px;">
                                    <div class="col-xl-3 col-12 text-right">
                                        <span>ชื่อบัญชีธนาคาร: </span>
                                    </div>
                                    <div class="col-xl-2 col-12">
                                        <input type="text" class="form-control" id="semester" value="<?php echo $accountname ?>" maxlength="100" disabled>
                                    </div>
                                </div>
                                <div class="row mb-4" style="margin:20px;">
                                    <div class="col-xl-3 col-12 text-right">
                                        <span>เลขบัญชีธนาคาร: </span>
                                    </div>
                                    <div class="col-xl-2 col-12">
                                        <input type="text" class="form-control" id="semester" value="<?php echo $accountname ?>" maxlength="100" disabled>
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


                    <div id="editInfo" class="modal fade">
                        <form class="modal-dialog modal-lg " method="post" action="manage.php">
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
                                                <input type="text" class="form-control" id="dormitoryname" name="dormitoryname" value="<?php echo $dormitoryname ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>ที่อยู่ <span style="color:red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>เบอร์โทร <span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="dormitorytel" name="dormitorytel" value="<?php echo $dormitorytel ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>Email <span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>ค่าน้ำหน่วยละ <span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="waterbill" name="waterbill" value="<?php echo $waterbill ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>ค่าไฟหน่วยละ<span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="electricitybill" name="electricitybill" value="<?php echo $electricitybill ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>ค่าเช่าเราท์เตอร์ <span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="router" name="router" value="<?php echo $router ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>ค่าส่วนกลางและอื่นๆ <span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="commonfee" name="commonfee" value="<?php echo $commonfee ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>ชื่อบัญชีธนาคาร<span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="accountname" name="accountname" value="<?php echo $accountname ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right">
                                                <span>เลขบัญชีธนาคาร<span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="account" name="account" value="<?php echo $account ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-xl-3 col-12 text-right">
                                                <span>ธนาคาร<span style="color: red">*</span> :</span>
                                            </div>
                                            <div class="col-xl-9 col-12">
                                                <select class="form-control" id="bank" name=bank>


                                                    <option value="กรุงเทพ" <?php if ($bank == "กรุงเทพ") {
                                                                                echo "selected";
                                                                            } ?>>กรุงเทพ</option>
                                                    <option value="กรุงไทย" <?php if ($bank == "กรุงไทย") {
                                                                                echo "selected";
                                                                            } ?>>กรุงไทย</option>
                                                    <option value="ทหารไทย" <?php if ($bank == "ทหารไทย") {
                                                                                echo "selected";
                                                                            } ?>>ทหารไทย</option>
                                                    <option value="ไทยพาณิชย์" <?php if ($bank == "ไทยพาณิชย์") {
                                                                                    echo "selected";
                                                                                } ?>>ไทยพาณิชย์</option>
                                                    <option value="กรุงศรี" <?php if ($bank == "กรุงศรี") {
                                                                                echo "selected";
                                                                            } ?>>กรุงศรี</option>
                                                    <option value="ออมสิน" <?php if ($bank == "ออมสิน") {
                                                                                echo "selected";
                                                                            } ?>>ออมสิน</option>
                                                    <option value="กสิกร" <?php if ($bank == "กสิกร") {
                                                                                echo "selected";
                                                                            } ?>>กสิกร</option>
                                                </select>

                                            </div>
                                        </div>


                        </form>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save" id="save" value="insert" class="btn btn-success" name="submitedit">ยืนยัน</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
            </form>
        </div>

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
    <?php include("../layout/MainJS.php"); ?>
</body>


</html>

<script>
    $(document).ready(function() {
        $('#btn_edit').click(function() {
            $("#editInfo").modal();
        });
    });
</script>