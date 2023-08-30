<!DOCTYPE html>
<html lang="en">
<?php require("connect.php");
$nome_entidade = $_GET['nome_entidade'];
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
        <h1 class="h1 mt-5">Informação da Entidade</h1>
        <?php
        $view_entidade = "select * from entidade_financiamento where nome_entidade like '%$nome_entidade%'";

        $stmt = sqlsrv_query($conn, $view_entidade);
        if ($stmt == false) {
            echo "Error";
        }
        while ($entidade =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
        ?>
            <div class="container rounded-4 mb-5" style="background-color: #e3f2fd;">
                <div class="row">
                    <div class="col">
                        <b>Designação</b><br /><?php echo $entidade['designacao']; ?>
                    </div>
                    <div class="col">
                        <b>Sigla</b><br /><?php echo $entidade['sigla']; ?>
                    </div>
                    <div class="col">
                        <b>Nome Entidade</b><br /><?php echo $entidade['nome_entidade']; ?>
                    </div>
                    <div class="col">
                        <b>País</b><br /><?php echo $entidade['pais']; ?>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col">
                        <b>URL</b><br /><?php echo $entidade['url']; ?>
                    </div>
                    <div class="col">
                        <b>Telefone</b><br /><?php echo $entidade['telefone']; ?>
                    </div>
                    <div class="col">
                        <b>Morada</b><br /><?php echo $entidade['morada'];  ?>
                    </div>
                    <div class="col">
                        <b>Email</b><br /><?php echo $entidade['email'];  ?>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col">
                        <b>Descrição</b><br /><?php echo $entidade['descricao']; ?>
                    </div>
                </div>
            </div>
        <?php
            endwhile;
            sqlsrv_free_stmt($stmt);
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>