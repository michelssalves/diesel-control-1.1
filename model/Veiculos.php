<?php
function selectTodosOsVeiculosComFiltro($filtroStatus, $filtroPrefixo, $filtroCombustivel, $filtroMarca, $filtroModelo, $filtroSetor, $start, $result_for_page){        
    
    include 'config.php';

    $sql = $pdo->prepare("SELECT * FROM veiculos AS v 
        $filtroStatus $filtroPrefixo $filtroCombustivel $filtroMarca $filtroModelo $filtroSetor
        ORDER BY prefixo ASC LIMIT $start, $result_for_page");
        $sql->execute();
        return $sql;
    }
function insertTableVeiculosCadastrarNovo($numero_equipamento, $prefixoCad, $placa, $descricao_caminhao, $renavam, $chassi, 
$numero_motor, $ano, $marcaCad, $modeloCad, $combustivelCad, $metodo, $setorCad, $status_veiculo){

    include 'config.php';

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
function updateTabeleaVeiculosAlterarVeiculo($idVeiculoAlt, $numero_equipamento, $prefixoAlt, $placa, $descricao_caminha, $renavam, $chassi, 
$numero_motor, $ano, $marcaAlt, $modeloAlt, $metodo, $setorAlt, $status_veiculo){

    include 'config.php';

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

    function updateVeiculosStatus($idVeiculoAlt, $status_veiculo){

    include 'config.php';

    $sql = $pdo->prepare("UPDATE veiculos SET status_veiculo = :status_veiculo WHERE id_veiculo = :idVeiculoAlt");
    $sql->bindValue(':status_veiculo', $status_veiculo);
    $sql->bindValue(':idVeiculoAlt', $idVeiculoAlt);
    $sql->execute();
    }

?>