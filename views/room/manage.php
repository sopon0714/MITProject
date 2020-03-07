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
