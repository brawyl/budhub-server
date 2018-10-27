<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$email = $_GET["email"];

$st_check = $con->prepare("select * from users where email=?");
$st_check->bind_param("s", $email);
$st_check->execute();
$rs = $st_check->get_result();

if($rs->num_rows==0) {
    echo "0";
} else {
    echo "1";
}