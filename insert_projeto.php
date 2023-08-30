<!DOCTYPE html>
<html lang="en">
<?php require("connect.php"); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Trabalho base dados</title>
</head>

<body>
    <?php include('navigation.php'); ?>
    <div class="container mt-5">
        <h1 class="h1 text-center">Área de Inserção de Projeto de Investigação</h1>
        <form class="row g-3 mt-5" method="POST" action="submit_formulario.php">
            <div class="col-md-4">
                <label for="dominio_projeto" class="form-label">Dominio Projeto</label>
                <select class="form-select" aria-label="Default select example" id="id_dominio" name="id_dominio" required>
                    <option value="" selected>Selecione o Dominio</option>
                    <?php
                    $select_dominios = "SELECT * FROM dominio";

                    $stmt = sqlsrv_query($conn, $select_dominios);
                    if ($stmt == false) {
                        echo "Error";
                    }

                    while ($dominio =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                    ?>
                        <option value="<?php echo $dominio["id_dominio"]; ?>"><?php echo $dominio["nome_dominio"]; ?></option>
                    <?php
                    endwhile;
                    sqlsrv_free_stmt($stmt);
                    //sqlsrv_close($conn);
                    ?>
                </select>
                <div class="invalid-feedback">Insira um dominio</div>
            </div>
            <div class="col-md-4">
                <label for="area_dominio" class="form-label">Area do Dominio</label>
                <select class="form-select" aria-label="Default select example" id="area_dominio" name="area_dominio" required>
                </select>
                <div class="invalid-feedback">Insira uma Área</div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <label for="cod_projeto" class="form-label">Código Projeto</label>
                    <input type="text" class="form-control" id="cod_projeto" name="cod_projeto" required>
                    <div class="invalid-feedback">Insira Código de Projeto</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <label for="nome_curto" class="form-label">Nome Curto</label>
                    <input type="text" class="form-control" id="nome_curto" name="nome_curto" required>
                    <div class="invalid-feedback">Insira Nome Curto</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <label for="titulo" class="form-label">Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                    <div class="invalid-feedback">Insira Titulo</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" required>
                    <div class="invalid-feedback">Insira a descrição</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <label for="data_inicio" class="form-label">Data Inicio</label>
                    <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
                    <div class="invalid-feedback">Insira a data de inicio</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <label for="data_fim" class="form-label">Data Fim</label>
                    <input type="date" class="form-control" id="data_fim" name="data_fim" required>
                    <div class="invalid-feedback">Insira a data de fim</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <label for="url" class="form-label">URL</label>
                    <input type="text" class="form-control" id="url" name="url" required>
                    <div class="invalid-feedback">Insira a data de fim</div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="programa_financiamento" class="form-label">Programa Financiamento</label>
                <select class="form-select" aria-label="Default select example" id="programa_financiamento" name="programa_financiamento" required>
                    <option selected>Selecione o Programa</option>
                    <?php
                    $select_programas = "SELECT * FROM programa_financiamento";

                    $stmt = sqlsrv_query($conn, $select_programas);
                    if ($stmt == false) {
                        echo "Error";
                    }

                    while ($programa =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                    ?>
                        <option value="<?php echo $programa["id_programa"]; ?>"><?php echo $programa["nome_programa"]; ?></option>
                    <?php
                    endwhile;
                    sqlsrv_free_stmt($stmt);
                    //sqlsrv_close($conn);
                    ?>
                </select>
                <div class="invalid-feedback">Insira programa de financiamento</div>
            </div>
            <div class="col-md-4">
                <label for="estado_projeto" class="form-label">Estado Projeto</label>
                <select class="form-select" aria-label="Default select example" id="estado_projeto" name="estado_projeto" required>
                    <option value="" selected>Selecione o Estado</option>
                    <?php
                    $select_estados = "SELECT * FROM estado_projeto";

                    $stmt = sqlsrv_query($conn, $select_estados);
                    if ($stmt == false) {
                        echo "Error";
                    }

                    while ($estado =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                    ?>
                        <option value="<?php echo $estado["id_estado"]; ?>"><?php echo $estado["nome_estado"]; ?></option>
                    <?php
                    endwhile;
                    sqlsrv_free_stmt($stmt);
                    //sqlsrv_close($conn);
                    ?>
                </select>
                <div class="invalid-feedback">Insira programa de financiamento</div>
            </div>
            <div class="col-md-12">
                <div class="form-check">
                    <label for="descricao_projeto" class="form-label">Descrição Projeto</label>
                    <textarea class="form-control" id="descricao_projeto" name="descricao_projeto" rows="10" required></textarea>
                    <div class="invalid-feedback">Insira uma descrição</div>
                </div>
            </div>
            <div class="col-md-6">
                <p><b>Unidades de Investigação</b></p>
                    <?php
                    $select_unidade = "select * from unidade_investigacao";

                    $stmt = sqlsrv_query($conn, $select_unidade);
                    if ($stmt == false) {
                        echo "Error";
                    }

                    while ($unidade =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                    ?>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="unidades[]" name="unidades[]" value="<?php echo $unidade['id_unidade']; ?>">
                            <label class="form-check-label" for="unidades[]"><?php echo $unidade['unidade_investigacao']; ?></label>
                        </div>
                    <?php
                    endwhile;
                    sqlsrv_free_stmt($stmt);
                    //sqlsrv_close($conn);
                    ?>
            </div>
            <div class="col-md-6">
                <p><b>Entidades de Financiamento</b></p>
                    <?php
                    $select_entidades = "select * from entidade_financiamento";

                    $stmt = sqlsrv_query($conn, $select_entidades);
                    if ($stmt == false) {
                        echo "Error";
                    }

                    while ($entidade =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                    ?>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="entidades[]" name="entidades[]" value="<?php echo $entidade['id_entidade']; ?>">
                            <label class="form-check-label" for="entidades[]"><?php echo $entidade['designacao']; ?></label>
                        </div>
                    <?php
                    endwhile;
                    sqlsrv_free_stmt($stmt);
                    //sqlsrv_close($conn);
                    ?>
            </div>
            <div class="d-grid gap-2 mb-5">
                <button class="btn btn-primary" type="submit" id="insere_proj" name="insere_proj">Inserir Projeto</button>
            </div>
    </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
</body>

</html>