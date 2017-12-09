<html>
    
    <?php 
    $title = "회원가입";
    include("navbar.php");?>
        
    <body>
        
        <div class="container">
            <div class="page-header">
                <h1>회원가입</h1>
            </div>

            <form class="form" id="register" role="form" method="post" action="signup.php">
                <div class="from-group">
                    <label for="user_id">아이디</label>
                    <input class="form-control" id="user_id" type="text" placeholder="아이디">
                    
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