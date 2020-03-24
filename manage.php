<?php
header('Content-Type: application/json');
require_once("./dbConnect.php");
$uername = $_POST['username'];
$sql = "SELECT * FROM user WHERE username ='$uername' AND isDelete = 0";
$DATAUSER = selectDataOne($sql);
$arr = array();
if (is_null($DATAUSER)) {
    $arr['output'] = 1;
} else {
    $arr['output'] = 2;
    $sql = "SELECT config_value FROM user WHERE config_key ='Email'";
    $Config = selectDataOne($sql);
    $password = $DATAUSER['password'];
    $EmailSend = $Config['config_value'];
    $EmailDest = $DATAUSER['email'];
    $arr['Email'] = $EmailDest;
    require("./lib/PHPMailer/PHPMailerAutoload.php");
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
    $subject = "รหัสผ่าน"; // หัวข้อเมล์ 
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
                    <h2>รหัสผ่านของคุณ คือ: <strong style='color:#0000ff;'> $password </strong></h2>
                    
                </div>
                
            </div>
           
        </body>
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
echo json_encode($arr);
