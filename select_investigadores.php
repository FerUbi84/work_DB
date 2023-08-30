<?php

require("connect.php");

$id_uni = $_GET['id_uni'];
$cod_proj = $_GET['cod_proj'];

/** @var mixed $select_inv query não correcta, corrigir */
$select_inv = "select i.id_investigador, i.nome
from investigador i, projeto p, unidade_investigacao u
where not exists(select e.id_investigador
from equipa e , unidade_investigacao u 
where i.id_investigador = e.id_investigador
and p.cod_projeto = e.cod_projeto)
and p.cod_projeto = '$cod_proj'
and i.id_unidade = u.id_unidade
and u.id_unidade =$id_uni";


$stmt = sqlsrv_query($conn, $select_inv);
if ($stmt == false) {
    echo "Error";
}
echo "<option selected>Selecione o investigador</option>";
while ($inv =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
?>
    <option value="<?php echo $inv["id_investigador"]; ?>"><?php echo $inv["nome"]; ?></option>
<?php
endwhile;
sqlsrv_free_stmt($stmt);
?>
