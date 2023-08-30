<!DOCTYPE html>
<html lang="en">
<?php require("connect.php");
$equipa_projeto = 0; ?>

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
        <h1 class="h1 text-center mt-5 mb-5">Área de gestão de equipas de projetos</h1>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-hover table-bordered border-primary mt-2" id="table_proj">
                    <thead>
                        <tr>
                            <th scope="col">Código Projeto</th>
                            <th scope="col">Data Inicio</th>
                            <th scope="col">Data Fim</th>
                            <th scope="col">Estado Projeto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $view_proj = "select p.cod_projeto,p.data_inicio,p.data_fim,t.nome_estado
                        from projeto p, estado_projeto t
                        where p.id_estado = t.id_estado
                        ";
                        $c_p = 0;
                        $stmt = sqlsrv_query($conn, $view_proj);
                        if ($stmt == false) {
                            echo "Error";
                        }
                        while ($proj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
                        ?>
                            <tr>
                                <td><?php echo $proj['cod_projeto']; ?></td>
                                <td><?php echo $proj['data_inicio']->format('d/m/Y'); ?></td>
                                <td><?php echo $proj['data_fim']->format('d/m/Y'); ?></td>
                                <td><?php echo $proj['nome_estado']; ?></td>
                            </tr>
                            <p id="estado_p" name="estado_p" hidden><?php echo $proj['nome_estado']; ?></p>
                            <p id="cod_p" name="cod_p" hidden><?php echo $proj['cod_projeto']; ?></p>
                        <?php
                            $equipa_projeto = $proj['cod_projeto'];
                        endwhile;
                        sqlsrv_free_stmt($stmt);
                        //sqlsrv_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12" id="form_equipa" name="form_equipa">
                <h3 class="h3 mt-5 ">Insira um investigador na equipa e edite os dados caso seja necessário</h3>
                <form method="POST" action="insert_to_equipa.php">
                    <input type="text" id="cod_pro" name="cod_pro" hidden />
                    <div class="input-group mb-3">
                        <select id="name_ins" name="name_ins">
                            <option selected>Selecione a Unidade</option>
                        </select>
                        <select id="inv_name" name="inv_name">
                            <option selected>Selecione o Instituto</option>
                        </select>
                        <button class="btn btn-outline-secondary" type="submit" id="insere_investigador" name="insere_investigador">Inserir</button>
                    </div>
                </form>
            </div>
            <div class="col-md-12" id="proj_equipa">

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
     
    <script>
        const tbody = document.querySelector("#table_proj tbody")

        tbody.addEventListener('click', (e) => {
            const uni_investigador = document.getElementById("proj_equipa")
            const estado_p = document.getElementById("estado_p")
            let valor_estado = estado_p.innerHTML
            console.log("estado:" + valor_estado)
            const name_ins = document.getElementById("name_ins")
            const cod_pro = document.getElementById("cod_pro")
            const cell = e.target.closest('td')
            
            if (!cell) return
            const row = cell.parentElement
            const cod_proj = cell.innerHTML
            cod_pro.value = cod_proj
            let p
            console.log(cod_pro.value)
            fetch("equipas.php?equipa_projeto=" + cod_proj)
                .then((response) => {
                    p = cod_proj
                    return response.text()
                })
                .then(a => {
                    uni_investigador.innerHTML = a
                    return fetch("select_equipa.php?equipa_projeto=" + p)
                        .then(response => {

                            return response.text()
                        })
                        .then(a => {

                            name_ins.innerHTML = a
                        })

                })
        })

        name_ins.onchange = () => {
            let inv_name = document.getElementById("inv_name")
            let v = name_ins.value
            let cod_p = document.getElementById("cod_p").innerHTML
            fetch("select_investigadores.php?id_uni=" + v + "&cod_proj=" + cod_p)
                .then(response => {
                    return response.text()
                })
                .then(a => {
                    //console.log(a)
                    inv_name.innerHTML = a
                })
        }

       
    </script>

</body>

</html>