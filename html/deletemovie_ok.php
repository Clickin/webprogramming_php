<meta charset="utf-8">
<?php
session_start();
include("connect.php");
$error = "";

if ($_SESSION['user_id'] != "admin") {
    echo "<script>alert(\"관리자 계정이 아닙니다.\");</script>";
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}

foreach ($_POST['del_list'] as $del) {
    $sql = "DELETE FROM movies WHERE movie_uid = ";
    $sql = $sql. $del;
    $result = $con->query($sql);
}

if (!empty($result)) {
    mysqli_close($con);
    echo "<script>history.back();</script>";
    exit();
    
}
else {
    $error = "DB에 연결하지 못했습니다.";
    mysqli_close($con);
    
}
echo "<script>alert('$error');</script>";