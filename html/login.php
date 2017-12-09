<html>
<?php include("navbar.php");
$title = "로그인";
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel='stylesheet' type='text/css' href='./css/login.css'>
</head>
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