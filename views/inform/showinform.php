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
    <title>Profile</title>
    <?php require_once('../../views/layout/MainCSS.php');
    include("../../dbConnect.php");

    $sql_tableRequest = "SELECT DATE_FORMAT(request.date,'%T ')As TimeRequest,DATE_FORMAT(request.date, '%d/%m/%Y')As DateRequest,room.rnumber As room,request.detail As detail,request.requestId  FROM `request` INNER JOIN user ON request.uid = user.uid
INNER JOIN agreement ON agreement.uid = user.uid 
INNER JOIN room ON room.rid = agreement.rid  WHERE 1";
    $sql_NumRequest = "SELECT COUNT(request.requestId) AS numRequest FROM request";
    $NumRequest = selectData($sql_NumRequest);
    $TableRequest = selectData($sql_tableRequest);

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
                                <div class="card-header card-bg" style="background-color: #bf4040"">
                                    <div class=" row">
                                    <div class="col-12">
                                        <span class="link-active " style="font-size: 15px; color:white;">แสดงคำร้อง</span>

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
                                        <div class="font-weight-bold  text-uppercase mb-1">คำร้องทั้งหมด</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $NumRequest[1]['numRequest'] ?> คำร้อง</div>
                                    </div>
                                    <div class="col-auto">

                                        <i class="fas fa-home"></i>
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
                                            การค้นหาขั้นสูง  แสดงคำร้องทั้งหมด
                                        </div> -->
                    </div>
                </div>
                <!-- ######################## end filter ######################## -->
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
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