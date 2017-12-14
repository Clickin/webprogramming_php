<?php
session_start();
if ($_SESSION['user_id'] != "admin") {
    echo "<script>alert(\"관리자 계정이 아닙니다.\");</script>";
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}

?>
<html>
    <?php 
    $title = "영화 추가 페이지";
    include("navbar.php");?>
    <body>
        
        <div class="container">
            <div class="page-header">
                <h1>영화 추가</h1>
            </div>

            <form class="form" id="addmovie" role="form" enctype="multipart/form-data" method="post" action="./addmovie_ok.php">
                <div class="from-group">
                    <label for="name">영화이름</label>
                    <input class="form-control" name="name" type="text" placeholder="이름">
                    
                </div>
                
                <div class="from-group">
                    <label for="day">상영일자</label>
                    <input class="form-control" name="day" type="date" placeholder="날짜">
                    
                </div>
                
                <div class="from-group">
                    <label for="time">상영시간</label>
                    <input class="form-control" name="time" type="time" placeholder="시간">
                </div>
                
                <div class="from-group">
                    <label class="" for="theater">상영관</label>
                    <select class="form-control" name="theater">
                        <option value="1">1관</option>
                        <option value="2">2관</option>
                        <option value="3">3관</option>
                    </select> 
                </div>
                
                <div class="form-group">
                        <label for="picture">영화 사진</label>
                        <input type="file" name="pic" accept="image/.jpg|image/.jpeg,|image/.png">
                </div>

                <div>
                    <button class="btn btn-primary pull-center" type="submit" form="addmovie" value="submit">제출</button>
                    <button class="btn btn-danger pull-center" type="reset" form="addmovie" value="reset">초기화</button>
                </div>
            
            </form>
        </div>
        
    </body>
</html>