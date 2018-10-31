<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$userid = $_GET["uid"];

$st_check = $con->prepare("select id, name, producer, description, price, rating, image, qty, uid from temporder inner join products on products.id=temporder.pid where uid=?");
$st_check->bind_param("s",$userid);
$st_check->execute();

$rs = $st_check->get_result();
$arr = array();

while($row=$rs->fetch_assoc()) {
    array_push($arr, $row);
}

echo json_encode($arr);