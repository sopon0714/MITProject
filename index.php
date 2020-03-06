<?php $msg = $_GET['msg'] ?? "" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="./lib/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="./css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="./lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- sweetalert  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
</head>

<body>

    <div>
        <form id="sign_in" method="POST" action="sign-in-verify.php">
            <br>
            <br>
            <br>
            <br>
            <div class="container">
                <div class=" row">
                    <img src="./img/KU_Logo.png" style="width:30%;margin-top:45px">
                    <div class="col-sm-9 col-md-7 col-lg-5 " style="margin-left: 20%;margin-top: 5%">
                        <div>
                            <h5 class="text-center">KU Apartment</h5>
                        </div>

                        <div class="card  my-1">

                            <div class="card-body " style="margin-right: 10px">
                                <form class="form-signin" method="POST" action='sign-in-verify.php'>
                                    <h6>ล็อกอินเข้าสู่ระบบ</h6>
                                    <br>
                                    <div class="form-label-group">
                                        <label for="inputEmail">ชื่อผู้ใช้</label>
                                        <div class="col-11">
                                            <input type="text" name="username" id="username" class="form-control" placeholder="username" value="" autofocus>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-label-group">
                                        <label for="inputPassword">รหัสผ่าน</label>
                                        <div class="col-11">
                                            <input class="form-control" type="password" name="password" id="password" placeholder="Password" value="">
                                        </div>
                                    </div>
                                    </br>
                                    <div class="form-label-group">
                                        <label style="color: red"><?= $msg ?></label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" />
                                        <label class="custom-control-label" for="remember">บันทึกบัญชีผู้ใช้</label>
                                        <label style="margin-left: 20px;cursor:pointer;color: blue" id="pass_edit"> ลืมรหัสผ่าน?</label>
                                        <button class="btn btn-success btn-md" style="float:right;" type="submit">ล็อกอิน</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>

    </div>


</body>

</html>
<!-- Modal -->
<div class="modal fade" id="ChangeModal" name="ChangeModal" tabindex="-1" role="dialog" style="padding-top: 10%;">

    <div class="modal-dialog modal-lg" role="document" style="width: 30%">
        <div class="modal-content">
            <form method="post" id="formAdd" name="formAdd" action="manage.php">
                <div class="changepass">
                    <div class="modal-header header-modal">
                        <h4 class="modal-title">ลืม Password</h4>
                    </div>
                    <div class="modal-body" id="ChangeModalBody">
                        <div class="container">

                            <div class="row mb-4" style="margin-left: 10px">
                                <label for="inputEmail">ชื่อผู้ใช้</label>
                                <div class="col-12">
                                    <input type="text" name="username2" id="username2" class="form-control" placeholder="username" required autofocus>
                                </div>
                            </div>



                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" name="save" id="save" value="insert" class="btn btn-success save">ยืนยัน</button>
                        <button type="button" class="btn btn-danger cancel" id="a_cancel" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="lib/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<script src="lib/datatables/jquery.dataTables.min.js"></script>
<script src="lib/datatables/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#pass_edit').click(function() {
            $("#ChangeModal").modal();
        });
        $(document).on('click', '.save', function() {
            var user = document.getElementById("username2").value;
            changepassword(user);
        });
        $('#ChangeModal').on('hidden.bs.modal', function() {
            $(this).find('form').trigger('reset');
        })
        // $(document).on('click', '.cancel', function() {
        //     // cancel();
        //     $("#username2").value = "";

        // });


        function changepassword(username2) {

            $.ajax({
                type: "POST",

                data: {
                    username: username2
                },
                url: "view/ChangePassword/manage.php",
                async: false,

                success: function(result) {

                    $(".changepass").empty();
                    $(".changepass").append(result);
                }
            });
        }

        function cancel() {
            $.ajax({
                type: "POST",

                data: {
                    cancel: "ccc"
                },
                url: "view/ChangePassword/manage.php",
                async: false,

                success: function(result) {

                    $(".changepass").empty();
                    $(".changepass").append(result);
                }
            });
        }

    });
</script>