<?php

function selectAbastecimentosTodosVeiculos(){
    include 'config.php';

    $sql = $pdo->prepare("SELECT *FROM veiculos AS v  
    JOIN abastecimentos AS a 
    ON a.id_veiculo = v.id_veiculo
    ORDER BY data_abastecimento DESC LIMIT 30 ");
    $sql->execute();

    return $sql;
}
function selectAbastecimentosPorVeiculo($id_veiculo){
    include 'config.php';
    
    $sql = $pdo->prepare("SELECT * FROM abastecimentos 
	WHERE id_veiculo = :id_veiculo  
    ORDER BY data_abastecimento DESC LIMIT 1");
	$sql->bindValue(':id_veiculo', $id_veiculo);
	$sql->execute();

    return $sql;
}
function selectAbastecimentosFiltrar($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo, $filtroSetor, $dataHoraIncial, $dataHoraFinal){
    
    include 'config.php';

    $sql = $pdo->prepare("SELECT *FROM veiculos AS v  
    JOIN abastecimentos AS a 
    ON a.id_veiculo = v.id_veiculo
    WHERE a.data_abastecimento BETWEEN '$dataHoraIncial' AND '$dataHoraFinal'
    $filtroPrefixo $filtroCombustivel $filtroMarca $filtroModelo $filtroSetor
    ORDER BY a.data_abastecimento ASC ");
    $sql->execute();

    return $sql;
}
function insertAbastecimentoNovo( $id_veiculoRegistrar, $bombaRegistrar ,$odometroinicialRegistrar ,$ultimokmRegistrar ,$kmRegistrar ,
$diferencakmRegistrar ,$ultimohrRegistrar ,$hrRegistrar ,$diferencahrRegistrar ,$frentistaRegistrar ,$odometrofinalRegistrar ,
$litrosRegistrar, $litros_odRegistrar, $mediaRegistrar){

    include 'config.php';

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

function updateAbastecimentoAlterar($id_abastecimentoAlterar, $id_veiculoAlterar, $bombaAlterar, $odometroinicialAlterar, $odometrofinalAlterar, 
$litros_odAlterar, $litrosAlterar, $ultimokmAlterar, $kmAlterar, $diferencakmAlterar, $mediaAlterar, $ultimohrAlterar, $hrAlterar, 
$diferencahrAlterar, $frentistaAlterar){

    include 'config.php';

     $sql = $pdo->prepare("UPDATE abastecimentos SET id_veiculo = :id_veiculo, bomba = :bomba, odometroinicial = :odometroinicial, 
     ultimokm = :ultimokm, km = :km, diferencakm = :diferencakm, ultimohr = :ultimohr, hr = :hr, diferencahr = :diferencahr, 
     frentista = :frentista,	odometrofinal = :odometrofinal, litros = :litros, litros_od = :litros_od, media = :media, data_alteracao = :data_alteracao 
     WHERE id_abastecimento = :id_abastecimento");
     
     $sql->bindValue(':id_abastecimento', $id_abastecimentoAlterar);
     $sql->bindValue(':id_veiculo', $id_veiculoAlterar);
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
     $sql->bindValue(':data_alteracao', date('Y-m-d H:i'));
     $sql->execute();
 }

 function deleteAbastecimento($id_abastecimentoAlterar){

    include 'config.php';

    $sql = $pdo->prepare("DELETE FROM abastecimentos WHERE id_abastecimento = :id_abastecimentoAlterar");
    $sql->bindValue(':id_abastecimentoAlterar', $id_abastecimentoAlterar);
    $sql->execute();
    
}
?>