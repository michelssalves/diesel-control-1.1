<?php
session_start();
include '../controller/userDataBaseAcess.php';
include '../controller/checkAcess.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/menu.css">    
</head>
<body style="background-color: #d1d1d1;">
    <div class="container-md">
        <div class="container-lg">
            <div class="container-xl">
                <div class="container-xxl">
<div class="w3-bar w3-light-grey">
  <a href="logout-novo"class="w3-bar-item w3-button w3-red w3-right">Sair</a>
  <label class="w3-bar-item">Usuario Logado: <?= $usuario; ?></label> 
</div> 
                    <table class="table table-hover">
                        <?= menuPrincipal();?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>