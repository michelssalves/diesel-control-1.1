<?php
session_start();
include 'assets/controllers/config.php';
include 'assets/controllers/abastecimentoDataBaseAcess.php';
$nivelPremissao = 1;
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

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/menucontroles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
</head>
<body>
<form class="menu" method="POST">
        <input id="id_abastecimento" value="<?= ($_REQUEST['id_abastecimento']);?>" name="id_abastecimento" type="hidden" autofocus required style="width: 300px;">
        <center><label style="font-weight:bold;">Data Abastecimento</label><br>
        <input id="data_abastecimento" value="<?= ($_REQUEST['data_abastecimento']);?>" name="data_abastecimento" type="datetime-local" autofocus required style="width: 300px;"><br>

        <label style="font-weight:bold;">Numero do Equipamento</label><br>
        <input id="numero_equipamento"  value="<?= $_REQUEST['numero_equipamento']?>" name="numero_equipamento" type="text" autofocus required style="width: 300px;"><br>
        
        <label style="font-weight:bold;">Bomba</label><br>
        <input  id="bomba" value="<?= $_REQUEST['bomba']?>" name="bomba" type="text"  autofocus required style="width: 300px;"><br>
        
        <label style="font-weight:bold;">Odometro Inicial</label><br>
        <input onkeyup="somenteNumeros(this);"  id="odometroinicial" value="<?= $_REQUEST['odometroinicial']?>" name="odometroinicial" type="text"  autofocus required style="width: 300px;"><br>

        <label style="font-weight:bold;">Odometro Final</label><br>
        <input onkeyup="somenteNumeros(this), calcularLitrosOd();" id="odometrofinal" value="<?= $_REQUEST['odometrofinal']?>" name="odometrofinal" type="text" autofocus required style="width: 300px;"><br>
    
        <label style="font-weight:bold;">Litros Odometro</label><br>
        <input id="litros_od" value="<?= $_REQUEST['litros_od']?>" name="litros_od" type="text"  autofocus required style="width: 300px;"><br>
    
        <label style="font-weight:bold;">Litros</label><br>
        <input onkeyup="somenteNumeros(this), calcularMedia();"  id="litros" value="<?= $_REQUEST['litros']?>" name="litros" type="text" autofocus required style="width: 300px;"><br>
    
        <label style="font-weight:bold;">Ultimo Km</label><br>
        <input onkeyup="somenteNumeros(this),calcularMedia();" id="ultimokm" value="<?= $_REQUEST['ultimokm']?>" name="ultimokm" type="text" autofocus required style="width: 300px;"><br>

        <label style="font-weight:bold;">Km</label><br>
        <input onkeyup="somenteNumeros(this), calcularDiferencaKm(),calcularMedia();" id="km" value="<?= $_REQUEST['km']?>" name="km" type="text" autofocus required style="width: 300px;"><br>
    

        <label style="font-weight:bold;">Diferenca Km</label><br>
        <input readonly id="diferencakm" value="<?= $_REQUEST['diferencakm']?>" name="diferencakm" type="text" autofocus required style="width: 300px;"><br>
        
        <label style="font-weight:bold;">Media</label><br>
        <input id="media" value="<?= $_REQUEST['media']?>" name="media" type="text" autofocus required style="width: 300px;"><br>

        <label style="font-weight:bold;">Ultimo Hr</label><br>
        <input onkeyup="somenteNumeros(this), calcularDiferencaHr();" id="ultimohr" value="<?= $_REQUEST['ultimohr']?>" name="ultimohr" type="text" autofocus required style="width: 300px;"><br>

        <label style="font-weight:bold;">Hr</label><br>
        <input onkeyup="somenteNumeros(this), calcularDiferencaHr();" id="hr" value="<?= $_REQUEST['hr']?>" name="hr" type="text" autofocus required style="width: 300px;"><br>
        
        <label style="font-weight:bold;">Diferenca Hr</label><br>
        <input readonly id="diferencahr" value="<?= $_REQUEST['diferencahr']?>" name="diferencahr" type="text" autofocus required style="width: 300px;"><br>

        <label style="font-weight:bold;">Frentista</label><br>
        <input id="frentista" value="<?= $_REQUEST['frentista']?>" name="frentista" type="text" autofocus required style="width: 300px;"><br>
        <br>
        <button name="acao" value="excluir-abastecimento" class="w3-button w3-red">Excluir</button>
        <button name="acao" value="alterar-abastecimento" class="w3-button w3-blue">Alterar</button>
</form> 
        <script src="diesel-control-1.1/assets/js/scripts.js"></script>
</body>
</html>                    