<?php
require_once("../../dbConnect.php");
session_start();
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
