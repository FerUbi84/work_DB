<?php

include('connect.php');

$id_dominio = $_POST['id_dominio'];
$area = $_POST['area'];


if (isset($_POST['insere_area'])) {

    $insert_area = "INSERT INTO [area_investigacao]
    ([nome_area],[id_dominio])
    VALUES('$area',$id_dominio)";

    $stmt = sqlsrv_query($conn, $insert_area);
    if ($stmt == false) {
        echo "Error";
    } else {

        header("Location:params_projetos.php");
    }
}
