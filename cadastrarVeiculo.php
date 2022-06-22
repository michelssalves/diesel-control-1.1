<?php
session_start();
include 'assets/controllers/config.php';
include 'assets/controllers/veiculosDataBaseAcess.php';
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
<form method="POST">
        <center><label style="font-weight:bold;">Prefixo</label><br>
            <input id="prefixo"  name="prefixo" type="text" autofocus required style="width: 300px;"><br>
    
            <label style="font-weight:bold;">Numero do Equipamento</label><br>
            <input id="numero_equipamento"  name="numero_equipamento" type="text" autofocus required style="width: 300px;"><br>
        
            <label style="font-weight:bold;">Placa</label><br>
            <input id="placa"  name="placa" type="text"  autofocus required style="width: 300px;"><br>
        
            <label style="font-weight:bold;">Descrição</label><br>
            <input id="descricao_caminhao" name="descricao_caminhao" type="text" autofocus required style="width: 300px;"><br>
        
            <label style="font-weight:bold;">Renavam</label><br>
            <input id="renavam" name="renavam" type="text"  autofocus required style="width: 300px;"><br>
    
            <label style="font-weight:bold;">Chassi</label><br>
            <input id="chassi"  name="chassi" type="text" autofocus required style="width: 300px;"><br>
        
            <label style="font-weight:bold;">Numero do Motor</label><br>
            <input id="numero_motor" name="numero_motor" type="text"  autofocus required style="width: 300px;"><br>
        
            <label style="font-weight:bold;">Ano</label><br>
            <input id="ano"  name="ano" type="text" autofocus required style="width: 300px;"><br>
        
            <label style="font-weight:bold;">Marca</label><br>
            <input id="marca" name="marca" type="text" autofocus required style="width: 300px;"><br>
    
            <label style="font-weight:bold;">Modelo</label><br>
            <input id="modelo"  name="modelo" type="text" autofocus required style="width: 300px;"><br>
    
            <label style="font-weight:bold;">Combustivel</label><br>
            <input id="combustivel" name="combustivel" type="text" autofocus required style="width: 300px;"><br>
        

            <label style="font-weight:bold;">Metodo</label><br>
            <input id="metodo" name="metodo" type="text" autofocus required style="width: 300px;"><br>

            <label style="font-weight:bold;">Setor</label><br>
            <input id="setor" name="setor" type="text" autofocus required style="width: 300px;"><br>

            <label style="font-weight:bold;">Status</label><br>
            <input id="status_veiculo" name="status_veiculo" type="text" autofocus required style="width: 300px;"><br>
            
            <input value="cadastro-veiculo" name="menu" type="hidden"required><br>
            <br>
        <button name="acao" value="cadastro-alteracao-veiculo" class="w3-button w3-blue">Cadastrar</button>

</form> 
<script src="diesel-control-1.1/assets/js/functionScripts.js"></script>
</body>
</html>                    