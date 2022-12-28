<?php
include 'model/Veiculos.php';

$acao = $_REQUEST['acao'];

$page = $_REQUEST['page'];
$combustivel = $_REQUEST['combustivel'];
$marca = $_REQUEST['marca'];
$modelo = $_REQUEST['modelo'];
$prefixo = $_REQUEST['prefixo'];
$setor = $_REQUEST['setor'];
$status = $_REQUEST['status'];

if($acao == 'limpar'){

    $prefixo = '';
    $combustivel = '';
    $marca = '';
    $modelo = '';
    $setor = '';
    $status = '';
}

if($prefixo && $prefixo <> 'TODOS'){$filtroPrefixo = "AND prefixo = '$prefixo'";};
if($combustivel && $combustivel <> 'TODOS' ){$filtroCombustivel = "AND combustivel = '$combustivel'";}
if($marca && $marca <> 'TODOS'){$filtroMarca = "AND marca = '$marca'";}
if($modelo && $modelo <> 'TODOS'){$filtroModelo = "AND modelo = '$modelo'";}
if($setor && $setor <> 'TODOS'){$filtroSetor = "AND setor = '$setor'";}
if($status == 'checked'){
    $filtroStatus = "WHERE status_veiculo <= 2";
}else{
     $filtroStatus = "WHERE status_veiculo = 1";
}
if($acao == 'cadastrarVeiculo'){

    cadastrarVeiculo();
}
if($acao == 'desativar-veiculo' || $acao == 'ativar-veiculo'){

    desativarVeiculo($acao);
}
if($acao == 'alterar-veiculo'){
 
    alterarVeiculo();
}
function cadastrarVeiculo(){

    $numero_equipamento = strtoupper($_POST['numero_equipamento']);
    $prefixoCad = strtoupper($_POST['prefixoCad']);
    $placa = strtoupper($_POST['placa']);
    $descricao_caminhao = strtoupper($_POST['descricao_caminhao']);
    $renavam = strtoupper($_POST['renavam']);
    $chassi = strtoupper($_POST['chassi']);
    $numero_motor = strtoupper($_POST['numero_motor']);
    $ano = strtoupper($_POST['ano']);
    $marcaCad  = strtoupper($_POST['marcaCad ']);
    $modeloCad  = strtoupper($_POST['modeloCad ']);
    $combustivelCad = strtoupper($_POST['combustivelCad']);
    $metodo = strtoupper($_POST['metodo']);
    $setorCad = $_POST['setorCad'];
    $status_veiculo = strtoupper($_POST['status_veiculo']);

    insertTableVeiculosCadastrarNovo($numero_equipamento, $prefixoCad, $placa, $descricao_caminhao, $renavam, $chassi, 
    $numero_motor, $ano, $marcaCad, $modeloCad, $combustivelCad, $metodo, $setorCad, $status_veiculo);

}
function alterarVeiculo(){

    include 'config.php';
    
    $idVeiculoAlt = $_POST['idVeiculoAlt'];
    $numero_equipamento = strtoupper($_POST['numero_equipamento']);
    $prefixoAlt = strtoupper($_POST['prefixoAlt']);
    $placa = strtoupper($_POST['placa']);
    $descricao_caminhao = strtoupper($_POST['descricao_caminhao']);
    $renavam = strtoupper($_POST['renavam']);
    $chassi = strtoupper($_POST['chassi']);
    $numero_motor = strtoupper($_POST['numero_motor']);
    $ano = strtoupper($_POST['ano']);
    $marcaAlt = strtoupper($_POST['marcaAlt']);
    $modeloAlt = strtoupper($_POST['modeloAlt']);
    $combustivelAlt = strtoupper($_POST['combustivelAlt']);
    $metodo = strtoupper($_POST['metodo']);
    $setorAlt = $_POST['setorAlt'];
    $status_veiculo = strtoupper($_POST['status_veiculo']);

    updateTabeleaVeiculosAlterarVeiculo($idVeiculoAlt, $numero_equipamento, $prefixoAlt, $placa, $descricao_caminhao, $renavam, $chassi, 
     $numero_motor, $ano, $marcaAlt, $modeloAlt, $combustivelAlt, $metodo, $setorAlt, $status_veiculo);
     
}
function desativarVeiculo($acao){

    include 'config.php';
    if($acao == 'desativar-veiculo'){
        $status_veiculo = '2';
    }else{
        $status_veiculo = '1';
    }

    $idVeiculoAlt = $_POST['idVeiculoAlt'];

    updateVeiculosStatus($idVeiculoAlt, $status_veiculo);


}
function filtrarVeiculos($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo,$filtroSetor, $filtroStatus, $page){

    $result_for_page = 25;
    if($page == ''){$page = 1;}
    $start = ($page * $result_for_page) - $result_for_page;
   
    include 'controller/functions.php';
    include 'view/modal/modalCadastrarVeiculos.php';

    $sql = selectTodosOsVeiculosComFiltro($filtroStatus, $filtroPrefixo, $filtroCombustivel, $filtroMarca, $filtroModelo, 
    $filtroSetor, $start, $result_for_page);        


        if ($sql->rowCount() > 0) {

            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
        
            foreach($lista as $row){

                $modalAlterarVeiculo = "modalAlterarVeiculo".$row['id_veiculo']."";

                $linkModalAlterar = "data-bs-toggle='modal' data-bs-target='#$modalAlterarVeiculo' style='cursor:pointer'";

                $txtTableVeiculos .= '<tr '.$linkModalAlterar.' style="cursor:pointer;">
                <td>'.$row['numero_equipamento'].'</td>
                <td>'.l4($row['prefixo']).'</td>
                <td>'.$row['placa'].'</td>
                <td>'.$row['descricao_caminhao'].'</td>
                <td>'.$row['renavam'].'</td>
                <td>'.$row['chassi'].'</td>
                <td>'.$row['numero_motor'].'</td>
                <td>'.$row['ano'].'</td>
                <td>'.$row['marca'].'</td>
                <td>'.$row['modelo'].'</td>
                <td>'.$row['combustivel'].'</td>
                <td>'.($row['metodo'] == 1 ? 'KM' : 'HR').'</td>
                <td>'.$row['setor'].'</td>
                <td>'.($row['status_veiculo'] == 1 ? 'Ativo' :'Inativo').'</td>
            </tr>';

            include 'view/modal/modalAlterarVeiculos.php';
            }

        $txtTableVeiculos .='</tbody></table>';

        $resultados = $sql->rowCount();
        $number_pages = ceil($resultados / $result_for_page);
        $max_link = 2;

        $txtTableVeiculos .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';

        $txtTableVeiculos .= "<li class='page-item'><a class='page-link' href='controle-de-veiculos?page=1'>First Page</a></li>";

        for ($previous_page = $page - $max_link; $previous_page <= $page - 1; $previous_page++) {
            if ($previous_page >= 1) {
                $txtTableVeiculos .= "<li class='page-item'><a class='page-link' href='controle-de-veiculos?page=$previous_page'>$previous_page</a></li>";
            }
        }
        $txtTableVeiculos .= "<li class='page-item active' ><a class='page-link' href='#'>$page</a></li>";

        for ($next_page = $page + 1; $next_page <= $page + $max_link; $next_page++) {
            if ($next_page <= $number_pages) {
                $txtTableVeiculos .= "<li class='page-item'><a class='page-link' href='controle-de-veiculos?page=$next_page' >$next_page</a></li>";
            }
        }
        $txtTableVeiculos .= "<li class='page-item'><a class='page-link' href='controle-de-veiculos?page=$number_pages'>Last Page</a></li>";
        $txtTableVeiculos .= '</ul></nav>';

        
        }

    return  $txtTableVeiculos;      
}     
?>