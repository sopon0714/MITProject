<?php
session_start();
if (!isset($_SESSION['DATAUSER'])) {
    header("location:../../index.php?msg=กระบวนการเข้าเว็บไซต์ไม่ถูกต้อง");
}
$DATAUSER = $_SESSION['DATAUSER'] ?? NULL;
// $uid = $_SESSION['DATAUSER']['uid'];
// echo $uid;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <?php require_once('../../views/layout/MainCSS.php');
    include("../../dbConnect.php");

    $sqlRequest = "SELECT * FROM `request` INNER JOIN user ON request.uid = user.uid"

    ?>


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

                <!-- ######################## start filter ######################## -->

                <!-- ######################## end filter ######################## -->
                <!-- DataTales Example -->
                <!-- <div class="card shadow mb-4">
                    <div class="card">
                        <div class="card-header card-bg " style="background-color: #bf4040">
                            <span class="link-active " style="font-size: 15px; color:white;">แสดงคำร้องทั้งหมด</span>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row center">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr role="row" style="text-align:center;">
                                                    <th rowspan="1" colspan="1">เวลา</th>
                                                    <th rowspan="1" colspan="1">วันที่</th>
                                                    <th rowspan="1" colspan="1">หมายเลขห้อง</th>
                                                    <th rowspan="1" colspan="1">รายละเอียดปัญหา</th>
                                                    <th rowspan="1" colspan="1">จัดการ</th>

                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php for ($i = 0; $i < $TableRequest[0]['numrow']; $i++) { ?>
                                                    <tr role="row" class="odd" style="text-align:center;">
                                                        <td class="sorting_1">
                                                            <?php echo $TableRequest[$i + 1]['TimeRequest'] ?>น.</td>
                                                        <td>
                                                            <?php echo $TableRequest[$i + 1]['DateRequest'] ?></td>
                                                        <td>
                                                            <?php echo $TableRequest[$i + 1]['room'] ?></td>
                                                        <td>
                                                            <a href="#" class="detailRequest" detail="<?php echo $TableRequest[$i + 1]['detail'] ?>">

                                                                <button type="button" class="btn btn-info btn-sm tt" title='รายละเอียดปัญหา'>
                                                                    <i class="fas fa-file-alt"></i>
                                                                </button>
                                                            </a>
                                                        </td>
                                                        <td style="text-align:center;">

                                                            <button onclick="delfunction('คำร้อง','<?php echo $TableRequest[$i + 1]['requestId'] ?>')" type='button' class="btn btn-danger btn-sm tt" title='ลบคำร้อง'><i class="far fa-trash-alt"></i></button>
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
                </div> -->
                <!-- ส่วนของคำว่า "แจ้งข้อเสนอแนะ" -->

                <div class="col-xl-12 col-12 mb-4">
                    <div class="card">
                        <div class="card-header card-bg  header-text-color" style="background-color:#fff;">
                            หน้าแจ้งข้อเสนอแนะเพิ่มเติม
                        </div>
                    </div>
                </div>
                <!-- จบ ส่วนของคำว่า "แจ้งข้อเสนอแนะ" -->

                <!-- ส่วนของข้อเสนอแนะเพิ่มเติม -->
                <!-- <div class="col-xl-12 col-12 mb-4"> -->

                <form class="card " method="POST" action="manageUser.php">
                    <div class="card-header card-bg">
                        <div class="card-header py-1">
                            <h6 class="h5 m-0 font-weight-bold text-primary">แจ้งข้อเสนอแนะเพิ่มเติม</h6>
                        </div>
                        <div class="form-group">
                            <!-- <label for="exampleFormControlTextarea2">แจ้งข้อเสนอแนะเพิ่มเติม</label> -->
                            <textarea name="suggestion" id="suggestion_1" cols="160" rows="10"></textarea>
                            <br>
                            <button type="submit" id="suggestion_2" style="float:right;" class="btn btn-success" data-toggle="modal" data-target="#modal-1">ส่งข้อเสนอแนะ</button>
                        </div>
                    </div>

                    <input type="hidden" id="uid" name="uid">

                    <input type="hidden" name="add">
                </form>
            </div>


            <!-- จบ ส่วนของข้อเสนอแนะเพิ่มเติม-->
        </div>
    </div>
    </div>
    </div>
</body>

</html>
<!-- footer -->
<?php require_once('../../views/layout/MainJS.php') ?>
<!-- Start Modal -->
<div id="modalDetail" class="modal fade">
    <form class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00ace6">

                <h4 class="modal-title" style="color:white">รายละเอียดปัญหา</h4>
            </div>
            <br>
            <div class="row mb-4">
                <div class="col-xl-2 col-10 text-right" style="font-size:20px">
                    <span>ปัญหา :</span>
                </div>
                <div class="col-xl-5 col-8 " style="font-size:20px">
                    <!-- <label for="detail" >
                        
                    
                    </label> -->

                    <textarea type="text" rows="4" cols="50" id="detail" name="detail" value="" disabled>

                    </textarea>
                    <!-- <input type="text" class="form-control" id="detail" name="detail" value="" maxlength="100" disabled> -->
                </div>
            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
</div>
</form>
</div>
<div>



</div>
<!-- End Modal -->
<script>
    $(document).ready(function() {
        console.log("ready!");
        $('.tt').tooltip({
            trigger: "hover"
        });

    });



    $(".detailRequest").click(function() {
        var detail = $(this).attr('detail');


        $('#detail').val(detail);

        $("#modalDetail").modal('show');
    });

    function delfunction(title, requestId) {
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
                    delete_1(requestId);
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    swal("การลบไม่สำเร็จ กรุณาทำรายการใหม่!");
                }
            });
    }

    function delete_1(requestId1) {
        $.ajax({
            type: "POST",
            data: {
                requestId1: requestId1,
                delete: "delete"
            },
            url: "./manage.php",
            async: false,
            success: function(result) {}
        });
    }
</script>