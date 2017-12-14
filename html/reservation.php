<html>
<?php 
$title = "영화예매";
include("navbar.php");
include("connect.php");
if (empty($_SESSION)) {
    echo "<script>alert(\"로그인이 필요한 서비스입니다\");</script>";
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
}
$id = $_SESSION['user_id'];
if (isset($_GET['movie_id'])) {
    $movie_uid = $_GET['movie_id'];
    debug($movie_uid);
    $sql = "SELECT seat_uid FROM seats WHERE movie_uid = '$movie_uid' AND valid = 1";
    $reserved_result = $con->query($sql);
    $seat_reserved = array();
    $sql = "SELECT * FROM movies WHERE movie_uid=$movie_uid";
    $movie_result = $con->query($sql);
    $movie_data = $movie_result->fetch_assoc();
    if (!empty($reserved_result)) {
        foreach ($reserved_result as $row) {
            array_push($seat_reserved, $row['seat_uid']);
        }
    }
    
}
else {
    $sql = "SELECT * FROM movies";
    $movie_result = $con->query($sql);
    
}

?>

<style>
.pic-list{border: 2px solid gray;margin: 10px;display: inline-block;}
</style>

<link rel="stylesheet" href="./css/screen.css">
<body>
<div class="container">
<div class="row">
    <?php if (empty($_GET)) {?>
        <div class="col-md-6">
        <h1>영화 목록</h1>
        <form method="get" action="./reservation.php" role="form">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>선택</th>
                    <th>영화이름</th>
                    <th>상영일자</th>
                    <th>상영시간</th>
                    <th>상영관</th>                      
                </tr>
            </thead>
            <tbody>
            <?php foreach ($movie_result as $row) { ?>
                <tr>
                    <td><input type="radio" name="movie_uid" value="<?php echo $row['movie_uid'] ?>" required></td>
                    <td><?php echo $row['movie_name']?></td>
                    <td><?php echo $row['screen_date']?></td>
                    <td><?php echo $row['screen_time']?></td>
                    <td><?php echo $row['theater_uid']?></td>
                    
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <input type="submit" class="btn btn-info pull-right" value="예매하기">
        </form>
        </div>
    <?php } ?>
    <?php if(!empty($_GET)) { ?>
    <div class="col-md-6">
        <h1> <?php echo $movie_data['movie_name']; ?></h1>
        <div class="screen">screen</div>
        <table border= "1" class="seat">
        <?php
            $uid = 0;
            for ($i = 0; $i < 12; $i++) {
                echo "<tr><td>" .$list[$i] . "</td>";
                for ($j = 0; $j < 13; $j++) {
                    if (empty($seat_reserved)) {
                        echo "<td onclick=add($uid)'>$num[$j]</td>";
                    }
                    else if (in_array($uid, $seat_reserved)) {
                        echo "<td style='background-color:gray;'>X</td>";
                    }
                    else {
                        echo "<td onclick=add($uid)'>$num[$j]</td>";
                    }
                    $uid++;
                }

            }
        ?>
        </table>
    </div>
    <?php } ?>
    </div>
    </div>
</body>
</html>