<?php
$credentials = parse_ini_file("config.ini");
$user = $credentials["user"];
$password = $credentials["password"];
$con = new mysqli("localhost",$user,$password,"budhubdb");

$order = $_GET["order"];
$uid = $_GET["uid"];

$st = $con->prepare("delete from temporder where uid=?");
$st->bind_param("s",$uid);
$st->execute();

if (strpos($order, "clear") === false) {
    $orders = explode(";", $order);
    foreach($orders as $item) {
        $items = explode(":", $item);
        $pid = $items[0];
        if (strlen($pid) > 0) {
            $qty = "1";
    
            $lid = $pid.$uid;

            $st_check = $con->prepare("insert into temporder values(?,?,?,?)");
            $st_check->bind_param("ssss", $pid, $uid, $qty, $lid);
            $st_check->execute();
        }
    }
}

echo "1";