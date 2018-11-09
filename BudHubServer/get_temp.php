<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

if ($con->connect_error) {
    echo $con->connect_error;
    
} else {
    $uid = $_POST["uid"];

    if (!isset($uid) || strlen($uid) < 1) {
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
                $st_check = $con->prepare("select id, name, producer, description, price, rating, image, qty, uid from temporder inner join products on products.id=temporder.pid where uid=?");
                if (!$st_check) {
                    echo "There was a problem querying the database.";

                } else {
                    $st_check->bind_param("s",$uid);
                    $st_check->execute();

                    $rs = $st_check->get_result();
                    $arr = array();

                    while($row=$rs->fetch_assoc()) {
                        array_push($arr, $row);
                    }

                    echo json_encode($arr);
                }
            }
        }
    }
}