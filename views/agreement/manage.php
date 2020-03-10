<?php
require_once("../../dbConnect.php");
session_start();
// ********************************************Agreement*************************************************
if (isset($_POST['add'])) {
    $arr = array();
    $rnumber = $_POST['rnumber'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $title = $_POST['title'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $formalId = $_POST['formalId'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqluser = "INSERT INTO user ( uid, `username`, `password` , type , title , firstname , lastname ,formalId ,email , phoneNumber ,status , isDelete) 
    VALUES ( NULL, '$username', '$password' ,'ผู้เช่า','$title','$firstname','$lastname','$formalId','$email','$phoneNumber','รอยืนยัน', 0 )";
    echo $sqluser;
    addinsertData($sqluser);
    // $rid = "SELECT rid FROM `room` WHERE room.rnumber = $rnumber";
    // echo $rnumber;
    //$r_rid = selectData($rid);
    $uid = "SELECT user.uid as uid FROM user where user.firstname = '$firstname' && user.lastname = '$lastname'";
    $u_uid = selectData($uid);
    echo ($u_uid[1]['uid']);
    $userID = ($u_uid[1]['uid']);
    // $update = ($r_rid[1]['rid']);

    $sqlagree = "INSERT INTO agreement ( agreeId,`rid`, `uid`, `startDate`, `endDate`) VALUES ( NULL,'$rnumber', '$userID', '$startDate', '$endDate' )";
    echo $sqlagree;
    addinsertData($sqlagree);

    $sqlUpdateStatus = "UPDATE `room` SET `status` = 'ไม่ว่าง' WHERE `room`.`rid` =  '$rnumber'";
    updateData($sqlUpdateStatus);

    $sql = "SELECT * FROM user WHERE `user`.`uid` = $userID AND isDelete = 0";
    $DATAUSER = selectDataOne($sql);
    $sql = "SELECT config.config_value FROM config WHERE config.config_key ='Email'";
    $Config = selectData($sql);
    $EmailSend = $Config[1]['config_value'];
    $EmailDest = $email; //>>>>>>>>>>>>>>>>>>>>>>>>>
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
    $email_receiver = $email; // เมล์ผู้รับ *** >>>>>>>>>>>>
    $subject = "ยืนยันผู้เข้าหอพัก"; // หัวข้อเมล์ 
    $mail->Username = $gmail_username;
    $mail->Password = $gmail_password;
    $mail->setFrom($email_sender, $sender);
    $mail->addAddress($email_receiver);
    $mail->Subject = $subject;
    $email_content = "
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset=utf-8'/>
        </head>
        <body>
            <h1 style='background: #E91E63;padding: 10px 0 20px 10px;margin-bottom:10px;font-size:30px;color:white;' >
            ระบบบริหารจัดการหอพัก
            </h1>
            <div style='padding:20px;'>
                
                <div>             
                    <h2>ยืนยันการสมัคร: <strong style='color:#0000ff;'></strong></h2>
                    <a href='http://127.0.0.1/MITProject/views/agreement/acceptEmail.php? &ID=$userID ' target='_blank'>
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
    header("location:./agreement.php");
}
if (isset($_POST['delete'])) {
    $uid = $_POST['uid'];
    $sql = "UPDATE user SET isDelete = 1  WHERE user.uid =  $uid";
    updateData($sql);

    $sqlrid = "SELECT room.rid as rid FROM `room` INNER JOIN agreement ON agreement.rid = room.rid
    INNER JOIN user ON user.uid=agreement.uid
    WHERE user.uid = $uid";
    $ridselect = selectData($sqlrid);
    $rid = $ridselect[1]['rid'];

    $sqlUpdateRoom = "UPDATE `room` SET `status` = 'ว่าง' WHERE `room`.`rid` = $rid";
    updateData($sqlUpdateRoom);
}
if (isset($_POST['edit'])) {
    $e_idAgree = $_POST['e_idAgree'];
    $e_rnumber = $_POST['e_rnumber'];
    $e_startDate = $_POST['e_startDate'];
    $e_endDate = $_POST['e_endDate'];
    $e_rid = $_POST['e_rid'];
    echo ("$e_idAgree    ");
    echo ("$e_rnumber    ");
    echo "$e_startDate    ";
    echo "$e_endDate     ";
    echo "$e_rid";
    $sql_editAgree = "UPDATE agreement SET rid = '$e_rnumber', startDate ='$e_startDate', `endDate` = '$e_endDate' WHERE agreement.agreeId =  $e_idAgree";
    updateData($sql_editAgree);
    if ($e_rid != $e_rnumber) {
        $sql_statusOld = "UPDATE room SET status = 'ว่าง' WHERE room.rid = $e_rid";
        updateData($sql_statusOld);
    }
    $sql_statusNew = "UPDATE room SET status = 'ไม่ว่าง' WHERE room.rid = $e_rnumber";
    updateData($sql_statusNew);

    header("location:./agreement.php");
}
// ********************************************Admin*************************************************
if (isset($_POST['addAdmin'])) {
    $title = $_POST['title'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $formalId = $_POST['formalId'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqluser = "INSERT INTO user ( uid, `username`, `password` , type , title , firstname , lastname ,formalId ,email , phoneNumber ,status , isDelete) 
    VALUES ( NULL, '$username', '$password' ,'ผู้ดูแลระบบ','$title','$firstname','$lastname','$formalId','$email','$phoneNumber','รอยืนยัน', 0 )";
    echo $sqluser;
    addinsertData($sqluser);

    $uid = "SELECT user.uid as uid FROM user where user.firstname = '$firstname' && user.lastname = '$lastname'";
    $u_uid = selectData($uid);
    echo ($u_uid[1]['uid']);
    $userID = ($u_uid[1]['uid']);

    $sql = "SELECT * FROM user WHERE `user`.`uid` = $userID AND isDelete = 0";
    $DATAUSER = selectDataOne($sql);
    $sql = "SELECT config.config_value FROM config WHERE config.config_key ='Email'";
    $Config = selectData($sql);
    $EmailSend = $Config[1]['config_value'];
    $EmailDest = $email; //>>>>>>>>>>>>>>>>>>>>>>>>>
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
    $email_receiver = $email; // เมล์ผู้รับ *** >>>>>>>>>>>>
    $subject = "ยืนยันผู้เข้าหอพัก"; // หัวข้อเมล์ 
    $mail->Username = $gmail_username;
    $mail->Password = $gmail_password;
    $mail->setFrom($email_sender, $sender);
    $mail->addAddress($email_receiver);
    $mail->Subject = $subject;
    $email_content = "
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset=utf-8'/>
        </head>
        <body>
            <h1 style='background: #E91E63;padding: 10px 0 20px 10px;margin-bottom:10px;font-size:30px;color:white;' >
            ระบบบริหารจัดการหอพัก
            </h1>
            <div style='padding:20px;'>
                
                <div>             
                    <h2>ยืนยันการสมัคร: <strong style='color:#0000ff;'></strong></h2>
                    <a href='http://127.0.0.1/MITProject/views/agreement/acceptEmail.php? &ID=$userID ' target='_blank'>
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

    header("location:./adminRead.php");
}
if (isset($_POST['deleteAdmin'])) {
    $uid = $_POST['uid'];
    $sql = "UPDATE user SET isDelete = 1  WHERE user.uid =  $uid";
    updateData($sql);
}