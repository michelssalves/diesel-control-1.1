<?php session_start(); 
include '../controller/config.php';
include '../controller/checkAcess.php';
include '../model/Abastecimentos.php';
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/custom.css">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/fontawesome.all.min.6.2.1.css">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/tablesaw.css">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/w3.min.css">
    <!--  TABLESAW - DEIXA A TABELA RESPONSIVA-->
    <script src="diesel-control-1.1/assets/js/tablesawn-label.js"></script>
    <script src="diesel-control-1.1/assets/js/tablesaw.js"></script>
    <script src="diesel-control-1.1/assets/js/tablesaw-init.js"></script>
   <!--  /TABLESAW - DEIXA A TABELA RESPONSIVA-->
    <script src="diesel-control-1.1/assets/js/jquery-3.6.1.min.js"></script>
    <script src="diesel-control-1.1/assets/js/sorttable.js"></script>
    <script src="diesel-control-1.1/assets/js/jquery.table2excel.js"></script>  
</head>
<body>
    <div class="w3-bar w3-light-grey">
        <a href="menu-principal-novo" class="w3-bar-item w3-button">Menu Principal</a>
        <a href="controle-de-veiculos-novo" class="w3-bar-item w3-button">Veiculos</a>
        <a href="logout-novo" class="w3-bar-item w3-button w3-red w3-right">Sair</a>
        <a class="w3-bar-item w3-button w3-right"><?= $usuario; ?></a>
    </div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto mt-4">  
            <?php 
            
            include '../controller/abastecimentoDataBaseAcess.php';
            ?>
            <form method="POST">  
                <button type="button" class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modalCadastrarAbastecimento'>Cadastrar</button>
                <button class="btn btn-success btn-sm" onclick="table2excel('t1')">Excel</button>
                <button name="acao" value="filtrar" type="submit" class='btn btn-primary btn-sm'>Filtrar</button>
                <button name="acao" value="limpar" type="submit" class='btn btn-secondary btn-sm'>Limpar</button>
            </div>
        </div>
    </div>
    <div class="container">
                <div class="table-responsive">
                    <table class="table table-sm fs-6 mb-0">
                        <thead class="fundo-cabecalho">
                            <tr>
                                <th>Data 01</th>
                                <th>Data 02</th>
                                <th>Prefixo</th>
                                <th>Combustivel</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Setor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="date" name="dataInicial" value="<?= $dataInicial ?>"></td>
                                <td><input type="date" name="dataFinal" value="<?= $dataFinal ?>"></td>
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
                                    <option selected><?= ($combustivelFiltro <> '' ? $combustivelFiltro : 'TODOS') ?></options>
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
                                    <option selected><?= ($marcaFiltro <> '' ? $marcaFiltro : 'TODOS') ?></options>
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
                                    <option selected><?= ($modeloFiltro <> '' ? $modeloFiltro : 'TODOS') ?></options>
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
                                    <option selected><?= ($setorFiltro <> '' ? $setorFiltro : 'TODOS') ?></options>
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
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
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
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
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
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Dif Km
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Ultimo Hr
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Hr
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
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
                    <tbody>
                        <?= filtrarAbastecimentos($dataInicial, $dataFinal) ?>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>  
    <script src="diesel-control-1.1/assets/js/scripts.js"></script>
    <script src="diesel-control-1.1/assets/js/fontawesome.all.min.js"></script>
    <script src="diesel-control-1.1/assets/js/bootstrap.bundle.min.v5.2.3.js"></script>
</body>
</html>