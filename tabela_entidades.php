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
    <h1 class="h1 text-center mt-5 mb-5">Área de Pesquisa de Entidades de Financiamento</h1>
    <div class="col-6 mt-5">
      <input type="text" class="form-control" placeholder="Pesquise pelo Código Projeto" id="getCode" name="getCode" aria-describedby="basic-addon1" onkeyup="myFunction()">
    </div>
    <table class="table table-hover mt-2 table-bordered border-primary" id="tableProject">
      <thead>
        <tr class="table-primary">
          <th scope="col">Nome Entidade</th>
          <th scope="col">Sigla</th>
          <th scope="col">Email</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $view_entidades = "select nome_entidade, sigla, email from entidade_financiamento";

        $stmt = sqlsrv_query($conn, $view_entidades);
        if ($stmt == false) {
          echo "Error";
        }

        while ($entidade =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
          $nome_entidade=$entidade['nome_entidade'];
        ?>
          <tr>
            <td><a href="view_entidade.php?nome_entidade=<?php echo $nome_entidade; ?>"><?php echo $entidade['nome_entidade']; ?></a></td>
            <td><?php echo $entidade['sigla']; ?></td>
            <td><?php echo $entidade['email']; ?></td>
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
        td = tr[i].getElementsByTagName("td")[0];
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