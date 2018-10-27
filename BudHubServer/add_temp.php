<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$pid = $_GET["pid"];
$uid = $_GET["uid"];
$qty = $_GET["qty"];

$st_check = $con->prepare("insert into temporder values(?,?,?)");
$st_check->bind_param("sss", $pid, $uid, $qty);
$st_check->execute();
$rs = $st_check->get_result();
