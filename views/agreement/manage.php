<?php
require_once("../../dbConnect.php");
session_start();
// ********************************************Agreement*************************************************
if (isset($_POST['add'])) {
    $rnumber = $_POST['rnumber'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $title = $_POST['title'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $formalId = $_POST['formalId'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqluser = "INSERT INTO user ( uid, `username`, `password` , type , title , firstname , lastname ,formalId ,email , phoneNumber ,status , isDelete) 
    VALUES ( NULL, '$username', '$password' ,'ผู้เช่า','$title','$firstname','$lastname','$formalId','$email','$phoneNumber','รอยืนยัน', 0 )";
    echo $sqluser;
    addinsertData($sqluser);

    $uid = "SELECT user.uid as uid FROM user where user.firstname = '$firstname' && user.lastname = '$lastname'";
    $u_uid = selectData($uid);
    echo ($u_uid[1]['uid']);
    $ss = ($u_uid[1]['uid']);

    $sqlagree = "INSERT INTO agreement ( agreeId,`rid`, `uid`, `startDate`, `endDate`) VALUES ( NULL,'$rnumber', '$ss', '$startDate', '$endDate' )";
    echo $sqlagree;
    addinsertData($sqlagree);
    header("location:./agreement.php");
}
if (isset($_POST['delete'])) {
    $uid = $_POST['uid'];
    $sql = "UPDATE user SET isDelete = 1  WHERE user.uid =  $uid";
    updateData($sql);
}
if (isset($_POST['edit'])) {
    $e_idAgree = $_POST['e_idAgree'];
    $e_rnumber = $_POST['e_rnumber'];
    $e_startDate = $_POST['e_startDate'];
    $e_endDate = $_POST['e_endDate'];
    echo ("$e_idAgree    ");
    echo ("$e_rnumber    ");
    echo "$e_startDate    ";
    echo "$e_endDate     ";

    $sql_editAgree = "UPDATE agreement SET rid = '$e_rnumber', startDate ='$e_startDate', `endDate` = '$e_endDate' WHERE agreement.agreeId =  $e_idAgree";
    updateData($sql_editAgree);
    header("location:./agreement.php");
}
// ********************************************Admin*************************************************
if (isset($_POST['addAdmin'])) {
    $title = $_POST['title'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $formalId = $_POST['formalId'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqluser = "INSERT INTO user ( uid, `username`, `password` , type , title , firstname , lastname ,formalId ,email , phoneNumber ,status , isDelete) 
    VALUES ( NULL, '$username', '$password' ,'ผู้ดูแลระบบ','$title','$firstname','$lastname','$formalId','$email','$phoneNumber','รอยืนยัน', 0 )";
    echo $sqluser;
    addinsertData($sqluser);
    header("location:./adminRead.php");
}
if (isset($_POST['deleteAdmin'])) {
    $uid = $_POST['uid'];
    $sql = "UPDATE user SET isDelete = 1  WHERE user.uid =  $uid";
    updateData($sql);
}