<?php
include('connect.php');

$dominio = $_POST['dominio'];


if (isset($_POST['insere_dominio'])) {

    $insert_dominio = "INSERT INTO [dominio]
    ([nome_dominio])
    VALUES ('$dominio')";

    $stmt = sqlsrv_query($conn, $insert_dominio);
    if ($stmt == false) {
        echo "Error";
    } else {

        header("Location:params_projetos.php");
    }
}


