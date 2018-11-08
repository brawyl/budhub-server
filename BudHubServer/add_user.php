<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

if ($con->connect_error) {
    echo $con->connect_error;
    
} else {
    $email = $_POST["email"];
    $pw = $_POST["pass"];
    
    if (!isset($email) || strlen($email) < 1 ||
        !isset($pw) || strlen($pw) < 1) {
        echo "ERROR: Incorrectly formatted data";
        
    } else {
        $st_check = $con->prepare("select * from users where email=?");
        if (!$st_check) {
            echo "ERROR: There was a problem verifying this email address";

        } else {
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
                echo "ERROR: An account with this email already exists";

            }
        }
    }
}