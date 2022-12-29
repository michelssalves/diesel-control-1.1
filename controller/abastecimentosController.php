<?php
include 'config.php';
include 'validaToken.php';

$acao = $_REQUEST['acao'];

$page = $_REQUEST['page'];

$dataAbastecimento = ($_POST['dataAbastecimento'] ? $_POST['dataAbastecimento'] : date('2022-12-13'));
$combustivel = ($_POST['combustivel'] <> '' ? $_POST['combustivel'] : 'TODOS');
$marca = ($_POST['marca'] <> '' ? $_POST['marca'] : 'TODOS');
$modelo = ($_POST['modelo'] <> '' ? $_POST['modelo'] : 'TODOS');
$prefixo = ($_POST['prefixo'] <> '' ? $_POST['prefixo'] : 'TODOS');
$setor = ($_POST['setor'] <> '' ? $_POST['setor'] : 'TODOS');

if($acao == 'limpar'){

    $dataAbastecimento = date('2022-12-13'); 
    $prefixo = '';
    $combustivel = '';
    $marca = '';
    $modelo = '';
    $setor = '';

}

if($dataAbastecimento && $dataAbastecimento <> ''){ 
    $filtrodataAbastecimento = $dataAbastecimento;
}else{
    $filtrodataAbastecimento = date('Y-m-d');
}

if($prefixo && $prefixo <> 'TODOS'){$filtroPrefixo = "AND v.prefixo = '$prefixo'";};
if($combustivel && $combustivel <> 'TODOS' ){$filtroCombustivel = "AND v.combustivel = '$combustivel'";}
if($marca && $marca <> 'TODOS'){$filtroMarca = "AND v.marca = '$marca'";}
if($modelo && $modelo <> 'TODOS'){$filtroModelo = "AND v.modelo = '$modelo'";}
if($setor && $setor <> 'TODOS'){$filtroSetor = "AND v.setor = '$setor'";}

function filtrarAbastecimentos($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo, $filtroSetor, $filtrodataAbastecimento, $page){

    include 'config.php';
    include 'functions.php';
    include 'modal/modalCadastrarAbastecimento.php'; 

    $resultadoPorPagina = 25;
    if($page == ''){$page = 1;}
    $start = ($page * $resultadoPorPagina) - $resultadoPorPagina;
    
        $sql = selectAbastecimentosFiltrar($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo, $filtroSetor, $filtrodataAbastecimento, $start, $resultadoPorPagina);

        if ($sql->rowCount() > 0) {
            
            $txtTableAbastecimentos .='<tbody>';

            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($lista as $row){

                $modalAlterarAbastecimento = "modalAlterarAbastecimento".$row['id_abastecimento']."";
                if(!$_SESSION['id_permissao'] < 1){
                $linkModalAlterarAbastecimento = "data-bs-toggle='modal' data-bs-target='#$modalAlterarAbastecimento' style='cursor:pointer'";
                }
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
     
                $txtTableAbastecimentos .= '<tr '.$linkModalAlterarAbastecimento.'>
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
                if(!$_SESSION['id_permissao'] < 1){

                include 'modal/modalAlterarAbastecimento.php';
                
                }
            }

            $txtTableAbastecimentos .='</tbody></table>';

            $number_pages = ceil($resultados / $resultadoPorPagina);
            $max_link = 2;
    
            $txtTableAbastecimentos .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';
    
            $txtTableAbastecimentos .= "<li class='page-item'><a class='page-link' href='controle-de-veiculos?page=1'>First Page</a></li>";
    
            for ($previous_page = $page - $max_link; $previous_page <= $page - 1; $previous_page++) {
                if ($previous_page >= 1) {
                    $txtTableVeiculos .= "<li class='page-item'><a class='page-link' href='controle-de-veiculos?page=$previous_page'>$previous_page</a></li>";
                }
            }
            $txtTableAbastecimentos .= "<li class='page-item active' ><a class='page-link' href='#'>$page</a></li>";
    
            for ($next_page = $page + 1; $next_page <= $page + $max_link; $next_page++) {
                if ($next_page <= $number_pages) {
                    $$txtTableAbastecimentos .= "<li class='page-item'><a class='page-link' href='controle-de-veiculos?page=$next_page' >$next_page</a></li>";
                }
            }
            $txtTableAbastecimentos .= "<li class='page-item'><a class='page-link' href='controle-de-veiculos?page=$number_pages'>Last Page</a></li>";
            $txtTableAbastecimentos .= '</ul></nav>';
          
        }

        return $$txtTableAbastecimentos;  

} 
if($acao == 'registrar-abastecimento'){

    registrarAbastecimento();

}
if($acao == 'alterar-abastecimento'){

    alterarAbastecimento();

    
}
if($acao == 'ultimoKm'){
    
    $idVeiculo =  $_REQUEST['id'];

    $return = ['error' => false,  'dados' => informacoesVeiculo($idVeiculo)];
  
    echo json_encode($return);
  
}

if($acao == 'excluir-abastecimento'){

    excluirAbastecimento();
  
}
function registrarAbastecimento(){

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
function alterarAbastecimento(){

    $idAbastecimentoAlt = $_POST['idAbastecimentoAlt'];
    $idVeiculoAlt = $_POST['idVeiculoAlt'];
    $bombaAlt = $_POST['bombaAlt'];
    $odometroInicialAlt = $_POST['odometroInicialAlt']; 
    $odometroFinalAlt = $_POST['odometroFinalAlt']; 
    $litrosOdAlt = $odometroFinalAlt - $odometroInicialAlt;
    $litrosAlt = $_POST['litrosAlt']; 
    $ultimoKmAlt = $_POST['ultimoKmAlt']; 
    $kmAlt = $_POST['kmAlt']; 
    $diferencaKmAlt = $kmAlt - $ultimoKmAlt ;
    $ultimoHrAlt = $_POST['ultimoHrAlt']; 
    $hrAlt = $_POST['hrAlt']; 
    $diferencaHrAlt = $hrAlt - $ultimoHrAlt; 
    $frentistaAlt = $_POST['frentistaAlt'];
    $mediaAlt = $diferencaKmAlt / $litrosAlt;
    $dataAbastecimentoAlt = $_POST['dataAbastecimentoAlt'];
 
  updateAbastecimentoAlterar($idAbastecimentoAlt, $idVeiculoAlt, $bombaAlt,$odometroInicialAlt,$odometroFinalAlt,
  $litrosOdAlt,$litrosAlt,$ultimoKmAlt, $kmAlt, $diferencaKmAlt,$mediaAlt,$ultimoHrAlt ,$hrAlt,$diferencaHrAlt, $frentistaAlt, $dataAbastecimentoAlt);
   
} 
function informacoesVeiculo($idVeiculo){

    include 'config.php';

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
function excluirAbastecimento(){

    $idAbastecimentoAlt = $_POST['idAbastecimentoAlt'];

    deleteAbastecimento($idAbastecimentoAlt);

}    
?>