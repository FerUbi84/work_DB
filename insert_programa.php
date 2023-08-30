<?php

include('connect.php');

$financiamento = $_POST['financiamento'];



if (isset($_POST['insere_financiamento'])) {

    $insert_programa = "INSERT INTO [programa_financiamento]
    ([nome_programa])
    VALUES('$financiamento')";

    $stmt = sqlsrv_query($conn, $insert_programa);
    if ($stmt == false) {
        echo "Error";
    } else {

        header("Location:params_projetos.php");
    }
}
