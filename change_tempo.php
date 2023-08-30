<?php
include('connect.php');

$cod_p = $_POST['cod_p'];
$id_iv = $_POST['id_iv'];
$temp_f = $_POST['temp_f'];

if (isset($_POST['ch_temp'])) {
    
    
    $change_tempo = "UPDATE equipa 
        SET tempo_projeto='$temp_f'
        WHERE id_investigador=$id_iv
        AND cod_projeto='$cod_p'";

    $stmt = sqlsrv_query($conn, $change_tempo);

    if ($stmt == false) {
        echo "Error";
    } else {

        header("Location:view_equipas_projeto.php");
    }
    //sqlsrv_free_stmt($stmt);
}
