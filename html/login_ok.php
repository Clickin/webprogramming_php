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
$password = password_hash($_POST['user_pw']);
$sql = "SELECT password FROM account WHERE id = $id";
$result = $con->query($sql);
$row = mysqli_fetch_assoc($result);
if ($result->num_rows = 1 && password_verify($password, $row['password'] )) {
    $_SESSION['is_logged'] = 'YES';
    $_SESSION['user_id'] = $id;
    mysqli_close($con);
    echo '<meta http-equiv="refresh" content="0; url=./index.php"></meta>';
}
else {
    $error = "아이디 혹은 비밀번호가 일치하지 않습니다.";
    mysqli_close($con);
    echo $error;
    echo "<script>history.back();</script>";
}
?>