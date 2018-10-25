<?php
$userid = $_GET["uid"];

$con = new mysqli("localhost","root","root","budhubdb");
$st_check = $con->prepare("select id, name, producer, description, price, image, qty, uid from temporder inner join products on products.id=temporder.pid where uid=?");
$st_check->bind_param("s",$userid);
$st_check->execute();

$rs = $st_check->get_result();
$arr = array();

while($row=$rs->fetch_assoc()) {
    array_push($arr, $row);
}

echo json_encode($arr);