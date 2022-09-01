<?php 
session_start();
include 'assets/controllers/config.php';
$nivelPremissao = 1;
$acao=$_REQUEST['acao'];
$login = $_SESSION['usuario'];
$usuario = $_SESSION['nome'];
$permissao =  $_SESSION['id_permissao'];
$id_funcionario = $_SESSION['id_funcionario'];
$token = $_SESSION['token'];
include 'assets/controllers/checkAcess.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/menucontroles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php if($acao == 'alterarAbastecimento' || $acao== 'alterarVeiculo' || $acao=='cadastrarVeiculo'){?>
     <div >
        <img src="diesel-control-1.1/assets/img/sucessoAlterar.png" style="width:400px;;margin-left: 30px;">
    </div>
    <?php }?>
    <?php if($acao == 'excluir' || $acao== 'desativarVeiculo'){?>
     <div >
        <img src="diesel-control-1.1/assets/img/sucessoExcluir.png" style="width:400px;">
    </div>
    <?php }?>
</body>
</html>