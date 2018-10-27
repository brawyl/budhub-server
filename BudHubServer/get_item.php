<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$category = $_GET["id"];

$st = $con->prepare("select * from products where id=?");
$st->bind_param("s",$category);
$st->execute();
$rs = $st->get_result();
$row=$rs->fetch_assoc();

echo json_encode($row);