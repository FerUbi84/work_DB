<?php
include('connect.php');

$designacao = $_POST["designacao"];
$sigla = $_POST["sigla"];
$nome_entidade = $_POST["nome_entidade"];
$pais = $_POST["pais"];
$url = $_POST["url"];
$telefone = $_POST["telefone"];
$email = $_POST["email"];
$morada = $_POST["morada"];
$descricao = $_POST["descricao"];


if (isset($_POST["insere_entidade"])) {
    

    $params = array($designacao, $sigla, $nome_entidade, $pais, $url, $telefone, $morada, $descricao, $email);
    $insert_entidade = "INSERT INTO [entidade_financiamento]
        ([designacao]
        ,[sigla]
        ,[nome_entidade]
        ,[pais]
        ,[url]
        ,[telefone]
        ,[morada]
        ,[descricao]
        ,[email]) VALUES (?,?,?,?,?,?,?,?,?)";

    $stmt = sqlsrv_query($conn, $insert_entidade, $params);

    if (!$stmt) {
        die(print_r(sqlsrv_errors(), true));
    }
    else {
        header("Location:tabela_projetos.php");
    }
}
