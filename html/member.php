<html>
<?php 
$title = "회원정보";
include("navbar.php");
include("connect.php");
if (empty($_SESSION)) {
    echo "<script>alert(\"로그인이 필요한 서비스입니다\");</script>";
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
}
$id = $_SESSION['user_id'];
$sql = "SELECT * FROM account WHERE id = '$id'";
$account_result = $con->query($sql)->fetch_assoc();
$sql = "SELECT M.movie_name, M.screen_date, M.screen_time, ";
$sql = $sql. "T.theater_uid, T.seat_uid, R.reserved_date ";
$sql = $sql. "FROM reservation R JOIN tickets T ON R.ticket_uid = T.ticket_uid ";
$sql = $sql. "JOIN movies M ON M.movie_uid = T.movie_uid WHERE R.user_id = '$id'";
$reserve_result = $con->query($sql) or die('Error: '.$con->error);
if ($reserve_result === false) {
    echo "<script>alert('DB에러')</script>";
}
?>
<body>
    <div class="container">
        <div class="row">
        
            <div class="col-md-6">
                <h2>회원정보</h2>
                <table class="table">
                    <tr>
                        <td>아이디</td>
                        <td><?php echo $account_result['id']?></td>
                    </tr>
                    <tr>
                        <td>이름</td>
                        <td><?php echo $account_result['name']?></td>
                    </tr>
                    <tr>
                        <td>전화번호</td>
                        <td><?php echo $account_result['phone']?></td>
                    </tr>
                </table>
            </div>
            <hr>
            <div class="col-md-6">
            <h2>예매정보</h2>
            <?php 
            if ($reserve_result->num_rows == 0) {
                echo "예매하신 영화가 없습니다.";
            }
            else {?>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>영화이름</th>
                        <th>상영일자</th>
                        <th>상영시간</th>
                        <th>상영관</th>
                        <th>좌석</th>
                        <th>예매일자</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($reserve_result as $row) : ?>
                    <tr>
                        <td><?php echo $row['movie_name']?></td>
                        <td><?php echo $row['screen_date']?></td>
                        <td><?php echo $row['screen_time']?></td>
                        <td><?php echo $row['theater_uid']?></td>
                        <td><?php echo display_seat($row['seat_uid'])?></td>
                        <td><?php echo $row['reserved_date']?></td>
                        
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="./cancel.php" class="btn btn-info pull-right" role="button">예매 취소</a>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>