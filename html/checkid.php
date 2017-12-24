<?php
include("connect.php");
$error = "";
$idch = $_POST['user_id'];
if (empty($idch)) {
    $error = "항목을 기입하셔야 합니다.";
}
if(!$con){
    echo "not connect DB";
}
 
$sql = "SELECT * FROM account WHERE id = '$idch'";
$result = $con->query($sql);
$count = $result->num_rows;

if($idch == '') {

echo "<div>아이디를 입력하세요.</div>";
}
else {
    
    if($count == 0){
    
    echo '<div style="color:green" id="idch">사용가능한 아이디입니다<input type="hidden" value="1" id="use"></div>';
    }
    else {
    
    echo '<div style="color:red" id="idch">이미 존재하는 아이디입니다<input type="hidden" value="0" id="use"></div>';
    }
    $con->close();
}
$error = mysqli_error;
echo '<script>console.log($erro")</script>';
?>