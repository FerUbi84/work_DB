<!DOCTYPE html>
<html lang="en">
<?php
require("connect.php");
$proj_cod = $_GET['cod_projeto'];
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Trabalho base dados</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">Gestão de Projetos</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="cointainer">
            <h2 class="h2">Selecione a equipa e insira, os montantes das entidades financiadoras e o montante distinado a cada unidade de investigação para o projeto <?php echo $proj_cod;?></h2>
        </div>
        <form class="row g-3 mt-5" method="POST" action="finalize_projeto.php">
        <input type="text"id="cod_proj" name="cod_proj" value="<?php echo $proj_cod;?>" hidden>
            <div class="col-md-4">
                <label for="chefe_projeto" class="form-label">Selecione a equipa do Projeto</label>
                <?php
                $select_chefe = "select i.id_investigador, i.nome, u.unidade_investigacao
                from investigador i, unidade_investigacao u, nivel_participacao n
                where i.id_unidade = u.id_unidade
                and u.id_unidade = n.id_unidade
                and n.cod_projeto = '$proj_cod'";

                $stmt = sqlsrv_query($conn, $select_chefe);
                if ($stmt == false) {
                    echo "Error";
                }

                while ($investigador =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                ?>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="equipa[]" name="equipa[]" value="<?php echo $investigador['id_investigador']; ?>">
                        <label class="form-check-label" for="equipa[]"><?php echo $investigador['nome']; ?> | <?php echo $investigador['unidade_investigacao']; ?></label>
                    </div>
                <?php
                endwhile;
                sqlsrv_free_stmt($stmt);
                //sqlsrv_close($conn);
                ?>
            </div>
            <div class="col-md-4">
                <label for="chefe_projeto" class="form-label">Selecione chefe de equipa do Projeto</label>
                <?php
                $select_chefe = "select i.id_investigador, i.nome, u.unidade_investigacao
                from investigador i, unidade_investigacao u, nivel_participacao n
                where i.id_unidade = u.id_unidade
                and u.id_unidade = n.id_unidade
                and n.cod_projeto = '$proj_cod'";

                $stmt = sqlsrv_query($conn, $select_chefe);
                if ($stmt == false) {
                    echo "Error";
                }

                while ($investigador =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                ?>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="chefe[]" name="chefe[]" value="<?php echo $investigador['id_investigador']; ?>">
                        <label class="form-check-label" for="chefe[]"><?php echo $investigador['nome']; ?> | <?php echo $investigador['unidade_investigacao']; ?></label>
                    </div>
                <?php
                endwhile;
                sqlsrv_free_stmt($stmt);
                //sqlsrv_close($conn);
                ?>
            </div>
            <div class="col-md-12">
                <p class="mt-3"><b>Insira o Montante Financiado pelas Entidades</b></p>
                <div class="row">
                    <?php
                    $select_custos = "select e.nome_entidade, e.id_entidade, c.custo
                from entidade_financiamento e, custo_projeto c
                where e.id_entidade = c.id_entidade
                and c.cod_projeto = '$proj_cod'";

                    $state = sqlsrv_query($conn, $select_custos);
                    if ($state == false) {
                        echo "Error";
                    }
                    while ($custo =  sqlsrv_fetch_array($state, SQLSRV_FETCH_ASSOC)) :
                    ?>
                        <div class="col-md-4">
                            <label for="custo[]" class="form-label">Finciamento da entidade <?php echo $custo['nome_entidade']; ?></label>
                            <input type="text" class="form-control" id="custo[]" name="custo[]" placeholder="<?php echo $custo['custo'] ?>">
                        </div>
                    <?php
                    endwhile;
                    sqlsrv_free_stmt($state);
                    //sqlsrv_close($conn);
                    ?>
                </div>
            </div>
            <div class="col-md-12">
                <p class="mt-3"><b>Insira o Montante para as Unidades de Investigação</b></p>
                <div class="row">
                    <?php
                    $select_recebimentos = "select u.unidade_investigacao, n.percentagem_projeto
                from nivel_participacao n, unidade_investigacao u
                where n.id_unidade = u.id_unidade
                and n.cod_projeto = '$proj_cod'";

                    $state = sqlsrv_query($conn, $select_recebimentos);
                    if ($state == false) {
                        echo "Error";
                    }
                    while ($recebimentos =  sqlsrv_fetch_array($state, SQLSRV_FETCH_ASSOC)) :
                    ?>
                        <div class="col-md-4">
                            <label for="valor[]" class="form-label">Valor para <?php echo $recebimentos['unidade_investigacao']; ?></label>
                            <input type="text" class="form-control" id="valor[]" name="valor[]" placeholder="<?php echo $recebimentos['percentagem_projeto'] ?>">
                        </div>
                    <?php
                    endwhile;
                    sqlsrv_free_stmt($state);
                    //sqlsrv_close($conn);
                    ?>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit" id="final_proj" name="final_proj">Finalizar Projeto</button>
            </div>
    </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
</body>

</html>