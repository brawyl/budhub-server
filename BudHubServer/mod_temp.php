<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$uid = $_GET["uid"];

$st_check = $con->prepare("delete from temporder where uid=?");
$st_check->bind_param("s", $uid);
$st_check->execute();
$rs = $st_check->get_result();

echo "1";