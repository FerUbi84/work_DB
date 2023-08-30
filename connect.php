<?php

$serverName = "LAPTOP-PCFO58ST\SQLEXPRESS";
$database = "projetos";
$uid = "";
$pass = "";

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass,
    "CharacterSet" => "UTF-8"
];

$conn = sqlsrv_connect($serverName, $connection);


if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

/*

$stmt = sqlsrv_query($conn, $select_all);

if ($stmt == false) {
    echo "Error";
}

while ($obj =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo $obj['id_area'] . " " . $obj['area'] . " " . $obj['id_dominio'];
}
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
**/