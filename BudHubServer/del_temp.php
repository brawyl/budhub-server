<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$id = $_GET["id"];

$st = $con->prepare("delete from temporder where lid=?");
$st->bind_param("s",$id);
$st->execute();
$rs = $st->get_result();
echo "1";