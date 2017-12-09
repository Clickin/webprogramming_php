<meta charset="utf-8">
<?php
session_start();
include("connect.php");
$error = "";
if (isset($_POST['login'])) {
    if (empty($_POST['user_id']) || empty($_POST['user_pw'])) {
        $error = "항목을 기입하셔야 합니다.";
    }
}
$id = $_POST['user_id'];
$password = $_POST['user_pw'];
$sql = "SELECT * FROM account WHERE id = '$id'";
$result = $con->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
if (password_verify($password, $row['password'] )) {
    $_SESSION['is_logged'] = 'YES';
    $_SESSION['user_id'] = $id;
    mysqli_close($con);
    echo "<script>history.go(-2);</script>";
    exit();
}
else {
    $error = "아이디 혹은 비밀번호가 일치하지 않습니다.";
    mysqli_close($con);
    echo "<script>history.back();</script>";
    
}
echo "<script>alert('$error')</script>";

exit;
?>