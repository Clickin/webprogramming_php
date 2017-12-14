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
if (!empty($_GET)) {
    $movie_uid = $_GET['movie_id'];
    $sql = "SELECT seat_uid FROM seats WHERE movie_uid = '$movie_uid' AND valid = 1";
    $reserve_result = $con->query($sql);
    $seat_reserved = array();
    $sql = "SELECT * FROM movies WHERE movie_uid = '$movie_uid'";
    $movie_result = $con->query($sql)->fetch_assoc();
    foreach ($reserved_result as $row) {
        array_push($seat_reserved, $row['seat_uid']);
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

<link rel="stylesheet" href="./css/screen.csss">
<body>
<div class="container">
<div class="row">
    <?php if (empty($_GET)) {?>
        <div class="col-md-6">
        <h1>영화 목록</h1>
        <div class="pic-list">
            <?php foreach ($movie_result as $row) {
                echo "<img src='./pic/" . $row['pic'] . "' width='180' height='270'>";
            } ?>
        </div>
        <form method="get" action="./reserve.php" role="form">
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
        <h1> <?php echo $movie_result['movie_name']; ?><h1>
        <img src="./pic/<?php echo $movie_result['pic']; ?>" style="width:300px;height:370px;border:1px;">
        <div class="screen">screen</div>
        <table border = 1 width = 300px class="seat">
        <?php
            $uid = 0;
            for ($i = 0; $i < 12; $i++) {
                echo "<tr><td>" .$list[$i] . "</td>";
                for ($j = 0; $j < 13; $j++) {
                    if (in_array($uid, $seat_reserved)) {
                        echo "<td style='background-color:gray;'>X</td>";
                    }
                    else {
                        echo "<td onclick=add($uid) style='background-color:red;'>$num[$j]</td>";
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