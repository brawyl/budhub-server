<?php
$category = $_GET["id"];

$con = new mysqli("localhost","root","root","budhubdb");
$st = $con->prepare("select * from products where id=?");
$st->bind_param("s",$category);
$st->execute();
$rs = $st->get_result();
$row=$rs->fetch_assoc();

echo json_encode($row);