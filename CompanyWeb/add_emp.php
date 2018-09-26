<?php

$con = new mysqli("localhost","root","root","company");
$st = $con->prepare("insert into emp values(?,?,?)");
$st->bind_param("isi", $GET_["id"],$GET_["name"],$GET_["salary"]);
$st->execute();