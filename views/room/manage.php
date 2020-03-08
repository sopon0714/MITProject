<?php

require_once('../../dbConnect.php');
$action = $_POST['action'] ?? "";
if ($action = 'delete') {
    header('Content-Type: application/json');
    $arr = array();
    $arr['sss'] = 15;
    $rid = $_POST['rid'] ?? "";
    $sql = "UPDATE `room` SET `isDelete` = '1' WHERE `room`.`rid` = $rid";
    updateData($sql);
    echo json_encode($arr);
}

if (isset($_POST['add'])) {
    $rnumber = $_POST['rnumber'];
    $rent = $_POST['rent'];
    $detail = $_POST['detail'];


    $sqluser = "INSERT INTO `room` (`rid`, `rnumber`, `rent`, `detail`, `status`, `isDelete`) VALUES (NULL, '$rnumber', '$rent', '$detail', 'ว่าง', '0')";
    echo $sqluser;
    addinsertData($sqluser);



    header("location:./room.php");
}
