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
        <h1 class="h1 text-center mb-5">Unidades de Investigação</h1>
        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="insert_unidade.php">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Insira uma nova unidade de investigação" id="uni" name="uni" required autocomplete="off">
                        <button class="btn btn-outline-secondary" type="submit" id="insere_unidade" name="insere_unidade">Inserir</button>
                        <div class="invalid-feedback">Insira uma descrição</div>
                    </div>
                </form>
                <table class="table table-hover table-bordered border-primary mt-2" id="table_unidades">
                    <thead>
                        <tr>
                            <th scope="col">Unidade de Investigação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $view_unidades = "select * from unidade_investigacao";

                        $stmt = sqlsrv_query($conn, $view_unidades);
                        if ($stmt == false) {
                            echo "Error";
                        }
                        while ($unidade = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                        ?>
                            <tr>
                                <td><?php echo $unidade['unidade_investigacao']; ?></td>
                            </tr>
                        <?php
                        endwhile;
                        sqlsrv_free_stmt($stmt);
                        //sqlsrv_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6" id="uni_investigador">

            </div>
            <div class="col-md-12" id="proj_investigador">

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        const tbody = document.querySelector("#table_unidades tbody")
        tbody.addEventListener('click', (e) => {
            const uni_investigador = document.getElementById("uni_investigador")
            const cell = e.target.closest('td')
            if (!cell) return
            const row = cell.parentElement
            console.log(cell.innerHTML)
            const val_uni = cell.innerHTML
            console.log(val_uni)
            fetch("investigador_unidade.php?unidade_investigacao=" + val_uni)
                .then((response) => {
                    return response.text()
                })
                .then(a => {
                    uni_investigador.innerHTML = a
                })
        })

        tbody.addEventListener('click', (e) => {
            const proj_investigador = document.getElementById("proj_investigador")
            const cell = e.target.closest('td')
            if (!cell) return
            const row = cell.parentElement
            console.log(cell.innerHTML)
            const val_uni = cell.innerHTML

            fetch("investigador_projeto.php?unidade_investigacao=" + val_uni)
                .then((response) => {
                    return response.text()
                })
                .then(a => {
                    proj_investigador.innerHTML = a
                })
        })
    </script>
</body>

</html>