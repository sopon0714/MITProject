<?php
session_start();
$DATAUSER = $_SESSION['DATAUSER'] ?? NULL;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <?php require_once('../../views/layout/MainCSS.php');
    include("../../dbConnect.php");
    $sql_tableRoom = "SELECT room.rid,room.status as status,rnumber,rent,COALESCE(title,'-') as title,firstname,lastname ,detail ,user.uid
    FROM room LEFT JOIN agreement ON room.rid = agreement.rid LEFT JOIN user ON user.uid = agreement.uid WHERE room.isDelete LIKE 0";
    $sqlnumroom = "SELECT COUNT(rid) AS Numroom FROM room WHERE isDelete LIKE 0";
    $sqlRoomEmpty = "SELECT COUNT(rid) AS Numroom FROM room WHERE isDelete LIKE 0 AND status LIKE 'ว่าง' ";

    $tableRoom = selectData($sql_tableRoom);
    $numroom = selectData($sqlnumroom);
    $RoomEmpty = selectData($sqlRoomEmpty);

    // echo $tableRoom
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
                                <div class="card-header card-bg" style="background-color: #bf4040">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="link-active " style="font-size: 15px; color:white;">การจัดการห้อง</span>

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
                                            <div class="font-weight-bold  text-uppercase mb-1">จำนวนห้องทั้งหมด</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $numroom[1]['Numroom'] ?> ห้อง</div>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $RoomEmpty[1]['Numroom'] ?> ห้อง</div>
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

                    <!-- ######################## end filter ######################## -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card">
                            <div class="card-header card-bg " style="background-color: #bf4040">
                                <span class="link-active " style="font-size: 15px; color:white;">รายชื่อห้องในระบบ</span>

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
														</tr> 
                                                </tfoot>-->
                                                <tbody>
                                                    <?php for ($i = 0; $i <  $tableRoom[0]['numrow']; $i++) { ?>
                                                        <tr role="row" class="odd">
                                                            <td style="text-align:center;">
                                                                <?php if ($tableRoom[$i + 1]['status'] == 'ว่าง') { ?>
                                                                    <a class="btn btn-success btn-square btn-sm active" data-toggle="tooltip" title="" data-original-title="พร้อมใช้งาน">R</a>
                                                                <?php } else { ?>
                                                                    <a class="btn btn-danger btn-square btn-sm active" data-toggle="tooltip" title="" data-original-title="ไม่พร้อมใช้งาน">R</a>
                                                                <?php } ?>
                                                            </td>
                                                            <td><?php echo $tableRoom[$i + 1]['rnumber'] ?></td>
                                                            <td><?php echo $tableRoom[$i + 1]['rent'] ?></td>
                                                            <td><?php echo $tableRoom[$i + 1]['title'] ?> <?php echo $tableRoom[$i + 1]['firstname'] ?> <?php echo $tableRoom[$i + 1]['lastname'] ?> </td>
                                                            <td style="text-align:center;">
                                                                <a href="#" class="detailRoom" detail="<?php echo $tableRoom[$i + 1]['detail']; ?>">
                                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title='รายละเอียดห้อง'>
                                                                        <i class="fas fa-file-alt"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td style="text-align:center;">
                                                                <a href="#" class="EditRoom" rid=<?php echo  $tableRoom[$i + 1]['rid'] ?> rnumber=<?php echo $tableRoom[$i + 1]['rnumber'] ?> rent=<?php echo $tableRoom[$i + 1]['rent'] ?> detail=' <?php echo $tableRoom[$i + 1]['detail'] ?>'>
                                                                    <button type="button" class="btn btn-warning  btn-sm" 4 data-toggle="tooltip" title="แก้ไขข้อมูล">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                </a>
                                                                <?php if ($tableRoom[$i + 1]['status'] == "ว่าง") { ?>
                                                                    <button type="button" onclick="delfunction(<?= $tableRoom[$i + 1]['rid'] ?>,<?= $tableRoom[$i + 1]['rnumber'] ?>)" class="btn btn-danger btn-sm btndel" data-toggle="tooltip" title="" data-original-title="ลบห้อง"><i class="far fa-trash-alt"></i></button>
                                                                <?php } else { ?>
                                                                    <button type="button" onclick="delfunction2(<?= $tableRoom[$i + 1]['rid'] ?>,<?= $tableRoom[$i + 1]['rnumber'] ?>)" class="btn btn-danger btn-sm btndel" data-toggle="tooltip" title="" data-original-title="ลบห้อง"><i class="far fa-trash-alt"></i></button>
                                                                <?php } ?>
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
        <form class="modal-dialog modal-lg " method="POST" action='manage.php'>
            <div class="modal-content">
                <div class="modal-header" style="background-color:#3E49BB">
                    <h4 class="modal-title" style="color:white">เพิ่มห้องพัก</h4>
                </div>
                <div class="modal-body" id="addModalBody">

                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>หมายเลขห้อง :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="rnumber" name="rnumber" value="" placeholder="กรุณากรอกหมายเลขห้อง" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ค่าเช่าห้อง:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="rent" name="rent" value="" placeholder="กรุณากรอกค่าเช่าห้อง" maxlength="100">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>รายละเอียด:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <!-- <input type="text" class="form-control" id="mail" value="" placeholder="กรุณากรอกรายละเอียด"> -->
                            <textarea id="detail" name="detail" rows="5" cols="60" placeholder="กรุณากรอกรายละเอียด"></textarea>
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
    <div id="modalEdit" class="modal fade">
        <form class="modal-dialog modal-lg" method="POST" action='manage.php'>
            <div class="modal-content">
                <div class="modal-header" style="background-color:#eecc0b">
                    <h4 class="modal-title" style="color:white">แก้ไขห้อง</h4>
                </div>

                <div class="modal-body" id="addModalBody">
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>หมายเลขห้อง :</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_rnumber" name="e_rnumber" value="" placeholder="กรุณากรอกหมายเลขห้อง" maxlength="100">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>ค่าเช่าห้อง:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <input type="text" class="form-control" id="e_rent" name="e_rent" value="" placeholder="กรุณากรอกค่าเช่าห้อง" maxlength="100">
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>รายละเอียด:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <!-- <input type="text" class="form-control" id="mail" value="ทีวี ตู้เย็น" placeholder="กรุณากรอกรายละเอียด"> -->
                            <textarea id="e_detail" name="e_detail" rows="5" cols="60" class="form-control" value="" placeholder=""></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="e_rid" name="e_rid">
                    <input type="hidden" name="edit">


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">บันทึก</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>

    <div id="modalDetailRoom" class="modal fade">
        <form class="modal-dialog modal-lg" method="POST" action='manage.php'>
            <div class="modal-content">
                <div class="modal-header" style="background-color:#eecc0b">
                    <h4 class="modal-title" style="color:white">แก้ไขห้อง</h4>
                </div>

                <div class="modal-body" id="addModalBody">
                    <div class="row mb-4">
                        <div class="col-xl-3 col-12 text-right">
                            <span>รายละเอียด:</span>
                        </div>
                        <div class="col-xl-8 col-12">
                            <!-- <input type="text" class="form-control" id="mail" value="ทีวี ตู้เย็น" placeholder="กรุณากรอกรายละเอียด"> -->
                            <textarea id="d_detail" name="d_detail" rows="5" cols="60" class="form-control" value="" placeholder=""></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">บันทึก</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>
</div>




</div>
<!-- End Modal -->
<script>
    $(document).ready(function() {

        $('.tt').tooltip({
            trigger: "hover"
        });
        $(".btndel").on('click', function() {

        });


    });
    $(document).ready(function() {
        console.log("ready!");
        $("#addRoom").on('click', function() {
            $("#modalAddRoom").modal('show');
        });
        $('[data-toggle="tooltip"]').tooltip();
    });

    // function EditRoom() {
    //     $("#modalEdit").modal('show');
    // }
    $(".EditRoom").click(function() {
        var rid = $(this).attr('rid');
        var rnumber = $(this).attr('rnumber');
        var rent = $(this).attr('rent');
        var detail = $(this).attr('detail');

        //alert(detail);
        // alert(rnumber);
        // alert(startDate);
        // alert(endDate);
        $('#e_rid').val(rid);
        $('#e_rnumber').val(rnumber);
        $('#e_rent').val(rent);
        $('#e_detail').val(detail);

        $("#modalEdit").modal();
    });

    $(".detailRoom").click(function() {
        var detail = $(this).attr('detail');

        //alert(detail);
        $('#d_detail').val(detail);


        $("#modalDetailRoom").modal();
    });

    function delfunction(id, rname) {

        swal({
                title: "คุณต้องการลบหรือไม่?",
                text: "ต้องการยืนยันลบห้อง " + rname + " ใช่ไหม ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "POST",

                        data: {
                            rid: id,
                            action: "delete"

                        },
                        url: "../../views/room/manage.php",
                        async: false,

                        success: function(result) {
                            console.table(result);

                        }
                    });

                    swal("ลบรายการของคุณเรียบร้อยแล้ว", {
                        icon: "success",
                        buttons: false
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1500);

                } else {
                    swal("การลบไม่สำเร็จ กรุณาทำรายการใหม่!");
                }
            });


    }

    function delfunction2(id, rname) {

        swal({
            title: "คุณไม่สามารถทำรายการได้",
            text: "คุณไม่สามารถลบได้เนื่องจากห้อง " + rname + " ติดสัญญาอยู่",
            icon: "error",
            confirmButtonClass: "btn-danger",
            dangerMode: true,
        })



    }
</script>