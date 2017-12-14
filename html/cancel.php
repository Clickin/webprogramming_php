<html>
<?php 
$title = "예매취소";
include("navbar.php");
include("connect.php");
if (empty($_SESSION)) {
    echo "<script>alert(\"로그인이 필요한 서비스입니다\");</script>";
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
}
$id = $_SESSION['user_id'];
if (!empty($_GET)) {
    $movie_uid = $_GET['movie_id'];
    $sql = "SELECT T.seat_uid, T.ticket_uid, R.reserve_uid, M.movie_name, M.pic FROM tickets T, reservation R, movies M ";
    $sql = $sql . "WHERE R.user_id = '$id' AND T.movie_uid = '$movie_uid' AND M.movie_uid = '$movie_uid'";
    $cancel_result = $con->query($sql)->fetch_assoc() or die('Error :' . $con->error);
    $sql = "SELECT seat_uid FROM seats WHERE movie_uid = '$movie_uid' AND valid = '1'";
    $seat_occupied = array();
    $seat_reserved = array();
    $list = array("A","B","C","D","E","F","G","H","I","J","K","L");
    $num = array("01","02","03","04","05","06","07","08","09","10","11","12","13");
    while($row = $cancel_result) {
        array_push($seat_reserved, $row['seat_uid']);
    }
    
    foreach ($con->query($sql)->fetch_assoc() as $row) {
        if (!in_array($row['seat_uid'], $seat_reserved)) {
            array_push($seat_occupied, $row['seat_uid']);
        }
    }
    

}
else {
    $sql = "SELECT M.movie_uid, M.movie_name, M.screen_time, M.screen_date, T.theater_uid, R.reserved_date ";
    $sql = $sql . "FROM movies M, reservation R, tickets T ";
    $sql = $sql. "WHERE R.user_id = '$id' AND R.ticket_uid = T.ticket_uid AND T.movie_uid = M.movie_uid";
    $reserve_result = $con->query($sql) or die('Error :' . $con->error);
    
}


?>
<link rel="stylesheet" href="./css/screen.csss">
<body>
<div class="container">
<div class="row">
    <?php if (empty($_GET)) {?>
        <div class="col-md-6">
        <h1>예매 내역</h1>
        <form method="get" action="./cancel.php" role="form">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>선택</th>
                    <th>영화이름</th>
                    <th>예매일자</th>
                    <th>상영일자</th>
                    <th>상영시간</th>
                    <th>상영관</th>                      
                </tr>
            </thead>
            <tbody>
            <?php foreach ($reserve_result as $row) { ?>
                <tr>
                    <td><input type="radio" name="movie_uid" value="<?php echo $row['movie_uid'] ?>" required></td>
                    <td><?php echo $row['movie_name']?></td>
                    <td><?php echo $row['reserved_date']?></td>
                    <td><?php echo $row['screen_date']?></td>
                    <td><?php echo $row['screen_time']?></td>
                    <td><?php echo $row['theater_uid']?></td>
                    
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <input type="submit" class="btn btn-info pull-right" value="예매 취소">
        </form>
        </div>
    <?php } ?>
    <?php if(!empty($_GET)) { ?>
    <div class="col-md-6">
        <h1> <?php echo $cancel_result['movie_name']; ?><h1>
        <img src="./pic/<?php echo $cancel_result['pic']; ?>" style="width:300px;height:370px;border:1px;">
        <div class="screen">screen</div>
        <table border = 1 width = 300px class="seat">
        <?php
            $uid = 0;
            for ($i = 0; $i < 12; $i++) {
                echo "<tr><td>" .$list[$i] . "</td>";
                for ($j = 0; $j < 13; $j++) {
                    if (in_array($uid, $seat_reserved)) {
                        echo "<td onclick=add($uid) style='background-color:red;'>$num[$j]</td>";
                    }
                    else if (in_array($uid, $seat_occupied)) {
                        echo "<td style='background-color:gray;'>X</td>";
                    }
                    else {
                        echo "<td>$num[$j]</td>";
                    }
                    $uid++;
                }

            }
        ?>
    </div>
    <?php } ?>
    </div>
    </div>
</body>
</html>