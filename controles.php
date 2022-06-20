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
    <link rel="stylesheet" href="diesel-control/assets/css/menucontroles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="diesel-control/assets/js/sorttable.js"></script>
	<script src="diesel-control/assets/js/jquery.table2excel.js"></script>  
</head>
<body>
<div class="container-md">
        <div class="container-lg">
            <div class="container-xl">
                <div class="container-xxl">
<div class="w3-bar w3-light-grey">
  <a href="menu-principal" class="w3-bar-item w3-button" >Menu Principal</a>
  <a href="controle-de-veiculos" class="w3-bar-item w3-button" >Veiculos</a>
  <button class="w3-button w3-green" onClick="table2excel('t1')">Excel</button>
  <a href="logout" class="w3-bar-item w3-button w3-red w3-right">Sair</a>
  <a class="w3-bar-item w3-button w3-right"><?= $usuario; ?></a>

</div>    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
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
                <label><center>Prefixo</label><br>
                <select onChange="this.form.submit()" name="prefixo" required>
                <option selected><?= ($prefixo <> '' ? $prefixo : 'TODOS' )?></options>
                <option>TODOS</options>
                     <?php
                    $ativado = 1;
                    $sql = $pdo->prepare("SELECT * FROM veiculos  WHERE status_veiculo = :ativado ORDER BY prefixo");
                    $sql->bindValue(':ativado', $ativado);
                    $sql->execute();
                    $fetchAll = $sql->fetchAll();
                    foreach ($fetchAll as $prefixo) {
                        echo '<option value="' . $prefixo['prefixo'] . '">' . $prefixo['prefixo'] . '</option>';
                    }
                    ?>
                </select> 
            </th>
            <th>
                <label><center>Combustivel</label><br>
                <select onChange="this.form.submit()" name="combustivel">
                <option selected><?= ($combustivel <> '' ? $combustivel : 'TODOS' )?></options>
                <option>TODOS</options>
                <option>DIESEL S10</option>
                <option>GASOLINA</option>
                </select>
            </th>
            <th>
                <label><center>Marca</label><br>
                <select onChange="this.form.submit()" name="marca">
                <option selected><?= ($marca <> '' ? $marca : 'TODOS' )?></options>
                <option>TODOS</options>
                <option>VOLVO</option>
                <option>VOLKSWAGEN</option>
                <option>MERCEDES BENZ</option>
                </select>
            </th>
            <th>
                <label><center>Modelo</label><br>
                <select onChange="this.form.submit()" name="modelo">
                <option selected><?= ($modelo <> '' ? $modelo : 'TODOS' )?></options>
                <option>TODOS</options>
                <option>VM270R</option>
                <option>MB1729</option>
                <option>VW17280</option>
                <option>VW17260</option>
                <option>VW17230</option>
                </select>
            </th>
            <th>
                <input type="hidden"  name="acao" value="filtrar">
            </th>
            <th>
                <label><center></label><br>
            <button  class="w3-button w3-blue" type="submit">Filtrar</button>      
            </th>
            <th>
                <label><center></label><br>
                <button  class="w3-button w3-grey" name="acao" value="limpar" type="submit">Limpar</button>
            </th>
        </tr>          
    </table>

    </form>
  
  </div>
</nav>     
</div>
    </div>
    </div>
    </div> 
           <table id="t1" class="w3-table w3-table-all sortable " border="1">
                <thead class="thead-dark sorttable">
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
                    <th><center>Setor</th>  
                    </tr>
                </thead>
                <tbody>
                    <?= filtrarAbastecimentos($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo,$dataHoraIncial, $dataHoraFinal) ?>
                </tbody>
            </table>
        
    
<script src="diesel-control/assets/js/scripts.js"></script>