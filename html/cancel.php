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
    $movie_uid = $_GET['movie_uid'];
    $sql = "SELECT T.seat_uid, T.ticket_uid, R.reserve_uid, M.movie_name FROM tickets T, reservation R, movies M WHERE R.user_id = '$id' AND T.movie_uid = '$movie_uid' AND M.movie_uid = '$movie_uid' AND R.ticket_uid = T.ticket_uid";
    $cancel_result = $con->query($sql) or die('Error :' . $con->error);
    $sql = "SELECT seat_uid FROM seats WHERE movie_uid = '$movie_uid' AND valid = '1'";
    $seat_occupied = array();
    $seat_reserved = array();
    $ticket = array();
    $list = array("A","B","C","D","E","F","G","H","I","J","K","L");
    $num = array("01","02","03","04","05","06","07","08","09","10","11","12","13");
    
    foreach ($cancel_result as $row) {
        array_push($seat_reserved, $row['seat_uid']);
        array_push($ticket, $row['ticket_uid']);
        $movie_name = $row['movie_name'];
        
    }
        
    foreach ($con->query($sql) as $row) {
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

<link rel="stylesheet" href="./css/screen.css">
<script>
    var seat = [];
    var post_obj = {
        "movie_uid" : <?php echo $movie_uid ?>,
        "seat" : seat,
        "ticket" : <?php echo json_encode($ticket) ?>
    }
    function add(t){
        document.getElementById(t).style.backgroundColor="lightyellow";
        seat.push(t);
        
	}

    function post_to_url(path, params, method) {
        method = method || "post"; // 전송 방식 기본값을 POST로
    
        
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);
        
        //히든으로 값을 주입시킨다.
        for(var key in params) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
    
            form.appendChild(hiddenField);
        }
    
        document.body.appendChild(form);
        form.submit();
    }

    function display_seat(seat_uid) {
        var arr = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L"];
        if (seat_uid % 13 < 9) {
            return "".concat(arr[parseInt(seat_uid/13)], 0, (seat_uid % 13 + 1));
        }
        else {
            return "".concat(arr[parseInt(seat_uid/13)], (seat_uid % 13 + 1));
        }
    }


</script>

<link rel="stylesheet" href="./css/screen.csss">
<body>
<div class="container">
<div class="row">
    <?php if (!isset($_GET['movie_uid'])) {?>
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
    <?php } 
    else { ?>
    <div class="col-md-6">
        <h1> <?php echo $movie_name ?><h1>
        <div class="screen">screen</div>
        <table border = 1 class="seat">
        <?php
            $uid = 0;
            for ($i = 0; $i < 12; $i++) {
                echo "<tr><td style='background-color:white;'>" .$list[$i] . "</td>";
                for ($j = 0; $j < 13; $j++) {
                    if (in_array($uid, $seat_reserved)) {
                        echo "<td id='$uid' onclick=add($uid) style='background-color:red;'>$num[$j]</td>";
                    }
                    else if (!empty($seat_occupied) && in_array($uid, $seat_occupied)) {
                        echo "<td style='background-color:gray;'>X</td>";
                    }
                    else {
                        echo "<td>$num[$j]</td>";
                    }
                    $uid++;
                }

            }
        ?>
        </table>
        <a class="btn btn-danger" href="javascript:post_to_url('cancel_ok.php', post_obj)">취소하기</a>
    </div>
    <?php } ?>
    </div>
    </div>
</body>
</html>