<div class="modal fade" id="modalCadastrarVeiculo" tabindex="-1" aria-labelledby="cadastrarVeiculoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>CADASTRAR VEICULO</h1>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Prefixo:</span>
                        <input id="prefixo" name="prefixoCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Prefixo Sap:</span>
                        <input id="numeroEquipamento" name="numeroEquipamentoCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Placa:</span>
                        <input id="placa" name="placaCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Descricao:</span>
                        <input id="descricaoCaminhao" name="descricaoCaminhaoCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Renavam:</span>
                        <input id="renavam" name="renavamCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Chassi:</span>
                        <input id="chassi" name="chassiCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Nº Motor:</span>
                        <input id="numeroMotor" name="numeroMotorCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Ano:</span>
                        <input id="ano" name="anoCad" type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Marca:</span>
                        <select id="marca" name="marca" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
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
                        <input id="modelo" name="modeloCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Combustivel:</span>
                        <select id="combustivel" name="combustivelCad" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="DIESEL S10">DIESEL S10</option>
                            <option value="GASOLINA">GASOLINA</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Metodo:</span>
                        <select id="metodo" name="metodoCad" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="1">KM</option>
                            <option value="3">HR</option>
                            <option value="MM">MM</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Setor:</span>
                        <select id="setor" name="setorCad" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="Coleta Domiciliar">Coleta Domiciliar</option>
                            <option value="Ctrss">Ctrss</option>
                            <option value="Limpeza Especial">Limpeza Especial</option>
                            <option value="Varricao">Varricão</option>
                            <option value="Lqnl">Lqnl</option>
                            <option value="Privado">Privado</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Status:</span>
                        <select id="statusVeiculo" name="statusVeiculoCad" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
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