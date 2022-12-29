    <div class="container mt-2 mb-1 ">
        <div class="fundo-botoes rounded">
            <div class="row justify-content-md-center h-auto ">
                <div class="col-md-auto mt-4">
                    <form method="POST">
                        <a href="controle-de-veiculos" class="btn btn-primary btn">Veiculos</a>
                        <button type="button" class='btn btn-success btn' data-bs-toggle='modal' data-bs-target='#modalCadastrarAbastecimento'>Cadastrar Abastecimento</button>
                        <button type="submit" class='btn btn-warning btn'>Filtrar</button>
                        <button class="btn btn-success btn" onclick="table2excel('t1')">Excel</button>
                        <button name="acao" value="limpar" type="submit" class='btn btn-secondary btn'>Limpar</button>
                        <a href="logout" class="btn btn-danger btn">Sair</a>
                </div>
            </div>
        </div>
    </div>
    <div class="d-grid gap-3">
    <div class="container-fluid p-4">
        <div class="table-responsive">
            <table class="table table-sm fs-6 mb-0">
                <thead class="fundo-cabecalho">
                    <tr>
                        <th>Data Abastecimento</th>
                        <th>Prefixo</th>
                        <th>Combustivel</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Setor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="date" name="dataAbastecimento" value="<?= $dataAbastecimento ?>"></td>
                        <td>
                            <select onChange="this.form.submit()" name="prefixo" required>
                                <option selected><?= ($prefixoFiltro <> '' ? $prefixoFiltro : 'TODOS') ?></options>
                                <option>TODOS</options>
                                    <?php
                                    $ativado = 1;
                                    $sql = $pdo->prepare("SELECT * FROM veiculos  WHERE status_veiculo = :ativado ORDER BY prefixo");
                                    $sql->bindValue(':ativado', $ativado);
                                    $sql->execute();
                                    $fetchAll = $sql->fetchAll();
                                    foreach ($fetchAll as $prefixo) {
                                        echo '<option value="' . $prefixo['prefixo'] . '">' . $prefixo['prefixo'] . '</option>';
                                    }
                                    ?>
                            </select>
                        </td>
                        <td>
                            <select onChange="this.form.submit()" name="combustivel">
                                <option selected><?= ($combustivel <> '' ? $combustivel : 'TODOS') ?></options>
                                <option>TODOS</options>
                                    <?php
                                    $sql = $pdo->prepare("SELECT DISTINCT combustivel FROM veiculos  ORDER BY combustivel");
                                    $sql->execute();
                                    $fetchAll = $sql->fetchAll();
                                    foreach ($fetchAll as $combustivel) {
                                        echo '<option value="' . $combustivel['combustivel'] . '">' . substr($combustivel['combustivel'], 0, 10) . '</option>';
                                    }
                                    ?>
                            </select>
                        </td>
                        <td>
                            <select onChange="this.form.submit()" name="marca">
                                <option selected><?= ($marca <> '' ? $marca : 'TODOS') ?></options>
                                <option>TODOS</options>
                                    <?php
                                    $sql = $pdo->prepare("SELECT DISTINCT marca FROM veiculos  ORDER BY marca");
                                    $sql->execute();
                                    $fetchAll = $sql->fetchAll();
                                    foreach ($fetchAll as $marca) {
                                        echo '<option value="' . $marca['marca'] . '">' . substr($marca['marca'], 0, 10) . '</option>';
                                    }
                                    ?>
                            </select>
                        </td>
                        <td>
                            <select onChange="this.form.submit()" name="modelo">
                                <option selected><?= ($modelo <> '' ? $modelo : 'TODOS') ?></options>
                                <option>TODOS</options>
                                    <?php
                                    $sql = $pdo->prepare("SELECT DISTINCT modelo FROM veiculos  ORDER BY modelo");
                                    $sql->execute();
                                    $fetchAll = $sql->fetchAll();
                                    foreach ($fetchAll as $modelo) {
                                        echo '<option value="' . $modelo['modelo'] . '">' . substr($modelo['modelo'], 0, 15) . '</option>';
                                    }
                                    ?>
                            </select>
                        </td>
                        <td>
                            <select onChange="this.form.submit()" name="setor">
                                <option selected><?= ($setor <> '' ? $setor : 'TODOS') ?></options>
                                <option>TODOS</options>
                                    <?php
                                    $sql = $pdo->prepare("SELECT DISTINCT setor FROM veiculos  ORDER BY setor");
                                    $sql->execute();
                                    $fetchAll = $sql->fetchAll();
                                    foreach ($fetchAll as $setor) {
                                        echo '<option value="' . $setor['setor'] . '">' . substr($setor['setor'], 0, 15) . '</option>';
                                    }
                                    ?>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        </form>
        <div class="table-responsive">
            <div class="tabelas-customizadas">
                <table id="t1" data-tablesaw-sortable data-tablesaw-sortable-switch class="tablesaw table-sm fs-6 mb-0" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
                    <thead class="fundo-cabecalho">
                        <tr>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="6">
                                <center>Data
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Hora
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Mês
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Ano
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Prefixo Sap
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Prefixo
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Placa
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="6">
                                <center>Combustivel
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Bomba
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Odometro Incial
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Odometro Final
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Litros Od
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Litros
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Ultimo Km
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Km
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="5">
                                <center>Dif Km
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Ultimo Hr
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="6">
                                <center>Hr
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="6">
                                <center>Dif Hr
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Frentista
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Marca
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Modelo
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Media
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Setor
                            </th>
                        </tr>
                    </thead>