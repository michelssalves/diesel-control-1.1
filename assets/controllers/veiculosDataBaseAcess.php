<?php
session_start();

$acao = $_REQUEST['acao'];

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
    $filtroStatus = "WHERE status_veiculo <= 1";
}else{
     $filtroStatus = "WHERE status_veiculo = 1";
}
if($acao == 'cadastrarVeiculo'){

    cadastrarVeiculo();
}
if($acao == 'desativar-veiculo'){

    desativarVeiculo();
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
function desativarVeiculo(){

    include 'config.php';

    $idVeiculoAlt = $_POST['idVeiculoAlt'];
    $status_veiculo = '2';
    
    $sql = $pdo->prepare("UPDATE veiculos SET status_veiculo = :status_veiculo WHERE id_veiculo = :idVeiculoAlt");
    
    $sql->bindValue(':status_veiculo', $status_veiculo);
    $sql->bindValue(':idVeiculoAlt', $idVeiculoAlt);
    $sql->execute();


}
function filtrarVeiculos($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo,$filtroSetor, $filtroStatus){
   
    include 'config.php';
    include 'functions.php';
    include 'modalCadastrarVeiculos.php';

        $sql = $pdo->prepare("SELECT * FROM veiculos AS v
        $filtroStatus    
        $filtroPrefixo $filtroCombustivel $filtroMarca $filtroModelo $filtroSetor
        ORDER BY prefixo ASC ");
        $sql->execute();


       
        if ($sql->rowCount() > 0) {

            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
            $x = 0;
            foreach($lista as $row){

                $modalAlterarVeiculo = "modalAlterarVeiculo".$row['id_veiculo']."";

                $linkModalAlterar = "data-bs-toggle='modal' data-bs-target='#$modalAlterarVeiculo' style='cursor:pointer'";

                $info = array(
                'id_veiculo' => $row['id_veiculo'],
                'numero_equipamento' => $row['numero_equipamento'],
                'prefixo' => $row['prefixo'],
                'placa' =>  $row['placa'],
                'descricao_caminhao' =>  $row['descricao_caminhao'],
                'renavam' =>  $row['renavam'],
                'chassi' =>  $row['chassi'],
                'numero_motor' =>  $row['numero_motor'],
                'ano' =>  $row['ano'],
                'marca' =>  $row['marca'],
                'modelo' =>  $row['modelo'],
                'combustivel' =>  $row['combustivel'],
                'metodo' =>  $row['metodo'],
                'setor' => $row['setor'],
                'status_veiculo' =>  $row['status_veiculo']   
                );

                $info = http_build_query($info);
                $url ='alterar-veiculo?'.$info;
                $link = "PopupCenter('$url','Veiculos',400,900)";
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
                <td>'.($row['metodo']).'</td>
                <td>'.$row['setor'].'</td>
                <td>'.($row['status_veiculo']).'</td>
            </tr>';

                include 'modalAlterarVeiculos.php';
            }
           
        }
          return  $txtTableVeiculos;      
}     
?>