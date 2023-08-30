<!DOCTYPE html>
<html lang="en">
<?php require("connect.php"); ?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <title>Document</title>
</head>

<body>
  <?php include('navigation.php'); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <div class="table-responsive mt-lg-5">
          <h4 class="h4">Número de Projetos por Unidade</h4>
          <table class="table table-bordered">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Unidade de Investigação</th>
                <th>Números de Projetos</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $select_num_projetos = "select cast(u.unidade_investigacao as nvarchar(50)) as unidades, count(cast(p.cod_projeto as nvarchar(50))) as qtd_projeto
          from projeto p, unidade_investigacao u, nivel_participacao n
          where u.id_unidade = n.id_unidade
          and p.cod_projeto = n.cod_projeto
          group by cast(u.unidade_investigacao as nvarchar(50))
          order by count(cast(p.cod_projeto as nvarchar(50))) desc";


              $stmt = sqlsrv_query($conn, $select_num_projetos);

              if ($stmt == false) {
                echo "Error";
              }

              while ($projetos =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
              ?>
                <tr>
                  <td><b><?php echo $projetos["unidades"]; ?></b></td>
                  <td class="text-center"><b><?php echo $projetos["qtd_projeto"]; ?></b></td>

                </tr>
              <?php
              endwhile;
              sqlsrv_free_stmt($stmt);
              ?>

            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-4">
        <div class="table-responsive mt-lg-5">
          <h4 class="h4 ">Total de Financiamento</h4>
          <table class="table table-bordered">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Unidade de Financiamento</th>
                <th>Total Finaciado</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $select_total = "select cast(e.designacao as nvarchar(50)) as designacao, sum(c.custo) as qtd_projeto
              from entidade_financiamento e, custo_projeto c
              where e.id_entidade = c.id_entidade
              group by cast(e.designacao as nvarchar(50))";


              $stmt = sqlsrv_query($conn, $select_total);

              if ($stmt == false) {
                echo "Error";
              }

              while ($total =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
              ?>
                <tr>
                  <td><b><?php echo $total["designacao"]; ?></b></td>
                  <td class="text-center"><b><?php echo $total["qtd_projeto"]; ?>€</b></td>

                </tr>
              <?php
              endwhile;
              sqlsrv_free_stmt($stmt);
              ?>

            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-4">
        <div class="table-responsive mt-lg-5">
          <h4 class="h4 ">Total de Valor recebido</h4>
          <table class="table table-bordered">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Unidade de Investigação</th>
                <th>Total Finaciado</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $select_total = "select cast(u.unidade_investigacao as nvarchar(50)) as unidade, sum(n.percentagem_projeto) total
              from unidade_investigacao u, nivel_participacao n
              where u.id_unidade = n.id_unidade
              group by cast(u.unidade_investigacao as nvarchar(50)) ";


              $stmt = sqlsrv_query($conn, $select_total);

              if ($stmt == false) {
                echo "Error";
              }

              while ($total =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
              ?>
                <tr>
                  <td><b><?php echo $total["unidade"]; ?></b></td>
                  <td class="text-center"><b><?php echo $total["total"]; ?>€</b></td>

                </tr>
              <?php
              endwhile;
              sqlsrv_free_stmt($stmt);
              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="table-responsive mt-lg-5">
          <h4 class="h4">Número de Líder de Projetos por Unidade</h4>
          <table class="table table-bordered">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Unidade de Investigação</th>
                <th>Lider por Projeto</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $select_lider_projetos = "select cast(u.unidade_investigacao as nvarchar(50)) as unidades, count(cast(e.funcao as nvarchar(50))) as lider
              from projeto p, unidade_investigacao u, equipa e, investigador i
              where u.id_unidade = i.id_unidade
              and i.id_investigador = e.id_investigador
              and p.cod_projeto = e.cod_projeto
              and e.funcao like '%chefe%'
              group by cast(u.unidade_investigacao as nvarchar(50))";


              $stmt = sqlsrv_query($conn, $select_lider_projetos);

              if ($stmt == false) {
                echo "Error";
              }

              while ($lider =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
              ?>
                <tr>
                  <td><b><?php echo $lider["unidades"]; ?></b></td>
                  <td class="text-center"><b><?php echo $lider["lider"]; ?></b></td>

                </tr>
              <?php
              endwhile;
              sqlsrv_free_stmt($stmt);
              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>