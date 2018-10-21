<?php
$category = $_GET["category"];

$con = new mysqli("localhost","root","root","budhubdb");
$st = $con->prepare("select * from products where category=?");
$st->bind_param("s",$category);
$st->execute();
$rs = $st->get_result();
$arr = array();

while($row=$rs->fetch_assoc()) {
    array_push($arr, $row);
}

echo json_encode($arr);