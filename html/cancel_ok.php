<meta charset="utf-8">
<?php
session_start();
include("connect.php");
$error = "";
$movie_uid = $_POST['movie_uid'];
$seat = explode(",",$_POST['seat']);
$ticket = explode(",",$_POST['ticket']);
$id = $_SESSION['user_id'];

$date = date(DATE_ATOM);
if (empty($_SESSION['user_id'])) {
    $error = "로그인이 필요한 서비스입니다";
}
else {
    //Update seats first
    foreach ($seat as $row) {
        $sql = "UPDATE seats SET valid = 0 WHERE movie_uid = '$movie_uid' AND seat_uid = '$row'";
        $con->query($sql);
    }
    
    foreach ($ticket as $row) {
        //delete tickets
        $sql = "DELETE FROM tickets";
        $sql = $sql. " WHERE ticket_uid = '$row'";
        $con->query($sql);
        
        //delete reservation
        $sql = "DELETE FROM reservation";
        $sql = $sql. " WHERE ticket_uid = '$row'";
        $con->query($sql);
    }
    echo "<script>alert('취소되었습니다')</script>";
    echo "<meta http-equiv='refresh' content='0;url=cancel.php?movie_uid=$movie_uid'>";
}
echo "<script>alert('$error')";

