<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$email = $_GET["email"];
$pw = $_GET["pw"];

$st_check = $con->prepare("select * from users where email=? and password=?");
$st_check->bind_param("ss", $email, $pw);
$st_check->execute();
$rs = $st_check->get_result();

if($rs->num_rows==0) {
    echo "0";
} else {
    $row=$rs->fetch_assoc();
    echo $row["id"];
}