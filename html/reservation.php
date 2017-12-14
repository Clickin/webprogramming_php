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
if (isset($_GET['movie_uid'])) {
    $movie_uid = $_GET['movie_uid'];
    $sql = "SELECT seat_uid FROM seats WHERE movie_uid = '$movie_uid' AND valid = 1";
    $reserved_result = $con->query($sql);
    $seat_reserved = array();
    $sql = "SELECT * FROM movies WHERE movie_uid = $movie_uid";
    $movie_result = $con->query($sql);
    $movie_data = $movie_result->fetch_assoc();
    if (!empty($reserved_result)) {
        foreach ($reserved_result as $row) {
            array_push($seat_reserved, $row['seat_uid']);
        }
    }
    
    $list = array("A","B","C","D","E","F","G","H","I","J","K","L");
    $num = array("01","02","03","04","05","06","07","08","09","10","11","12","13");
    
}
else {
    
    $sql = "SELECT * FROM movies";
    $movie_result = $con->query($sql);
}

?>

<script>
    var seat = [];
    var post_obj = {
        "movie_uid" : <?php echo $movie_uid ?>,
        "seat" : seat
        
    }
    function add(t){
        var max= document.getElementById("max").value
        var text=document.createTextNode(display_seat(t));
        if(seat.length>=max) {
            alert("예약 가능 좌석을 모두 선택했습니다 max:"+max); 
        }
        else {
            document.getElementById("target").appendChild(text);
            document.getElementById(t).style.backgroundColor="red";
            seat.push(t);
        }
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

<link rel="stylesheet" href="./css/screen.css">
<body>
<div class="container">
<div class="row">
    <div class="col-md-6">

        <?php if (!isset($_GET['movie_uid'])) { ?>
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
        <?php }
        else {
            
        ?>

        <h1> <?php echo $movie_data['movie_name']; ?></h1>
        예매할 좌석 수<input id="max" type="number" min="1" max="156" value="1">
        <div class="screen">screen</div>
        <table border= "1" class="seat">
        <?php
            $uid = 0;
            for ($i = 0; $i < 12; $i++) {
                echo "<tr><td style='background-color:white;'>" .$list[$i] . "</td>";
                for ($j = 0; $j < 13; $j++) {
                    if (empty($seat_reserved)) {
                        echo "<td id='$uid' onclick='javascript:add($uid)'>$num[$j]</td>";
                    }
                    else if (in_array($uid, $seat_reserved)) {
                        echo "<td style='background-color:gray;'>X</td>";
                    }
                    else {
                        echo "<td id='$uid' onclick='javascript:add($uid)'>$num[$j]</td>";
                    }
                    $uid++;
                }

            }
        ?>
        </table>
        <div id="target">선택된 좌석: </div>
        <a class="btn btn-default" href="javascript:post_to_url('reservation_ok.php', post_obj)">예매하기</a>
        <?php } ?>
        
    </div>
    </div>
</div>
</body>
</html>