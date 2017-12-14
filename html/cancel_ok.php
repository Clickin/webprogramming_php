<meta charset="utf-8">
<?php
session_start();
include("connect.php");
$error = "";
$movie_uid = $_POST['movie_uid'];
$seat = explode(",",$_POST['seat']);
var_dump($_POST['ticket']);
$id = $_SESSION['user_id'];

$date = date(DATE_ATOM);
if (empty($_SESSION['user_id'])) {
    $error = "로그인이 필요한 서비스입니다";
}/*
else {
    //Update seats first
    foreach ($seat as $row) {
        $sql = "UPDATE seats SET valid = 0 WHERE movie_uid = '$movie_uid' AND seat_uid = '$row'";
        $con->query($sql);
    }
    $sql = "SELECT theater_uid FROM movies WHERE movie_uid = '$movie_uid'";
    //bring theater_uid
    $theater_result = $con->query($sql)->fetch_assoc()['theater_uid'];
    
    foreach ($seat as $row) {
        //insert tickets
        $sql = "INSERT INTO tickets(movie_uid, seat_uid, theater_uid)";
        $sql = $sql. " VALUES ($movie_uid,$row,$theater_result)";
        $con->query($sql);
        //bring ticket_uid
        $sql = "SELECT MAX(ticket_uid) FROM tickets";
        $ticket_uid = $con->query($sql)->fetch_assoc()['MAX(ticket_uid)'];
        //insert reservation
        $sql = "INSERT INTO reservation(ticket_uid, reserved_date, user_id)";
        $sql = $sql. " VALUES ($ticket_uid,$date,$id)";
        $con->query($sql);
    }
    echo "<script>alert('예매되었습니다')";
    echo "<script>history.back();</script>";
}
echo "<script>alert('$error')";
*/
