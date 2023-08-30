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
    <h1 class="h1 text-center">Área de Inserção de Entidade de Financiamento</h1>
        <form class="row g-3 mt-5" method="POST" action="submit_entidade.php">
            <div class="col-md-4">
                <label for="designacao" class="form-label">Designação</label>
                <input type="text" class="form-control" id="designacao" name="designacao" required>
            </div>
            <div class="col-md-4">
                <label for="sigla" class="form-label">Sigla</label>
                <input type="text" class="form-control" id="sigla" name="sigla" required>
            </div>
            <div class="col-md-4">
                <label for="nome_entidade" class="form-label">Nome Entidade</label>
                <input type="text" class="form-control" id="nome_entidade" name="nome_entidade" required>
            </div>
            <div class="col-md-4">
                <label for="pais" class="form-label">País</label>
                <input type="text" class="form-control" id="pais" name="pais" required>
            </div>
            <div class="col-md-4">
                <label for="url" class="form-label">URL</label>
                <input type="text" class="form-control" id="url" name="url" required>
            </div>
            <div class="col-md-4">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" required>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-md-4">
                <label for="morada" class="form-label">Morada</label>
                <input type="text" class="form-control" id="morada" name="morada" required>
            </div>
            <div class="col-md-12">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="10" required></textarea>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit" id="insere_entidade" name="insere_entidade">Inserir Entidade</button>
            </div>
    </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
</body>

</html>