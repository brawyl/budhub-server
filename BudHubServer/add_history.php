<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

if ($con->connect_error) {
    echo $con->connect_error;
    
} else {
    $uid = $_POST["EWvqVkFgLY"];
    $tot = $_POST["MgthQcNfYj"];
    $sum = $_POST["DYQQfUBUVy"];
    $itm = $_POST["WbymhBTUje"];
    $od = $_POST["KKEupEBxzL"];
    
    if (isset($uid) && 
        isset($tot) &&
        isset($sum) &&
        isset($itm)) {

        $date = new DateTime();
        $oid = substr($date->getTimestamp(), 0, 9);
        $hid = $uid.$oid;

        $st_check = $con->prepare("insert into history values(?,?,?,?,?,?,?)");
        if (!$st_check) {
            echo "There was a problem querying the database.";
            
        } else {
            $st_check->bind_param("sssssss", $uid, $tot, $sum, $itm, $od, $oid, $hid);
            $st_check->execute();
            $rs = $st_check->get_result();

            echo "OK";
        }
        
    } else {
        echo "There are missing required fields.";
    }
}