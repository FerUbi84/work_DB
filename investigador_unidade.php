<?php
include('connect.php');


$nome_uni = $_GET['unidade_investigacao'];

$select_investigador = "select i.nome,i.orcid,u.id_unidade
from unidade_investigacao u, investigador i
where u.id_unidade = i.id_unidade
and u.unidade_investigacao like '$nome_uni'";

$id_uni = 0;

$stmt = sqlsrv_query($conn, $select_investigador);
if ($stmt == false) {
    echo "Error";
}

?>
<form method="POST" action="insert_investigador.php">
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="nome_uni" name="nome_uni" value="<?php echo $nome_uni;?>" hidden>
        <input type="text" class="form-control" placeholder="Insira o nome" id="nome_inv" name="nome_inv"  required autocomplete="off">
        <input type="text" class="form-control" placeholder="Insira o ORCID" id="orcid_inv" name="orcid_inv" required autocomplete="off">
        <button class="btn btn-outline-secondary" type="submit" id="insere_investigador" name="insere_investigador">Inserir</button>
    </div>
</form>
<table class="table table-hover table-bordered border-primary mt-2" id="table_proj">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">ORCID</th>
        </tr>
    </thead>
    <tbody>

        <?php while ($investigador =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>

            <tr>
                <td><?php echo $investigador['nome']; ?></td>
                <td><?php echo $investigador['orcid']; ?></td>
            </tr>
        <?php
            $id_uni = $investigador['id_unidade'];
        endwhile;
        sqlsrv_free_stmt($stmt);
        ?>

    </tbody>
</table>
