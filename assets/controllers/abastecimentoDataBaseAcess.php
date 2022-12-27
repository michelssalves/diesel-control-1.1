<?php
session_start();
$acao = $_REQUEST['acao'];

if($acao == 'registrar-abastecimento'){

        registrarAbastecimento();

}
if($acao == 'alterar-abastecimento'){

    alterarAbastecimento();

}
if($acao == 'excluir-abastecimento'){

    excluirAbastecimento();
  
}
if($acao == 'alterar-status-erro'){

    $id_abastecimento = $_POST['id_abastecimento'];
    $idErro = $_POST['idErro'];

    $statusNovo = alterarStatuErro($idErro, $id_abastecimento);

    header('Content-Type: application/json');
    
    echo json_encode($statusNovo);

}

if($acao == 'ultimoKm'){
    
    $id_veiculo =  $_REQUEST['id'];

   // $informacoesVeiculo = informacoesVeiculo($id_veiculo);

    $return = ['error' => false,  'dados' => informacoesVeiculo($id_veiculo)];
  
    echo json_encode($return);

 //   header('Content-Type: application/json');
   // echo json_encode($informacoesVeiculo);
}
$combustivel = $_REQUEST['combustivel'];
$marca = $_REQUEST['marca'];
$modelo = $_REQUEST['modelo'];
$prefixo = $_REQUEST['prefixo'];
$setor = $_REQUEST['setor'];
$dataIncial = $_REQUEST['dataIncial'];
$dataFinal = $_REQUEST['dataFinal'];
if($acao == 'limpar'){

    $x = new DateTime('NOW', new DateTimeZone('America/Sao_Paulo'));
    $$dataIncial = $x->format('Y-m-d 00:00');
    $x = new DateTime('NOW', new DateTimeZone('America/Sao_Paulo'));
    $dataFinal = $x->format('Y-m-d 23:59');
    $prefixo = '';
    $combustivel = '';
    $marca = '';
    $modelo = '';
    $setor = '';

}
if($prefixo && $prefixo <> 'TODOS'){$filtroPrefixo = "AND v.prefixo = '$prefixo'";};
if($combustivel && $combustivel <> 'TODOS' ){$filtroCombustivel = "AND v.combustivel = '$combustivel'";}
if($marca && $marca <> 'TODOS'){$filtroMarca = "AND v.marca = '$marca'";}
if($modelo && $modelo <> 'TODOS'){$filtroModelo = "AND v.modelo = '$modelo'";}
if($setor && $setor <> 'TODOS'){$filtroSetor = "AND v.setor = '$setor'";}
if($dataIncial  == ''){

    $x = new DateTime('NOW', new DateTimeZone('America/Sao_Paulo'));
    $dataHoraIncial = $x->format('Y-m-d 00:00');

}else{
    $horaInicial = '00:00';
    $dataHoraIncial = $dataIncial.' '.$horaInicial;
}
if($dataFinal == ''){ 

    $x = new DateTime('NOW', new DateTimeZone('America/Sao_Paulo'));
    $dataHoraFinal = $x->format('Y-m-d 23:59');

}else{
    $horaFinal = '23:59';
    $dataHoraFinal = $dataFinal.' '.$horaFinal;
}

