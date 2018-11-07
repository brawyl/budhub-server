<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

if ($con->connect_error) {
    echo $con->connect_error;
    
} else {
    $rdate = $_POST["ryPwdKTdWV"];
    $rtitle = $_POST["xrZfArnwpf"];
    $rtext = $_POST["FDnPfdndfU"];
    $rrating = $_POST["jWTxDKBzSU"];
    $rauthor = $_POST["xzExJAkAGn"];
    $ruid = $_POST["PYAQhwwfxG"];

    if (isset($rdate) && 
        isset($rtitle) &&
        isset($rtext) &&
        isset($rrating) &&
        isset($rauthor) &&
        isset($ruid)) {
        $date = new DateTime();
        $nums = substr($date->getTimestamp(), 0, 9);
        $rid =  $nums . $ruid;

        $st_check = $con->prepare("insert into reviews values(?,?,?,?,?,?,?)");
        if (!$st_check) {
            echo "There was a problem querying the database.";
            
        } else {
            $st_check->bind_param("sssssss", $rid, $rdate, $rtitle, $rtext, $rrating, $rauthor, $ruid);
            $st_check->execute();
            $rs = $st_check->get_result();

            echo "OK";
        }
        
    } else {
        echo "There are missing required fields.";
    }
    
}