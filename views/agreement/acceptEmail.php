<?php
require_once('../../dbConnect.php');
$ID = $_GET['ID'];
$contant = "";

$sql = "UPDATE `user` SET user.status = 'ยืนยัน' WHERE `user`.`uid` = $ID";
updateData($sql);
$contant = "การยืนยันสำเร็จ";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>

    <!-- Custom fonts for this template-->
    <link href="../../lib/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="../../lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- sweetalert  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">

</head>

<body style="background-color: #e6fff5">
    <div style="text-align: center;">
        <label style="font-size: 400%;padding-top: 5%;color:#bf4040" class="font-weight-bold">YuDeeMeeSuk
            Dormitory</label>
    </div>
    <div style="text-align: center;">
        <label style="font-size: 300%;color:tomato" class="font-weight-bold"><?= $contant ?></label>
    </div>
</body>

</html>
<script src="../../lib/jquery/jquery.min.js"></script>
<script src="../../lib/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../lib/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../js/sb-admin-2.min.js"></script>

<script src="../../lib/datatables/jquery.dataTables.min.js"></script>
<script src="../../lib/datatables/dataTables.bootstrap4.min.js"></script>