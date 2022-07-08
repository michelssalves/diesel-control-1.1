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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/menuregistro.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="diesel-control-1.1/assets/js/sorttable.js"></script>
	<script src="diesel-control-1.1/assets/js/jquery.table2excel.js"></script>  
</head>
<body>
            <div class="w3-bar w3-light-grey">
                <a href="logout" class="w3-bar-item w3-button w3-red w3-right">Sair</a>
                <a href="controle-de-combustivel" class="w3-bar-item w3-button w3-blue w3-right">Voltar</a>
                <button class="w3-button w3-green" onClick="table2excel('t1')">Excel</button>
                <label class="w3-bar-item w3-button w3-left">Usuario Logado:</label>
                <a class="w3-bar-item w3-button"><?= $usuario; ?></a>
            </div>  
            <form method="POST">
    <table style="margin-left:60px;">
        <tr >
            <th>
                <label><center>Data 01</label><br>
                <input type="date" name="dataIncial" value="<?= $dataIncial ?>"></th>
            <th>
                <label><center>Data 02</label><br>
                <input type="date" name="dataFinal" value="<?= $dataFinal ?>"></th>
            <th>
            <th>
                <input type="hidden"  name="acao" value="filtrar">
            </th>
            <th>
                <label><center></label><br>
            <button  class="w3-button w3-blue" type="submit">Filtrar</button>      
            </th>
        </tr>          
    </table>
    </form> 
            <table id="t1" class="w3-table w3-table-all sortable " border="1">
                <thead class="thead-dark">
                    <tr>
                        <th><center>Data</th>
                        <th><center>Prefixo</th>
                        <th><center>Setor</th>
                        <th><center>Bomba</th>
                        <th><center>ODI</th>
                        <th><center>ODF</th>
                        <th><center>Litros Od</th>
                        <th><center>Litros</th>
                        <th><center>Ultimo Km</th>
                        <th><center>Km</th>
                        <th><center>Dif Km</th>
                        <th><center>Ultimo Hr</th>
                        <th><center>Hr</th>
                        <th><center>Dif Hr</th>
                        <th><center>Frentista</th> 
                        <th><center>Média</th> 
                        <th><center>Anulado?</th> 
                    </tr>
                </thead>
                <tbody>
                    <?= listarTodosErros($dataHoraIncial, $dataHoraFinal)?>
                </tbody>
            </table>
    <script src="diesel-control-1.1/assets/js/scripts.js"></script>
</body>
</html>


