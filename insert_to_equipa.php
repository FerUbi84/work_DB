<?php
include('connect.php');

$name_ins = $_POST["name_ins"];
$inv_name = $_POST["inv_name"];
$cod_pro = $_POST["cod_pro"];



if (isset($_POST["insere_investigador"])) {

    $params = array( $cod_pro,$inv_name,'participante','0');
    $insert_equipa = "INSERT INTO [dbo].[equipa] ([cod_projeto],[id_investigador],[funcao],[tempo_projeto]) VALUES(?,?,?,?)";


    $stmt = sqlsrv_query($conn, $insert_equipa,$params);

    if (!$stmt) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        header("Location:view_equipas_projeto.php");
    }
}
