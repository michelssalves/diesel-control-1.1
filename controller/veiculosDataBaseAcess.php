<?php
$acao = $_REQUEST['acao'];

$page = $_REQUEST['page'];
$idVeiculo = $_POST['idVeiculo'];
$prefixo = $_REQUEST['prefixo'];
$numeroEquipamento = $_POST['numeroEquipamento'];
$placa = $_POST['placa'];
$descricaoCaminhao = $_POST['descricaoCaminhao'];
$combustivel = $_REQUEST['combustivel'];
$renavam = $_POST['renavam'];
$chassi = $_POST['chassi'];
$numeroMotor = $_POST['numeroMotor'];
$ano = $_POST['ano'];
$marca = $_REQUEST['marca'];
$modelo = $_REQUEST['modelo'];
$setor = $_REQUEST['setor'];
$statusVeiculo = $_POST['statusVeiculo'];
$metodo = $_POST['metodo'];

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

    desativarVeiculo($acao, $idVeiculo, $statusVeiculo);
}
if($acao == 'alterar-veiculo'){
 
    alterarVeiculo();
}
function cadastrarVeiculo(){
    include 'config.php';

    insertTableVeiculosCadastrarNovo($numeroEquipamento, $prefixo, $placa, $descricaoCaminhao, $renavam, $chassi, 
    $numeroMotor, $ano, $marca, $modelo, $combustivel, $metodo, $setor, $statusVeiculo);

}
function alterarVeiculo(){

    include 'config.php';
    
    updateTabeleaVeiculosAlterarVeiculo($idVeiculo, $numeroEquipamento, $prefixo, $placa, $descricaoCaminhao, $renavam, $chassi, 
     $numeroMotor, $ano, $marca, $modelo, $combustivel, $metodo, $setor, $statusVeiculo);
     
}
function desativarVeiculo($acao, $idVeiculo, $statusVeiculo){

    include 'config.php';

    if($acao == 'desativar-veiculo'){
        $statusVeiculo = '2';
    }else{
        $statusVeiculo = '1';
    }

 

    updateVeiculosStatus($idVeiculo, $statusVeiculo);


}
function filtrarVeiculos($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo,$filtroSetor, $filtroStatus, $page){

    $result_for_page = 25;
    if($page == ''){$page = 1;}
    $start = ($page * $result_for_page) - $result_for_page;
   
    //include 'functions.php';
    include 'modal/modalCadastrarVeiculos.php';

    $sql = selectTodosOsVeiculosComFiltro($filtroStatus, $filtroPrefixo, $filtroCombustivel, $filtroMarca, $filtroModelo, 
    $filtroSetor, $start, $result_for_page);        


        if ($sql->rowCount() > 0) {

            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
        
            foreach($lista as $row){

                $modalAlterarVeiculo = "modalAlterarVeiculo".$row['id_veiculo']."";

                $linkModalAlterar = "data-bs-toggle='modal' data-bs-target='#$modalAlterarVeiculo' style='cursor:pointer'";

                $txtTableVeiculos .= '<tr '.$linkModalAlterar.' style="cursor:pointer;">
                <td>'.$row['numero_equipamento'].'</td>
                <td>'.($row['prefixo']).'</td>
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

            include 'modal/modalAlterarVeiculos.php';
            }

        $txtTableVeiculos .='</tbody></table>';

        $resultados = $sql->rowCount();
        $number_pages = ceil(250 / $result_for_page);
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