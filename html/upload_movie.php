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
$pic_name = $_FILE['userfile']['name'];
if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    $error = "사진이 업로드되지 않았습니다.";

}
$sql = "INSERT INTO movies(screen_date, screen_time, movie_name, theater_uid, pic)";
$sql = $sql . "VALUES ($day,$time,$name,$theater,$pic_name)";
$result = $con->query($sql);
$row = mysqli_fetch_assoc($result);
if ($result->num_rows = 1) {
    mysqli_close($con);
    $uploaddir = "/pic";
    $uploadfile = $uploaddir. basename($_FILES['userfile']['name']);
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";
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
echo "<script>history.back();</script>";
exit;
?>