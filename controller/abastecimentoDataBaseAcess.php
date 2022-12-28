<?php
session_start();

$acao = $_REQUEST['acao'];
// ****** AQUI É FEITA A PARTE DE CONTROLE DO MENU REGISTRO DE ABASTECIMENTOS 
if($acao == 'registrar-abastecimento'){

    registrarAbastecimento();
}
if($acao == 'ultimoKm'){
    
    $id_veiculo =  $_REQUEST['id'];

    $return = ['error' => false,  'dados' => informacoesVeiculo($id_veiculo)];
  
    echo json_encode($return);
  
}
if($acao == 'alterar-abastecimento'){

    alterarAbastecimento();
    
}
if($acao == 'excluir-abastecimento'){

    excluirAbastecimento();
  
}

function listarAbastecimentos(){

    include 'functions.php';

    $sql = selectAbastecimentosTodosVeiculos();
        if ($sql->rowCount() > 0) {

            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
           
             foreach($lista as $row){

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
    
                    $txtTable = $txtTable.'<tr>
                    <td class="w3-left-align" > '.dmaH($row['data_abastecimento']).'</td>
                    <td> '.$row['numero_equipamento'].' </td>
                    <td> '.$row['placa'].' </td>
                    <td> '.$row['prefixo'].' </td>
                    <td class="w3-right-align"> '.v2($row['odometroinicial']).' </td>
                    <td class="w3-right-align" > '.v2($row['odometrofinal']).' </td>
                    <td class="'.$corLitros.' w3-right-align"> '.v2($row['litros_od']).' </td>
                    <td class="'.$corLitros.' w3-right-align"> '.v2($row['litros']).' </td>
                    <td class="'.$corMedia.' w3-right-align"> '.v2($row['media']).' </td>
                    <td> '.$row['ultimokm'].' </td>
                    <td> '.$row['km'].' </td>
                    <td class="'.$corDifKm.' class="w3-right-align"> '.$row['diferencakm'].' </td>
                    <td> '.$row['ultimohr'].'</td>
                    <td> '.$row['hr'].'</td>
                    <td class="'.$corDifHr.' class="w3-right-align"> '.$row['diferencahr'].'</td>
                    <td> '.$row['frentista'].'</td>
                    </tr>';
                      
                }
            }       
                  
           return $txtTable;            
}

function registrarAbastecimento(){

    $id_veiculoRegistrar = $_POST['id_veiculoRegistrar'];
    $bombaRegistrar = $_POST['bombaRegistrar'];
    $odometroinicialRegistrar = $_POST['odometroinicialRegistrar'];
    $ultimokmRegistrar = $_POST['ultimokmRegistrar']; 
    $kmRegistrar = $_POST['kmRegistrar']; 
    $diferencakmRegistrar = $_POST['diferencakmRegistrar'];
    $ultimohrRegistrar = $_POST['ultimohrRegistrar'];
    $hrRegistrar = $_POST['hrRegistrar']; 
    $diferencahrRegistrar = $_POST['diferencahrRegistrar'];
    $frentistaRegistrar = $_POST['frentistaRegistrar'];
    $odometrofinalRegistrar = $_POST['odometrofinalRegistrar'];
    $litrosRegistrar = $_POST['litrosRegistrar'];
    $litros_odRegistrar = $_POST['litros_odRegistrar'];
    $mediaRegistrar = $_POST['mediaRegistrar'];

    insertAbastecimentoNovo( $id_veiculoRegistrar, $bombaRegistrar ,$odometroinicialRegistrar ,$ultimokmRegistrar ,$kmRegistrar ,
    $diferencakmRegistrar ,$ultimohrRegistrar ,$hrRegistrar ,$diferencahrRegistrar ,$frentistaRegistrar ,$odometrofinalRegistrar ,
    $litrosRegistrar, $litros_odRegistrar, $mediaRegistrar);
}


