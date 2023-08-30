<!DOCTYPE html>
<html lang="en">
<?php require("connect.php");
$cod_proj = $_GET['cod_projeto'];
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php include('navigation.php'); ?>
    <div class="container">
        <h1 class="h1 mt-5">Informação do Projeto</h1>
        <?php
        $view_projeto = "select p.cod_projeto, p.descricao, d.nome_dominio, a.nome_area, f.nome_programa,e.nome_estado ,p.url,p.data_inicio,p.data_fim,p.descricao_projeto
        from projeto p, dominio d, area_investigacao a, estado_projeto e, programa_financiamento f
        where a.id_dominio = d.id_dominio
        and a.id_area = p.id_area
        and p.id_programa = f.id_programa
        and p.id_estado = e.id_estado
        and p.cod_projeto ='$cod_proj'";

        $stmt = sqlsrv_query($conn, $view_projeto);
        if ($stmt == false) {
            echo "Error";
        }
        while ($projeto =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
        ?>
            <div class="container rounded-4 mb-5" style="background-color: #e3f2fd;">
                <div class="row">
                    <div class="col">
                        <b>Titulo</b><br /><?php echo $projeto['descricao']; ?>
                    </div>
                    <div class="col">
                        <b>Código</b><br /><?php echo $projeto['cod_projeto']; ?>
                    </div>
                    <div class="col">
                        <b>Dominio</b><br /><?php echo $projeto['nome_dominio']; ?>
                    </div>
                    <div class="col">
                        <b>Área Cientifica</b><br /><?php echo $projeto['nome_area']; ?>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col">
                        <b>Programa Financiamento</b><br /><?php echo $projeto['nome_programa']; ?>
                    </div>
                    <div class="col">
                        <b>Estado Projeto</b><br /><?php echo $projeto['nome_estado']; ?>
                    </div>
                    <div class="col">
                        <b>url</b><br /><?php echo $projeto['url'];  ?>
                    </div>
                    <div class="col"></div>
                </div>
                <hr />
                <div class="row">
                    <div class="col">
                        <b>Data Inicio:</b><br /><?php echo $projeto['data_inicio']->format('d/m/Y'); ?>
                    </div>
                    <div class="col">
                        <b>Data FIm</b><br /><?php echo $projeto['data_fim']->format('d/m/Y'); ?>
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>
                <hr />
                <div class="container">
                    <p><b>Descrição Projeto</b></p>
                    <?php echo $projeto['descricao_projeto']; ?>
                </div>
            <?php
        endwhile;
        sqlsrv_free_stmt($stmt);
        //sqlsrv_close($conn);
            ?>
            <hr class="mt-5" />
            <div class="row">
                <div class="col">
                    <b>Entidades Financiadoras</b><br />
                    <ul>
                        <?php
                        $view_entidades = "select e.nome_entidade
                from entidade_financiamento e, projeto p, custo_projeto c
                where e.id_entidade = c.id_entidade
                and p.cod_projeto = c.cod_projeto
                and p.cod_projeto = '$cod_proj'";

                        $stmt = sqlsrv_query($conn, $view_entidades);
                        if ($stmt == false) {
                            echo "Error";
                        }
                        while ($entidade =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                        ?>
                            <li><?php echo $entidade['nome_entidade']; ?></li>
                        <?php
                        endwhile;
                        sqlsrv_free_stmt($stmt);
                        ?>
                    </ul>
                </div>
                <?php
                $view_custo = "select sum(c.custo) as total
            from entidade_financiamento e, projeto p, custo_projeto c
            where e.id_entidade = c.id_entidade
            and p.cod_projeto = c.cod_projeto
            and p.cod_projeto = '$cod_proj'";

                $stmt = sqlsrv_query($conn, $view_custo);
                if ($stmt == false) {
                    echo "Error";
                }
                while ($custo =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                ?>
                    <div class="col">
                        <b>Valor Total do Projeto</b><br /><?php echo $custo['total']; ?>€
                    </div>
                    <div class="col mt-5"></div>
                    <div class="col mt-5"></div>
            </div>
            <hr />
        <?php
                endwhile;
                sqlsrv_free_stmt($stmt);
        ?>
        <div class="row">
            <div class="col">
                <b>Unidades de Investigação</b><br />
                <ul>
                    <?php
                    $view_unidades = "select u.unidade_investigacao
            from unidade_investigacao u, nivel_participacao n, projeto p
            where u.id_unidade = n.id_unidade
            and p.cod_projeto = n.cod_projeto
            and p.cod_projeto = '$cod_proj'";

                    $stmt = sqlsrv_query($conn, $view_unidades);
                    if ($stmt == false) {
                        echo "Error";
                    }
                    while ($unidade =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                    ?>
                        <li><?php echo $unidade['unidade_investigacao']; ?></li>
                    <?php
                    endwhile;
                    sqlsrv_free_stmt($stmt);
                    ?>
                </ul>
            </div>
            <?php
            $view_chefe = "select i.nome
                from equipa e, projeto p, investigador i
                where e.id_investigador = i.id_investigador
                and e.cod_projeto = p.cod_projeto
                and e.funcao like '%chefe%'
                and p.cod_projeto = '$cod_proj'";

            $stmt = sqlsrv_query($conn, $view_chefe);
            if ($stmt == false) {
                echo "Error";
            }
            while ($chefe =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
            ?>
                <div class="col">
                    <b>Chefe do Projeto</b><br /><?php echo $chefe['nome']; ?>
                </div>
            <?php
            endwhile;
            sqlsrv_free_stmt($stmt);
            ?>
            <div class="col">
                <b>Membros da Equipa</b><br />
                <ul>
                    <?php
                    $view_equipa = "select i.nome
                        from investigador i, equipa e, projeto p
                        where e.id_investigador = i.id_investigador
                        and e.cod_projeto = p.cod_projeto
                        and e.funcao not like '%chefe%'
                        and p.cod_projeto = '$cod_proj'";

                    $stmt = sqlsrv_query($conn, $view_equipa);
                    if ($stmt == false) {
                        echo "Error";
                    }
                    while ($equipa =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                    ?>
                        <li><?php echo $equipa['nome']; ?></li>
                    <?php
                    endwhile;
                    sqlsrv_free_stmt($stmt);
                    ?>
                </ul>
            </div>
            <div class="col mt-5"></div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>