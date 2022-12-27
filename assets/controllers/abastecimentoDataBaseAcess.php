<?php
session_start();
$acao = $_REQUEST['acao'];

// ****** AQUI É FEITA A PARTE DE CONTROLE DO MENU REGISTRO DE ABASTECIMENTOS 
function listarAbastecimentos(){

    include 'config.php';
    include 'functions.php';

        $sql = $pdo->prepare("SELECT *
        FROM veiculos AS v  
        JOIN abastecimentos AS a 
        ON a.id_veiculo = v.id_veiculo
        ORDER BY data_abastecimento DESC LIMIT 30 ");
        $sql->execute();

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
if($acao == 'registrar-abastecimento'){

    registrarAbastecimento();
}
function registrarAbastecimento(){

    include 'config.php';
   // include 'functions.php';
   //echo '<pre>';  echo
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

    $sql = $pdo->prepare("INSERT INTO abastecimentos (id_veiculo, bomba, odometroinicial, ultimokm,	
     km, diferencakm, ultimohr, hr, diferencahr, frentista,	odometrofinal, litros, litros_od, media, data_abastecimento, dataabastecimento2) 
    VALUES (:id_veiculoRegistrar, :bombaRegistrar, :odometroinicialRegistrar,:ultimokmRegistrar,:kmRegistrar, :diferencakmRegistrar, :ultimohrRegistrar, :hrRegistrar, :diferencahrRegistrar,
    :frentistaRegistrar, :odometrofinalRegistrar, :litrosRegistrar, :litros_odRegistrar, :mediaRegistrar, :data_abastecimento, :data_sem_hora)");

    $sql->bindValue(':id_veiculoRegistrar', $id_veiculoRegistrar);
    $sql->bindValue(':bombaRegistrar', $bombaRegistrar);
    $sql->bindValue(':odometroinicialRegistrar', $odometroinicialRegistrar);
    $sql->bindValue(':ultimokmRegistrar', $ultimokmRegistrar);
    $sql->bindValue(':kmRegistrar', $kmRegistrar);
    $sql->bindValue(':diferencakmRegistrar', $diferencakmRegistrar);
    $sql->bindValue(':ultimohrRegistrar', $ultimohrRegistrar);
    $sql->bindValue(':hrRegistrar', $hrRegistrar);
    $sql->bindValue(':diferencahrRegistrar', $diferencahrRegistrar);
    $sql->bindValue(':frentistaRegistrar', $frentistaRegistrar);
    $sql->bindValue(':odometrofinalRegistrar', $odometrofinalRegistrar);
    $sql->bindValue(':litrosRegistrar', $litrosRegistrar);
    $sql->bindValue(':litros_odRegistrar', $litros_odRegistrar);
    $sql->bindValue(':mediaRegistrar', $mediaRegistrar);
    $sql->bindValue(':data_abastecimento', date('Y-m-d H:i'));
    $sql->bindValue(':data_sem_hora', date('Y-m-d'));
    $sql->execute();

}

if($acao == 'ultimoKm'){
    
    $id_veiculo =  $_REQUEST['id'];

    $return = ['error' => false,  'dados' => informacoesVeiculo($id_veiculo)];
  
    echo json_encode($return);
  
}
function informacoesVeiculo($id_veiculo){

    include 'config.php';
    
    $sql = $pdo->prepare("SELECT * FROM abastecimentos 
	WHERE id_veiculo = :id_veiculo  
    ORDER BY data_abastecimento DESC LIMIT 1
    ");
	$sql->bindValue(':id_veiculo', $id_veiculo);
	$sql->execute();
	$row = $sql->fetch(PDO::FETCH_ASSOC);
    $setor = $row['setor'];
    $ultimoKm = $row['km'];
    if($row['km'] < 0){$ultimoKm = 0;}
    $ultimoHr = $row['hr'];
    if($row['hr'] < 0){$ultimoHr = 0;}
    
    $sql = $pdo->prepare("SELECT * FROM veiculos WHERE id_veiculo = :id_veiculo");
	$sql->bindValue(':id_veiculo', $id_veiculo);
	$sql->execute();
	$row = $sql->fetch(PDO::FETCH_ASSOC);
    $setor = $row['setor'];

    $informacoesVeiculo = [
        'setor' => $setor,
        'ultimoKm' => $ultimoKm,
        'ultimoHr' => $ultimoHr
    ];

    return $informacoesVeiculo;

}
// ****** AQUI FINALIZA A PARTE DE CONTROLE DO MENU REGISTRO DE ABASTECIMENTOS 

// ****** AQUI INICIA A PARTE DE CONTROLE DO MENU CONTROLES.PHP
if($acao == 'alterar-abastecimento'){

  // alterarAbastecimento();
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
   
   
   $sql = $pdo->prepare("UPDATE abastecimentos SET id_veiculo = :id_veiculo, bomba = :bomba, odometroinicial = :odometroinicial, 
   ultimokm = :ultimokm, km = :km, diferencakm = :diferencakm, ultimohr = :ultimohr, hr = :hr, diferencahr = :diferencahr, 
   frentista = :frentista,	odometrofinal = :odometrofinal, litros = :litros, litros_od = :litros_od, media = :media, data_alteracao = :data_alteracao 
   WHERE id_abastecimento = :id_abastecimento");
   
   $sql->bindValue(':id_abastecimento', $id_abastecimentoAlterar);
   $sql->bindValue(':id_veiculo', $id_veiculo);
   $sql->bindValue(':bomba', $bombaAlterar);
   $sql->bindValue(':odometroinicial', $odometroinicialAlterar);
   $sql->bindValue(':ultimokm', $ultimokmAlterar);
   $sql->bindValue(':km', $kmAlterar);
   $sql->bindValue(':diferencakm', $diferencakmAlterar);
   $sql->bindValue(':ultimohr', $ultimohrAlterar);
   $sql->bindValue(':hr', $hrAlterar);
   $sql->bindValue(':diferencahr', $diferencahrAlterar);
   $sql->bindValue(':frentista', $frentistaAlterar);
   $sql->bindValue(':odometrofinal', $odometrofinalAlterar);
   $sql->bindValue(':litros', $litrosAlterar);
   $sql->bindValue(':litros_od', $litros_odAlterar);
   $sql->bindValue(':media', $mediaAlterar);
   $sql->bindValue(':data_alteracao', date('Y-m-d'));
   $sql->execute();

}
if($acao == 'excluir-abastecimento'){

    excluirAbastecimento();
  
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

function filtrarAbastecimentos($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo, $filtroSetor, $dataHoraIncial, $dataHoraFinal){
    
    include 'config.php';
    include 'functions.php';

        $sql = $pdo->prepare("SELECT *
        FROM veiculos AS v  
        JOIN abastecimentos AS a 
        ON a.id_veiculo = v.id_veiculo
        WHERE a.data_abastecimento BETWEEN '$dataHoraIncial' AND '$dataHoraFinal'
        $filtroPrefixo $filtroCombustivel $filtroMarca $filtroModelo $filtroSetor
        ORDER BY a.data_abastecimento ASC ");

        $sql->execute();

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
                <td hidden class="w3-left-align"> '.H_i($row['data_abastecimento']).'</td>
                <td hidden class="w3-left-align"> '.Month($row['data_abastecimento']).'</td>
                <td hidden class="w3-left-align"> '.Year($row['data_abastecimento']).'</td>
                <td> '.$row['numero_equipamento'].' </td>
                <td> '.$row['prefixo'].' </td>
                <td> '.$row['placa'].' </td>
                <td> '.$row['combustivel'].' </td>
                <td hidden> '.$row['bomba'].' </td>
                <td hidden> '.v2($row['odometroinicial']).' </td>
                <td hidden> '.v2($row['odometrofinal']).' </td>
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
                <td hidden><center> '.$row['setor'].'</td>
                </tr>';

                include 'modalAlterarAbastecimento.php';
            }
           
        }
          return  $txtTableControles;      
}                 


function alterarAbastecimento(){

  

}   
function excluirAbastecimento(){

/*    include 'config.php';

    $id_abastecimento = $_POST['id_abastecimento'];
    $sql = $pdo->prepare("DELETE FROM abastecimentos WHERE id_abastecimento = :id_abastecimento");
    $sql->bindValue(':id_abastecimento', $id_abastecimento);
    $sql->execute();*/

}

function consultarIdEquipamento($numero_equipamento){

    include 'config.php';
    include 'functions.php';
    
    $sql = $pdo->prepare("SELECT id_veiculo FROM veiculos WHERE numero_equipamento = :numero_equipamento");
    $sql->bindValue(':numero_equipamento', $numero_equipamento);
    $sql->execute();
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach($lista as $row){
        $id_veiculo = $row['id_veiculo'];
    }
    return  $id_veiculo;
 
}
/*function consultarEquipamento($id_veiculo){
    include 'config.php';
   
    $sql = $pdo->prepare("SELECT * FROM veiculos WHERE id_veiculo = :id_veiculo");
    $sql->bindValue(':id_veiculo', $id_veiculo);
    $sql->execute();
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
    return  $lista;
 
}*/

?>