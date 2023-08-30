<?php
include('connect.php');

$uni = $_POST["uni"];

if (isset($_POST["insere_unidade"])) {

    $params = array($uni);
    $insert_unidade = "INSERT INTO [unidade_investigacao] ([unidade_investigacao]) VALUES (?)";

    $stmt = sqlsrv_query($conn, $insert_unidade,$params);

    if (!$stmt) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        header("Location:view_unidades.php");
    }
}
?>