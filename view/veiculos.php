<?php
session_start();
include '../model/Veiculos.php';
include '../controller/veiculosController.php';
include 'header.php';
?>
<body>

<div class="container">
        <div class="col-md-auto mt-4">
        <div style="background-color: #5F9EA0;">
        <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 p-1">
                    <li class="nav-item p-1">
                    <a href="controle-de-combustivel-novo" class="btn btn-primary btn">Menu Principal</a>
                    </li>
                    <li class="nav-item p-1">
                    <a href="controle-de-combustivel-novo" class="btn btn-primary btn">Controles</a>
                    </li>

                </ul>
                <span class="navbar-text">
                <a class="navbar-brand mt-1" href="#"><label>Usuario Logado: <?= $_SESSION['nome']; ?></label></a>
                <a href="logout-novo" class="btn btn-danger btn">Sair</a>
                </span>
            </div>
        </div>
    </nav>
    </div>
    </div>
    </div>


   <!-- <div class="w3-bar w3-light-grey">
        <a href="controle-de-combustivel-novo" class="w3-bar-item w3-button">Menu Principal</a>
        <a href="controle-de-combustivel-novo" class="w3-bar-item w3-button">Controles</a>
        <a href="logout-novo" class="w3-bar-item w3-button w3-red w3-right">Sair</a>
        <a class="w3-bar-item w3-button w3-right"><?php // $usuario; ?></a>
    </div>-->

    <div class="container mt-2 mb-1 ">
    <div style="background-color: #5F9EA0;">
        <div class="row justify-content-md-center h-25 ">
        
            <div class="col-md-auto mt-4">
            
                <form method="POST">
                    <button class="btn btn-success btn" onclick="table2excel('t1')">Excel</button>
                    <button type="submit" class='btn btn-warning btn'>Filtrar</button>
                    <button type="button" class='btn btn-primary btn' data-bs-toggle='modal' data-bs-target='#modalCadastrarVeiculo'>Cadastrar</button>
                    <button name="acao" value="limpar" type="submit" class='btn btn-secondary btn'>Limpar</button>  
            </div>
        </div>
    </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-sm fs-6 mb-0">
                <thead class="fundo-cabecalho">
                    <tr>
                        <th>
                            Prefixo
                        </th>
                        <th>
                            Combustivel
                        </th>
                        <th>
                            Marca
                        </th>
                        <th>
                            Modelo
                        </th>
                        <th>
                            Setor
                        </th>
                        <th>
                            <center>Mostrar Desativados
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select onChange="this.form.submit()" name="prefixo">
                                <option selected><?= ($prefixo <> '' ? $prefixo : 'TODOS') ?></options>
                                    <?php
                                    $sql = $pdo->prepare("SELECT * FROM veiculos ORDER BY prefixo");
                                    $sql->execute();
                                    $fetchAll = $sql->fetchAll();
                                    foreach ($fetchAll as $prefixo) {
                                        echo '<option value="' . $prefixo['prefixo'] . '">' . substr($prefixo['prefixo'], 0, 8) . '</option>';
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
                        <td>
                            <center><input onChange="this.form.submit()" type="checkbox" id="status" name="statusVeiculo" value="checked" <?= $statusVeiculo ?>>
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
                                <center>Nº Equip
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Prefixo
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Placa
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="6">
                                <center>Descricao
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Renavam
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Chassi
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Nº Motor
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="6">
                                <center>Ano
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Marca
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Modelo
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="6">
                                <center>Combustivel
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="6">
                                <center>Metodo
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="6">
                                <center>Setor
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="6">
                                <center>Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= filtrarVeiculos($filtroPrefixo, $filtroCombustivel, $filtroMarca, $filtroModelo, $filtroSetor, $filtroStatus, $page) ?>
             
            </div>
        </div>
    </div>
    <script src="diesel-control-1.1/assets/js/scripts.js"></script>
    <script src="diesel-control-1.1/assets/js/fontawesome.all.min.js"></script>
    <script src="diesel-control-1.1/assets/js/bootstrap.bundle.min.v5.2.3.js"></script>
</body>
</html>