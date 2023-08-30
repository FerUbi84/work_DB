<?php
include('connect.php');


$unidade_investigacao = $_GET['unidade_investigacao'];

$projeto_investigador = "select i.nome, p.cod_projeto, e.funcao
from projeto p, equipa e, investigador i, unidade_investigacao u,nivel_participacao n
where e.id_investigador = i.id_investigador
and u.id_unidade = i.id_unidade
and n.id_unidade = i.id_unidade
and p.cod_projeto = e.cod_projeto
and e.cod_projeto = n.cod_projeto
and u.unidade_investigacao like '$unidade_investigacao'";

$id_uni = 0;

$stmt = sqlsrv_query($conn, $projeto_investigador);
if ($stmt == false) {
    echo "Error";
}

?>
<h3 class="h3">Projetos dos investigadores de <?php echo $unidade_investigacao;?></h3>
<table class="table table-hover table-bordered border-primary mt-2" id="table_proj">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Código Projeto</th>
            <th scope="col">Função</th>
        </tr>
    </thead>
    <tbody>

        <?php while ($projeto =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) :
            $cod_projeto = $projeto['cod_projeto'];
        ?>

            <tr>
                <td><?php echo $projeto['nome']; ?></td>
                <td><a href="view_project.php?cod_projeto=<?php echo $cod_projeto; ?>"><?php echo $projeto['cod_projeto']; ?></a></td>
                <td><?php echo $projeto['funcao']; ?></td>
            </tr>
        <?php
        endwhile;
        sqlsrv_free_stmt($stmt);
        ?>

    </tbody>
</table>
<script>
    const tbody_inv = document.querySelector("#table_proj tbody")
    tbody_inv.addEventListener('click', (e) => {
        const proj_investigador = document.getElementById("proj_investigador")
        const cell = e.target.closest('td')
        if (!cell) return
        const row = cell.parentElement
        console.log(cell.innerHTML)
        const id_inv = cell.innerHTML

        fetch("investigador_projeto.php?id_investigador=" + id_inv)
            .then((response) => {
                return response.text()
            })
            .then(a => {
                uni_investigador.innerHTML = a
            })
    })
</script>