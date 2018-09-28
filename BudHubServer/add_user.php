<?php
$id = 0;
$email = $_GET["email"];
$pw = $_GET["pw"];

$con = new mysqli("localhost","root","root","budhubdb");
$st_check = $con->prepare("select * from users where email=?");
$st_check->bind_param("s", $email);
$st_check->execute();
$rs = $st_check->get_result();

if($rs->num_rows==0) {
    $st = $con->prepare("insert into users values(?,?,?)");
    $st->bind_param("iss",$id,$email,$pw);
    $st->execute();
    echo "1";
} else {
    echo"0";
}