<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

if ($con->connect_error) {
    echo $con->connect_error;
    
} else {
    $tpid = $_POST["pid"];
    $tuid = $_POST["uid"];
    $tquantity = $_POST["quantity"];
    
    if (!isset($tpid) || strlen($tpid) < 1 ||
        !isset($tuid) || strlen($tuid) < 1 ||
        !isset($tquantity) || strlen($tquantity) < 1) {
        echo "ERROR: Incorrectly formatted data";
        
    } else {
        $st_check = $con->prepare("select * from users where id=?");
        if (!$st_check) {
            echo "ERROR: There was a problem verifying the user ID";

        } else {
            $st_check->bind_param("s", $tuid);
            $st_check->execute();
            $rs = $st_check->get_result();

            if($rs->num_rows==0) {
                echo "ERROR: Invalid user ID";

            } else {
                $tlid = $tpid.$tuid;

                $st_check = $con->prepare("insert into temporder values(?,?,?,?)");
                if (!$st_check) {
                    echo "ERROR: There was a problem querying the database";

                } else {
                    $st_check->bind_param("ssss", $tpid, $tuid, $tqty, $tlid);
                    $st_check->execute();
                    echo "OK";

                }
            }
        }
    }
}