
    
<div class="col-sm-3 col-md-2 sidebar" style="background-color:#F5F5F5; height:100%">
    <ul class="nav nav-sidebar">
    <li class="nav-item">
        <a class="nav-link" href="./reservation.php">영화예매</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./login.php">로그인</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./register.php">회원가입</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./member.php">회원정보</a>
    </li>
    <?php 
        if ($_SESSION['user_id'] == "admin") {
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="./admin.php">관리자 페이지</a>';
        echo "</li>";
        }
    ?>
    <?php 
        if (!empty($_SESSION)) {
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="./logout.php">로그아웃</a>';
            echo "</li>";
        }
    ?>
    </ul>
</div>