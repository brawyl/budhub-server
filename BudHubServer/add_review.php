<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

if ($con->connect_error) {
    echo $con->connect_error;
    
} else {
    $rdate = $_POST["date"];
    $rtitle = $_POST["title"];
    $rtext = $_POST["text"];
    $rrating = $_POST["rating"];
    $rauthor = $_POST["author"];
    $ruid = $_POST["uid"];

    if (!isset($rdate) || strlen($rdate) < 1 ||
        !isset($rtitle) || strlen($rtitle) < 1 ||
        !isset($rtext) || strlen($rtext) < 1 ||
        !isset($rrating) || strlen($rrating) < 1 ||
        !isset($rauthor) || strlen($rauthor) < 1 ||
        !isset($ruid) || strlen($ruid) < 1) {
        echo "ERROR: Incorrectly formatted data";
        
    } else {
        
                $st_check = $con->prepare("select * from users where id=?");
        if (!$st_check) {
            echo "ERROR: There was a problem verifying the user ID";

        } else {
            $st_check->bind_param("s", $ruid);
            $st_check->execute();
            $rs = $st_check->get_result();

            if($rs->num_rows==0) {
                echo "ERROR: Invalid user ID";

            } else {
                $date = new DateTime();
                $nums = substr($date->getTimestamp(), 0, 9);
                $rid =  $ruid . $nums;

                $st_check = $con->prepare("insert into reviews values(?,?,?,?,?,?,?)");
                if (!$st_check) {
                    echo "There was a problem querying the database.";

                } else {
                    $st_check->bind_param("sssssss", $rid, $rdate, $rtitle, $rtext, $rrating, $rauthor, $ruid);
                    $st_check->execute();
                    echo "OK";
                }
            }
        }
    }
}