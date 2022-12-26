<?php
session_start();
$msgSucesso = $_SESSION['msg']; 
include 'assets/controllers/config.php';
include 'assets/controllers/abastecimentoDataBaseAcess.php';
$nivelPremissao = 0;
$login = $_SESSION['usuario'];
$usuario = $_SESSION['nome'] ;
$permissao =  $_SESSION['id_permissao'] ;
$id_funcionario = $_SESSION['id_funcionario'];
$token = $_SESSION['token'];
include 'assets/controllers/checkAcess.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/menuregistro.css">    
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/tablesaw.css">
</head>
<body>
    <div class="container-md">
        <div class="container-lg">
            <div class="container-xl">
                <div class="container-xxl">
                <div class="w3-bar w3-light-grey">
                    <a href="logout"class="w3-bar-item w3-button w3-red w3-right">Sair</a>
                    <a href="menu-principal" class="w3-bar-item w3-button w3-blue w3-right">Voltar</a>
                    <label class="w3-bar-item">Usuario Logado: <?= $usuario; ?></label>    
                </div> 
                <div class="w3-bar w3-light-grey w3-container">
                <table class="table table-bordered" style="border: 10px;">
                <thead class="thead-dark" >
                    <tr>
                    <td colspan="3" style="font-weight:bold"><center>CLIQUE EM ERROS PARA VER SEU HISTÓRICO</td>
                    </tr>
                    <tr>
                        <th class="text-success"><center>Acertos</th>
                        <th class="text-danger"><center><a style="text-decoration:none; cursor:pointer; color:red" href="visualizador-de-erros">Erros</a></th>
                        <th><center>% Acertos</th>  
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?= listarAcertos($id_funcionario) ?>
                    </tr>
                </tbody>
            </table>
                </div> 
                <?php if(isset($msgSucesso)){echo $msgSucesso;}
                         unset($_SESSION['msg']);?>
                    <form name="formCadastro" onsubmit="return validarFormulario()" class="menu" method="POST">
                        <div class="field">
                            <div class="control">
                                <input readonly hidden id="frentista" name="frentista" type="text" class="form-control" value="<?= $login ?>" autofocus>
                                <input readonly hidden id="id_funcionario" name="id_funcionario" type="text" class="form-control" value="<?= $id_funcionario ?>" autofocus>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label>Prefixo</label>
                                <select class="form-select" name="prefixo" id="prefixo" required>
                                    <option value="">Escolha o Prefixo</option>
                                    <?php
                                    $ativado = 1;
                                    $sql = $pdo->prepare("SELECT * FROM veiculos  WHERE status_veiculo = :ativado ORDER BY prefixo");
                                    $sql->bindValue(':ativado', $ativado);
                                    $sql->execute();
                                    $fetchAll = $sql->fetchAll();
                                    foreach ($fetchAll as $prefixo) {
                                        echo '<option value="' . $prefixo['id_veiculo'] . '">' . $prefixo['prefixo'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="field">
                            <div class="control">
                                <div class="form-check form-check-inline">
                                    <input style="height: 50px; width: 50px;" class="form-check-input" type="radio" name="bomba" id="bomba" value="GASOLINA" required>
                                    <label class="form-check-label" for="inlineRadio2">GASOLINA</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input style="height: 50px; width: 50px;" class="form-check-input" type="radio" name="bomba" id="bomba" value="BOMBA 01" required>
                                    <label class="form-check-label" for="inlineRadio1">B01</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input style="height: 50px; width: 50px;" class="form-check-input" type="radio" name="bomba" id="bomba" value="BOMBA 02" required>
                                    <label class="form-check-label" for="inlineRadio2">B02</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input style="height: 50px; width: 50px;" class="form-check-input" type="radio" name="bomba" id="bomba" value="BOMBA 03" required>
                                    <label class="form-check-label" for="inlineRadio3">B03</label>
                                </div>
                            </div>

                        </div>
                </div>
                <br>
                <div class="field">
                    <div class="control">
                        <label></label>
                        <br><input readonly class="form-control" id="setor" name="setor">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label>Odometro Inicial</label>
                        <br><input value="<?=$odometroinicial?>" onkeyup="somenteNumeros(this),calcularLitrosOd();" id="odometroinicial" name="odometroinicial" type="number" step="0.01" class="form-control" placeholder="Odometro Inicial" autofocus>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label>Ultimo Km</label>
                        <br><input required readonly id="ultimokm" name="ultimokm" type="text" class="form-control" placeholder="Km Anterior" autofocus>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label>Km</label>
                        <br><input value="<?=$km?>"  onkeyup="somenteNumeros(this),calcularMedia(),calcularDiferencaKm();" id="km" name="km" type="number" step="0.01" class="form-control" placeholder="Km" autofocus required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label>Diferenca Km</label>
                        <br><input required readonly id="diferencakm" name="diferencakm" type="text" class="form-control" placeholder="Diferenca Km" autofocus>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label>Ultimo Hr</label>
                        <br><input readonly id="ultimohr" name="ultimohr" type="text" class="form-control" placeholder="Ultimo Hr" autofocus>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label>Horimetro</label>
                        <br><input value="<?=$hr?>" onkeyup="somenteNumeros(this),calcularDiferencaHr();" id="hr" name="hr" type="number" class="form-control" step="0.01" placeholder="Hr" autofocus required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label>Diferenca Hr</label>
                        <br><input readonly id="diferencahr" name="diferencahr" type="text" class="form-control" placeholder="Diferenca Hr" autofocus>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label>Odometro Final</label>
                        <input value="<?=$odometrofinal?>" onkeyup="somenteNumeros(this),calcularLitrosOd();" id="odometrofinal" name="odometrofinal" type="number" step="0.01" class="form-control" placeholder="Odometro Final" autofocus required>
                    </div>
                </div>
                                        
                <div class="field">
                    <div class="control">
                        <label>Litros</label>
                        <br><input value="<?=$litros?>" onkeyup="somenteNumeros(this),calcularMedia();" id="litros" name="litros" type="number" step="0.01" class="form-control" placeholder="Litros" autofocus required>
                    </div>
                </div>
                <?php if($permissao == 1){ ?>
                    <div class="field">
                            <div class="control">
                                <label>Data  Hora do Abastecimento</label>
                                <br><input id="data_abastecimento" name="data_abastecimento" type="datetime-local" class="form-control" placeholder="Data Hora do Abastecimento" autofocus required>
                            </div>
                        </div>
    
                <?php } ?>
                <div class="field">
                    <div class="control">
                        <label>Litros Odometro</label>
                        <br><input value="<?=$litros_od?>" readonly id="litros_od" name="litros_od" type="text" class="form-control" placeholder="Litros Odometro" autofocus required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">   
                        <label>Media do Veiculo</label>
                        <br><input value="<?=$media?>" readonly id="media" name="media" type="text" class="form-control" placeholder="Media" autofocus required>
                        <br><input hidden name="acao" value="registrar-abastecimento" type="text"  required> 
                    </div>
                </div>
                    <button type="submit" class="tn btn-primary btn-lg">Cadastrar</button>
        </form>
            </div>
        </div>
    </div>
    </div>  
    <div class="container">
        <div class="row">
            <table class="table table-striped table-bordered table-hoverable">
                <thead class="thead-dark">
                    <tr>
                        <th><center>Data</th>
                        <th><center>Prefixo Sap</th>
                        <th><center>Placa</th>
                        <th><center>Prefixo</th>
                        <th><center>ODI</th>
                        <th><center>ODF</th>
                        <th><center>Litros Od</th>
                        <th><center>Litros</th>
                        <th><center>Media</th>
                        <th><center>Ultimo Km</th>
                        <th><center>Km</th>
                        <th><center>Dif Km</th>
                        <th><center>Ultimo Hr</th>
                        <th><center>Hr</th>
                        <th><center>Dif Hr</th>
                        <th><center>Frentista</th>  
                    </tr>
                </thead>
                <tbody>
                    <?= listarAbastecimentos()?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="diesel-control-1.1/assets/js/scripts.js"></script>
        <!-- TABLESAW - DEIXA A TABELA RESPONSIVA-->
    <script src="diesel-control-1.1/assets/js/tablesawn-label.js"></script>
    <script src="diesel-control-1.1/assets/js/tablesaw.js"></script>
    <script src="diesel-control-1.1/assets/js/tablesaw-init.js"></script>
    <!-- /TABLESAW - DEIXA A TABELA RESPONSIVA-->
</body>
</html>
