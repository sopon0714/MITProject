<?php
session_start();
require_once('../../dbConnect.php');
$action = $_POST['action'] ?? "";
$USER = $_SESSION['DATAUSER'];
if ($action == "detailslip") {

    $pId = $_POST['pId'] ?? "";
    $month = $_POST['monthS'] ?? "";
    $year = $_POST['yearS'] ?? "";
    $sql = "SELECT `payment`.`pId`,`date`.`dateId`,`room`.`rnumber`,`payment`.`waterb`,`payment`.`waterUnit`, 
    `payment`.`waterb`*`payment`.`waterUnit` as costwater,
    `payment`.`elecb`,`payment`.`elecUnit`,`payment`.`elecb`*`payment`.`elecUnit` as costelec
    ,`payment`.`commonf`,`payment`.`paymentAll`,
    `payment`.`status`, IFNULL(FROM_UNIXTIME(payment.timeSlip, '%H:%i:%s %Y-%m-%d'),\"-\") as timeSlip ,
    IFNULL(FROM_UNIXTIME(payment.timeConfirm, '%H:%i:%s %Y-%m-%d'),\"-\") as timeConfirm ,`payment`.`picPath`FROM `payment`
    INNER JOIN `date` ON `date`.`dateId` = `payment`.`dateId` 
    INNER JOIN `agreement` ON `agreement`.`agreeId` = `payment`.`agreeId`
    INNER JOIN `room` ON `room`.`rid` = `agreement`.`rid` WHERE `payment`.`pId`=$pId";
    $DATA = selectDataOne($sql);
    $check = 0;
    $content = "";
    if ($DATA['status'] == "ยืนยันแล้ว") {
        $check = 1;
    }
    $content .= "<div class=\"modal-header\" style=\"background-color:#00ace6\">";
    if ($check == 1)
        $content .= "<h4 class=\"modal-title\" style=\"color:white\">รายละเอียดการชำระค่าเช่า</h4>";
    else
        $content .= "<h4 class=\"modal-title\" style=\"color:white\">ยืนยันการชำระค่าเช่า</h4>";
    $content .= "</div>";
    $content .= "<div class=\"modal-body\" id=\"addModalBody\" style=\"font-size:25px\">";
    $content .= "   <div class=\"row mb-3\">
                        <div class=\"col-xl-4 col-2 text-right \">
                            <span>ห้อง:</span>
                        </div>
                        <div class=\"col-xl-6 col-6 \">
                            <span>{$DATA['rnumber']}</span>
                        </div>
                    </div>";
    $content .= "   <div class=\"row mb-3\">
                        <div class=\"col-xl-4 col-2 text-right \">
                            <span>เดือนที่ชำระ:</span>
                        </div>
                        <div class=\"col-xl-6 col-6 \">
                            <span>เดือน $month ปีพุทธศักราช $year</span>
                        </div>
                    </div>";
    $content .= "   <div class=\"row mb-3\">
                        <div class=\"col-xl-4 col-2 text-right \">
                            <span>ค่าน้ำ:</span>
                        </div>
                        <div class=\"col-xl-6 col-6 \">
                            <span>{$DATA['waterb']} (บาท) x {$DATA['waterUnit']} (ยูนิต) = {$DATA['costwater']} บาท</span>
                        </div>
                    </div>";
    $content .= "   <div class=\"row mb-3\">
                        <div class=\"col-xl-4 col-2 text-right \">
                            <span>ค่าไฟ:</span>
                        </div>
                        <div class=\"col-xl-6 col-6 \">
                            <span>{$DATA['elecb']} (บาท) x {$DATA['elecUnit']} (ยูนิต) = {$DATA['costelec']} บาท</span>
                        </div>
                    </div>";
    $content .= "   <div class=\"row mb-3\">
                        <div class=\"col-xl-4 col-2 text-right \">
                            <span>ค่าห้องและค่าอื่นๆ:</span>
                        </div>
                        <div class=\"col-xl-6 col-6 \">
                            <span>{$DATA['commonf']} บาท</span>
                        </div>
                    </div>";
    $content .= "   <div class=\"row mb-3\">
                        <div class=\"col-xl-4 col-2 text-right \">
                            <span>ยอดที่ต้องชำระ:</span>
                        </div>
                        <div class=\"col-xl-6 col-6 \">
                            <span>{$DATA['paymentAll']} บาท</span>
                        </div>
                    </div>";
    $content .= "   <div class=\"row mb-3\">
                        <div class=\"col-xl-4 col-2 text-right \">
                            <span>วันเวลาที่ส่งสลิป:</span>
                        </div>
                        <div class=\"col-xl-6 col-6 \">
                            <span>{$DATA['timeSlip']}</span>
                        </div>
                    </div>";
    $content .= "   <div class=\"row mb-3\">
                        <div class=\"col-xl-4 col-2 text-right \">
                            <span>วันเวลาที่ยันยืน:</span>
                        </div>
                        <div class=\"col-xl-6 col-6 \">
                            <span>{$DATA['timeConfirm']}</span>
                        </div>
                    </div>";
    $content .= "   <div class=\"row mb-4\">
                        <div ALIGN=\"center\">
                            <img src=\"../../{$DATA['picPath']}\" style=\"width:50%\">
                        </div>
                    </div>";
    $content .= " <input type=\"hidden\" class=\"form-control\" id=\"IDpayment\" name=\"IDpayment\" value=\"$pId\">";
    $content .= " <input type=\"hidden\" class=\"form-control\" id=\"action\" name=\"action\" value=\"conf\">";
    $content .= " <input type=\"hidden\" class=\"form-control\" id=\"dateID\" name=\"dateID\" value=\"{$DATA['dateId']}\">";
    $content .= "</div>";
    $content .= "<div class=\"modal-footer\">";
    if ($check == 1) {
        $content .= "   <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">ปิด</button>";
    } else {
        $content .= "   <button type=\"submit\" class=\"btn btn-success\" >ยืนยัน</button>
                        <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">ยกเลิก</button>";
    }
    $content .= "</div>";

    echo $content;
    // $arr = array();
    // foreach ($DATA as $key => $value) {

    // }

} else if ($action == "conf") {
    $IDpayment = $_POST['IDpayment'];
    $dateID = $_POST['dateID'];
    $idsuersubmit = $USER['uid'];
    $time = time();
    $sql = "UPDATE `payment` SET `uid` = '$idsuersubmit', `timeConfirm` = '$time', `status` = 'ยืนยันแล้ว'  WHERE `payment`.`pId` =  $IDpayment";
    updateData($sql);
    header("location:./detailPayment.php?dateID=$dateID");
} else if ($action == "checkPayment") {
    header('Content-Type: application/json');
    $time = time();
    $month = (int) (date("m", $time));
    $year = (int) (date("Y", $time) + 543);
    $sql = "SELECT * FROM `date` WHERE `month`=$month AND `year`=$year";
    $DATA = selectDataOne($sql);
    $arr = array();

    if (is_null($DATA)) {
        $arr['type'] = 1;
        $sql = "INSERT INTO `date` (`dateId`, `month`, `year`) VALUES (NULL, '$month', '$year')";
        $arr['iddate'] = (int) addinsertData($sql);
        $sql = "SELECT * FROM `config` WHERE `config_key` = \"WaterBil\" OR   `config_key` = \"ElectricityBill\" OR  `config_key` = \"CommonFee\"";
        $CONFIG = selectData($sql);
        for ($i = 1; $i <= $CONFIG[0]['numrow']; $i++) {
            $arr[$CONFIG[$i]['config_key']] = (int) $CONFIG[$i]['config_value'];
        }
    } else {
        $arr['iddate'] = (int) $DATA['dateId'];
        $sql = "SELECT * FROM `payment` INNER JOIN `date` ON `date`.`dateId` = `payment`.`dateId`
         WHERE `month`=$month AND `year`=$year";
        $DATA2 = selectData($sql);
        if ($DATA2[0]['numrow'] == 0) {
            $arr['type'] = 1;
            $sql = "SELECT * FROM `config` WHERE `config_key` = \"WaterBil\" OR   `config_key` = \"ElectricityBill\" OR  `config_key` = \"CommonFee\"";
            $CONFIG = selectData($sql);
            for ($i = 1; $i <= $CONFIG[0]['numrow']; $i++) {
                $arr[$CONFIG[$i]['config_key']] = (int) $CONFIG[$i]['config_value'];
            }
        } else {
            $arr['type'] = 0;
        }
    }
    echo json_encode($arr);
}
