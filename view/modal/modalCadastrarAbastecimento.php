<div class="modal fade" id="modalCadastrarAbastecimento" tabindex="-1" aria-labelledby="CadastrarAbastecimentoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>CADASTRAR ABASTECIMENTO</h1>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input readonly id="frentista" name="frentistaCad" type="hidden" class="form-control" value="<?= $_SESSION['nome']; ?>" autofocus>
                    <div class="input-group input-group-sm mb-3 mt-1">
                        <span class="input-group-text" id="inputGroup-sizing">Prefixo:</span>
                        <select class="form-select" name="idVeiculoCad" id="prefixo" onchange="buscarInfoVeiculo(this.value)" aria-describedby="inputGroup-sizing" required>
                            <option value="">Escolha o Prefixo</option>
                            <?php
                            $ativado = 1;
                            $sql = $pdo->prepare("SELECT * FROM veiculos  WHERE status_veiculo = :ativado ORDER BY prefixo");
                            $sql->bindValue(':ativado', $ativado);
                            $sql->execute();
                            $fetchAll = $sql->fetchAll();
                            foreach ($fetchAll as $prefixo) {
                                echo '<option value="' . $prefixo['id_veiculo'] . '">' . $prefixo['prefixo'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="field mb-2">
                        <div class="control">
                            <div class="form-check form-check-inline">
                                <input style="height: 50px; width: 50px;" class="form-check-input" type="radio" name="bombaCad" id="bomba" value="GASOLINA" required>
                                <label class="form-check-label mt-3" for="inlineRadio2">GASOLINA</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input style="height: 50px; width: 50px;" class="form-check-input" type="radio" name="bombaCad" id="bomba" value="BOMBA 01" required>
                                <label class="form-check-label mt-3" for="inlineRadio1">B01</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input style="height: 50px; width: 50px;" class="form-check-input" type="radio" name="bombaCad" id="bomba" value="BOMBA 02" required>
                                <label class="form-check-label mt-3" for="inlineRadio2">B02</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input style="height: 50px; width: 50px;" class="form-check-input" type="radio" name="bombaCad" id="bomba" value="BOMBA 03" required>
                                <label class="form-check-label mt-3" for="inlineRadio3">B03</label>
                            </div>
                        </div>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Setor:</span>
                        <input readonly id="setor" name="setorCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Odometro Inicial:</span>
                        <input onkeyup="calcularLitrosOd()" onkeypress="return soNumeros()" name="odometroInicialCad" id="odometroinicial" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Odometro Inicial" autofocus required>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Ultimo Km:</span>
                        <input readonly id="ultimoKmCad" name="ultimoKmCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Km Anterior" autofocus required>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Km:</span>
                        <input onkeyup="calcularDiferencaKm(),calcularMedia()" onkeypress="return soNumeros()" name="kmCad" id="km" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Km" required>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Diferenca Km:</span>
                        <input readonly id="diferencaKmCad" name="diferencaKmCad" type="text" class="form-control" autofocus aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Diferenca Km" autofocus required>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Ultimo Hr:</span>
                        <input readonly id="ultimoHrCad" name="ultimoHrCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Ultimo Horimetro" autofocus required>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Hr:</span>
                        <input onkeyup="calcularDiferencaHr()" onkeypress="return soNumeros()" name="hrCad" id="hr" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Horimetro" autofocus required>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Diferenca Hr:</span>
                        <input readonly id="diferencaHrCad" name="diferencaHrCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Diferenca Horimetro" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Odometro Final:</span>
                        <input onkeyup="calcularLitrosOd()" onkeypress="return soNumeros()" name="odometroFinalCad" id="odometrofinal" type="text" class="form-control" placeholder="Odometro Final" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Litros:</span>
                        <input onkeyup="calcularMedia()" onkeypress="return soNumeros()" id="litros" name="litrosCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Litros" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Litros Odometro:</span>
                        <input readonly name="litrosOdCad" id="litros_od" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Litros Odometro" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Media:</span>
                        <input readonly id="media" name="mediaCad" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Media" autofocus required>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
                    <button type="submit" name="acao" value="registrar-abastecimento" class="btn btn-primary btn-sm">Cadastrar</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>