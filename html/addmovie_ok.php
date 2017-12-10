<meta charset="utf-8">
<?php
session_start();
include("connect.php");
$error = "";

if ($_SESSION['user_id'] != "admin") {
    echo "<script>alert(\"관리자 계정이 아닙니다.\");</script>";
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}
$name = $_POST['name'];
$day = $_POST['day'];
$time = $_POST['time'];
$theater = $_POST['theater'];
$pic_name = basename($_FILES['pic']['name']);
if (is_uploaded_file($_FILES['pic']['tmp_name'])) {
    $error = "사진이 업로드되지 않았습니다.";

}
$sql = "INSERT INTO movies(screen_date, screen_time, movie_name, theater_uid, pic) ";
$sql = $sql . "VALUES ('$day','$time','$name','$theater','$pic_name');";
$result = $con->query($sql);
if ($result === true) {
    mysqli_close($con);
    $uploaddir = './pic/';
    $uploadfile = $uploaddir. basename($_FILES['pic']['name']);
    if (move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile)) {
        echo "<script>history.back();</script>";
        exit();
    } else {
        $error = "파일 업로드 실패";
    }
    exit;
}
else {
    $error = "DB에 연결하지 못했습니다.";
    mysqli_close($con);
    
}
echo "<script>alert('$error')</script>";
exit;
?>