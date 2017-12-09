<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo($title)?></title>

    <!-- 부트스트랩 css import -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <?php session_start();?>


    <nav class="navbar navbar-default navbar-expand-md  fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="./index.php">SKKU Theater</a>
    </div>
        <div id="navbars">
            <ul class="nav navbar-nav mr-auto">
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
                    echo '<a class="nav-link" href="./admin.php">회원관리</a>';
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
    </nav>
</head>