<!DOCTYPE html>
<html lang="en">
<?php require("connect.php"); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php include('navigation.php'); ?>
    <div class="container mt-5">
        <h1 class="h1 text-center mb-5">Parâmetros </h1>
        <div class="row">
            <div class="col-md-4">
                <form method="POST" action="insert_params.php">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Insira um dominio" id="dominio" name="dominio">
                        <button class="btn btn-outline-secondary" type="submit" id="insere_dominio" name="insere_dominio">Inserir</button>
                    </div>
                </form>
                <table class="table table-hover table-bordered border-primary mt-2" id="table_unidades">
                    <thead>
                        <tr>
                            <th scope="col">Dominios</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dominios = "select * from dominio";

                        $stmt = sqlsrv_query($conn, $dominios);
                        if ($stmt == false) {
                            echo "Error";
                        }
                        while ($dominio = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                        ?>
                            <tr>
                                <td><?php echo $dominio['nome_dominio']; ?></td>
                            </tr>
                        <?php
                        endwhile;
                        sqlsrv_free_stmt($stmt);
                        //sqlsrv_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <form method="POST" action="insert_areas.php">
                    <div class="input-group mb-3">
                        <select id="id_dominio" name="id_dominio">
                            <?php
                            $dominios = "select * from dominio";

                            $stmt = sqlsrv_query($conn, $dominios);
                            if ($stmt == false) {
                                echo "Error";
                            }
                            while ($dominio = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                            ?>
                                <option value="<?php echo $dominio['id_dominio']; ?>"><?php echo $dominio['nome_dominio']; ?></option>
                            <?php
                            endwhile;
                            sqlsrv_free_stmt($stmt);
                            //sqlsrv_close($conn);
                            ?>
                        </select>
                        <input type="text" class="form-control" placeholder="Insira uma área" id="area" name="area">
                        <button class="btn btn-outline-secondary" type="submit" id="insere_area" name="insere_area">Inserir</button>
                    </div>
                </form>
                <table class="table table-hover table-bordered border-primary mt-2" id="table_unidades">
                    <thead>
                        <tr>
                            <th scope="col">Dominio</th>
                            <th scope="col">Área de dominio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $view_areas = "select d.nome_dominio, a.nome_area
                                        from dominio d, area_investigacao a
                                        where d.id_dominio = a.id_dominio";

                        $stmt = sqlsrv_query($conn, $view_areas);
                        if ($stmt == false) {
                            echo "Error";
                        }
                        while ($area = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                        ?>
                            <tr>
                                <td><?php echo $area['nome_dominio']; ?></td>
                                <td><?php echo $area['nome_area']; ?></td>
                            </tr>
                        <?php
                        endwhile;
                        sqlsrv_free_stmt($stmt);
                        //sqlsrv_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <form method="POST" action="insert_programa.php">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Insira um programa de financiamento" id="financiamento" name="financiamento">
                        <button class="btn btn-outline-secondary" type="submit" id="insere_financiamento" name="insere_financiamento">Inserir</button>
                    </div>
                </form>
                <table class="table table-hover table-bordered border-primary mt-2" id="table_unidades">
                    <thead>
                        <tr>
                            <th scope="col">Programas de Financiamento</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $view_programas = "SELECT * FROM programa_financiamento";

                        $stmt = sqlsrv_query($conn, $view_programas);
                        if ($stmt == false) {
                            echo "Error";
                        }
                        while ($programa = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                        ?>
                            <tr>
                                <td><?php echo $programa['nome_programa']; ?></td>
                            </tr>
                        <?php
                        endwhile;
                        sqlsrv_free_stmt($stmt);
                        //sqlsrv_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>