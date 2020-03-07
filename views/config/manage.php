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
    // dormitname
    $sql = "UPDATE `config` SET `config_value` = '$dormitname'
    WHERE `config`.`config_key` = 'DormitoryName'";
    echo $sql . "</br>";
    updateData($sql);
    // address
    $sql = "UPDATE `config` SET `config_value` = '$address'
    WHERE `config`.`config_key` = 'Address'";
    echo $sql . "</br>";
    updateData($sql);
    header("location:../../views/config/config.php");
}