function informacoesVeiculo($id_veiculo){

    $sql = selectAbastecimentosPorVeiculo($id_veiculo);

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
function filtrarAbastecimentos($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo, $filtroSetor, $dataHoraIncial, $dataHoraFinal){
    
    include 'functions.php';

        $sql = selectAbastecimentosFiltrar($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo, $filtroSetor, $dataHoraIncial, $dataHoraFinal);

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
          return  $txtTableControles;      
}    
    $combustivelFiltro = $_REQUEST['combustivelFiltro'];
    $marcaFiltro = $_REQUEST['marcaFiltro'];
    $modeloFiltro = $_REQUEST['modeloFiltro'];
    $prefixoFiltro = $_REQUEST['prefixoFiltro'];
    $setorFiltro = $_REQUEST['setorFiltro'];
    $dataIncialFiltro = $_REQUEST['dataIncialFiltro'];
    $dataFinalFiltro = $_REQUEST['dataFinalFiltro'];

    if($acao == 'limpar'){

        $x = new DateTime('NOW', new DateTimeZone('America/Sao_Paulo'));
        $dataIncialFiltro = $x->format('Y-m-d 00:00');
        $x = new DateTime('NOW', new DateTimeZone('America/Sao_Paulo'));
        $dataFinalFiltro = $x->format('Y-m-d 23:59');
        $prefixoFiltro = '';
        $combustivelFiltro = '';
        $marcaFiltro = '';
        $modeloFiltro = '';
        $setorFiltro = '';

    }

    if($prefixoFiltro && $prefixoFiltro <> 'TODOS'){$filtroPrefixo = "AND v.prefixo = '$prefixoFiltro'";};
    if($combustivelFiltro && $combustivelFiltro <> 'TODOS' ){$filtroCombustivel = "AND v.combustivel = '$combustivelFiltro'";}
    if($marcaFiltro && $marcaFiltro <> 'TODOS'){$filtroMarca = "AND v.marca = '$marcaFiltro'";}
    if($modeloFiltro && $modeloFiltro <> 'TODOS'){$filtroModelo = "AND v.modelo = '$modeloFiltro'";}
    if($setorFiltro && $setorFiltro <> 'TODOS'){$filtroSetor = "AND v.setor = '$setorFiltro'";}
    if($dataIncialFiltro  == ''){

        $x = new DateTime('NOW', new DateTimeZone('America/Sao_Paulo'));
        $dataHoraIncial = $x->format('Y-m-d 00:00');

    }else{
        $horaInicial = '00:00';
        $dataHoraIncial = $dataIncialFiltro.' '.$horaInicial;
    }
    if($dataFinalFiltro == ''){ 

        $x = new DateTime('NOW', new DateTimeZone('America/Sao_Paulo'));
        $dataHoraFinal = $x->format('Y-m-d 23:59');

    }else{
        $horaFinal = '23:59';
        $dataHoraFinal = $dataFinalFiltro.' '.$horaFinal;
    }

             


function alterarAbastecimento(){

    include 'config.php';

    $id_abastecimentoAlterar = $_POST['id_abastecimentoAlterar'];
    $id_veiculoAlterar = $_POST['id_veiculoAlterar'];
    $bombaAlterar = $_POST['bombaAlterar'];
    $odometroinicialAlterar = $_POST['odometroinicialAlterar']; 
    $odometrofinalAlterar = $_POST['odometrofinalAlterar']; 
    $litros_odAlterar = $_POST['litros_odAlterar'];
    $litrosAlterar = $_POST['litrosAlterar']; 
    $ultimokmAlterar = $_POST['ultimokmAlterar']; 
    $kmAlterar = $_POST['kmAlterar']; 
    $diferencakmAlterar = $_POST['diferencakmAlterar'];
    $mediaAlterar = $_POST['mediaAlterar'];
    $ultimohrAlterar = $_POST['ultimohrAlterar']; 
    $hrAlterar = $_POST['hrAlterar']; 
    $diferencahrAlterar = $_POST['diferencahrAlterar']; 
    $frentistaAlterar = $_POST['frentistaAlterar'];

    updateAbastecimentoAlterar($id_abastecimentoAlterar, $id_veiculoAlterar, $bombaAlterar, $odometroinicialAlterar, $odometrofinalAlterar, 
    $litros_odAlterar, $litrosAlterar, $ultimokmAlterar, $kmAlterar, $diferencakmAlterar, $mediaAlterar, $ultimohrAlterar, $hrAlterar, 
    $diferencahrAlterar, $frentistaAlterar);
   

}   
function excluirAbastecimento(){

    include 'config.php';

    $id_abastecimentoAlterar = $_POST['id_abastecimentoAlterar'];

    deleteAbastecimento($id_abastecimentoAlterar);

}    


?>