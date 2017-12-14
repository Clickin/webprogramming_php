<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<?php
include("connect.php");
session_start();
if (empty($_SESSION)) {
    echo "<script>alert(\"로그인이 필요한 서비스입니다\");</script>";
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
}
$id = $_SESSION['user_id'];
$sql = "DELETE FROM account WHERE id = '$id'";
$con->query($sql);
echo "<script>alert('탈퇴되었습니다');</script>";
echo "<meta http-equiv='refresh' content='0;url=index.php'>";
?>
