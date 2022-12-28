<?php
session_start();
$acao = $_REQUEST['acao'];

$dataInicial = ($_POST['dataInicial'] ? $_POST['dataInicial'] : date('Y-m-d'));
$dataFinal = ($_POST['dataFinal'] ? $_POST['dataFinal'] : date('Y-m-d'));
$combustivel = $_POST['combustivel'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$prefixo = $_POST['prefixo'];
$setor = $_POST['setor'];

if($acao == 'limpar'){

    $dataInicial = date('Y-m-d'); 
    $dataFinal = date('Y-m-d');
    $prefixo = '';
    $combustivel = '';
    $marca = '';
    $modelo = '';
    $setor = '';

}

if($dataInicial && $dataInicial <> ''){ 
    $filtrodataInicial = $dataInicial;
}else{
    $filtrodataInicial = date('Y-m-d');
}
if($dataFinal && $dataFinal <> ''){ 
    $filtrodataFinal = $dataFinal;
}else{
    $filtrodataFinal = date('Y-m-d');
}
if($prefixo && $prefixo <> 'TODOS'){$filtroPrefixo = "AND v.prefixo = '$prefixo'";};
if($combustivel && $combustivel <> 'TODOS' ){$filtroCombustivel = "AND v.combustivel = '$combustivel'";}
if($marca && $marca <> 'TODOS'){$filtroMarca = "AND v.marca = '$marca'";}
if($modelo && $modelo <> 'TODOS'){$filtroModelo = "AND v.modelo = '$modelo'";}
if($setor && $setor <> 'TODOS'){$filtroSetor = "AND v.setor = '$setor'";}


if($acao == 'registrar-abastecimento'){

    registrarAbastecimento();
}
if($acao == 'ultimoKm'){
    
    $idVeiculo =  $_REQUEST['id'];

    $return = ['error' => false,  'dados' => informacoesVeiculo($idVeiculo)];
  
    echo json_encode($return);
  
}
if($acao == 'alterar-abastecimento'){

   // alterarAbastecimento();

   include 'config.php';
   include 'model/Abastecimentos.php';
 
   echo '<pre>'; echo $idAbastecimentoAlt = $_POST['idAbastecimentoAlt'];
   echo '<pre>'; echo $idVeiculoAlt = $_POST['idVeiculoAlt'];
   echo '<pre>'; echo $bombaAlt = $_POST['bombaAlt'];
   echo '<pre>'; echo $odometroInicialAlt = $_POST['odometroInicialAlt']; 
   echo '<pre>'; echo $odometroFinalAlt = $_POST['odometroFinalAlt']; 
   echo '<pre>'; echo $litrosOdAlt = $_POST['litrosOdAlt'];
   echo '<pre>'; echo $litrosAlt = $_POST['litrosAlt']; 
   echo '<pre>'; echo $ultimoKmAlt = $_POST['ultimoKmAlt']; 
   echo '<pre>'; echo $kmAlt = $_POST['kmAlt']; 
   echo '<pre>'; echo $diferencaKmAlt = $_POST['diferencaKmAlt'];
   echo '<pre>'; echo $mediaAlt = $_POST['mediaAlt'];
   echo '<pre>'; echo $ultimoHrAlt = $_POST['ultimoHrAlt']; 
   echo '<pre>'; echo $hrAlt = $_POST['hrAlt']; 
   echo '<pre>'; echo $diferencaHrAlt = $_POST['diferencaHrAlt']; 
   echo '<pre>'; echo $frentistaAlt = $_POST['frentistaAlt'];

   updateAbastecimentoAlterar($idAbastecimentoAlt, $idVeiculoAlt, $bombaAlt,$odometroInicialAlt,$odometroFinalAlt,$litrosOdAlt,$litrosAlt,
   $ultimoKmAlt, $kmAlt, $diferencaKmAlt,$mediaAlt,$ultimoHrAlt ,$hrAlt,$diferencaHrAlt, $frentistaAlt);
    
}
if($acao == 'excluir-abastecimento'){

    excluirAbastecimento();
  
}

function filtrarAbastecimentos($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo, $filtroSetor, $filtrodataInicial, $filtrodataFinal){

    include 'config.php';
    include '../model/Abastecimentos.php';
    include 'functions.php';
    include 'modal/modalCadastrarAbastecimento.php'; 

        $sql = selectAbastecimentosFiltrar($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo, $filtroSetor, $filtrodataInicial, $filtrodataFinal);

        if ($sql->rowCount() > 0) {

            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($lista as $row){

                $modalAlterarAbastecimento = "modalAlterarAbastecimento".$row['id_abastecimento']."";

                $linkModalAlterarAbastecimento = "data-bs-toggle='modal' data-bs-target='#$modalAlterarAbastecimento' style='cursor:pointer'";
                
                $corDifKm = '';
                $corDifHr = '';
                $corMedia = '';
                $corLitros = '';
                    
                if($row['combustivel'] <> 'GASOLINA'){

                    if($row['setor'] == 'Coleta Domiciliar'){
                        if($row['diferencakm'] > 400 || $row['diferencakm'] < 0){$corDifKm = 'bg-danger';}
                        if($row['diferencahr'] > 24 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
                    }elseif($row['setor'] == 'Privado'){
                        if($row['diferencakm'] > 2000 || $row['diferencakm']  < 0){$corDifKm = 'bg-danger';}
                        if($row['diferencahr'] > 60 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
                    }else{
                        if($row['diferencakm'] > 1000 || $row['diferencakm']  < 0){$corDifKm = 'bg-danger';}
                        if($row['diferencahr'] > 50 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
                    }    
                }
           
                    if($row['media'] > 2.5 && $row['descricao_caminhao'] == 'COMPACTADOR'){$corMedia = 'bg-warning';}
                    if($row['media'] < 1.5){$corMedia = 'bg-danger';}
                    if($row['media'] > 17.0 ){$corMedia = 'bg-info';}

                    if($row['litros_od'] <> $row['litros'] ){$corLitros = 'bg-warning';}
     
                $txtTableControles .= '<tr '.$linkModalAlterarAbastecimento.'>
                <td class="w3-left-align">'.dmaH($row['data_abastecimento']).'</td>
                <td class="w3-left-align"> '.H_i($row['data_abastecimento']).'</td>
                <td class="w3-left-align"> '.Month($row['data_abastecimento']).'</td>
                <td class="w3-left-align"> '.Year($row['data_abastecimento']).'</td>
                <td> '.$row['numero_equipamento'].' </td>
                <td> '.$row['prefixo'].' </td>
                <td> '.$row['placa'].' </td>
                <td> '.$row['combustivel'].' </td>
                <td> '.$row['bomba'].' </td>
                <td> '.v2($row['odometroinicial']).' </td>
                <td> '.v2($row['odometrofinal']).' </td>
                <td class="'.$corLitros.' w3-right-align"> '.v2($row['litros_od']).' </td>
                <td class="'.$corLitros.' w3-right-align"> '.v2($row['litros']).' </td>
                <td> '.$row['ultimokm'].' </td>
                <td> '.$row['km'].' </td>
                <td class="'.$corDifKm.' class="w3-right-align"> '.$row['diferencakm'].' </td>
                <td> '.$row['ultimohr'].'</td>
                <td> '.$row['hr'].'</td>
                <td class="'.$corDifHr.' class="w3-right-align"> '.$row['diferencahr'].'</td>
                <td><center> '.$row['frentista'].'</td>
                <td><center> '.$row['marca'].'</td>
                <td><center> '.$row['modelo'].'</td>
                <td class="'.$corMedia.' w3-right-align"><center> '.($row['media']).' </td>
                <td><center> '.$row['setor'].'</td>
                </tr>';

                include 'modal/modalAlterarAbastecimento.php';
            }
           
        }

        return $txtTableControles;  

} 
function registrarAbastecimento(){

    include 'config.php';
    include '../model/Abastecimentos.php';
    include 'functions.php';

    $idVeiculoCad = $_POST['idVeiculoCad'];
    $bombaCad = $_POST['bombaCad'];
    $odometroInicialCad = $_POST['odometroInicialCad'];
    $ultimoKmCad = $_POST['ultimoKmCad']; 
    $kmCad = $_POST['kmCad']; 
    $diferencaKmCad = $_POST['diferencaKmCad'];
    $ultimoHrCad = $_POST['ultimoHrCad'];
    $hrCad = $_POST['hrCad']; 
    $diferencaHrCad = $_POST['diferencaHrCad'];
    $frentistaCad = $_POST['frentistaCad'];
    $odometroFinalCad = $_POST['odometroFinalCad'];
    $litrosCad = $_POST['litrosCad'];
    $litrosOdCad = $_POST['litrosOdCad'];
    $mediaCad = $_POST['mediaCad'];

    insertAbastecimentoNovo($idVeiculoCad,$bombaCad, $odometroInicialCad, $ultimoKmCad, $kmCad, $diferencaKmCad, $ultimoHrCad,
    $hrCad, $diferencaHrCad, $frentistaCad, $odometroFinalCad, $litrosCad, $litrosOdCad, $mediaCad);
}
function informacoesVeiculo($idVeiculo){

    $sql = selectAbastecimentosPorVeiculo($idVeiculo);

	$row = $sql->fetch(PDO::FETCH_ASSOC);
    $setor = $row['setor'];
    $ultimoKm = $row['km'];
    if($row['km'] < 0){$ultimoKm = 0;}
    $ultimoHr = $row['hr'];
    if($row['hr'] < 0){$ultimoHr = 0;}

    $informacoesVeiculo = [
        'setor' => $setor,
        'ultimoKm' => $ultimoKm,
        'ultimoHr' => $ultimoHr
    ];

    return $informacoesVeiculo;

}       
function alterarAbastecimento(){


   

}   
function excluirAbastecimento(){

    $idAbastecimentoAlt = $_POST['idAbastecimentoAlt'];

    deleteAbastecimento($idAbastecimentoAlt);

}    


?>