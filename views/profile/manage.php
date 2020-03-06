<?php
session_start();
require_once('../../dbConnect.php');
if (isset($_POST['saveInfo'])) {
    $uid = $_POST['IDEdit'];
    $title = $_POST['title'];
    $firstname = $_POST['fnameEdit'];
    $lastname = $_POST['lnameEdit'];
    $formalId = $_POST['formalIdEdit'];
    $phoneNumber = $_POST['phoneNumberEdit'];
    $sql = "UPDATE `user` SET `title` = '$title', `firstname` = '$firstname', `lastname` = '$lastname', `formalId` = '$formalId', `phoneNumber` = '$phoneNumber' WHERE `user`.`uid` = $uid";
    echo $sql . "</br>";
    updateData($sql);
    $sql = "SELECT * FROM user WHERE uid =$uid";
    echo $sql . "</br>";
    $DATAUSER = selectDataOne($sql);
    unset($DATAUSER['password']);
    $_SESSION['DATAUSER'] = $DATAUSER;
    header("location:../../views/profile/profile.php");
}
