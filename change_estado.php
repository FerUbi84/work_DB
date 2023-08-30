<?php
include('connect.php');
$cod_proj = $_POST["cod_proj"];
$change_estado = $_POST["change_estado"];


if (isset($_POST['change_id'])) {


    $update_estado = "UPDATE projeto SET id_estado=$change_estado WHERE cod_projeto='$cod_proj'";


    $stmt = sqlsrv_query($conn, $update_estado);
    if ($stmt == false) {
        echo "Error";
    } else {

        header("Location:tabela_projetos.php");
    }
    sqlsrv_free_stmt($stmt);
}
