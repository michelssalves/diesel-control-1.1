<?php session_start();
include 'assets/controllers/config.php';
include 'assets/controllers/abastecimentoDataBaseAcess.php';
$nivelPremissao = 1;
$login = $_SESSION['usuario'];
$usuario = $_SESSION['nome'];
$permissao =  $_SESSION['id_permissao'];
$id_funcionario = $_SESSION['id_funcionario'];
$token = $_SESSION['token'];?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Almoxarifado</title>
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
    
</body>
</html>