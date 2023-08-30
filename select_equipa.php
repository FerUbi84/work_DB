<?php
require("connect.php");

$equipa_projeto = $_GET["equipa_projeto"];


$select_uni = "select u.id_unidade, u.unidade_investigacao
                            from unidade_investigacao u, nivel_participacao n
                            where u.id_unidade = n.id_unidade
                            and n.cod_projeto = '$equipa_projeto'";

$stmt = sqlsrv_query($conn, $select_uni);
if ($stmt == false) {
    echo "Error";
}
echo "<option selected>Selecione a Unidade</option>";
while ($uni =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
?>
    <option value="<?php echo $uni["id_unidade"]; ?>"><?php echo $uni["unidade_investigacao"]; ?></option>
<?php
endwhile;
sqlsrv_free_stmt($stmt);
?>