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
    $uid = $_POST["uid"];
    $pid = $_POST["pid"];

    if (!isset($rdate) || strlen($rdate) < 1 ||
        !isset($rtitle) || strlen($rtitle) < 1 ||
        !isset($rtext) || strlen($rtext) < 1 ||
        !isset($rrating) || strlen($rrating) < 1 ||
        !isset($rauthor) || strlen($rauthor) < 1 ||
        !isset($uid) || strlen($uid) < 1 ||
        !isset($pid) || strlen($pid) < 1) {
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
                $date = new DateTime();
                $nums = substr($date->getTimestamp(), 0, 9);
                $rid =  $uid . $nums;

                $st_check = $con->prepare("insert into reviews values(?,?,?,?,?,?,?,?)");
                if (!$st_check) {
                    echo "There was a problem querying the database.";

                } else {
                    $st_check->bind_param("ssssssss", $rid, $rdate, $rtitle, $rtext, $rrating, $rauthor, $uid, $pid);
                    $st_check->execute();
                    
                    //calc new rating score
                    $st_reviews = $con->prepare("select reviewrating from reviews where productid=?");
                    $st_reviews->bind_param("s",$pid);
                    $st_reviews->execute();

                    $rs = $st_reviews->get_result();
                    $sum = 0.0;
                    $count = 0;

                    while($row=$rs->fetch_assoc()) {
                        $sum = $sum + (float)$row["reviewrating"];
                        $count++;
                    }
                    
                    $floatrating = $sum / $count;
                    $rating = number_format($floatrating,1,'.','');
                    
                    $st_product = $con->prepare("update products set rating=? where products.id=?");
                    $st_product->bind_param("ss",$rating,$pid);
                    $st_product->execute();
                    
                    echo "OK";

                }
            }
        }
    }
}