<div class="modal fade" id="<?= $modalAlterarVeiculo ?>" tabindex="-1" aria-labelledby="incluirChequeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>ALTERAR VEICULO</h1>
      </div>
      <div class="modal-body">
        <form method="POST">
        <input type="hidden" value="<?= $row['id_veiculo']?>" name="idVeiculoAlt" required>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Prefixo:</span>
            <input id="prefixo" value="<?= $row['prefixo']?>" name="prefixoAlt" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Prefixo Sap:</span>
            <input id="numero_equipamento"  value="<?= $row['numero_equipamento']?>" name="numero_equipamento" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Placa:</span>
            <input id="placa" value="<?= $row['placa']?>" name="placa" type="text"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Descricao:</span>
            <input id="descricao_caminhao" value="<?= $row['descricao_caminhao']?>" name="descricao_caminhao" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Renavam:</span>
            <input  id="renavam" value="<?= $row['renavam']?>" name="renavam" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Chassi:</span>
            <input id="chassi" value="<?= $row['chassi']?>" name="chassi" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Nº Motor:</span>
            <input id="numero_motor" value="<?= $row['numero_motor']?>" name="numero_motor" type="text"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Ano:</span>
            <input id="ano" value="<?= $row['ano']?>" name="ano" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Marca:</span>
            <input id="marca" value="<?= $row['marca']?>" name="marcaAlt" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Modelo:</span>
            <input id="modelo" value="<?= $row['modelo']?>" name="modeloAlt" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Combustivel:</span>
            <select id="combustivel" name="combustivelAlt"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  required >
                <option value="<?= $row['combustivel']?>"><?= $row['combustivel']?></option>
                <option value="DIESEL S10">DIESEL S10</option>
                <option value="GASOLINA">GASOLINA</option>
            </select>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Metodo:</span>
            <select id="metodo" name="metodo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required >
                <option value="<?= $row['metodo']?>">
                <?php if($row['metodo'] = 1){
                    echo 'KM';
                }elseif($row['metodo'] = 2){
                    echo 'HR';
                }else{
                    echo 'MM';
                }
                ?></option>
                <option value="1">KM</option>
                <option value="3">HR</option>
                <option value="MM">MM</option>
            </select>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Setor:</span>
            <select id="setor" name="setorAlt" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  required >
                <option value="<?= $row['setor']?>"><?= $row['setor']?></option>
                <option value="Coleta Domiciliar">Coleta Domiciliar</option>
                <option value="Ctrss">Ctrss</option>
                <option value="Limpeza Especial">Limpeza Especial</option>
                <option value="Varricao">Varricão</option>
                <option value="Lqnl">Lqnl</option>
                <option value="Privado">Privado</option>
            </select></div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Status:</span>
            <select id="status_veiculo" name="status_veiculo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required >
                <option value="<?= $row['status_veiculo']?>"><?php ($row['status_veiculo'] = 1 ? 'Ativo' :'Inativo') ?></option>
                <option value="1">Ativo</option>
                <option value="2">Inativo</option>
            </select>
        </div>
      </div>
        <div class="modal-footer">
          <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
            <button type="submit" name="acao" value="alterar-veiculo" class="btn btn-outline-primary btn-sm">Alterar</button>
            <?php if($row['status_veiculo'] == 1){ ?>
            <button type="submit" name="acao" value="desativar-veiculo" class="btn btn-outline-danger btn-sm">Desativar</button>
            <?php }else{ ?>
            <button type="submit" name="acao" value="ativar-veiculo" class="btn btn-outline-success btn-sm">Ativar</button>
            <?php } ?>
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div> 
      </form>
      </div>
    </div>
  </div>

