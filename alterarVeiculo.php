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
<form class="menu" method="POST">
            <input id="id_veiculo" value="<?= $_REQUEST['id_veiculo']?>" name="id_veiculo" type="hidden" autofocus required style="width: 300px;"><br>
        <center><label style="font-weight:bold;">Prefixo</label><br>
            <input id="prefixo" value="<?= $_REQUEST['prefixo']?>" name="prefixo" type="text" autofocus required style="width: 300px;"><br>
    
            <label style="font-weight:bold;">Numero do Equipamento</label><br>
            <input id="numero_equipamento"  value="<?= $_REQUEST['numero_equipamento']?>" name="numero_equipamento" type="text" autofocus required style="width: 300px;"><br>
        
            <label style="font-weight:bold;">Placa</label><br>
            <input id="placa" value="<?= $_REQUEST['placa']?>" name="placa" type="text"  autofocus required style="width: 300px;"><br>
        
            <label style="font-weight:bold;">Descriçãoo</label><br>
            <input id="descricao_caminhao" value="<?= $_REQUEST['descricao_caminhao']?>" name="descricao_caminhao" type="text" autofocus required style="width: 300px;"><br>
        
            <label style="font-weight:bold;">Renavam</label><br>
            <input id="renavam" value="<?= $_REQUEST['renavam']?>" name="renavam" type="text"  autofocus required style="width: 300px;"><br>
    
            <label style="font-weight:bold;">Chassi</label><br>
            <input id="chassi" value="<?= $_REQUEST['chassi']?>" name="chassi" type="text" autofocus required style="width: 300px;"><br>
        
            <label style="font-weight:bold;">Numero do Motor</label><br>
            <input id="numero_motor" value="<?= $_REQUEST['numero_motor']?>" name="numero_motor" type="text"  autofocus required style="width: 300px;"><br>
        
            <label style="font-weight:bold;">Ano</label><br>
            <input id="ano" value="<?= $_REQUEST['ano']?>" name="ano" type="text" autofocus required style="width: 300px;"><br>
        
            <label style="font-weight:bold;">Marca</label><br>
            <input id="marca" value="<?= $_REQUEST['marca']?>" name="marca" type="text" autofocus required style="width: 300px;"><br>
    
            <label style="font-weight:bold;">Modelo</label><br>
            <input id="modelo" value="<?= $_REQUEST['modelo']?>" name="modelo" type="text" autofocus required style="width: 300px;"><br>
    
            <label style="font-weight:bold;">Combustivel</label><br>
            <select id="combustivel" name="combustivel"   required style="width: 300px;text-align: center">
                <option value="<?= $_REQUEST['combustivel']?>"><?= $_REQUEST['combustivel']?></option>
                <option value="DIESEL S10">DIESEL S10</option>
                <option value="GASOLINA">GASOLINA</option>
            </select><br>
            <select id="metodo" name="metodo" required style="width: 300px;text-align: center">
                <option value="<?= $_REQUEST['metodo']?>"><?= $_REQUEST['metodo']?></option>
                <option value="1">KM</option>
                <option value="3">HR</option>
                <option value="MM">MM</option>
            </select><br>
            <label style="font-weight:bold;">Setor</label><br>
            <select id="setor" name="setor" required style="width: 300px;text-align: center">
                <option value="<?= $_REQUEST['setor']?>"><?= $_REQUEST['setor']?></option>
                <option value="Coleta Domiciliar">Coleta Domiciliar</option>
                <option value="Ctrss">Ctrss</option>
                <option value="Limpeza Especial">Limpeza Especial</option>
                <option value="Varricao">Varricão</option>
                <option value="Lqnl">Lqnl</option>
                <option value="Privado">Privado</option>
            </select><br>
            <label style="font-weight:bold;">Status</label><br>
            <select id="status_veiculo" name="status_veiculo" required style="width: 300px;text-align: center">
                <option value="<?= $_REQUEST['status_veiculo']?>"><?= $_REQUEST['status_veiculo']?></option>
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
            <input value="cadastro-veiculo" name="menu" type="hidden"required><br>
            <br>
        <button name="acao" value="excluir-veiculo" class="w3-button w3-red">Excluir</button>
        <button name="acao" value="cadastro-alteracao-veiculo" class="w3-button w3-blue">Alterar</button>
</form> 
<script src="diesel-control-1.1/assets/js/scripts.js"></script>
</body>
</html>                    