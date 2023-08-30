<?php
include('connect.php');

$nome_uni = $_POST['nome_uni'];
$nome = $_POST['nome_inv'];
$orcid = $_POST['orcid_inv'];



if (isset($_POST['insere_investigador'])) {

    $insert_investigador = "INSERT INTO [dbo].[investigador]
    ([orcid]
    ,[nome]
    ,[diubi]
    ,[id_unidade])
VALUES ('$orcid', '$nome', 0, (SELECT id_unidade from unidade_investigacao WHERE unidade_investigacao LIKE '%$nome_uni%'))";

    $stmt = sqlsrv_query($conn, $insert_investigador);
    if ($stmt == false) {
        echo "Error";
    } else {
        header("Location:view_unidades.php");
    }
}