function filtrarAbastecimentos($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo, $filtroSetor, $dataHoraIncial, $dataHoraFinal){
    
    include 'config.php';
    include 'functions.php';

        $sql = $pdo->prepare("SELECT *
        FROM veiculos AS v  
        JOIN abastecimentos AS a 
        ON a.id_veiculo = v.id_veiculo
        WHERE a.data_abastecimento BETWEEN '$dataHoraIncial' AND '$dataHoraFinal'
        $filtroPrefixo $filtroCombustivel $filtroMarca $filtroModelo $filtroSetor
        ORDER BY a.data_abastecimento ASC ");

        $sql->execute();

        if ($sql->rowCount() > 0) {

            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($lista as $row){

                $modalAlterarAbastecimento = "modalAlterarAbastecimento".$row['id_abastecimento']."";

                $linkModalAlterarAbastecimento = "data-bs-toggle='modal' data-bs-target='#$modalAlterarAbastecimento' style='cursor:pointer'";
                
                $corDifKm = '';
                $corDifHr = '';
                $corMedia = '';
                $corLitros = '';
                    
                if($row['combustivel'] <> 'GASOLINA'){

                    if($row['setor'] == 'Coleta Domiciliar'){
                        if($row['diferencakm'] > 400 || $row['diferencakm'] < 0){$corDifKm = 'bg-danger';}
                        if($row['diferencahr'] > 24 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
                    }elseif($row['setor'] == 'Privado'){
                        if($row['diferencakm'] > 2000 || $row['diferencakm']  < 0){$corDifKm = 'bg-danger';}
                        if($row['diferencahr'] > 60 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
                    }else{
                        if($row['diferencakm'] > 1000 || $row['diferencakm']  < 0){$corDifKm = 'bg-danger';}
                        if($row['diferencahr'] > 50 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
                    }    
                }
           
                    if($row['media'] > 2.5 && $row['descricao_caminhao'] == 'COMPACTADOR'){$corMedia = 'bg-warning';}
                    if($row['media'] < 1.5){$corMedia = 'bg-danger';}
                    if($row['media'] > 17.0 ){$corMedia = 'bg-info';}

                    if($row['litros_od'] <> $row['litros'] ){$corLitros = 'bg-warning';}
     
                $txtTableControles .= '<tr '.$linkModalAlterarAbastecimento.'>
                <td class="w3-left-align">'.dmaH($row['data_abastecimento']).'</td>
                <td hidden class="w3-left-align"> '.H_i($row['data_abastecimento']).'</td>
                <td hidden class="w3-left-align"> '.Month($row['data_abastecimento']).'</td>
                <td hidden class="w3-left-align"> '.Year($row['data_abastecimento']).'</td>
                <td> '.$row['numero_equipamento'].' </td>
                <td> '.$row['prefixo'].' </td>
                <td> '.$row['placa'].' </td>
                <td> '.$row['combustivel'].' </td>
                <td hidden> '.$row['bomba'].' </td>
                <td hidden> '.v2($row['odometroinicial']).' </td>
                <td hidden> '.v2($row['odometrofinal']).' </td>
                <td class="'.$corLitros.' w3-right-align"> '.v2($row['litros_od']).' </td>
                <td class="'.$corLitros.' w3-right-align"> '.v2($row['litros']).' </td>
                <td> '.$row['ultimokm'].' </td>
                <td> '.$row['km'].' </td>
                <td class="'.$corDifKm.' class="w3-right-align"> '.$row['diferencakm'].' </td>
                <td> '.$row['ultimohr'].'</td>
                <td> '.$row['hr'].'</td>
                <td class="'.$corDifHr.' class="w3-right-align"> '.$row['diferencahr'].'</td>
                <td><center> '.$row['frentista'].'</td>
                <td><center> '.$row['marca'].'</td>
                <td><center> '.$row['modelo'].'</td>
                <td class="'.$corMedia.' w3-right-align"><center> '.($row['media']).' </td>
                <td hidden><center> '.$row['setor'].'</td>
                </tr>';

                include 'modalAlterarAbastecimento.php';
            }
           
        }
          return  $txtTableControles;      
}                 

function registrarAbastecimento(){

    include 'config.php';
    include 'functions.php';
    
    $id_veiculo = $_POST['prefixo'];
    $bomba = $_POST['bomba'];
    $odometroinicial = $_POST['odometroinicial']; 
    $ultimokm = $_POST['ultimokm']; 
    $km = $_POST['km']; 
    $diferencakm = $_POST['diferencakm'];
    $ultimohr = $_POST['ultimohr']; 
    $hr = $_POST['hr']; 
    $diferencahr = $_POST['diferencahr'];
    $id_funcionario = $_POST['id_funcionario']; 
    $frentista = $_POST['frentista'];
    $odometrofinal = $_POST['odometrofinal']; 
    $litros = $_POST['litros']; 
    $litros_od = $_POST['litros_od'];
    $media = $_POST['media'];
    $data_abastecimento = dmaHLocal($_POST['data_abastecimento']);
    $data_sem_hora = Ymd($data_abastecimento);


    if($data_abastecimento == ''){
         
        $data_abastecimento = new DateTime('NOW', new DateTimeZone('America/Sao_Paulo'));
        $data_abastecimento = $data_abastecimento->format('Y-m-d H:i');
        $data_sem_hora = new DateTime('NOW', new DateTimeZone('America/Sao_Paulo'));
        $data_sem_hora = $data_sem_hora->format('Y-m-d');

        $sql = $pdo->prepare("INSERT INTO abastecimentos (id_veiculo, bomba, odometroinicial, ultimokm,	
        km, diferencakm, ultimohr, hr, diferencahr, frentista,	odometrofinal, litros, litros_od, media, data_abastecimento, dataabastecimento2) 
        VALUES (:id_veiculo, :bomba, :odometroinicial,:ultimokm,:km, :diferencakm, :ultimohr, :hr, :diferencahr,
        :frentista, :odometrofinal, :litros, :litros_od, :media, :data_abastecimento, :data_sem_hora)");

        $sql->bindValue(':data_abastecimento', $data_abastecimento);
        $sql->bindValue(':data_sem_hora', $data_sem_hora);

    }else{

        $sql = $pdo->prepare("INSERT INTO abastecimentos (id_veiculo, bomba, odometroinicial, ultimokm,	
        km, diferencakm, ultimohr, hr, diferencahr, frentista,	odometrofinal, litros, litros_od, media, data_abastecimento, dataabastecimento2) 
        VALUES (:id_veiculo, :bomba, :odometroinicial,:ultimokm,:km, :diferencakm, :ultimohr, :hr, :diferencahr,
        :frentista, :odometrofinal, :litros, :litros_od, :media, :data_abastecimento)");

        $sql->bindValue(':data_abastecimento', $data_abastecimento);
        $sql->bindValue(':data_sem_hora', $data_sem_hora);
    }
 
    $sql->bindValue(':id_veiculo', $id_veiculo);
    $sql->bindValue(':bomba', $bomba);
    $sql->bindValue(':odometroinicial', $odometroinicial);
    $sql->bindValue(':ultimokm', $ultimokm);
    $sql->bindValue(':km', $km);
    $sql->bindValue(':diferencakm', $diferencakm);
    $sql->bindValue(':ultimohr', $ultimohr);
    $sql->bindValue(':hr', $hr);
    $sql->bindValue(':diferencahr', $diferencahr);
    $sql->bindValue(':frentista', $frentista);
    $sql->bindValue(':odometrofinal', $odometrofinal);
    $sql->bindValue(':litros', $litros);
    $sql->bindValue(':litros_od', $litros_od);
    $sql->bindValue(':media', $media);
    $sql->execute();
    $id_abastecimento = $pdo->lastInsertId();

    $lista = consultarEquipamento($id_veiculo);
    foreach($lista as $row){
        $setor = $row['setor'];
        $combustivel = $row['combustivel'];
    }
    if($combustivel <> 'GASOLINA'){

        if($setor == 'Coleta Domiciliar'){

            if($diferencakm < 0 || $diferencakm > 600 ){
                $id_erro = 1;
                registrarErro($id_funcionario, $id_erro, $id_abastecimento);
                $x= 1;
            }
            if($diferencahr < 0 || $diferencahr > 48){
                $id_erro = 2;
                registrarErro($id_funcionario, $id_erro, $id_abastecimento);
                $x= 1;
            }
        }
        elseif($setor == 'Privado'){
            
            if($diferencakm < 0 || $diferencakm > 2000 ){
                $id_erro = 1;
                registrarErro($id_funcionario, $id_erro, $id_abastecimento);
                $x= 1;
            }
            if($diferencahr < 0 || $diferencahr > 100){
                $id_erro = 2;
                registrarErro($id_funcionario, $id_erro, $id_abastecimento);
                $x= 1;
            }
        }else{

            if($diferencakm < 0 || $diferencakm > 1000){
                $id_erro = 1;
                registrarErro($id_funcionario, $id_erro, $id_abastecimento);
                $x= 1;
        }
            if($diferencahr < 0 || $diferencahr > 50){
                $id_erro = 2;
                registrarErro($id_funcionario, $id_erro, $id_abastecimento);
                $x= 1;
            }

        }
    }    
        if($litros <> $litros_od){
            $id_erro = 3;
            registrarErro($id_funcionario, $id_erro, $id_abastecimento);
            $x= 1;
        }
   
        if($x == 0){
            $id_erro = 4;
            registrarAcerto($id_funcionario, $id_erro, $id_abastecimento);
        }

    $_SESSION['msg'] = '<div class="w3-green">CADASTRADO COM SUCESSO!</div>';
    header("Location: abastecer-veiculos");   
} 
function alterarAbastecimento(){

    include 'config.php';

    $id_abastecimento = $_POST['id_abastecimento'];
    $numero_equipamento = $_POST['numero_equipamento'];
    $bomba = $_POST['bomba'];
    $odometroinicial = $_POST['odometroinicial']; 
    $ultimokm = $_POST['ultimokm']; 
    $km = $_POST['km']; 
    $diferencakm = $_POST['diferencakm'];
    $ultimohr = $_POST['ultimohr']; 
    $hr = $_POST['hr']; 
    $diferencahr = $_POST['diferencahr']; 
    $frentista = $_POST['frentista'];
    $odometrofinal = $_POST['odometrofinal']; 
    $litros = $_POST['litros']; 
    $litros_od = $_POST['litros_od'];
    $media = $_POST['media'];

    $id_veiculo = consultarIdEquipamento($numero_equipamento);
    
    $sql = $pdo->prepare("UPDATE abastecimentos SET id_veiculo = :id_veiculo, bomba = :bomba, odometroinicial = :odometroinicial, 
    ultimokm = :ultimokm, km = :km, diferencakm = :diferencakm, ultimohr = :ultimohr, hr = :hr, diferencahr = :diferencahr, 
    frentista = :frentista,	odometrofinal = :odometrofinal, litros = :litros, litros_od = :litros_od, media = :media 
    WHERE id_abastecimento = :id_abastecimento");
    
    $sql->bindValue(':id_abastecimento', $id_abastecimento);
    $sql->bindValue(':id_veiculo', $id_veiculo);
    $sql->bindValue(':bomba', $bomba);
    $sql->bindValue(':odometroinicial', $odometroinicial);
    $sql->bindValue(':ultimokm', $ultimokm);
    $sql->bindValue(':km', $km);
    $sql->bindValue(':diferencakm', $diferencakm);
    $sql->bindValue(':ultimohr', $ultimohr);
    $sql->bindValue(':hr', $hr);
    $sql->bindValue(':diferencahr', $diferencahr);
    $sql->bindValue(':frentista', $frentista);
    $sql->bindValue(':odometrofinal', $odometrofinal);
    $sql->bindValue(':litros', $litros);
    $sql->bindValue(':litros_od', $litros_od);
    $sql->bindValue(':media', $media);
    $sql->execute();

    header("Location: abastecida-alterada");
}   
function excluirAbastecimento(){

    include 'config.php';

    $id_abastecimento = $_POST['id_abastecimento'];
    
    $sql = $pdo->prepare("DELETE FROM abastecimentos WHERE id_abastecimento = :id_abastecimento");
    
    $sql->bindValue(':id_abastecimento', $id_abastecimento);

    $sql->execute();

    header("Location: abastecida-excluida");

}
function listarAbastecimentos(){

    include 'config.php';
    include 'functions.php';

        $sql = $pdo->prepare("SELECT *
        FROM veiculos AS v  
        JOIN abastecimentos AS a 
        ON a.id_veiculo = v.id_veiculo
        ORDER BY data_abastecimento DESC LIMIT 30 ");
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
           
             foreach($lista as $row){

                    $corDifKm = '';
                    $corDifHr = '';
                    $corMedia = '';
                    $corLitros = '';
                        
                    if($row['combustivel'] <> 'GASOLINA'){

                        if($row['setor'] == 'Coleta Domiciliar'){
                            if($row['diferencakm'] > 400 || $row['diferencakm'] < 0){$corDifKm = 'bg-danger';}
                            if($row['diferencahr'] > 24 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
                        }elseif($row['setor'] == 'Privado'){
                            if($row['diferencakm'] > 2000 || $row['diferencakm']  < 0){$corDifKm = 'bg-danger';}
                            if($row['diferencahr'] > 60 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
                        }else{
                            if($row['diferencakm'] > 1000 || $row['diferencakm']  < 0){$corDifKm = 'bg-danger';}
                            if($row['diferencahr'] > 50 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
                        }    
                    }
               
                        if($row['media'] > 2.5 && $row['descricao_caminhao'] == 'COMPACTADOR'){$corMedia = 'bg-warning';}
                        if($row['media'] < 1.5){$corMedia = 'bg-danger';}
                        if($row['media'] > 17.0 ){$corMedia = 'bg-info';}

                        if($row['litros_od'] <> $row['litros'] ){$corLitros = 'bg-warning';}
    
                    $txtTable = $txtTable.'<tr>
                    <td class="w3-left-align" > '.dmaH($row['data_abastecimento']).'</td>
                    <td> '.$row['numero_equipamento'].' </td>
                    <td> '.$row['placa'].' </td>
                    <td> '.$row['prefixo'].' </td>
                    <td class="w3-right-align"> '.v2($row['odometroinicial']).' </td>
                    <td class="w3-right-align" > '.v2($row['odometrofinal']).' </td>
                    <td class="'.$corLitros.' w3-right-align"> '.v2($row['litros_od']).' </td>
                    <td class="'.$corLitros.' w3-right-align"> '.v2($row['litros']).' </td>
                    <td class="'.$corMedia.' w3-right-align"> '.v2($row['media']).' </td>
                    <td> '.$row['ultimokm'].' </td>
                    <td> '.$row['km'].' </td>
                    <td class="'.$corDifKm.' class="w3-right-align"> '.$row['diferencakm'].' </td>
                    <td> '.$row['ultimohr'].'</td>
                    <td> '.$row['hr'].'</td>
                    <td class="'.$corDifHr.' class="w3-right-align"> '.$row['diferencahr'].'</td>
                    <td> '.$row['frentista'].'</td>
                    </tr>';
                      
                }
            }       
                  
           return $txtTable;            
}
function consultarIdEquipamento($numero_equipamento){

    include 'config.php';
    include 'functions.php';
    
    $sql = $pdo->prepare("SELECT id_veiculo FROM veiculos WHERE numero_equipamento = :numero_equipamento");
    $sql->bindValue(':numero_equipamento', $numero_equipamento);
    $sql->execute();
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach($lista as $row){
        $id_veiculo = $row['id_veiculo'];
    }
    return  $id_veiculo;
 
}
function consultarEquipamento($id_veiculo){
    include 'config.php';
   
    $sql = $pdo->prepare("SELECT * FROM veiculos WHERE id_veiculo = :id_veiculo");
    $sql->bindValue(':id_veiculo', $id_veiculo);
    $sql->execute();
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
    return  $lista;
 
}
function registrarErro($id_funcionario, $id_erro, $id_abastecimento){

    include 'config.php';

    $x = new DateTime('NOW', new DateTimeZone('America/Sao_Paulo'));
    $erro_data = $x->format('Y-m-d H:i');
    $erro_status = 1;
    
    $sql = $pdo->prepare("INSERT INTO erros_de_registro(id_funcionario, id_erro, erro_status, erro_data, id_abastecimento) VALUES(:id_funcionario, :id_erro, :erro_status, :erro_data, :id_abastecimento)");
    $sql->bindValue(':id_funcionario', $id_funcionario);
    $sql->bindValue(':id_erro', $id_erro);
    $sql->bindValue(':erro_status', $erro_status);
    $sql->bindValue(':erro_data', $erro_data);
    $sql->bindValue(':id_abastecimento', $id_abastecimento);
    $sql->execute();

}
function registrarAcerto($id_funcionario, $id_erro, $id_abastecimento){

    include 'config.php';

    $x = new DateTime('NOW', new DateTimeZone('America/Sao_Paulo'));
    $erro_data = $x->format('Y-m-d H:i');
    $erro_status = 0;
    
    $sql = $pdo->prepare("INSERT INTO erros_de_registro(id_funcionario, id_erro, erro_status, erro_data, id_abastecimento) VALUES(:id_funcionario, :id_erro, :erro_status, :erro_data, :id_abastecimento)");
    $sql->bindValue(':id_funcionario', $id_funcionario);
    $sql->bindValue(':id_erro', $id_erro);
    $sql->bindValue(':erro_status', $erro_status);
    $sql->bindValue(':erro_data', $erro_data);
    $sql->bindValue(':id_abastecimento', $id_abastecimento);
    $sql->execute();

}
function listarAcertos($id_funcionario){
    include 'config.php';

    $sql = $pdo->prepare("SELECT a.acertos, b.erros, c.qtde_abastecimentos, d.mes_atual FROM 
    (SELECT COUNT(DISTINCT(id_abastecimento)) AS erros FROM erros_de_registro WHERE id_funcionario = :id_funcionario AND id_erro <> 4) AS b, 
    (SELECT COUNT(DISTINCT(id_abastecimento)) AS acertos FROM erros_de_registro WHERE id_funcionario = :id_funcionario AND id_erro = 4) AS a, 
    (SELECT COUNT(DISTINCT(id_abastecimento)) AS qtde_abastecimentos FROM erros_de_registro WHERE id_funcionario = :id_funcionario) AS c,
    (SELECT DISTINCT(MONTH(NOW())) AS mes_atual FROM erros_de_registro) AS d
        WHERE d.mes_atual = d.mes_atual");
    $sql->bindValue(':id_funcionario', $id_funcionario);
    $sql->execute();
    if($sql->rowCount() > 0){
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
   
    foreach($lista as $row){

        $v1 = $row['acertos'] * 100; 
        $v2 = $v1/$row['qtde_abastecimentos'];
        $txtTable = $txtTable.'<tr>
        <td style="color:green"><center>'.$row['acertos'].'</td>
        <td><center><a style="text-decoration:none; cursor:pointer; color:red" href="visualizador-de-erros">'.$row['erros'].'</a></td>
        <td><center>'.number_format($v2,'2',',','.').'%</td>
        </tr>';
    
        }
    }else{
    $txtTable = $txtTable.'<tr>
    <td><center>0</td>
    <td><center><a style="text-decoration:none; cursor:pointer" href="visualizador-de-erros">0</a></td>
    <td><center>0%</td>
    </tr>';
    }
    return $txtTable;
}
function listarErros($id_funcionario){

    include 'config.php';
    include 'functions.php';

    $sql = $pdo->prepare("SELECT * FROM erros_de_registro AS ER 
    JOIN abastecimentos AS AB ON AB.id_abastecimento = ER.id_abastecimento 
    JOIN veiculos AS V ON V.id_veiculo = AB.id_veiculo 
    WHERE id_funcionario = :id_funcionario AND id_erro <> 4 AND erro_status = 1");
    $sql->bindValue(':id_funcionario', $id_funcionario);
    $sql->execute();
    if($sql->rowCount() > 0){
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
   
    foreach($lista as $row){

        $corDifKm = '';
        $corDifHr = '';
        $corLitros = '';
            
        if($row['combustivel'] <> 'GASOLINA'){

            if($row['setor'] == 'Coleta Domiciliar'){
                if($row['diferencakm'] > 400 || $row['diferencakm'] < 0){$corDifKm = 'bg-danger';}
                if($row['diferencahr'] > 24 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
            }elseif($row['setor'] == 'Privado'){
                if($row['diferencakm'] > 2000 || $row['diferencakm']  < 0){$corDifKm = 'bg-danger';}
                if($row['diferencahr'] > 60 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
            }else{
                if($row['diferencakm'] > 1000 || $row['diferencakm']  < 0){$corDifKm = 'bg-danger';}
                if($row['diferencahr'] > 50 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
            }    
        }
   
            if($row['litros_od'] <> $row['litros'] ){$corLitros = 'bg-warning';}

        $txtTable = $txtTable.'<tr>
        <td style="width:150px"><center>'.$row['erro_data'].'</td>
        <td><center>'.$row['prefixo'].'</td>
        <td><center>'.l7($row['setor']).'</td>
        <td><center>'.$row['bomba'].'</td>
        <td><center>'.$row['odometroinicial'].'</td>
        <td><center>'.$row['odometrofinal'].'</td>
        <td class="'.$corLitros.'"><center>'.$row['litros_od'].'</td>
        <td class="'.$corLitros.'"><center>'.$row['litros'].'</td>
        <td><center>'.$row['ultimokm'].'</td>
        <td><center>'.$row['km'].'</td>
        <td class="'.$corDifKm.'"><center>'.$row['diferencakm'].'</td>
        <td><center>'.$row['ultimohr'].'</td>
        <td><center>'.$row['hr'].'</td>
        <td class="'.$corDifHr.'"><center>'.$row['diferencahr'].'</td>
        <td><center>'.$row['frentista'].'</td>
        <td><center>'.$row['media'].'</td>
        </tr>';
    }    
    return $txtTable;
}
}
function listarTodosErros($dataHoraIncial, $dataHoraFinal){

    include 'config.php';
    include 'functions.php';

    $sql = $pdo->prepare("SELECT * FROM erros_de_registro AS ER 
    JOIN abastecimentos AS AB ON AB.id_abastecimento = ER.id_abastecimento 
    JOIN veiculos AS V ON V.id_veiculo = AB.id_veiculo 
    WHERE id_erro <> 4 AND erro_data BETWEEN '$dataHoraIncial' AND '$dataHoraFinal'
    GROUP BY AB.id_abastecimento");

    $sql->execute();
    if($sql->rowCount() > 0){
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
   
    foreach($lista as $row){

        $corDifKm = '';
        $corDifHr = '';
        $corLitros = '';
            
        if($row['combustivel'] <> 'GASOLINA'){

            if($row['setor'] == 'Coleta Domiciliar'){
                if($row['diferencakm'] > 400 || $row['diferencakm'] < 0){$corDifKm = 'bg-danger';}
                if($row['diferencahr'] > 24 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
            }elseif($row['setor'] == 'Privado'){
                if($row['diferencakm'] > 2000 || $row['diferencakm']  < 0){$corDifKm = 'bg-danger';}
                if($row['diferencahr'] > 60 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
            }else{
                if($row['diferencakm'] > 1000 || $row['diferencakm']  < 0){$corDifKm = 'bg-danger';}
                if($row['diferencahr'] > 50 || $row['diferencahr'] < 0){$corDifHr = 'bg-danger';}
            }    
        }
   
            if($row['litros_od'] <> $row['litros'] ){$corLitros = 'bg-warning';}

            if($row['erro_status'] > 0){
                $anularErro = '<th id="td'.$row['id_abastecimento'].'" onclick="alterarStatusErro('.$row['id'].','.$row['id_abastecimento'].')" class="w3-red" style="cursor:pointer; text-align:center;"><center>NÃO</th>';
            }else{
                $anularErro = '<th id="td'.$row['id_abastecimento'].'" onclick="alterarStatusErro('.$row['id'].','.$row['id_abastecimento'].' )" class="w3-green" style="cursor:pointer; text-align:center;"><center>SIM</th>';
            }

        $txtTable = $txtTable.'<tr>
        <td style="width:250px"><center>'.$row['erro_data'].'</td>
        <td><center>'.$row['prefixo'].'</td>
        <td><center>'.l7($row['setor']).'</td>
        <td><center>'.$row['bomba'].'</td>
        <td><center>'.$row['odometroinicial'].'</td>
        <td><center>'.$row['odometrofinal'].'</td>
        <td class="'.$corLitros.'"><center>'.v2($row['litros_od']).'</td>
        <td class="'.$corLitros.'"><center>'.v2($row['litros']).'</td>
        <td><center>'.$row['ultimokm'].'</td>
        <td><center>'.$row['km'].'</td>
        <td class="'.$corDifKm.'"><center>'.$row['diferencakm'].'</td>
        <td><center>'.$row['ultimohr'].'</td>
        <td><center>'.$row['hr'].'</td>
        <td class="'.$corDifHr.'"><center>'.$row['diferencahr'].'</td>
        <td><center>'.$row['frentista'].'</td>
        <td><center>'.$row['media'].'</td>
        '.$anularErro.'
        
        </tr>';
    }    
    return $txtTable;
    }
}
function  alterarStatuErro($idErro, $id_abastecimento){

    include 'config.php';

    $sql = $pdo->prepare("SELECT erro_status FROM erros_de_registro WHERE id = :idErro");
    $sql->bindValue(':idErro', $idErro);
    $sql->execute();
    $lista = $sql->fetch(PDO::FETCH_ASSOC);

    $erro_status = $lista['erro_status'];

    if($erro_status <= 0){
        $sql = $pdo->prepare("UPDATE erros_de_registro SET erro_status = 1 WHERE id_abastecimento = :id_abastecimento");
        $sql->bindValue('id_abastecimento',$id_abastecimento);
        $sql->execute();
    }elseif($erro_status > 0){
        $sql = $pdo->prepare("UPDATE erros_de_registro SET erro_status = 0 WHERE id_abastecimento = :id_abastecimento");
        $sql->bindValue('id_abastecimento',$id_abastecimento);
        $sql->execute();
    }

    $sql = $pdo->prepare("SELECT erro_status FROM erros_de_registro WHERE id = :idErro");
    $sql->bindValue(':idErro', $idErro);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);

    $erro_status = $row['erro_status'];

    $statusNovo = [
        'erro_status' => $erro_status,
    ];

    return $statusNovo;

}
function informacoesVeiculo($id_veiculo){

    include 'config.php';
    
    $sql = $pdo->prepare("SELECT * FROM abastecimentos 
	WHERE id_veiculo = :id_veiculo  
    ORDER BY data_abastecimento DESC LIMIT 1
    ");
	$sql->bindValue(':id_veiculo', $id_veiculo);
	$sql->execute();
	$row = $sql->fetch(PDO::FETCH_ASSOC);
    $setor = $row['setor'];
    $ultimoKm = $row['km'];
    if($row['km'] < 0){$ultimoKm = 0;}
    $ultimoHr = $row['hr'];
    if($row['hr'] < 0){$ultimoHr = 0;}
    
    $sql = $pdo->prepare("SELECT * FROM veiculos WHERE id_veiculo = :id_veiculo");
	$sql->bindValue(':id_veiculo', $id_veiculo);
	$sql->execute();
	$row = $sql->fetch(PDO::FETCH_ASSOC);
    $setor = $row['setor'];

    $informacoesVeiculo = [
        'setor' => $setor,
        'ultimoKm' => $ultimoKm,
        'ultimoHr' => $ultimoHr
    ];

    return $informacoesVeiculo;

}
?>
