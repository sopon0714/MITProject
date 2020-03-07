<?php
session_start();
require_once('../../dbConnect.php');
if (isset($_POST['save'])) {
    $dormitname = $_POST['dormitoryname'];
    $address = $_POST['address'];
    $dormittel = $_POST['dormitorytel'];
    $email = $_POST['email'];
    $waterbill = $_POST['waterbill'];
    $elecbill = $_POST['electricitybill'];
    $router = $_POST['router'];
    $common = $_POST['commonfee'];
    $account = $_POST['account'];
    $bank = $_POST['bank'];

    $sql = "UPDATE `config` SET `dormitoryname` = '$dormitname'
    -- , `address` = '$address', `dormitorytel` = '$dormittel', 
    -- `email` = '$email', `waterbill` = '$waterbill', `router` = '$router', `commonfee` = '$common', `account` = '$account', `bank` = '$bank' 
    WHERE `config`.`dormitoryname` = $dormitname";
    echo $sql . "</br>";
    updateData($sql);
    $sql = "SELECT config_value FROM config WHERE dormitoryname =$dormitname";
    echo $sql . "</br>";
    header("location:../../views/config/config.php");
}
