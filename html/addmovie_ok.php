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
$pic_name = $_FILES['pic']['name'];
if (!is_uploaded_file($_FILES['pic']['tmp_name'])) {
    $error = "사진이 업로드되지 않았습니다.";

}
$sql = "INSERT INTO movies(screen_date, screen_time, movie_name, theater_uid, pic) ";
$sql = $sql . "VALUES ('$day','$time','$name','$theater','$pic_name');";
$result = $con->query($sql);
$sql = "SELECT MAX(movie_uid) FROM movies";
$result = $con->query($sql);
$movie_uid = $result->fetch_array(MYSQLI_ASSOC);
$movie_uid = $movie_uid['MAX(movie_uid)'];

for ($i = 0; $i < 156; $i++) {
    $sql = "INSERT INTO seats(seat_uid, theator_uid, movie_uid, valid)";
    $sql = $sql. "VALUES ('$i','$theater','$movie_uid','0')";
    $con->query($sql);
    
}

if (!empty($result)) {
    mysqli_close($con);
    $uploaddir = './pic/';
    $uploadfile = $uploaddir. basename($_FILES['pic']['name']);
    if (move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile)) {
        echo "<script>history.back();</script>";
        exit();
    } else {
        $error = "파일 업로드 실패";
    }
    echo "<script>history.back();</script>";
    exit();
}
else {
    $error = "DB에 연결하지 못했습니다.";
    mysqli_close($con);
    
}
echo "<script>alert('$error')</script>";
exit();
?>