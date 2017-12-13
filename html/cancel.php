<html>
<?php 
include("navbar.php");
include("connect.php");
if (empty($_SESSION)) {
    echo "<script>alert(\"로그인이 필요한 서비스입니다\");</script>";
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
}
$id = $_SESSION['user_id'];
$reserve_uid = $_GET['']
$sql = "SELECT "
?>

<body>

</body>
</html>