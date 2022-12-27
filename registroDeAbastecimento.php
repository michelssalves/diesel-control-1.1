<?php
session_start();
$msgSucesso = $_SESSION['msg'];
include 'assets/controllers/config.php';
include 'assets/controllers/abastecimentoDataBaseAcess.php';
$nivelPremissao = 0;
$login = $_SESSION['usuario'];
$usuario = $_SESSION['nome'];
$permissao =  $_SESSION['id_permissao'];
$id_funcionario = $_SESSION['id_funcionario'];
$token = $_SESSION['token'];
include 'assets/controllers/checkAcess.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/custom.css">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/fontawesome.all.min.6.2.1.css">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/tablesaw.css">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/w3.min.css">
    <script src="diesel-control-1.1/assets/js/jquery-3.6.1.min.js"></script>
</head>
<body>
    <div class="container">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><label>Usuario Logado: <?= $usuario; ?></label></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ml-30">
                        <a href="menu-principal" class="btn btn-primary btn-sm">Voltar</a>
                        <a href="logout" class="btn btn-danger btn-sm">Sair</a>
                    </li>
                </ul>
                <span class="navbar-text">
                </span>
            </div>
        </div>
    </nav>
    <?php if (isset($msgSucesso)) { echo $msgSucesso; }unset($_SESSION['msg']); ?>
    <form method="POST">
        <input readonly id="frentista" name="frentista" type="hidden" class="form-control" value="<?= $login ?>" autofocus>
        <input readonly id="id_funcionario" name="id_funcionario" type="hidden" class="form-control" value="<?= $id_funcionario ?>" autofocus>
        <input name="acao" value="registrar-abastecimento" type="hidden" required>
        <div class="input-group input-group-sm mb-3 mt-1">
            <span class="input-group-text" id="inputGroup-sizing">Prefixo:</span>
            <select class="form-select" name="prefixo" id="prefixo" onchange="buscarInfoVeiculo(this.value)" aria-describedby="inputGroup-sizing" required>
                <option value="">Escolha o Prefixo</option>
                <?php
                $ativado = 1;
                $sql = $pdo->prepare("SELECT * FROM veiculos  WHERE status_veiculo = :ativado ORDER BY prefixo");
                $sql->bindValue(':ativado', $ativado);
                $sql->execute();
                $fetchAll = $sql->fetchAll();
                foreach ($fetchAll as $prefixo) {
                    echo '<option value="'.$prefixo['id_veiculo'].'">' .$prefixo['prefixo'].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="field mb-2">
            <div class="control">
                <div class="form-check form-check-inline">
                    <input style="height: 50px; width: 50px;" class="form-check-input" type="radio" name="bomba" id="bomba" value="GASOLINA" required>
                    <label class="form-check-label mt-3" for="inlineRadio2">GASOLINA</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height: 50px; width: 50px;" class="form-check-input" type="radio" name="bomba" id="bomba" value="BOMBA 01" required>
                    <label class="form-check-label mt-3" for="inlineRadio1">B01</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height: 50px; width: 50px;" class="form-check-input" type="radio" name="bomba" id="bomba" value="BOMBA 02" required>
                    <label class="form-check-label mt-3" for="inlineRadio2">B02</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height: 50px; width: 50px;" class="form-check-input" type="radio" name="bomba" id="bomba" value="BOMBA 03" required>
                    <label class="form-check-label mt-3" for="inlineRadio3">B03</label>
                </div>
            </div>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Setor:</span>
            <input readonly id="setor" name="setor" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
        </div>

        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Odometro Inicial:</span>
            <input value="<?= $odometroinicial ?>"onkeypress="return soNumeros(),calcularLitrosOd();" id="odometroinicial" name="odometroinicial" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  placeholder="Odometro Inicial" autofocus required>
        </div>

        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Ultimo Km:</span>
            <input readonly id="ultimokm" name="ultimokm" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Km Anterior" autofocus required>
        </div>

        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Km:</span>
            <input value="<?= $km ?>" onkeypress="return soNumeros(),calcularMedia(),calcularDiferencaKm();" id="km" name="km"  type="text" step="0.01" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Km" required>
        </div>

        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Diferenca Km:</span>
            <input readonly id="diferencakm" name="diferencakm" type="text" class="form-control"  autofocus aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Diferenca Km" autofocus required>
        </div>

        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Ultimo Hr:</span>
            <input readonly id="ultimohr" name="ultimohr" type="text" class="form-control"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Ultimo Horimetro" autofocus required>
        </div>

        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Hr:</span>
            <input value="<?= $hr ?>" onkeypress="return soNumeros(),calcularDiferencaHr();" id="hr" name="hr" type="text" class="form-control" step="0.01"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Horimetro" autofocus required>
        </div>

        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Diferenca Hr:</span>
            <input readonly id="diferencahr" name="diferencahr" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Diferenca Horimetro" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Odometro Final:</span>
            <input value="<?= $odometrofinal ?> "onkeypress="return soNumeros(),calcularLitrosOd();" id="odometrofinal" name="odometrofinal" type="text" step="0.01" class="form-control" placeholder="Odometro Final"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>

        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Litros:</span>
            <input value="<?= $litros ?>" onkeypress="return soNumeros(),calcularMedia();" id="litros" name="litros" type="text" step="0.01" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Litros" autofocus required>
        </div>
        <?php if ($permissao == 1) { ?>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Data Abastecimento:</span>
            <input id="data_abastecimento" name="data_abastecimento" type="datetime-local" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Data Hora do Abastecimento" autofocus required>
        </div>
        <?php } ?>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Litros Odometro:</span>
            <input value="<?= $litros_od ?>" readonly id="litros_od" name="litros_od" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Litros Odometro" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Media:</span>
            <input value="<?= $media ?>" readonly id="media" name="media" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Media" autofocus required>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Cadastrar</button>
    </form>
        <div class="table-responsive">
            <div class="tabelas-customizadas">
                <table data-tablesaw-sortable data-tablesaw-sortable-switch class="tablesaw table-sm" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
                    <thead>
                        <tr>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Data
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Prefixo Sap
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Placa
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Prefixo
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>ODI
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>ODF
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Litros Od
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="6">
                                <center>Litros
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Media
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Ultimo Km
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Km
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
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
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Frentista
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= listarAbastecimentos() ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="diesel-control-1.1/assets/js/scripts.js"></script>
    <script src="diesel-control-1.1/assets/js/fontawesome.all.min.js"></script>
    <script src="diesel-control-1.1/assets/js/bootstrap.bundle.min.v5.2.3.js"></script>
    <!-- TABLESAW - DEIXA A TABELA RESPONSIVA-->
    <script src="diesel-control-1.1/assets/js/tablesawn-label.js"></script>
    <script src="diesel-control-1.1/assets/js/tablesaw.js"></script>
    <script src="diesel-control-1.1/assets/js/tablesaw-init.js"></script>
    <!-- /TABLESAW - DEIXA A TABELA RESPONSIVA-->
</body>
</html>