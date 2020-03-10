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
} else if ($action  == "changeemail") {
    header('Content-Type: application/json');
    $arr = array();
    $uid = $_POST['userid'];
    $emailEdit = $_POST['emailEdit'];
    $sql = "SELECT * FROM user WHERE `user`.`uid` = $uid AND isDelete = 0";
    $DATAUSER = selectDataOne($sql);
    $sql = "SELECT config_value FROM user WHERE config_key ='Email'";
    $Config = selectDataOne($sql);
    $EmailSend = $Config['config_value'];
    $EmailDest = $emailEdit;
    require("../../lib/PHPMailer/PHPMailerAutoload.php");
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
    $email_sender = $EmailSend; // เมล์ผู้ส่ง 
    $email_receiver = $EmailDest; // เมล์ผู้รับ ***
    $subject = "ยืนยันการเปลี่ยนEmail"; // หัวข้อเมล์ 
    $mail->Username = $gmail_username;
    $mail->Password = $gmail_password;
    $mail->setFrom($email_sender, $sender);
    $mail->addAddress($email_receiver);
    $mail->Subject = $subject;
    $email_content = "
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset='utf-8'/>
        </head>
        <body>
            <h1 style='background: #E91E63;padding: 10px 0 20px 10px;margin-bottom:10px;font-size:30px;color:white;' >
            ระบบบริหารจัดการหอพัก
            </h1>
            <div style='padding:20px;'>
                
                <div>             
                    <h2>ยืนยันการเปลี่ยนEmail: <strong style='color:#0000ff;'></strong></h2>
                    <a href='http://127.0.0.1/MITProject/views/profile/changeemail.php?token=" . md5($uid . $emailEdit) . "&ID=$uid&email=$emailEdit&t=" . (time() + 60 * 5) . "' target='_blank'>
                            <h1><strong style='color:#3c83f9;'> >> กรุณาคลิ๊กที่นี่ เพื่อยืนยัน<< </strong> </h1>
                        </a>
                    
                </div>
                
            </div>
           
        </body>
    </html>
";
    if ($email_receiver) {
        $mail->msgHTML($email_content);


        if (!$mail->send()) {  // สั่งให้ส่ง email
            $arr['output'] = 2;
            // กรณีส่ง email ไม่สำเร็จ
            //echo "<h3 class='text-center'>ระบบมีปัญหา กรุณาลองใหม่อีกครั้ง</h3>";
            //echo $mail->ErrorInfo; // ข้อความ รายละเอียดการ error
        } else {
            $arr['output'] = 1;
            // กรณีส่ง email สำเร็จ
            //echo "ระบบได้ส่งข้อความไปเรียบร้อย";
        }
    }
    echo json_encode($arr);
} else {
    header("location:../../index.php");
}
