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
    $accountname = $_POST['accountname'];
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
    // dormitorytel
    $sql = "UPDATE `config` SET `config_value` = '$dormittel'
        WHERE `config`.`config_key` = 'dormitorytel'";
    echo $sql . "</br>";
    updateData($sql);
    // email
    $sql = "UPDATE `config` SET `config_value` = '$email'
    WHERE `config`.`config_key` = 'email'";
    echo $sql . "</br>";
    updateData($sql);
    // waterbill
    $sql = "UPDATE `config` SET `config_value` = '$waterbill'
        WHERE `config`.`config_key` = 'waterbill'";
    echo $sql . "</br>";
    updateData($sql);
    // electricitybill
    $sql = "UPDATE `config` SET `config_value` = '$elecbill'
    WHERE `config`.`config_key` = 'electricitybill'";
    echo $sql . "</br>";
    updateData($sql);
    // router
    $sql = "UPDATE `config` SET `config_value` = '$router'
        WHERE `config`.`config_key` = 'router'";
    echo $sql . "</br>";
    updateData($sql);
    // commonfee
    $sql = "UPDATE `config` SET `config_value` = '$common'
    WHERE `config`.`config_key` = 'commonfee'";
    echo $sql . "</br>";
    updateData($sql);
    // account
    $sql = "UPDATE `config` SET `config_value` = '$account'
        WHERE `config`.`config_key` = 'account'";
    echo $sql . "</br>";
    updateData($sql);
    // bank
    $sql = "UPDATE `config` SET `config_value` = '$bank'
    WHERE `config`.`config_key` = 'bank'";
    echo $sql . "</br>";
    updateData($sql);
    $sql = "UPDATE `config` SET `config_value` = '$accountname'
    WHERE `config`.`config_key` = 'accountname'";
    echo $sql . "</br>";
    updateData($sql);
    header("location:../../views/config/config.php");
}
