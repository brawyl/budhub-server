<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$category = $_GET["category"];

$st = $con->prepare("select * from products where category=?");
$st->bind_param("s",$category);
$st->execute();
$rs = $st->get_result();
$arr = array();

while($row=$rs->fetch_assoc()) {
    array_push($arr, $row);
}

echo json_encode($arr);