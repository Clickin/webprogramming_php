<?php
session_start();
if ($_SESSION['user_id'] != "admin") {
    echo "<script>alert(\"관리자 계정이 아닙니다.\");</script>";
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>영화 추가 페이지</title>

        <!-- 부트스트랩 css import -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    </head>
    <body>
        
        <div class="container">
            <div class="page-header">
                <h1>영화 추가</h1>
            </div>

            <form class="form" id="addmovie" role="form" method="post" action="upload_movie.php">
                <div class="from-group">
                    <label for="name">영화이름</label>
                    <input class="form-control" id="name" type="text" placeholder="이름">
                    
                </div>
                
                <div class="from-group">
                    <label for="day">상영일자</label>
                    <input class="form-control" id="day" type="date" placeholder="날짜">
                    
                </div>
                
                <div class="from-group">
                    <label for="time">상영시간</label>
                    <input class="form-control" id="time" type="time" placeholder="시간">
                </div>
                
                <div class="from-group">
                    <label class="" for="theater">상영관</label>
                    <select class="form-control" id="theater">
                        <option value="1">1관</option>
                        <option value="2">2관</option>
                        <option value="3">3관</option>
                    </select> 
                </div>
                
                <div class="form-group">
                        <label for="picture">영화 사진</label>
                        <input type="file" id="pic" accept="image/.jpg,.jpeg,.png">
                </div>

                <div>
                    <button class="btn btn-primary pull-center" type="submit" form="addmovie" value="submit">제출</button>
                    <button class="btn btn-danger pull-center" type="reset" form="addmovie" value="reset">초기화</button>
                </div>
            
            </form>
        </div>
        
        <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    </body>
</html>