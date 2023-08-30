<?php
include('connect.php');
$cod_proj = $_POST['cod_proj'];
$id_inv = $_POST['id_inv'];
$nova_func = $_POST['nova_func'];
$change_funcao = "";

if (isset($_POST['ch_func'])) {

    
    if ($nova_func == "chefe") {
    
        $change_funcao = "UPDATE equipa 
        SET funcao='participante'
        WHERE funcao LIKE'%chefe'
        AND cod_projeto='$cod_proj';

        UPDATE equipa 
        SET funcao = 'chefe'
        WHERE id_investigador = $id_inv
        AND cod_projeto='$cod_proj'";

        $stmt = sqlsrv_query($conn, $change_funcao);
    } else {
    
        $change_funcao = "UPDATE equipa 
        SET funcao='$nova_func'
        WHERE id_investigador = $id_inv
        AND cod_projeto='$cod_proj'";

        $stmt = sqlsrv_query($conn, $change_funcao);
    }

    if ($stmt == false) {
        echo "Error";
    } else {

        header("Location:view_equipas_projeto.php");
    }
    //sqlsrv_free_stmt($stmt);
}
