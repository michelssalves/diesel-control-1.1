    <div class="container">
        <div class="col-md-auto mt-1">
            <div class="fundo-botoes rounded">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon">
                            </span>
                            <a class="navbar-brand mt-1" href="#"><label>Usuario Logado: <?= $_SESSION['nome']; ?></label></a>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 p-1">
          
                            </ul>
                            <span class="navbar-text">
                               
                            </span>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
  
        <div class="row justify-content-md-center">
     
            <div class="col-md-auto mt-4">  
            <div class="fundo-botoes rounded">
            <form method="POST">  
                <button type="button" class='btn btn-success btn-lg' data-bs-toggle='modal' data-bs-target='#modalCadastrarAbastecimento'>Cadastrar</button>
                <a href="logout-novo" class="btn btn-danger btn-lg">Sair</a>
            </div>
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
