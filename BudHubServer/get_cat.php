<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$st_check = $con->prepare("select distinct category from products");
$st_check->execute();
$rs = $st_check->get_result();
$arr = array();

while($row=$rs->fetch_assoc()) {
    array_push($arr, $row);
}

echo json_encode($arr);