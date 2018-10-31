<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$qty = $_GET["qty"];
$lid = $_GET["lid"];

$st_check = $con->prepare("update temporder set qty=? where lineid=?");
$st_check->bind_param("is", $qty, $lid);
$st_check->execute();
$rs = $st_check->get_result();

echo "1";