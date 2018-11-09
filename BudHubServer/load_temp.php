<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

if ($con->connect_error) {
    echo $con->connect_error;
    
} else {
    $order = $_POST["order"];
    $uid = $_POST["uid"];

    if (!isset($order) || strlen($order) < 1 ||
        !isset($uid) || strlen($uid) < 1) {
        echo "ERROR: Incorrectly formatted data";
        
    } else {
        $st = $con->prepare("delete from temporder where uid=?");
        if (!$st) {
            echo "ERROR: There was a problem querying the database";

        } else {
            $st->bind_param("s",$uid);
            $st->execute();
            
            if (strpos($order, "clear") === false) {
                $success = true;
                $orders = explode(";", $order);
                foreach($orders as $item) {
                    $items = explode(":", $item);
                    $pid = $items[0];
                    if (strlen($pid) > 0) {
                        $qty = "1";

                        $lid = $pid.$uid;

                        $st_check = $con->prepare("insert into temporder values(?,?,?,?)");
                        if (!$st_check) {
                            echo "ERROR: There was a problem loading this order";
                            $success = false;

                        } else {
                            $st_check->bind_param("ssss", $pid, $uid, $qty, $lid);
                            $st_check->execute();
                            
                        }
                    }
                }
                
                if (!$success) {
                    echo "ERROR: We could not load the full order from your history";
                    
                } else {
                    echo "OK - loaded";
                    
                }
            } else {
                echo "OK - cleared";
            }
        }
    }
}