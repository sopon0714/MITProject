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


                <div class="col-xl-12 col-12 mb-4">
                    <div class="card">
                        <div class="card-header card-bg  header-text-color" style="background-color:#bf4040;">
                            <div class="row">
                                <div class="col-12">
                                    <span class="link-active " style="font-size: 15px; color:white;">หน้าแจ้งคำร้อง</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-12 mb-4">
                    <div class="card">
                        <div class="card-header card-bg " style="background-color: #bf4040">
                            <span class="link-active " style="font-size: 15px; color:white;">แจ้งคำร้อง</span>
                        </div>
                    </div>
                    <form class="card " method="POST" action="manageUser.php">
                        <div class="card-header card-bg">

                            <div class="form-group">
                                <!-- <label for="exampleFormControlTextarea2">แจ้งข้อเสนอแนะเพิ่มเติม</label> -->
                                <textarea name="suggestion" id="suggestion_1" cols="132" rows="10"></textarea>
                                <br>
                                <button type="submit" id="suggestion_2" style="float:right;" class="btn btn-success" data-toggle="modal" data-target="#modal-1">ส่งคำร้อง</button>
                            </div>
                        </div>


                        <input type="hidden" id="uid" name="uid">

                        <input type="hidden" name="add">
                    </form>
                </div>
            </div> <!-- จบ ส่วนของข้อเสนอแนะเพิ่มเติม-->
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