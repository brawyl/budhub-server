<?php
$pid = $_GET["pid"];
$uid = $_GET["uid"];
$qty = $_GET["qty"];

$con = new mysqli("localhost","root","root","budhubdb");
$st_check = $con->prepare("insert into temporder values(?,?,?)");
$st_check->bind_param("sss", $pid, $uid, $qty);
$st_check->execute();
$rs = $st_check->get_result();
