<?php

function selectAbastecimentosTodosVeiculos(){
    include '../controller/config.php';

    $sql = $pdo->prepare("SELECT *FROM veiculos AS v  
    JOIN abastecimentos AS a 
    ON a.id_veiculo = v.id_veiculo
    ORDER BY data_abastecimento DESC LIMIT 30 ");
    $sql->execute();

    return $sql;
}
function selectAbastecimentosPorVeiculo($idVeiculo){
    include '../controller/config.php';
    
    $sql = $pdo->prepare("SELECT * FROM abastecimentos 
	WHERE id_veiculo = :idVeiculo  
    ORDER BY data_abastecimento DESC LIMIT 1");
	$sql->bindValue(':idVeiculo', $idVeiculo);
	$sql->execute();

    return $sql;
}
function selectAbastecimentosFiltrar($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo, $filtroSetor, $filtrodataInicial, $filtrodataFinal){
    
    include '../controller/config.php';

    $sql = $pdo->prepare("SELECT *FROM veiculos AS v  
    JOIN abastecimentos AS a 
    ON a.id_veiculo = v.id_veiculo
    WHERE a.dataabastecimento2 BETWEEN '$filtrodataInicial' AND '$filtrodataFinal'
    $filtroPrefixo $filtroCombustivel $filtroMarca $filtroModelo $filtroSetor");
    $sql->execute();

    return $sql;
}
function insertAbastecimentoNovo($idVeiculoCad,$bombaCad, $odometroInicialCad, $ultimoKmCad, $kmCad, $diferencaKmCad, $ultimoHrCad,
$hrCad, $diferencaHrCad, $frentistaCad, $odometroFinalCad, $litrosCad, $litrosOdCad, $mediaCad){

    include '../controller/config.php';

    $sql = $pdo->prepare("INSERT INTO abastecimentos (id_veiculo, bomba, odometroinicial, ultimokm,	
    km, diferencakm, ultimohr, hr, diferencahr, frentista,	odometrofinal, litros, litros_od, media, data_abastecimento, dataabastecimento2) 
    VALUES (:idVeiculoCad, :bombaCad, :odometroInicialCad,:ultimoKmCad,:kmCad, :diferencaKmCad, :ultimoHrCad, :hrCad, :diferencaHrCad,
    :frentistaCad, :odometroFinalCad, :litrosCad, :litrosOdCad, :mediaCad, :data_abastecimento, :data_sem_hora)");

    $sql->bindValue(':idVeiculoCad', $idVeiculoCad);
    $sql->bindValue(':bombaCad', $bombaCad);
    $sql->bindValue(':odometroInicialCad', $odometroInicialCad);
    $sql->bindValue(':ultimoKmCad', $ultimoKmCad);
    $sql->bindValue(':kmCad', $kmCad);
    $sql->bindValue(':diferencaKmCad', $diferencaKmCad);
    $sql->bindValue(':ultimoHrCad', $ultimoHrCad);
    $sql->bindValue(':hrCad', $hrCad);
    $sql->bindValue(':diferencaHrCad', $diferencaHrCad);
    $sql->bindValue(':frentistaCad', $frentistaCad);
    $sql->bindValue(':odometroFinalCad', $odometroFinalCad);
    $sql->bindValue(':litrosCad', $litrosCad);
    $sql->bindValue(':litrosOdCad', $litrosOdCad);
    $sql->bindValue(':mediaCad', $mediaCad);
    $sql->bindValue(':data_abastecimento', date('Y-m-d H:i'));
    $sql->bindValue(':data_sem_hora', date('Y-m-d'));
    $sql->execute();

}

function updateAbastecimentoAlterar($idAbastecimentoAlt, $idVeiculoAlt, $bombaAlt,$odometroInicialAlt,$odometroFinalAlt,
$litrosOdAlt,$litrosAlt,$ultimoKmAlt, $kmAlt, $diferencaKmAlt,$mediaAlt,$ultimoHrAlt ,$hrAlt,$diferencaHrAlt, $frentistaAlt){

    include '../controller/config.php';

     $sql = $pdo->prepare("UPDATE abastecimentos SET id_veiculo = :idVeiculoAlt, bomba = :bombaAlt, odometroinicial = :odometroInicialAlt, 
     ultimokm = :ultimoKmAlt, km = :kmAlt, diferencakm = :diferencaKmAlt, ultimohr = :ultimoHrAlt, hr = :hrAlt, diferencahr = :diferencaHrAlt, 
     frentista = :frentista, odometrofinal = :odometroFinalAlt, litros = :litrosAlt, litros_od = :litrosOdAlt, media = :mediaAlt, data_alteracao = :data_alteracao 
     WHERE id_abastecimento = :idAbastecimentoAlt");
     return $sql;
     $sql->bindValue(':idAbastecimentoAlt', $idAbastecimentoAlt);
     $sql->bindValue(':idVeiculoAlt', $idVeiculoAlt);
     $sql->bindValue(':bombaAlt', $bombaAlt);
     $sql->bindValue(':odometroInicialAlt', $odometroInicialAlt);
     $sql->bindValue(':ultimoKmAlt', $ultimoKmAlt);
     $sql->bindValue(':kmAlt', $kmAlt);
     $sql->bindValue(':diferencaKmAlt', $diferencaKmAlt);
     $sql->bindValue(':ultimoHrAlt', $ultimoHrAlt);
     $sql->bindValue(':hrAlt', $hrAlt);
     $sql->bindValue(':diferencaHrAlt', $diferencaHrAlt);
     $sql->bindValue(':frentistaAlt', $frentistaAlt);
     $sql->bindValue(':odometroFinalAlt', $odometroFinalAlt);
     $sql->bindValue(':litrosAlt', $litrosAlt);
     $sql->bindValue(':litrosOdAlt', $litrosOdAlt);
     $sql->bindValue(':mediaAlt', $mediaAlt);
     $sql->bindValue(':data_alteracao', date('Y-m-d H:i'));
     $sql->execute();
     
 }

 function deleteAbastecimento($idAbastecimentoAlt){

    include '../controller/config.php';

    $sql = $pdo->prepare("DELETE FROM abastecimentos WHERE id_abastecimento = :idAbastecimentoAlt");
    $sql->bindValue(':idAbastecimentoAlt', $idAbastecimentoAlt);
    $sql->execute();
    
}
?>