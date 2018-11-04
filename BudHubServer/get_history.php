<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$userid = $_GET["uid"];

$st_check = $con->prepare("select * from history where uid=? order by orderdate desc");
$st_check->bind_param("s",$userid);
$st_check->execute();

$rs = $st_check->get_result();
$arr = array();

while($row=$rs->fetch_assoc()) {
    array_push($arr, $row);
}

echo json_encode($arr);