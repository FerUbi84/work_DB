<?php
include('connect.php');


$equipa_projeto = $_GET['equipa_projeto'];



?>
<table class="table table-hover table-bordered border-primary mt-2" id="table_proj">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Unidade de Investigação</th>
            <th scope="col">Função</th>
            <th scope="col">Tempo no Projeto</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $select_equipa = "select i.id_investigador, i.nome,u.unidade_investigacao, e.funcao, e.tempo_projeto 
        from equipa e, projeto p, investigador i, unidade_investigacao u
        where e.id_investigador = i.id_investigador
        and i.id_unidade = u.id_unidade
        and e.cod_projeto = p.cod_projeto
        and e.cod_projeto = '$equipa_projeto'";

        $id_uni = 0;

        $stmt = sqlsrv_query($conn, $select_equipa);
        if ($stmt == false) {
            echo "Error";
        }


        while ($equipa =  sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>

            <tr>
                <td><?php echo $equipa['nome']; ?></td>
                <td><?php echo $equipa['unidade_investigacao']; ?></td>
                <td>
                    <?php
                    if ($equipa['funcao'] != 'chefe') :
                    ?>
                        <form method="POST" action="change_funcao.php">
                            <div class="input-group">
                                <input type="hidden" id="cod_proj" name="cod_proj" value="<?php echo $equipa_projeto; ?>">
                                <input type="hidden" id="id_inv" name="id_inv" value="<?php echo $equipa['id_investigador']; ?>">
                                <input type="text" id="nova_func" name="nova_func" class="form-control" value="<?php echo $equipa['funcao']; ?>">
                                <button class="btn btn-outline-secondary" type="submit" id="ch_func" name="ch_func">Mudar</button>
                            </div>
                        </form>
                    <?php
                    elseif ($equipa['funcao'] == 'chefe') :
                        echo $equipa['funcao'];
                    endif;
                    ?>
                </td>
                <td>
                    <form method="POST" action="change_tempo.php">
                        <div class="input-group">
                            <input type="hidden" id="cod_p" name="cod_p" value="<?php echo $equipa_projeto; ?>">
                            <input type="hidden" id="id_iv" name="id_iv" value="<?php echo $equipa['id_investigador']; ?>">
                            <input type="text" id="temp_f" name="temp_f" class="form-control" value="<?php echo $equipa['tempo_projeto']; ?>">
                            <button class="btn btn-outline-secondary" type="submit" id="ch_temp" name="ch_temp">Mudar</button>
                        </div>
                    </form>
                </td>
            </tr>
        <?php
        //$id_uni = $investigador['id_unidade'];
        endwhile;
        sqlsrv_free_stmt($stmt);
        ?>
    </tbody>
</table>
<script src="equipa.js"></script>