<meta charset="utf-8">
<?php
session_start();
include("connect.php");
$error = "";

if (isset($_POST['submit'])) {
    if (empty($_POST['user_id']) || empty($_POST['user_pw'])) {
        $error = "항목을 기입하셔야 합니다.";
    }
}
$id = $_POST['user_id'];
$password = password_hash($_POST['user_pw'], PASSWORD_DEFAULT);
$password2 = $_POST['user_pw2'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$checked = $_POST['agree'];
$duplicate = $_POST['use'];
if (!password_verify($password2, $password)) {
    $error = "비밀번호가 일치하지 않습니다";
}
else if ($duplicate == '0') {
    $error = "중복확인을 하지 않으셨습니다";
}
else if ($checked != "Yes") {
    $error = "약관에 동의하지 않으셨습니다";
}
else {
    $sql = "INSERT INTO account (id, password, phone, name, reserve_uid) ";
    
    $sql = $sql."VALUES ('$id','$password','$phone','$name', NULL);";
    $result = $con->query($sql);
    echo $sql;
    if ($result === true) {
        $_SESSION['is_logged'] = 'YES';
        $_SESSION['user_id'] = $id;
        mysqli_close($con);
        echo "<script>history.go(-2);</script>";
        
    }
    else {
        $error = $con->error;
        
    }

}
echo "<script>alert('$error');</script>";
echo "<script>history.back();</script>";
exit;
?>