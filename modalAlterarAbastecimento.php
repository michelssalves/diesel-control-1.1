<div class="modal fade" id="<?= $modalAlterarAbastecimento ?>" tabindex="-1" aria-labelledby="alterarAbastecimentoModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>ALTERAR ABASTECIMENTO</h1>
      </div>
      <div class="modal-body">
        <form method="POST">
        <input type="hidden" name="id_abastecimentoAlterar" value="<?= $row['id_abastecimento'] ?>">
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Data:</span>
            <input id="data_abastecimento" name="data_abastecimento" value="<?= ($row['data_abastecimento']);?>" type="datetime-local" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3 mt-1">
            <span class="input-group-text" id="inputGroup-sizing">Prefixo:</span>
            <select class="form-select" name="id_veiculoAlterar" id="prefixo" onchange="buscarInfoVeiculo(this.value)" aria-describedby="inputGroup-sizing" required>
                <option value="<?= $row['id_veiculo'] ?>"><?= $row['prefixo'] ?></option>
                <?php
                $ativado = 1;
                $sql = $pdo->prepare("SELECT * FROM veiculos  WHERE status_veiculo = :ativado ORDER BY prefixo");
                $sql->bindValue(':ativado', $ativado);
                $sql->execute();
                $fetchAll = $sql->fetchAll();
                foreach ($fetchAll as $prefixo) {
                    echo '<option value="'.$prefixo['id_veiculo'].'">' .$prefixo['prefixo'].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Bomba:</span>
            <select id="bomba" name="bombaAlterar"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  required >
                <option value="<?= $row['bomba']?>"><?= $row['bomba']?></option>
                <option value="BOMBA 01">BOMBA 01</option>
                <option value="BOMBA 02">BOMBA 02</option>
                <option value="BOMBA 03">BOMBA 03</option>
                <option value="GASOLINA">GASOLINA</option>
            </select>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Od Inicial:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularLitrosOd()" id="odometroinicial" value="<?= $row['odometroinicial']?>" name="odometroinicialAlterar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Od Final:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularLitrosOd();" id="odometrofinal" value="<?= $row['odometrofinal']?>" name="odometrofinalAlterar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >  
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Litros Od:</span>
            <input id="litros_od" value="<?= $row['litros_od']?>" name="litros_odAlterar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Litros:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularMedia()"  id="litros" value="<?= $row['litros']?>" name="litrosAlterar" type="text"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Ultimo KM:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularMedia();" id="ultimokm" value="<?= $row['ultimokm']?>" name="ultimokmAlterar" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">KM:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularDiferencaKm(),calcularMedia()" id="km" value="<?= $row['km']?>" name="kmAlterar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Dif KM:</span>
            <input readonly id="diferencakm" value="<?= $row['diferencakm']?>" name="diferencakmAlterar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Média:</span>
            <input readonly id="media" value="<?= $row['media']?>" name="mediaAlterar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Ult HR:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularDiferencaHr()" id="ultimohr" value="<?= $row['ultimohr']?>" name="ultimohrAlterar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">HR:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularDiferencaHr();" id="hr" value="<?= $row['hr']?>" name="hrAlterar"  type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
            <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Dif Hr:</span>
            <input readonly id="diferencahr" value="<?= $row['diferencahr']?>" name="diferencahrAlterar"  type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Frentista:</span>
            <input id="frentista" value="<?= $row['frentista']?>" name="frentistaAlterar" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
      </div>
        <div class="modal-footer">
          <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
            <button type="submit" name="acao" value="alterar-abastecimento" class="btn btn-outline-primary btn-sm">Alterar</button>
              <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div> 
      </form>
      </div>
    </div>
  </div>

