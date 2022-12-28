<div class="modal fade" id="<?= $modalAlterarAbastecimento ?>" tabindex="-1" aria-labelledby="alterarAbastecimentoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="fundo-cabecalho">
                <h1>ALTERAR ABASTECIMENTO</h1>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" name="idAbastecimentoAlt" value="<?= $row['id_abastecimento'] ?>">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Data:</span>
                        <input id="dataAbastecimentoAlt" name="dataAbastecimentoAlt" value="<?= ($row['dataabastecimento2']); ?>" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3 mt-1">
                        <span class="input-group-text" id="inputGroup-sizing">Prefixo:</span>
                        <select class="form-select" name="idVeiculoAlt" id="prefixo" onchange="buscarInfoVeiculo(this.value)" aria-describedby="inputGroup-sizing" required>
                            <option value="<?= $row['id_veiculo'] ?>"><?= $row['prefixo'] ?></option>
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
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Bomba:</span>
                        <select id="bomba" name="bombaAlt" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="<?= $row['bomba'] ?>"><?= $row['bomba'] ?></option>
                            <option value="BOMBA 01">BOMBA 01</option>
                            <option value="BOMBA 02">BOMBA 02</option>
                            <option value="BOMBA 03">BOMBA 03</option>
                            <option value="GASOLINA">GASOLINA</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Od Inicial:</span>
                        <input name="odometroInicialAlt" id="odometroinicialAlt" onkeypress="return soNumeros()" onkeyup="calcularLitrosOdAlt()"  value="<?= $row['odometroinicial'] ?>" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Od Final:</span>
                        <input name="odometroFinalAlt" id="odometrofinalAlt" onkeypress="return soNumeros()" onkeyup="calcularLitrosOdAlt();"  value="<?= $row['odometrofinal'] ?>" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Litros Od:</span>
                        <input id="litrosOdAlt" value="<?= $row['litros_od'] ?>" name="litrosOdAlt" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Litros:</span>
                        <input name="litrosAlt" id="litrosAlt" onkeypress="return soNumeros()" onkeyup="calcularMediaAlt()"  value="<?= $row['litros'] ?>" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Ultimo KM:</span>
                        <input name="ultimoKmAlt"  id="ultimoKmAlt" onkeypress="return soNumeros()" onkeyup="calcularDiferencaKmAlt(),calcularMediaAlt()" name="ultimoKmAlt"  id="ultimoKmCad" value="<?= $row['ultimokm'] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">KM:</span>
                        <input name="kmAlt" id="kmAlt" onkeypress="return soNumeros()" onkeyup="calcularDiferencaKmAlt(),calcularMediaAlt()"  value="<?= $row['km'] ?>" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Dif KM:</span>
                        <input name="diferencaKmAlt" id="diferencaKmAlt" readonly  value="<?= $row['diferencakm'] ?>"  type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Média:</span>
                        <input readonly id="mediaAlt" value="<?= $row['media'] ?>" name="mediaAlt" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Ult HR:</span>
                        <input name="ultimoHrAlt" id="ultimoHrAlt" onkeypress="return soNumeros()" onkeyup="calcularDiferencaHrAlt()"  value="<?= $row['ultimohr'] ?>"  type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">HR:</span>
                        <input name="hrAlt" id="hrAlt"  onkeypress="return soNumeros()" onkeyup="calcularDiferencaHrAlt();" value="<?= $row['hr'] ?>" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Dif Hr:</span>
                        <input name="diferencaHrAlt" id="diferencaHrAlt" readonly  value="<?= $row['diferencahr'] ?>" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing">Frentista:</span>
                        <select id="frentista" name="frentistaAlt" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            <option value="<?= $row['frentista'] ?>"><?= $row['frentista'] ?></option>
                            <?php
                            $sql = $pdo->prepare("SELECT usuario FROM funcionarios WHERE id_permissao < 3");
                            $sql->execute();
                            $fetchAll = $sql->fetchAll();
                            foreach ($fetchAll as $pessoa) {
                                echo '<option value="' . $pessoa['usuario'] . '">' . $pessoa['usuario'] . '</option>';
                            }
                            ?>
                        </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex gap-2 d-sm-flex mb-2 justify-content-md-center">
                            <button type="submit" name="acao" value="alterar-abastecimento" class="btn btn-outline-primary btn-sm">Alterar</button>
                            <button type="submit" name="acao" value="excluir-abastecimento" class="btn btn-outline-danger btn-sm">Excluir</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>