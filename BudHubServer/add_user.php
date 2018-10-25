<?php
$email = $_GET["email"];
$pw = $_GET["pw"];

$con = new mysqli("localhost","root","root","budhubdb");
$st_check = $con->prepare("select * from users where email=?");
$st_check->bind_param("s", $email);
$st_check->execute();
$rs = $st_check->get_result();

if($rs->num_rows==0) {
    $date = new DateTime();
    $nums = substr($date->getTimestamp(), 0, 9);
    $chars = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
    $id = $nums . $chars;
    $st = $con->prepare("insert into users values(?,?,?)");
    $st->bind_param("sss",$id,$email,$pw);
    $st->execute();
    echo $id;
} else {
    echo "0";
}