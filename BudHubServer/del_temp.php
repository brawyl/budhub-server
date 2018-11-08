<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

if ($con->connect_error) {
    echo $con->connect_error;
    
} else {
    $uid = $_POST["uid"];
    $tlid = $_POST["lid"];
    
    if (!isset($uid) || strlen($uid) < 1 ||
        !isset($tlid) || strlen($tlid) < 1) {
        echo "ERROR: Incorrectly formatted data";
        
    } else {
        $st_check = $con->prepare("select * from users where id=?");
        if (!$st_check) {
            echo "ERROR: There was a problem verifying the user ID";

        } else {
            $st_check->bind_param("s", $uid);
            $st_check->execute();
            $rs = $st_check->get_result();

            if($rs->num_rows==0) {
                echo "ERROR: Invalid user ID";

            } else {
                $st = $con->prepare("delete from temporder where lid=?");
                if (!$st_check) {
                    echo "ERROR: There was a problem querying the database";

                } else {
                    $st->bind_param("s",$tlid);
                    $st->execute();
                    echo "OK";
                    
                }
            }
        }
    }
}