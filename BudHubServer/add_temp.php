<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$pid = $_GET["pid"];
$uid = $_GET["uid"];
$qty = $_GET["qty"];
$lid = $pid.$uid;

$st_check = $con->prepare("insert into temporder values(?,?,?,?)");
$st_check->bind_param("ssss", $pid, $uid, $qty, $lid);
$st_check->execute();
$rs = $st_check->get_result();

echo "1";