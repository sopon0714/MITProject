<?php

require_once("../../dbConnect.php");
session_start();
if (isset($_POST['add'])) {
    $sug = $_POST['suggestion'];
    date_default_timezone_set('Asia/Bangkok');
    $start_date = time();
    $datetime = date("Y-m-d H:i:s",$start_date);
    $uid = $_SESSION['DATAUSER']['uid'];
       
    $sqluser = "INSERT INTO `request` (`requestId`, `uid`, `date`, `detail`) VALUES (NULL, '$uid', '$datetime', '$sug')";
    echo $sqluser;
    addinsertData($sqluser);



    header("location: ./informUser.php");
}
