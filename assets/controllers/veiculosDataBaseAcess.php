<?php
session_start();

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

    include 'config.php';
    
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

    $sql = $pdo->prepare("INSERT INTO veiculos(
        numero_equipamento, prefixo, placa, descricao_caminhao, renavam,chassi, numero_motor,
        ano,marca,modelo,combustivel,metodo,setor,status_veiculo)
        VALUES(:numero_equipamento, :prefixoCad, :placa, :descricao_caminhao, :renavam, :chassi,
        :numero_motor,:ano, :marcaCad, :modeloCad, :combustivelCad, :metodo, :setorCad, :status_veiculo)");

    $sql->bindValue(':numero_equipamento', $numero_equipamento);
    $sql->bindValue(':prefixoCad', $prefixoCad);
    $sql->bindValue(':placa', $placa);
    $sql->bindValue(':descricao_caminhao', $descricao_caminhao);
    $sql->bindValue(':renavam', $renavam);
    $sql->bindValue(':chassi', $chassi);
    $sql->bindValue(':numero_motor', $numero_motor);
    $sql->bindValue(':ano', $ano);
    $sql->bindValue(':marcaCad', $marcaCad);
    $sql->bindValue(':modeloCad', $modeloCad);
    $sql->bindValue(':combustivelCad', $combustivelCad);
    $sql->bindValue(':metodo', $metodo);
    $sql->bindValue(':setorCad', $setorCad);
    $sql->bindValue(':status_veiculo', $status_veiculo);
    $sql->execute();

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
     
    $sql = $pdo->prepare("UPDATE veiculos SET
    numero_equipamento = :numero_equipamento, prefixo = :prefixoAlt, placa = :placa, 
    descricao_caminhao = :descricao_caminhao, renavam = :renavam, chassi = :chassi, 
    numero_motor = :numero_motor,
    ano = :ano, marca = :marcaAlt, modelo = :modeloAlt, combustivel = :combustivelAlt ,metodo =:metodo,
    setor = :setorAlt, status_veiculo = :status_veiculo
    WHERE id_veiculo = :idVeiculoAlt");

    $sql->bindValue(':idVeiculoAlt', $idVeiculoAlt);
    $sql->bindValue(':numero_equipamento', $numero_equipamento);
    $sql->bindValue(':prefixoAlt', $prefixoAlt);
    $sql->bindValue(':placa', $placa);
    $sql->bindValue(':descricao_caminhao', $descricao_caminhao);
    $sql->bindValue(':renavam', $renavam);
    $sql->bindValue(':chassi', $chassi);
    $sql->bindValue(':numero_motor', $numero_motor);
    $sql->bindValue(':ano', $ano);
    $sql->bindValue(':marcaAlt', $marcaAlt);
    $sql->bindValue(':modeloAlt', $modeloAlt);
    $sql->bindValue(':combustivelAlt', $combustivelAlt);
    $sql->bindValue(':metodo', $metodo);
    $sql->bindValue(':setorAlt', $setorAlt);
    $sql->bindValue(':status_veiculo', $status_veiculo);
    $sql->execute();
           
}
function desativarVeiculo($acao){

    include 'config.php';
    if($acao == 'desativar-veiculo'){
        $status_veiculo = '2';
    }else{
        $status_veiculo = '1';
    }

    $idVeiculoAlt = $_POST['idVeiculoAlt'];
    
    $sql = $pdo->prepare("UPDATE veiculos SET status_veiculo = :status_veiculo WHERE id_veiculo = :idVeiculoAlt");
    $sql->bindValue(':status_veiculo', $status_veiculo);
    $sql->bindValue(':idVeiculoAlt', $idVeiculoAlt);
    $sql->execute();

}
function filtrarVeiculos($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo,$filtroSetor, $filtroStatus, $page){

    $result_for_page = 25;
   // $page = 1;
    $start = ($page * $result_for_page) - $result_for_page;
   
    include 'config.php';
    include 'functions.php';
    include 'modalCadastrarVeiculos.php';

        $sql = $pdo->prepare("SELECT * FROM veiculos AS v
        $filtroStatus    
        $filtroPrefixo $filtroCombustivel $filtroMarca $filtroModelo $filtroSetor
        ORDER BY prefixo DESC LIMIT $start, $result_for_page");
        $sql->execute();

        var_dump($sql);

        if ($sql->rowCount() > 0) {

            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
            $x = 0;
            foreach($lista as $row){

                $modalAlterarVeiculo = "modalAlterarVeiculo".$row['id_veiculo']."";

                $linkModalAlterar = "data-bs-toggle='modal' data-bs-target='#$modalAlterarVeiculo' style='cursor:pointer'";

                //$info = http_build_query($info);

                $x++;
                $txtTableVeiculos .= '<tr '.$linkModalAlterar.' style="cursor:pointer;">
                <td><center>'.$x.'</td>
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
            </tr>
        ';

                include 'modalAlterarVeiculos.php';
            }
        $txtTableVeiculos .='</tbody></table>';
        $number_pages = ceil($resultados / $result_for_page);
        $max_link = 2;
        
        $resultados = $sql->rowCount();

        $txtTableVeiculos .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';

        $txtTableVeiculos .= "<li class='page-item'><a class='page-link' onclick='listUsers(1)'>First Page</a></li>";

        for ($previous_page = $page - $max_link; $previous_page <= $page - 1; $previous_page++) {
            if ($previous_page >= 1) {
                $txtTableVeiculos .= "<li class='page-item'><a class='page-link' href='#'onclick='listUsers($previous_page)'>$previous_page</a></li>";
            }
        }
        $txtTableVeiculos .= "<li class='page-item active' ><a class='page-link' href='#'>$page</a></li>";

        for ($next_page = $page + 1; $next_page <= $page + $max_link; $next_page++) {
            if ($next_page <= $number_pages) {
                $txtTableVeiculos .= "<li class='page-item'><a class='page-link' href='#' onclick='listUsers($next_page)'>$next_page</a></li>";
            }
        }
        $txtTableVeiculos .= "<li class='page-item'><a class='page-link' href='#' onclick='listUsers($number_pages)'>Last Page</a></li>";
        $txtTableVeiculos .= '</ul></nav>';

        
        }
          return  $txtTableVeiculos;      
}     
?>