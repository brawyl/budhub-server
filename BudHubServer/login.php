<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

if ($con->connect_error) {
    echo $con->connect_error;
    
} else {
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    if (!isset($email) || strlen($email) < 1 ||
        !isset($pass) || strlen($pass) < 1) {
        echo "ERROR: Incorrectly formatted data";
        
    } else {
        
        $st_check = $con->prepare("select * from users where email=? and password=?");
        if (!$st_check) {
            echo "ERROR: There was a problem querying the database";

        } else {
            $st_check->bind_param("ss", $email, $pass);
            $st_check->execute();
            $rs = $st_check->get_result();

            if($rs->num_rows==0) {
                echo "0";
            } else {
                $row=$rs->fetch_assoc();
                echo $row["id"];
            }
        }
    }
}