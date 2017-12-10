<?php

$db_host = "localhost";
$db_user = "z1z0b4v";
$db_password = "zfdwdzde1";
$db_name = "z1z0b4v";


$con = new mysqli($db_host, $db_user, $db_password, $db_name); // 데이터베이스 접속

if ($con->connect_errno) { die('Connection Error : '.$con->connect_error); } // 오류가 있으면 오류 메세지 출력

if (!$con->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
    exit();
}
?>
