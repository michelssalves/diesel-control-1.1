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
if($acao == 'ultimoKm'){
    
    $id_veiculo =  $_REQUEST['id_veiculo'];

    $informacoesVeiculo = informacoesVeiculo($id_veiculo);

    header('Content-Type: application/json');
    echo json_encode($informacoesVeiculo);
}
$combustivel = $_REQUEST['combustivel'];
$marca = $_REQUEST['marca'];
$modelo = $_REQUEST['modelo'];
$prefixo = $_REQUEST['prefixo'];
$setor = $_REQUEST['setor'];
$dataIncial = $_REQUEST['dataIncial'];
$dataFinal = $_REQUEST['dataFinal'];
if($acao == 'limpar'){

    $dataIncial = date('Y-m-d');
    $dataFinal = date('Y-m-d');
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
    $dataIncial = date('Y-m-d');
    $dataHoraIncial = date('Y-m-d 00:00');}else{
    $horaInicial = '00:00';
    $dataHoraIncial = $dataIncial.' '.$horaInicial;
}
if($dataFinal == ''){ 
    $dataHoraFinal = date('Y-m-d 23:59');
    $dataFinal = date('Y-m-d'); 
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

                $info = array(
                'id_abastecimento' => $row['id_abastecimento'],
                'bomba' => $row['bomba'],
                'data_abastecimento' => dmaHLocal($row['data_abastecimento']),
                'numero_equipamento' =>  $row['numero_equipamento'],
                'odometroinicial' =>  $row['odometroinicial'],
                'odometrofinal' =>  $row['odometrofinal'],
                'litros_od' =>  $row['litros_od'],
                'litros' =>  $row['litros'],
                'media' =>  $row['media'],
                'ultimokm' =>  $row['ultimokm'],
                'km' =>  $row['km'],
                'diferencakm' => $row['diferencakm'],
                'ultimohr' =>  $row['ultimohr'],
                'hr' =>  $row['hr'],
                'diferencahr' =>  $row['diferencahr'],
                'frentista' =>  $row['frentista']
                );

                $info = http_build_query($info);
                $url ='alterar-abastecimento?'.$info;
                $link = "PopupCenter('$url','Upload',400,900)";
                
                $corMedia = '';
                $corLitros = '';
                    if($row['media'] < 1.5){$corMedia = 'bg-danger';}
                    if($row['media'] > 2.5 && $row['descricao_caminhao'] == 'COMPACTADOR'){$corMedia = 'bg-warning';}
                    if($row['media'] > 17.0 ){$corMedia = 'bg-info';}
                    if($row['litros_od'] <> $row['litros'] ){$corLitros = 'bg-warning';}
     
                $txtTableControles .= '<tr>
                <td class="w3-left-align" width="200px;"> '.dmaHis($row['data_abastecimento']).'</td>
                <td hidden class="w3-left-align" width="200px;"> '.H_i($row['data_abastecimento']).'</td>
                <td hidden class="w3-left-align" width="200px;"> '.Month($row['data_abastecimento']).'</td>
                <td hidden class="w3-left-align" width="200px;"> '.Year($row['data_abastecimento']).'</td>
                <td> '.$row['numero_equipamento'].' </td>
                <td onclick="'.$link.'" style="cursor:pointer;"> '.$row['prefixo'].' </td>
                <td> '.$row['placa'].' </td>
                <td> '.$row['combustivel'].' </td>
                <td hidden> '.v2($row['odometroinicial']).' </td>
                <td hidden> '.v2($row['odometrofinal']).' </td>
                <td class="'.$corLitros.' w3-right-align"> '.v3($row['litros_od']).' </td>
                <td class="'.$corLitros.' w3-right-align"> '.v3($row['litros']).' </td>
                <td> '.$row['ultimokm'].' </td>
                <td> '.$row['km'].' </td>
                <td class="w3-right-align"> '.$row['diferencakm'].' </td>
                <td> '.$row['ultimohr'].'</td>
                <td> '.$row['hr'].'</td>
                <td class="w3-right-align"> '.$row['diferencahr'].'</td>
                <td><center> '.$row['frentista'].'</td>
                <td><center> '.$row['marca'].'</td>
                <td><center> '.$row['modelo'].'</td>
                <td class="'.$corMedia.' w3-right-align"><center> '.($row['media']).' </td>
                <td><center> '.$row['setor'].'</td>
                </tr>';
            }
           
        }
          return  $txtTableControles;      
}                 
function informacoesVeiculo($id_veiculo){

    include 'config.php';

    $id_veiculo =  intval($_REQUEST['id_veiculo']);
    
    $sql = $pdo->prepare("SELECT * FROM abastecimentos
	WHERE id_veiculo = :id_veiculo  ORDER BY data_abastecimento DESC LIMIT 1");
	$sql->bindValue(':id_veiculo', $id_veiculo);
	$sql->execute();
	$row = $sql->fetch(PDO::FETCH_ASSOC);
    $ultimoKm = $row['km'];
    if($row['km'] < 0){$ultimoKm = 0;}
    $ultimoHr = $row['hr'];
    if($row['hr'] < 0){$ultimoHr = 0;}
    

    $informacoesVeiculo = [
        'ultimoKm' => $ultimoKm,
        'ultimoHr' => $ultimoHr
    ];

    return $informacoesVeiculo;

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

    if($diferencakm < 0 || $diferencakm > 600){
        $id_erro = 1;
        registrarErro($id_funcionario, $id_erro);
    }
    if($diferencahr < 0 || $diferencahr > 48){
        $id_erro = 2;
        registrarErro($id_funcionario, $id_erro);
    }
    if($litros <> $litros_od){
        $id_erro = 3;
        registrarErro($id_funcionario, $id_erro);
    }

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

        $sql = $pdo->prepare("SELECT a.diferencahr, a.ultimohr, a.id_abastecimento, a.data_abastecimento, v.placa, v.numero_equipamento, v.descricao_caminhao, a.odometroinicial,a.odometrofinal, a.litros_od, a.litros, 
        a.ultimokm,a.km, a.diferencakm, a.hr, a.frentista, v.prefixo, a.media
        FROM veiculos AS v  
        JOIN abastecimentos AS a 
        ON a.id_veiculo = v.id_veiculo
        ORDER BY data_abastecimento DESC LIMIT 30");
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
           
             foreach($lista as $row){

                    $corMedia = '';
                    $corLitros = '';
                        if($row['media'] < 1.5){$corMedia = 'bg-danger';}
                        if($row['media'] > 2.5 && $row['descricao_caminhao'] == 'COMPACTADOR'){$corMedia = 'bg-warning';}
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
                    <td class="w3-right-align"> '.$row['diferencakm'].' </td>
                    <td> '.$row['ultimohr'].'</td>
                    <td> '.$row['hr'].'</td>
                    <td class="w3-right-align"> '.$row['diferencahr'].'</td>
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
function registrarErro($id_funcionario, $id_erro){

    include 'config.php';
    include 'functions.php';

    $erro_data = new DateTime('NOW', new DateTimeZone('America/Sao_Paulo'));
    $erro_data = $erro_data->format('Y-m-d H:i');
    $erro_status = 1;
    
    $sql = $pdo->prepare("INSERT INTO erros_de_registro(id_funcionario, id_erro, erro_status, erro_data) VALUES(:id_funcionario, id_erro, erro_status, erro_data)");
    $sql->bindValue(':id_funcionario', $id_funcionario);
    $sql->bindValue(':erro_km', $id_erro);
    $sql->bindValue(':erro_status', $erro_status);
    $sql->bindValue(':erro_data', $erro_data);
    $sql->execute();

}

?>
