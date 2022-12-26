<?php
session_start();
include 'assets/controllers/config.php';
include 'assets/controllers/abastecimentoDataBaseAcess.php';
$nivelPremissao = 1;
$login = $_SESSION['usuario'];
$usuario = $_SESSION['nome'];
$permissao =  $_SESSION['id_permissao'];
$id_funcionario = $_SESSION['id_funcionario'];
$token = $_SESSION['token'];
include 'assets/controllers/checkAcess.php';
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

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
        <a href="menu-principal" class="w3-bar-item w3-button">Menu Principal</a>
        <a href="controle-de-veiculos" class="w3-bar-item w3-button">Veiculos</a>
        <button class="w3-button w3-green" onclick="table2excel('t1')">Excel</button>
        <a href="logout" class="w3-bar-item w3-button w3-red w3-right">Sair</a>
        <a class="w3-bar-item w3-button w3-right"><?= $usuario; ?></a>
    </div>
    <div class="container">
        <form method="POST">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <tr>
                            <th>
                                <label>
                                    <center>Data 01
                                </label><br>
                                <input type="date" name="dataIncial" value="<?= $dataIncial ?>">
                            </th>
                            <th>
                                <label>
                                    <center>Data 02
                                </label><br>
                                <input type="date" name="dataFinal" value="<?= $dataFinal ?>">
                            </th>
                            <th>
                                <label>
                                    <center>Prefixo
                                </label><br>
                                <select onChange="this.form.submit()" name="prefixo" required>
                                    <option selected><?= ($prefixo <> '' ? $prefixo : 'TODOS') ?></options>
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
                            </th>
                            <th>
                                <label>
                                    <center>Combustivel
                                </label><br>
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
                            </th>
                            <th>
                                <label>
                                    <center>Marca
                                </label><br>
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
                            </th>
                            <th>
                                <label>
                                    <center>Modelo
                                </label><br>
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
                            </th>
                            <th>
                                <label>
                                    <center>Setor
                                </label><br>
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
                            </th>
                            <th>
                                <input type="hidden" name="acao" value="filtrar">
                            </th>
                            <th>
                                <label>
                                    <center>
                                </label><br>
                                <button class="w3-button w3-blue" type="submit">Filtrar</button>
                            </th>
                            <th>
                                <label>
                                    <center>
                                </label><br>
                                <button class="w3-button w3-grey" name="acao" value="limpar" type="submit">Limpar</button>
                            </th>
                        </tr>
                    </table>
                </div>
        </form>
        </nav>
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
                        <?= filtrarAbastecimentos($filtroPrefixo, $filtroCombustivel, $filtroMarca, $filtroModelo, $filtroSetor, $dataHoraIncial, $dataHoraFinal) ?>
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