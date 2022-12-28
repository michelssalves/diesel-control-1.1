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
function  updateTabeleaVeiculosAlterarVeiculo($idVeiculoAlt, $prefixoAlt, $numeroEquipamentoAlt, $placaAlt, $descricaoCaminhaoAlt,
$renavamAlt, $chassiAlt, $numeroMotorAlt, $anoAlt, $marcaAlt, $modeloAlt, $combustivelAlt, $metodoAlt, $setorAlt, 
$statusVeiculoAlt){

    include 'config.php';

    $sql = $pdo->prepare("UPDATE veiculos SET
    prefixo = :prefixoAlt, numero_equipamento = :numeroEquipamentoAlt, placa = :placaAlt, 
    descricao_caminhao = :descricaoCaminhaoAlt, renavam = :renavamAlt, chassi = :chassiAlt, 
    numero_motor = :numeroMotorAlt,
    ano = :anoAlt, marca = :marcaAlt, modelo = :modeloAlt, combustivel = :combustivelAlt ,metodo =:metodoAlt,
    setor = :setorAlt, status_veiculo = :statusVeiculoAlt
    WHERE id_veiculo = :idVeiculoAlt");

    $sql->bindValue(':idVeiculoAlt', $idVeiculoAlt);
    $sql->bindValue(':prefixoAlt', $prefixoAlt);
    $sql->bindValue(':numeroEquipamentoAlt', $numeroEquipamentoAlt);
    $sql->bindValue(':placaAlt', $placaAlt);
    $sql->bindValue(':descricaoCaminhaoAlt', $descricaoCaminhaoAlt);
    $sql->bindValue(':renavamAlt', $renavamAlt);
    $sql->bindValue(':chassiAlt', $chassiAlt);
    $sql->bindValue(':numeroMotorAlt', $numeroMotorAlt);
    $sql->bindValue(':anoAlt', $anoAlt);
    $sql->bindValue(':marcaAlt', $marcaAlt);
    $sql->bindValue(':modeloAlt', $modeloAlt);
    $sql->bindValue(':combustivelAlt', $combustivelAlt);
    $sql->bindValue(':metodoAlt', $metodoAlt);
    $sql->bindValue(':setorAlt', $setorAlt);
    $sql->bindValue(':statusVeiculoAlt', $statusVeiculoAlt);
    $sql->execute();
    }    

    function updateVeiculosStatus($idVeiculo, $statusVeiculo){

    include 'config.php';

    $sql = $pdo->prepare("UPDATE veiculos SET status_veiculo = :statusVeiculo WHERE id_veiculo = :idVeiculo");
    $sql->bindValue(':statusVeiculo', $statusVeiculo);
    $sql->bindValue(':idVeiculo', $idVeiculo);
    $sql->execute();
    }

?>