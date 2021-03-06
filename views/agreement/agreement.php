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
    <title>การจัดการผู้เช่า</title>
    <?php require_once('../../views/layout/MainCSS.php');
    include("../../dbConnect.php");

    $sql_TableAgreement = "SELECT * FROM `user` INNER JOIN agreement ON agreement.uid = user.uid
        INNER JOIN room ON room.rid = agreement.rid WHERE user.isDelete=0";
    $sql_NumAgreement = "SELECT COUNT(agreement.agreeId) AS numAgreement FROM agreement 
    INNER JOIN user ON user.uid = agreement.uid WHERE user.isDelete=0";

    $TableAgreement = selectData($sql_TableAgreement);
    $NumAgreement = selectData($sql_NumAgreement);

    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css.map">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <?php
        if ($_SESSION['DATAUSER']['type'] == "ผู้ดูแลระบบ") {
            require_once('../../views/layout/SidebarAdmin.php');
        } else {
            require_once('../../views/layout/SidebarUser.php');
        }
        ?>
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
                                <div class="card-header card-bg" style="background-color: #bf4040">
                                    <div class=" row">
                                        <div class="col-12">
                                            <span class="link-active " style="font-size: 15px; color:white;">การจัดการผู้เช่า</span>
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
                                            <div class="font-weight-bold  text-uppercase mb-1">จำนวนผู้เช่า</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $NumAgreement[1]['numAgreement'] ?> ห้อง</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-home fa-2x"></i>
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
                                            <div class="font-weight-bold  text-uppercase mb-1">เพิ่มผู้เช่า
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">+1 คน</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-plus-circle fa-2x"></i>
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
                                <span class="link-active " style="font-size: 15px; color:white;">ผู้เช่าทั้งหมดในระบบ</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row center">

                                        <div class="card-body">
                                            <div class="table-responsive">

                                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                    <div class="row center">

                                                        <div class="col-sm-12" id="Agreement_table">
                                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                                <thead>
                                                                    <tr role="row" style="text-align:center;">

                                                                        <th rowspan="1" colspan="1">หมายเลขห้อง</th>
                                                                        <th rowspan="1" colspan="1">ชื่อผู้เช่า</th>
                                                                        <th rowspan="1" colspan="1">วันที่เริ่มสัญญา
                                                                        </th>
                                                                        <th rowspan="1" colspan="1">วันที่สิ้นสุดสัญญา
                                                                        </th>
                                                                        <th rowspan="1" colspan="1">รายละเอียด</th>
                                                                        <th rowspan="1" colspan="1">จัดการ</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php for ($i = 0; $i < $TableAgreement[0]['numrow']; $i++) { ?>
                                                                        <tr role="row" class="odd" style="text-align:center;">
                                                                            <td class="sorting_1">
                                                                                <?php echo $TableAgreement[$i + 1]['rnumber'] ?>
                                                                            </td>
                                                                            <td><?php echo $TableAgreement[$i + 1]['title'] ?>
                                                                                <?php echo $TableAgreement[$i + 1]['firstname'] ?>
                                                                                <?php echo $TableAgreement[$i + 1]['lastname'] ?>
                                                                            </td>
                                                                            <td><?php echo $TableAgreement[$i + 1]['startDate'] ?>
                                                                            </td>
                                                                            <td><?php echo $TableAgreement[$i + 1]['endDate'] ?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                <a href="#" class="detailAgreement" rnumber="<?php echo $TableAgreement[$i + 1]['rnumber']; ?>" firstname="<?php echo $TableAgreement[$i + 1]['firstname']; ?>" lastname="<?php echo $TableAgreement[$i + 1]['lastname']; ?>" startDate="<?php echo $TableAgreement[$i + 1]['startDate']; ?>" endDate="<?php echo $TableAgreement[$i + 1]['endDate']; ?>" phoneNumber="<?php echo $TableAgreement[$i + 1]['phoneNumber']; ?>" email="<?php echo $TableAgreement[$i + 1]['email']; ?>">
                                                                                    <button type="button" class="btn btn-info btn-sm tt" title='รายละเอียดผู้เช่า'>
                                                                                        <i class="fas fa-file-alt"></i>
                                                                                    </button>
                                                                                </a>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                <a href="#" class="EditAgreement" idAgree="<?php echo $TableAgreement[$i + 1]['agreeId']; ?>" rnumber="<?php echo $TableAgreement[$i + 1]['rnumber']; ?>" startDate="<?php echo $TableAgreement[$i + 1]['startDate']; ?>" endDate="<?php echo $TableAgreement[$i + 1]['endDate']; ?>" rid="<?php echo $TableAgreement[$i + 1]['rid']; ?>">
                                                                                    <button type="button" class="btn btn-warning  btn-sm tt" title="แก้ไขข้อมูล">
                                                                                        <i class="fas fa-edit"></i>
                                                                                    </button>
                                                                                </a>

                                                                                <button onclick="delfunction('ผู้เช่าห้อง<?php echo $TableAgreement[$i + 1]['rnumber'] ?>','<?php echo $TableAgreement[$i + 1]['uid'] ?>')" type='button' id='btn_delete' class="btn btn-danger btn-sm" data-toggle="tooltip" title="" data-original-title="ลบผู้เช่า"><i class="far fa-trash-alt"></i></button>
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
    <?php $sql_room = "SELECT * FROM `room` WHERE room.status = 'ว่าง' && room.isDelete LIKE 0";
    $room = selectData($sql_room); ?>
    <div id="modalAddAgreement" class="modal fade">
        <form class="modal-dialog modal-lg " method="POST" action='manage.php'>
            <div class="modal-content">
                <div class="modal-header" style="background-color:#3E49BB">
                    <h4 class="modal-title" style="color:white">เพิ่มผู้เช่า</h4>
                </div>
                <div class="modal-body" id="addModalBody">
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เลขห้อง :</span>
                        </div>
                        <div class="col-lg-auto col-md-9 col-sm-6 col-xs-6">
                            <select class="custom-select  mb-3" id="rnumber" name="rnumber">
                                <?php for ($i = 0; $i < $room[0]['numrow']; $i++) {
                                ?>
                                    <option value="<?= $room[$i + 1]['rid'] ?>">ห้อง <?php echo $room[$i + 1]['rnumber'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4" style="margin:10px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>วันที่เข้า : </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="date" class="form-control" id="startDate" name="startDate" value="" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4" style="margin:10px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>วันที่ออก : </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="date" class="form-control" id="endDate" name="endDate" value="" maxlength="100">
                        </div>
                    </div>
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
                            <span>ชื่อผู้เข้าพักอาศัย :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="กรุณากรอกชื่อ" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>นามสกุล:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="lastname" name="lastname" value="" placeholder="กรุณากรอกนามสกุล" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>รหัสประจำตัวประชาชน:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="formalId" name="formalId" value="" placeholder="กรุณากรอกรหัสประจำตัวประชาชนร">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เบอร์โทรติดต่อ:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="" placeholder="กรุณากรอกเบอร์โทร">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>อีเมล์ :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="email" name="email" value="" placeholder="กรุณากรอกอีเมล์">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>username :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="username" name="username" value="" placeholder="กรุณากรอกusername">
                        </div>
                    </div>

                    <input type="hidden" name="add">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">บันทึก</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>

    <!-- แก้ไขสัญญาเช่า -->
    <div id="modalEdit" class="modal fade">
        <form class="modal-dialog modal-lg " method="POST" action='manage.php'>
            <div class="modal-content">
                <div class="modal-header" style="background-color:#eecc0b">
                    <h4 class="modal-title" style="color:white">แก้ไขข้อมูลผู้เช่า </h4>
                </div>
                <div class="modal-body" id="addModalBody">
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เลขห้อง :</span>
                        </div>
                        <div class=" col-md-5 col-sm-6 col-xs-6">
                            <select class="form-control " id="e_rnumber" name="e_rnumber">
                                <option id="sel" value="0" selected>ห้อง xxxx </option>
                                <?php for ($i = 0; $i < $room[0]['numrow']; $i++) {
                                ?>
                                    <option value="<?= $room[$i + 1]['rid'] ?>">ห้อง <?php echo $room[$i + 1]['rnumber'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4" style="margin:10px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>วันที่เข้า: </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="date" class="form-control" id="e_startDate" name="e_startDate" value="2020-03-07" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4" style="margin:10px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>วันที่ออก: </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="date" class="form-control" id="e_endDate" name="e_endDate" value="2020-03-07" maxlength="100">
                        </div>
                    </div>
                    <input type="hidden" id="e_idAgree" name="e_idAgree">
                    <input type="hidden" id="e_idAgree2" name="edit">
                    <input type="hidden" id="e_rid" name="e_rid">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">บันทึก</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>
    <!-- รายละเอียดสัญญา -->
    <div id="modalDetailAgreement" class="modal fade">
        <form class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#00ace6">

                    <h4 class="modal-title" style="color:white">รายละเอียดของผู้เช่า</h4>
                </div>
                <div class="modal-body" id="addModalBody">
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เลขห้อง :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_rnumber2" name="e_rnumber2" value="" maxlength="100" disabled>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ชื่อผู้เข้าพักอาศัย :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_firstname" name="e_firstname" value="" maxlength="100" disabled>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>นามสกุล:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_lastname" name="e_lastname" value="" placeholder="กรุณากรอกนามสกุล" maxlength="100" disabled>
                        </div>
                    </div>
                    <div class="row mb-4" style="margin:10px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>วันที่เข้า: </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="date" class="form-control" id="e_startDate2" name="e_startDate" value="2020-03-07" maxlength="100" disabled>
                        </div>
                    </div>
                    <div class="row mb-4" style="margin:10px;">
                        <div class="col-xl-3 col-12 text-right">
                            <span>วันที่ออก: </span>
                        </div>
                        <div class="col-xl-5 col-12">
                            <input type="date" class="form-control" id="e_endDate2" name="e_endDate" value="2020-03-07" maxlength="100" disabled>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>เบอร์โทรติดต่อ:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_phoneNumber" name="e_phoneNumber" value="" placeholder="กรุณากรอกเบอร์โทร" disabled>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>อีเมล์ :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_email" name="e_email" value="" placeholder="กรุณากรอกอีเมล์" disabled>
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
<script>
    $(document).ready(function() {
        console.log("ready!");
        $('[data-toggle="tooltip"]').tooltip();

        $('.tt').tooltip({
            trigger: "hover"
        });
    });
    $(".detailAgreement").click(function() {
        var rnumber = $(this).attr('rnumber');
        var firstname = $(this).attr('firstname');
        var lastname = $(this).attr('lastname');
        var startDate = $(this).attr('startDate');
        var endDate = $(this).attr('endDate');
        var phoneNumber = $(this).attr('phoneNumber');
        var email = $(this).attr('email');

        //alert(rnumber);
        $('#e_rnumber2').val(rnumber);
        $('#e_firstname').val(firstname);
        $('#e_lastname').val(lastname);
        $('#e_startDate2').val(startDate);
        $('#e_endDate2').val(endDate);
        $('#e_phoneNumber').val(phoneNumber);
        $('#e_email').val(email);

        $("#modalDetailAgreement").modal();
    });
    $(".EditAgreement").click(function() {
        var idAgree = $(this).attr('idAgree');
        var rnumber = $(this).attr('rnumber');
        var startDate = $(this).attr('startDate');
        var endDate = $(this).attr('endDate');
        var rid = $(this).attr('rid');
        // alert(idAgree);
        // alert(rnumber);
        // alert(startDate);
        // alert(endDate);
        $('#sel').val(rid);
        $('#sel').text("ห้อง " + rnumber);
        $('#e_idAgree').val(idAgree);
        $('#e_startDate').val(startDate);
        $('#e_endDate').val(endDate);
        $('#e_rid').val(rid);
        //$('#sel01').html("<option value=\"" + rid + "\" selected>ห้อง " + rnumber + " </option>");
        $("#modalEdit").modal();

    });

    function delfunction(title, uid) {
        //alert(uid + " dddd")
        swal({
                title: "คุณต้องการลบ",
                text: title + "หรือไม่ ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("ลบรายการสำเร็จเรียบร้อยแล้ว", {
                        icon: "success",
                        buttons: false
                    });
                    delete_1(uid);
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    swal("การลบไม่สำเร็จ กรุณาทำรายการใหม่!");
                }
            });
    }

    function delete_1(uid1) {
        $.ajax({
            type: "POST",
            data: {
                uid: uid1,
                delete: "delete"
            },
            url: "./manage.php",
            async: false,
            success: function(result) {}
        });
    }
</script>