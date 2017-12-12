<html>
<?php include("navbar.php");
$title = "로그인";
?>
<link rel='stylesheet' type='text/css' href='./css/login.css'>
<body>
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>로그인</h1>
            <form class="form" id="login" role="form" method="post" action="./login_ok.php">
                <input type="text" name="user_id" placeholder="아이디">
                <input type="password" name="user_pw" placeholder="패스워드">
                <input type="submit" name="login" class="login loginmodal-submit" value="login">
            </form>
        </div>
    </div>
    
</body>
</html>