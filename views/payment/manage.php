<?php
session_start();
require_once('../../dbConnect.php');
require("../../lib/PHPMailer/PHPMailerAutoload.php");
$action = $_POST['action'] ?? "";
$USER = $_SESSION['DATAUSER'];
$arrMonth = array("-", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
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
} else if ($action == "addpayment") {
    $addmonthID = $_POST['addmonthID'];
    $addyear = $_POST['addyear'];
    $inputwater = $_POST['inputwater'];
    $inputelec = $_POST['inputelec'];
    $inputcomf = $_POST['inputcomf'];
    $hiddeniddate = $_POST['hiddeniddate'];
    $arraid = $_POST['aid'];
    $arrwater = $_POST['water'];
    $arrelec = $_POST['eclec'];
    $arrrent = $_POST['rent'];
    $arremail = $_POST['email'];
    $arrername = $_POST['rname'];
    $valpay = array();
    $allpay = array();
    $sql = "SELECT * FROM `config` WHERE config_key = 'Account' OR config_key = 'Bank' ";
    $DATA = selectData($sql);
    $Account = "{$DATA[1]['config_value']} ({$DATA[2]['config_value']})";
    $sql = "SELECT * FROM `date` WHERE dateId = $hiddeniddate";
    $DATA = selectDataOne($sql);
    for ($i = 0; $i < count($arraid); $i++) {
        $valpay[$i] = $inputcomf + $arrrent[$i];
        $allpay[$i] = $valpay[$i] + ($inputwater * $arrwater[$i]) + ($arrelec[$i] * $inputelec);
        $sql = "INSERT INTO `payment` (`pId`, `agreeId`, `dateId`, `waterb`, `waterUnit`, `elecb`, `elecUnit`, `commonf`, `paymentAll`, `timeSlip`, `uid`, `timeConfirm`, `picPath`, `status`) VALUES (NULL, '{$arraid[$i]}', '$hiddeniddate', '$inputwater', '{$arrwater[$i]}', '$inputelec', '{$arrelec[$i]}', '{$valpay[$i]}', '{$allpay[$i]}', NULL, NULL, NULL, NULL, 'ยังไม่ได้จ่าย')";
        addinsertData($sql);
    }
    for ($i = 0; $i < count($arraid); $i++) {

        $mail = new PHPMailer;
        $mail->CharSet = "utf-8";
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $gmail_username = "sopon0369@gmail.com"; // gmail ที่ใช้ส่ง
        $gmail_password = "toyai0369"; // รหัสผ่าน gmail
        // ตั้งค่าอนุญาตการใช้งานได้ที่นี่ https://myaccount.google.com/lesssecureapps?pli=1
        $sender = "YuDeeMeeSuk Dormitory"; // ชื่อผู้ส่ง
        $email_sender = "sopon0369@gmail.com"; // เมล์ผู้ส่ง 
        $email_receiver = $arremail[$i]; // เมล์ผู้รับ ***
        $subject = "ใบแจ้งค่าเช่าห้อง {$arrername[$i]} เดือน {$arrMonth[$DATA['month']]} ปี {$DATA['year']} "; // หัวข้อเมล์ 
        $mail->Username = $gmail_username;
        $mail->Password = $gmail_password;
        $mail->setFrom($email_sender, $sender);
        $mail->addAddress($email_receiver);
        $mail->Subject = $subject;
        $email_content = "
                            <!DOCTYPE html>
                            <html>

                            <head>
                                <meta charset=\"utf-8\">
                                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                                <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css\">
                                <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
                                <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js\"></script>
                                <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js\"></script>
                            </head>
                            <center>

                                <body>
                                    <h1 style='background: #bf4040;padding: 10px 0 20px 10px;margin-bottom:10px;font-size:30px;color:white;'>
                                    ใบแจ้งค่าเช่าห้อง
                                    </h1>
                                    <div style='padding:20px;'>
                                        <div class=\"container-fluid\">
                                            <div class=\"card shadow mb-4\">
                                                <div class=\"card\">
                                                    <div class=\"card-header card-bg \" style=\"background-color: #bf4040\">
                                                        <span class=\"link-active \" style=\"font-size: 30px; color:white;\">ประจำเดือน {$arrMonth[$DATA['month']]} ปี {$DATA['year']} </span>
                                                    </div>
                                                </div>
                                                <div class=\"card-body\" style=\"font-size: 20px\">
                                                    <div class=\"row mb-3\">
                                                        <div class=\"col-xl-4 col-2 text-right \">
                                                            <span>ห้อง:</span>
                                                        </div>
                                                        <div class=\"col-xl-6 col-6 \">
                                                            <span>{$arrername[$i]}</span>
                                                        </div>
                                                    </div>
                                                    <div class=\"row mb-3\">
                                                        <div class=\"col-xl-4 col-2 text-right \">
                                                            <span>เดือนที่ชำระ:</span>
                                                        </div>
                                                        <div class=\"col-xl-6 col-6 \">
                                                            <span>เดือน {$arrMonth[$DATA['month']]} ปี {$DATA['year']}</span>
                                                        </div>
                                                    </div>
                                                    <div class=\"row mb-3\">
                                                        <div class=\"col-xl-4 col-2 text-right \">
                                                            <span>ค่าน้ำ:</span>
                                                        </div>
                                                        <div class=\"col-xl-6 col-6 \">
                                                            <span>$inputwater (บาท) x {$arrwater[$i]} (ยูนิต) = " . $inputwater * $arrwater[$i] . " บาท</span>
                                                        </div>
                                                    </div>
                                                    <div class=\"row mb-3\">
                                                        <div class=\"col-xl-4 col-2 text-right \">
                                                            <span>ค่าไฟ:</span>
                                                        </div>
                                                        <div class=\"col-xl-6 col-6 \">
                                                            <span>$inputelec (บาท) x{$arrelec[$i]} (ยูนิต) = " . $inputelec * $arrelec[$i] . " บาท</span>
                                                        </div>
                                                    </div>
                                                    <div class=\"row mb-3\">
                                                        <div class=\"col-xl-4 col-2 text-right \">
                                                            <span>ค่าห้องและค่าอื่นๆ:</span>
                                                        </div>
                                                        <div class=\"col-xl-6 col-6 \">
                                                            <span>{$valpay[$i]} บาท</span>
                                                        </div>
                                                    </div>
                                                    <div class=\"row mb-3\">
                                                        <div class=\"col-xl-4 col-2 text-right \">
                                                            <span>ยอดที่ต้องชำระ:</span>
                                                        </div>
                                                        <div class=\"col-xl-6 col-6 \">
                                                            <span>{$allpay[$i]} บาท</span>
                                                        </div>
                                                    </div>
                                                    <div class=\"row mb-3\">
                                                        <div class=\"col-xl-4 col-2 text-right \">
                                                            <span>บัญชีที่ชำระ:</span>
                                                        </div>
                                                        <div class=\"col-xl-6 col-6 \">
                                                            <span> $Account </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </body>
                            </center>


                            </html>
                        ";
        if ($email_receiver) {
            $mail->msgHTML($email_content);


            if (!$mail->send()) {  // สั่งให้ส่ง email

                // กรณีส่ง email ไม่สำเร็จ
                //echo "<h3 class='text-center'>ระบบมีปัญหา กรุณาลองใหม่อีกครั้ง</h3>";
                //echo $mail->ErrorInfo; // ข้อความ รายละเอียดการ error
            } else {

                // กรณีส่ง email สำเร็จ
                //echo "ระบบได้ส่งข้อความไปเรียบร้อย";
            }
        }
    }
    header("location:./payment.php");
}
