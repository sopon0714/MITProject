<?php
require_once("../../dbConnect.php");
session_start();

if (isset($_POST['addPic']) && !empty($_FILES["file"]["name"])) {
    //$pic = $_POST['file'];
    $upload_image = $_FILES['file']["name"];
    $file = $_FILES['file'];
    echo $_FILES['file']['size'];
    $fileName = basename($upload_image);
    $pId = $_POST['e_pId'];
    $sql = "SELECT user.uid FROM `payment` 
    INNER JOIN agreement ON agreement.agreeId = payment.agreeId
    INNER JOIN user ON user.uid = agreement.uid
    INNER JOIN date on date.dateId = payment.dateId WHERE payment.pId =$pId ORDER BY `payment`.`dateId`  DESC";
    $data = selectDataOne($sql);
    $id = $data['uid'];

    if (!file_exists("../../pic/$id")) {
        mkdir("../../pic/$id");
        move_uploaded_file($_FILES["file"]["tmp_name"], "../../pic/$id/" . $_FILES["file"]["name"]);
        //file_put_contents("../../pic/$id/$fileName", "");
    } else {
        move_uploaded_file($_FILES["file"]["tmp_name"], "../../pic/$id/" . $_FILES["file"]["name"]);
        //file_put_contents("../../pic/$id/$fileName", "");
    }

    $time = time();
    $sqlUploadPIC = "UPDATE payment SET `picPath`='pic/$id/$fileName' ,timeSlip ='$time' WHERE pId='$pId' ";
    echo $sqlUploadPIC;
    updateData($sqlUploadPIC);
    //header("location:./paymentuser.php");
}
if (isset($_POST['action'])) {

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
    $content .= "<h4 class=\"modal-title\" style=\"color:white\">รายละเอียดการชำระค่าเช่า</h4>";
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
    $content .= "   <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">ปิด</button>";

    $content .= "</div>";

    echo $content;
    // $arr = array();
    // foreach ($DATA as $key => $value) {

    // }
}