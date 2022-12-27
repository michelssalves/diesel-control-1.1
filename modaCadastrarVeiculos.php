<div class="modal fade" id="modalCadastrarVeiculo" tabindex="-1" aria-labelledby="incluirChequeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="fundo-cabecalho">
        <h1>ALTERAR VEICULO</h1>
      </div>
      <div class="modal-body">
        <form method="POST">
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Prefixo:</span>
            <input id="prefixo" name="prefixoAlt" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Prefixo Sap:</span>
            <input id="numero_equipamento" name="numero_equipamento" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Placa:</span>
            <input id="placa" name="placa" type="text"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Descricao:</span>
            <input id="descricao_caminhao" name="descricao_caminhao" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Renavam:</span>
            <input  id="renavam" name="renavam" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Chassi:</span>
            <input id="chassi" name="chassi" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Nº Motor:</span>
            <input id="numero_motor" name="numero_motor" type="text"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Ano:</span>
            <input id="ano" name="ano" type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Marca:</span>
              <select id="marca" name="marcaAlt" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required >
                <option value="VOLVO">VOLVO</option>
                <option value="MERCEDEZ">MERCEDEZ</option>
                <option value="VOLKSWAGEN">VOLKSWAGEN</option>
                <option value="FORD">FORD</option>
                <option value="CHEVROLET">CHEVROLET</option>
                <option value="RENAULT">RENAULT</option>
                <option value="IVECO">IVECO</option>
            </select>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Modelo:</span>
            <input id="modelo" name="modeloAlt" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required >
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Combustivel:</span>
            <select id="combustivel" name="combustivelAlt"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  required >
                <option value="DIESEL S10">DIESEL S10</option>
                <option value="GASOLINA">GASOLINA</option>
            </select>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Metodo:</span>
            <select id="metodo" name="metodo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required >
                <option value="1">KM</option>
                <option value="3">HR</option>
                <option value="MM">MM</option>
            </select>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing">Setor:</span>
            <select id="setor" name="setorAlt" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  required >
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
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
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

