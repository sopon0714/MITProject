<?php
session_start();
$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";
if ($username == "" || $password == "") {
    header("location:./index.php?msg=กรุณากรอกข้อมูลให้ครบถ้วน");
} else {
    require_once("./dbConnect.php");
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $DATAUSER = selectDataOne($sql);
    if (is_null($DATAUSER)) {
        header("location:./index.php?msg=username หรือ password ไม่ถูกต้อง");
    } else if ($DATAUSER['isDelete'] == '1') {
        header("location:./index.php?msg=บัญชีของคุณถูกลบแล้ว");
    } else if ($DATAUSER['status'] == "รอยืนยัน") {
        header("location:./index.php?msg=กรุณายืนยันemail:{$DATAUSER['email']}ก่อน");
    } else {
        if (isset($_POST['remember'])) {
            setcookie("username", $username, time() + (10 * 365 * 24 * 60 * 60));
            setcookie("password", $password, time() + (10 * 365 * 24 * 60 * 60));
        } else {
            setcookie("username");
            setcookie("password");
        }
        unset($DATAUSER['password']);
        $_SESSION['DATAUSER'] = $DATAUSER;
        header("location:./views/profile/profile.php");
    }
}
