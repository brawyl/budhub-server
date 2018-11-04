<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$uid = $_GET["uid"];
$tot = $_GET["tot"];
$sum = $_GET["sum"];
$itm = $_GET["itm"];
$od = $_GET["date"];

$date = new DateTime();
$oid = substr($date->getTimestamp(), 0, 9);
$hid = $uid.$oid;

$st_check = $con->prepare("insert into history values(?,?,?,?,?,?,?)");
$st_check->bind_param("sssssss", $uid, $tot, $sum, $itm, $od, $oid, $hid);
$st_check->execute();
$rs = $st_check->get_result();

echo "1";