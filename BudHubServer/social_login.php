<?php

$email = $_GET["email"];

$con = new mysqli("localhost","root","root","budhubdb");
$st_check = $con->prepare("select * from users where email=?");
$st_check->bind_param("s", $email);
$st_check->execute();
$rs = $st_check->get_result();

if($rs->num_rows==0) {
    echo "0";
} else {
    echo "1";
}