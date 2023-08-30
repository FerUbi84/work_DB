<?php
include('connect.php');

$id_dominio = $_GET['id_dominio'];


$select_area = "SELECT * FROM area_investigacao WHERE id_dominio=$id_dominio";

//$data = ["id_dominio" => $dominio];

$stmt = sqlsrv_query($conn, $select_area);
if ($stmt == false) {
    echo "Error";
}
echo "<option selected>Selecione a Area</option>";
while ($area =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { ?>
    <option value="<?php echo $area["id_area"]; ?>"><?php echo $area["nome_area"]; ?></option>
<?php
}
sqlsrv_free_stmt($stmt); ?>