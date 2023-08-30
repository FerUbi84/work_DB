<?php
require("connect.php");

function select_all($query)
{

    $statment = sqlsrv_query($conn, $query);
    if ($statment == false) {
        echo "Error";
    }
    sqlsrv_free_stmt($statment);
    sqlsrv_close($conn);
    return $statment;
}
/*
$select = "SELECT * FROM estados"

$estados = select_all($select);

    while ($obj =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo $obj['id_area'] . " " . $obj['area'] . " " . $obj['id_dominio'];
    }
    
*/
