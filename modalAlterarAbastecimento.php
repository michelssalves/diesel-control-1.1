<div class="modal fade" id="<?= $modalAlterarAbastecimento ?>" tabindex="-1" aria-labelledby="incluirChequeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>ALTERAR ABASTECIMENTO</h1>
      </div>
      <div class="modal-body">
        <form method="POST">
        <input type="hidden" action="acao" name="alterar-abastcimento">
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Data:</span>
            <input id="data_abastecimento" name="data_abastecimento" value="<?= ($row['data_abastecimento']);?>" type="datetime-local" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Prefixo Sap:</span>
            <input id="numero_equipamento" value="<?= $row['numero_equipamento']?>" name="numero_equipamento"  type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >   
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Bomba:</span>
            <input id="bomba" value="<?= $row['bomba']?>" name="bomba" type="text"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Od Inicial:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularLitrosOd() id="odometroinicial" value="<?= $row['odometroinicial']?>" name="odometroinicial" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Od Final:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularLitrosOd();" id="odometrofinal" value="<?= $row['odometrofinal']?>" name="odometrofinal" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >  
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Litros Od:</span>
            <input id="litros_od" value="<?= $row['litros_od']?>" name="litros_od" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Litros:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularMedia()"  id="litros" value="<?= $row['litros']?>" name="litros" type="text"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Ultimo KM:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularMedia();" id="ultimokm" value="<?= $row['ultimokm']?>" name="ultimokm" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">KM:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularDiferencaKm(),calcularMedia()" id="km" value="<?= $row['km']?>" name="km" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Dif KM:</span>
            <input readonly id="diferencakm" value="<?= $row['diferencakm']?>" name="diferencakm" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Média:</span>
            <input readonly id="media" value="<?= $row['media']?>" name="media" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Ult HR:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularDiferencaHr()" id="ultimohr" value="<?= $row['ultimohr']?>" name="ultimohr" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">HR:</span>
            <input onkeypress="return soNumeros()" onkeyup="calcularDiferencaHr();" id="hr" value="<?= $row['hr']?>" name="hr"  type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
            <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Dif Hr:</span>
            <input readonly id="diferencahr" value="<?= $row['diferencahr']?>" name="diferencahr"  type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Frentista:</span>
            <input id="frentista" value="<?= $row['frentista']?>" name="frentista" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
      </div>
        <div class="modal-footer">
          <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
            <button type="submit" name="acao" value="cadastrar-veiculo" class="btn btn-outline-primary btn-sm">Cadastrar</button>
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div> 
      </form>
      </div>
    </div>
  </div>

