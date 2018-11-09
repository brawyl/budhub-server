<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

if ($con->connect_error) {
    echo $con->connect_error;
    
} else {
    $uid = $_POST["uid"];
    $term = $_POST["term"];
    $field = $_POST["field"];

    if (!isset($uid) || strlen($uid) < 1 ||
        !isset($term) || strlen($term) < 1 ||
        !isset($field) || strlen($field) < 1) {
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
                $sqlQuery = "select * from products where name like concat('%',?,'%') "
                        . "or producer like concat('%',?,'%') "
                        . "or description like concat('%',?,'%')";
                if (!$sqlQuery) {
                    echo "There was a problem querying the database.";

                } else {
                    $st = $con->prepare($sqlQuery);
                    $st->bind_param("sss", $term, $term, $term);
                    $st->execute();
                    $rs = $st->get_result();
                    $arr = array();

                    while($row=$rs->fetch_assoc()) {
                        array_push($arr, $row);
                    }

                    $sortBy = array();
                    foreach ($arr as $key => $row) {
                        $sortBy[$key] = $row[$field];
                    }
                    array_multisort($sortBy, SORT_ASC, $arr);

                    echo json_encode($arr);
                }
            }
        }
    }
}