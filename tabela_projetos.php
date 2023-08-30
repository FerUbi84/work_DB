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
  <div class="container">
    <h1 class="h1 text-center mt-5 mb-5">Área de Pesquisa de Projetos</h1>
    <div class="col-6 mt-5">
      <input type="text" class="form-control" placeholder="Pesquise pelo Código Projeto" id="getCode" name="getCode" aria-describedby="basic-addon1" onkeyup="myFunction()">
    </div>
    <table class="table table-hover mt-2 table-bordered border-primary" id="tableProject">
      <thead>
        <tr class="table-primary">
          <th scope="col">Título</th>
          <th scope="col">Código Projeto</th>
          <th scope="col">Nome Curto</th>
          <th scope="col">Data Inicio</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $view_projetos = "select p.titulo,p.nome_curto,p.cod_projeto, p.data_inicio,e.nome_estado
         from projeto p, estado_projeto e
         where p.id_estado = e.id_estado";

        $stmt = sqlsrv_query($conn, $view_projetos);
        if ($stmt == false) {
          echo "Error";
        }

        while ($projeto =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
          $cod_projeto = $projeto['cod_projeto'];
        ?>
          <tr>
            <td><?php echo $projeto['titulo']; ?></td>
            <td><a href="view_project.php?cod_projeto=<?php echo $cod_projeto; ?>"><?php echo $projeto['cod_projeto']; ?></a></td>
            <td><?php echo $projeto['nome_curto']; ?></td>
            <td><?php echo $projeto['data_inicio']->format('d/m/Y'); ?></td>
            <td>
              <form method="POST" action="change_estado.php">
                <div class="input-group">
                  <input type="hidden" id="cod_proj" name="cod_proj" value="<?php echo $projeto['cod_projeto']; ?>">
                  <select name="change_estado" id="change_estado" class="form-select">
                    <?php
                    $select_estados = "SELECT * FROM estado_projeto";
                    $state = sqlsrv_query($conn, $select_estados);
                    if ($state == false) {
                      echo "Error";
                    }
                    while ($estado =  sqlsrv_fetch_array($state, SQLSRV_FETCH_ASSOC)) :
                    ?>
                      <option value="<?php echo $estado["id_estado"]; ?>" <?php echo ($projeto['nome_estado'] == $estado["nome_estado"]) ? "selected" : ""; ?>><?php echo $estado["nome_estado"]; ?></option>
                    <?php
                    endwhile;
                    sqlsrv_free_stmt($state);
                    ?>
                  </select>
                  <button class="btn btn-outline-secondary" type="submit" name="change_id" id="change_id">Alterar</button>
                </div>
              </form>
            </td>
          </tr>
        <?php
        endwhile;
        sqlsrv_free_stmt($stmt);
        //sqlsrv_close($conn);
        ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script>
    function myFunction() {

      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("getCode");
      filter = input.value.toUpperCase();
      table = document.getElementById("tableProject");
      tr = table.getElementsByTagName("tr");


      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>
</body>

</html>