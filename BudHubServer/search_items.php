<?php
$term = $_GET["term"];
$sort = $_GET["sort"];

$sqlQuery = "select * from products where name like concat('%',?,'%') "
        . "or producer like concat('%',?,'%') "
        . "or description like concat('%',?,'%')";

$con = new mysqli("localhost","root","root","budhubdb");
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
    $sortBy[$key] = $row[$sort];
}
array_multisort($sortBy, SORT_ASC, $arr);

echo json_encode($arr);