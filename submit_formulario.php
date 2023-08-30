<?php
include('connect.php');

$id_area = $_POST["area_dominio"];
$cod_projeto = $_POST["cod_projeto"];
$nome_curto = $_POST["nome_curto"];
$titulo = $_POST["titulo"];
$descricao = $_POST["descricao"];
$data_inicio = $_POST["data_inicio"];
$data_fim = $_POST["data_fim"];
$descricao_projeto = $_POST["descricao_projeto"];
$url = $_POST["url"];

$id_programa = $_POST["programa_financiamento"];
$id_estado = $_POST["estado_projeto"];

$unidades = $_POST['unidades'];
$entidades = $_POST['entidades'];

if (isset($_POST['insere_proj'])) {


    $params = array($cod_projeto, $nome_curto, $titulo, $descricao, $data_fim, $data_fim, $descricao_projeto, $id_programa, $id_area, $id_estado, $url);
    $insert_projeto = "INSERT INTO [projeto]
        ([cod_projeto]
        ,[nome_curto]
        ,[titulo]
        ,[descricao]
        ,[data_inicio]
        ,[data_fim]
        ,[descricao_projeto]
        ,[id_programa]
        ,[id_area]
        ,[id_estado]
        ,[url]) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = sqlsrv_query($conn, $insert_projeto, $params);

    if (!$stmt) {
        die(print_r(sqlsrv_errors(), true));
    }

    foreach ($unidades as $unidade) {
        $query_unidade = "INSERT INTO  nivel_participacao (cod_projeto, id_unidade,percentagem_projeto) VALUES('$cod_projeto',$unidade, 0)";
        $state = sqlsrv_query($conn, $query_unidade);
        if (!$state) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    foreach ($entidades as $entidade) {
        $query_entidade = "INSERT INTO  custo_projeto (cod_projeto, id_entidade,custo) VALUES('$cod_projeto',$entidade, 0)";
        $state = sqlsrv_query($conn, $query_entidade);
        if (!$state) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            header("Location:insert_info.php?cod_projeto=" . $cod_projeto);
        }
    }
}
