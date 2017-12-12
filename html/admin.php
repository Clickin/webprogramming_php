<?php
session_start();
if ($_SESSION['user_id'] != "admin") {
    echo "<script>alert(\"관리자 계정이 아닙니다.\");</script>";
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}
include("connect.php");
$sql = "SELECT * FROM movies";
$movie_result = $con->query($sql);
$sql = "SELECT * FROM account";
$account_result = $con->query($sql);

?>
<html>
    <?php 
    $title = "관리자 페이지";
    include("navbar.php");?>
    <body>
    <div class="container">
        <h1 class="page-header">영화 관리</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>선택</th>
                    <th>이름</th>
                    <th>상영일자</th>
                    <th>상영시간</th>
                    <th>상영관</th>
                    <th>좌석현황</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movie_result as $row) : ?>
                <tr>
                    <td> <?php echo '<input type="checkbox" value="'. $row['movie_uid']. '">';?></td>
                    <td> <?php echo $row['movie_name'];?></td>
                    <td> <?php echo $row['screen_date'];?></td>
                    <td> <?php echo $row['screen_time'];?></td>
                    <td> <?php echo $row['theater_uid'];?></td>
                    <td> <?php echo $count_movie[$row['movie_uid']];?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary pull-right" onclick="location.href='addmovie.php'">영화 추가</button>
        <button type="button" class="btn btn-danger pull-right" onclick="del_movies()">영화 삭제</button>
        <hr>

        <h1 class="page-header">회원 관리</h1>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>아이디</th>
                    <th>이름</th>
                    <th>전화번호</th>
                    <th>예매횟수</th>
                </tr>
                
            </thead>
            <tbody>
            <?php foreach ($account_result as $row) : ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['phone'];?></td>
                    <td><?php echo $row['reserve_cnt'];?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
                        
            
                        
    </div>
            
    </body>