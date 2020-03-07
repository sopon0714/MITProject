<?php
session_start();
require_once('../../dbConnect.php');
$action = $_POST['action'] ?? "";
if (isset($_POST['saveInfo'])) {
    $uid = $_POST['IDEdit'];
    $title = $_POST['title'];
    $firstname = $_POST['fnameEdit'];
    $lastname = $_POST['lnameEdit'];
    $formalId = $_POST['formalIdEdit'];
    $phoneNumber = $_POST['phoneNumberEdit'];
    $sql = "UPDATE `user` SET `title` = '$title', `firstname` = '$firstname', `lastname` = '$lastname', `formalId` = '$formalId', `phoneNumber` = '$phoneNumber' WHERE `user`.`uid` = $uid";
    updateData($sql);
    $sql = "SELECT * FROM user WHERE uid =$uid";
    $DATAUSER = selectDataOne($sql);
    unset($DATAUSER['password']);
    $_SESSION['DATAUSER'] = $DATAUSER;
    header("location:../../views/profile/profile.php");
} else if ($action  == "changepassword") {
    header('Content-Type: application/json');
    $uid = $_POST['userid'];
    $passold = $_POST['passold'];
    $passnew = $_POST['passnew'];
    $passnew2 = $_POST['passnew2'];
    $sql = "SELECT * FROM user WHERE uid =$uid";
    $DATAUSER = selectDataOne($sql);
    $arr = array();
    $arr['passold'] = $passold;
    $arr['passnew'] = $passnew;
    $arr['passnew2'] = $passnew2;
    if ($DATAUSER['password'] != $passold) {
        $arr['output'] = 1;
    } else if ($passnew != $passnew2) {
        $arr['output'] = 2;
    } else {
        $sql = "UPDATE `user` SET `password` = '$passnew' WHERE `user`.`uid` = $uid";
        updateData($sql);
        $arr['output'] = 3;
    }
    echo json_encode($arr);
}
