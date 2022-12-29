<div class="w3-bar w3-light-grey">
        <a href="menu-principal-novo" class="w3-bar-item w3-button">Usuario Logado: <?= $_SESSION['nome']?></a>
        <a href="logout-novo" class="w3-bar-item w3-button w3-red w3-right">Sair</a>
    </div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto mt-4">  
            <form method="POST">  
                <button type="button" class='btn btn-success btn-lg' data-bs-toggle='modal' data-bs-target='#modalCadastrarAbastecimento'>Cadastrar</button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <div class="tabelas-customizadas">
                <table id="t1" data-tablesaw-sortable data-tablesaw-sortable-switch class="tablesaw table-sm fs-6 mb-0" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
                    <thead class="fundo-cabecalho">
                        <tr>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Data
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Hora
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Mês
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Ano
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Prefixo Sap
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Prefixo
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Placa
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Combustivel
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Bomba
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Odometro Incial
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Odometro Final
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Litros Od
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Litros
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Ultimo Km
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Km
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Dif Km
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Ultimo Hr
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Hr
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Dif Hr
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Frentista
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Marca
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Modelo
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                                <center>Media
                            </th>
                            <th data-tablesaw-sortable-col data-tablesaw-priority="0">
                                <center>Setor
                            </th>
                        </tr>
                    </thead>