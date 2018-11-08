<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

if ($con->connect_error) {
    echo $con->connect_error;
    
} else {
    $huid = $_POST["uid"];
    $htotal = $_POST["total"];
    $hsummary = $_POST["summary"];
    $hitem = $_POST["item"];
    $hdate = $_POST["date"];
    
    if (!isset($huid) || strlen($huid) < 1 ||
        !isset($htotal) || strlen($htotal) < 1 ||
        !isset($hsummary) || strlen($hsummary) < 1 ||
        !isset($hitem) || strlen($hitem) < 1 ||
        !isset($hdate) || strlen($hdate) < 1) {
        echo "ERROR: Incorrectly formatted data";
        
    } else {
        $st_check = $con->prepare("select * from users where id=?");
        if (!$st_check) {
            echo "ERROR: There was a problem verifying the user ID";

        } else {
            $st_check->bind_param("s", $huid);
            $st_check->execute();
            $rs = $st_check->get_result();

            if($rs->num_rows==0) {
                echo "ERROR: Invalid user ID";

            } else {
                $date = new DateTime();
                $nums = substr($date->getTimestamp(), 0, 9);
                $hid = $huid . $nums;

                $st_check = $con->prepare("insert into history values(?,?,?,?,?,?,?)");
                if (!$st_check) {
                    echo "ERROR: There was a problem querying the database";

                } else {
                    $st_check->bind_param("sssssss", $huid, $htotal, $hsummary, $hitem, $hdate, $nums, $hid);
                    $st_check->execute();
                    echo "OK";

                }
            }
        }
    }
}