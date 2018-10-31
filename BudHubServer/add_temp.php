<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$pid = $_GET["pid"];
$uid = $_GET["uid"];
$qty = $_GET["qty"];
$lineid = $pid.$uid;

$st_check = $con->prepare("insert into temporder values(?,?,?,?)");
$st_check->bind_param("ssss", $pid, $uid, $qty, $lineid);
$st_check->execute();
$rs = $st_check->get_result();

echo "1";