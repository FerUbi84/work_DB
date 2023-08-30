<?php
include('connect.php');

$cod_proj = $_POST["cod_proj"];
$equipa = $_POST["equipa"];
$chefe = $_POST["chefe"];
$custo = $_POST["custo"];
$valor = $_POST["valor"];

if (isset($_POST["final_proj"])) {



    foreach ($equipa as $elemento) {
        $query_equipa = "INSERT INTO [equipa]
        ([cod_projeto]
        ,[id_investigador]
        ,[funcao]
        ,[tempo_projeto]) VALUES('$cod_proj',$elemento, 'participante','0')";
        $state = sqlsrv_query($conn, $query_equipa);
        if (!$state) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    foreach ($chefe as $chef) {
        $query_chefe = "UPDATE [equipa] SET [funcao] = 'chefe' WHERE [id_investigador] = $chef AND [cod_projeto] = '$cod_proj'";

        $state = sqlsrv_query($conn, $query_chefe);
        if (!$state) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    foreach ($custo as $c) {
        $float_c = floatval($c);
        $query_custo = "UPDATE [custo_projeto] SET [custo] = $float_c WHERE [cod_projeto] = '$cod_proj'";

        $state = sqlsrv_query($conn, $query_custo);
        if (!$state) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    foreach ($valor as $v) {
        $float_v = floatval($v);
        $query_valor = "UPDATE [nivel_participacao] SET [percentagem_projeto] = $float_v WHERE [cod_projeto] = '$cod_proj'";

        $state = sqlsrv_query($conn, $query_valor);
        if (!$state) {
            die(print_r(sqlsrv_errors(), true));
        }else{
            header("Location:tabela_projetos.php");
        }
    }
}
