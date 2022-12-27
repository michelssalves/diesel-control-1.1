<?php
session_start();

$acao = $_REQUEST['acao'];

$combustivel = $_REQUEST['combustivel'];
$marca = $_REQUEST['marca'];
$modelo = $_REQUEST['modelo'];
$prefixo = $_REQUEST['prefixo'];
$setor = $_REQUEST['setor'];
$status = $_REQUEST['status'];

if($acao == 'limpar'){

    $prefixo = '';
    $combustivel = '';
    $marca = '';
    $modelo = '';
    $setor = '';
    $status = '';
}

if($prefixo && $prefixo <> 'TODOS'){$filtroPrefixo = "AND prefixo = '$prefixo'";};
if($combustivel && $combustivel <> 'TODOS' ){$filtroCombustivel = "AND combustivel = '$combustivel'";}
if($marca && $marca <> 'TODOS'){$filtroMarca = "AND marca = '$marca'";}
if($modelo && $modelo <> 'TODOS'){$filtroModelo = "AND modelo = '$modelo'";}
if($setor && $setor <> 'TODOS'){$filtroSetor = "AND setor = '$setor'";}
if($status == 'checked'){
    $filtroStatus = "WHERE status_veiculo <= 1";
}else{
     $filtroStatus = "WHERE status_veiculo = 1";
}

if($acao == 'desativar-veiculo'){

    desativarVeiculo();
}
if($acao == 'alterar-veiculo'){

    include 'config.php';
    
    $idVeiculoAlt = $_POST['idVeiculoAlt'];
    $numero_equipamento = strtoupper($_POST['numero_equipamento']);
    $prefixoAlt = strtoupper($_POST['prefixoAlt']);
    $placa = strtoupper($_POST['placa']);
    $descricao_caminhao = strtoupper($_POST['descricao_caminhao']);
    $renavam = strtoupper($_POST['renavam']);
    $chassi = strtoupper($_POST['chassi']);
    $numero_motor = strtoupper($_POST['numero_motor']);
    $ano = strtoupper($_POST['ano']);
    $marcaAlt = strtoupper($_POST['marcaAlt']);
    $modeloAlt = strtoupper($_POST['modeloAlt']);
    $combustivelAlt = strtoupper($_POST['combustivelAlt']);
    $metodo = strtoupper($_POST['metodo']);
    $setorAlt = $_POST['setorAlt'];
    $status_veiculo = strtoupper($_POST['status_veiculo']);
   

  /*  if($menu == 'cadastro-veiculo'){
        
			$sql = $pdo->prepare("INSERT INTO veiculos(
			numero_equipamento, prefixo, placa, descricao_caminhao, renavam,chassi, numero_motor,
            ano,marca,modelo,combustivel,metodo,setor,status_veiculo)
			VALUES(:numero_equipamento, :prefixo, :placa, :descricao_caminhao, :renavam, :chassi,
			:numero_motor,:ano, :marca, :modelo, :combustivel, :metodo, :setor, :status_veiculo)");

     }else{*/
            $sql = $pdo->prepare("UPDATE veiculos SET
			numero_equipamento = :numero_equipamento, prefixo = :prefixo, placa = :placa, 
            descricao_caminhao = :descricao_caminhao, renavam = :renavam, chassi = :chassi, 
            numero_motor = :numero_motor,
            ano = :ano, marca = :marca,modelo = :modelo, combustivel = :combustivel ,metodo =:metodo,
            setor = :setor, status_veiculo = :status_veiculo
			WHERE id_veiculo = :id_veiculo");


            $sql->bindValue(':id_veiculo', $idVeiculoAlt);

     //}
            
			$sql->bindValue(':numero_equipamento', $numero_equipamento);
			$sql->bindValue(':prefixo', $prefixoAlt);
			$sql->bindValue(':placa', $placa);
			$sql->bindValue(':descricao_caminhao', $descricao_caminhao);
			$sql->bindValue(':renavam', $renavam);
			$sql->bindValue(':chassi', $chassi);
			$sql->bindValue(':numero_motor', $numero_motor);
			$sql->bindValue(':ano', $ano);
			$sql->bindValue(':marca', $marcaAlt);
			$sql->bindValue(':modelo', $modeloAlt);
			$sql->bindValue(':combustivel', $combustivelAlt);
			$sql->bindValue(':metodo', $metodo);
			$sql->bindValue(':setor', $setorAlt);
			$sql->bindValue(':status_veiculo', $status_veiculo);
			$sql1->execute();
         
            
   // cadastroAlteracaoVeiculo();
}
function cadastroAlteracaoVeiculo(){

    include 'config.php';
    
    $id_veiculo = $_POST['idVeiculoAlt'];
    $numero_equipamento = strtoupper($_POST['numero_equipamento']);
    $prefixo = strtoupper($_POST['prefixoAlt']);
    $placa = strtoupper($_POST['placa']);
    $descricao_caminhao = strtoupper($_POST['descricao_caminhao']);
    $renavam = strtoupper($_POST['renavam']);
    $chassi = strtoupper($_POST['chassi']);
    $numero_motor = strtoupper($_POST['numero_motor']);
    $ano = strtoupper($_POST['ano']);
    $marca = strtoupper($_POST['marcaAlt']);
    $modelo = strtoupper($_POST['modeloAlt']);
    $combustivel = strtoupper($_POST['combustivelAlt']);
    $metodo = strtoupper($_POST['metodo']);
    $setor = $_POST['setorAlt'];
    $status_veiculo = strtoupper($_POST['status_veiculo']);
   

  /*  if($menu == 'cadastro-veiculo'){
        
			$sql = $pdo->prepare("INSERT INTO veiculos(
			numero_equipamento, prefixo, placa, descricao_caminhao, renavam,chassi, numero_motor,
            ano,marca,modelo,combustivel,metodo,setor,status_veiculo)
			VALUES(:numero_equipamento, :prefixo, :placa, :descricao_caminhao, :renavam, :chassi,
			:numero_motor,:ano, :marca, :modelo, :combustivel, :metodo, :setor, :status_veiculo)");

     }else{*/
            $sql = $pdo->prepare("UPDATE veiculos SET
			numero_equipamento = :numero_equipamento, prefixo = :prefixo, placa = :placa, 
            descricao_caminhao = :descricao_caminhao, renavam = :renavam, chassi = :chassi, 
            numero_motor = :numero_motor,
            ano = :ano, marca = :marca,modelo = :modelo, combustivel = :combustivel ,metodo =:metodo,
            setor = :setor, status_veiculo = :status_veiculo
			WHERE id_veiculo = :id_veiculo");
            $sql->bindValue(':id_veiculo', $id_veiculo);

     //}
            
			$sql->bindValue(':numero_equipamento', $numero_equipamento);
			$sql->bindValue(':prefixo', $prefixo);
			$sql->bindValue(':placa', $placa);
			$sql->bindValue(':descricao_caminhao', $descricao_caminhao);
			$sql->bindValue(':renavam', $renavam);
			$sql->bindValue(':chassi', $chassi);
			$sql->bindValue(':numero_motor', $numero_motor);
			$sql->bindValue(':ano', $ano);
			$sql->bindValue(':marca', $marca);
			$sql->bindValue(':modelo', $modelo);
			$sql->bindValue(':combustivel', $combustivel);
			$sql->bindValue(':metodo', $metodo);
			$sql->bindValue(':setor', $setor);
			$sql->bindValue(':status_veiculo', $status_veiculo);
			$sql->execute();

     
}
function desativarVeiculo(){

    include 'config.php';

    $id_veiculo = $_POST['id_veiculo'];
    $status_veiculo = '2';
    
    $sql = $pdo->prepare("UPDATE veiculos SET status_veiculo = :status_veiculo WHERE id_veiculo = :id_veiculo");
    
    $sql->bindValue(':status_veiculo', $status_veiculo);
    $sql->bindValue(':id_veiculo', $id_veiculo);

    $sql->execute();

    header("Location: veiculo-desativado?acao=desativarVeiculo");

}
function filtrarVeiculos($filtroPrefixo, $filtroCombustivel,$filtroMarca, $filtroModelo,$filtroSetor, $filtroStatus){
   
    include 'config.php';
    include 'functions.php';

        $sql = $pdo->prepare("SELECT * FROM veiculos AS v
        $filtroStatus    
        $filtroPrefixo $filtroCombustivel $filtroMarca $filtroModelo $filtroSetor
        ORDER BY prefixo ASC ");
        $sql->execute();


       
        if ($sql->rowCount() > 0) {

            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
            $x = 0;
            foreach($lista as $row){

                $modalAlterarVeiculo = "modalAlterarVeiculo".$row['id_veiculo']."";

                $linkModalAlterar = "data-bs-toggle='modal' data-bs-target='#$modalAlterarVeiculo' style='cursor:pointer'";

                $info = array(
                'id_veiculo' => $row['id_veiculo'],
                'numero_equipamento' => $row['numero_equipamento'],
                'prefixo' => $row['prefixo'],
                'placa' =>  $row['placa'],
                'descricao_caminhao' =>  $row['descricao_caminhao'],
                'renavam' =>  $row['renavam'],
                'chassi' =>  $row['chassi'],
                'numero_motor' =>  $row['numero_motor'],
                'ano' =>  $row['ano'],
                'marca' =>  $row['marca'],
                'modelo' =>  $row['modelo'],
                'combustivel' =>  $row['combustivel'],
                'metodo' =>  $row['metodo'],
                'setor' => $row['setor'],
                'status_veiculo' =>  $row['status_veiculo']   
                );

                $info = http_build_query($info);
                $url ='alterar-veiculo?'.$info;
                $link = "PopupCenter('$url','Veiculos',400,900)";
                $x++;
                $txtTableVeiculos .= '<tr '.$linkModalAlterar.' style="cursor:pointer;">
                <td><center>'.$x.'</td>
                <td>'.$row['numero_equipamento'].'</td>
                <td>'.l4($row['prefixo']).'</td>
                <td>'.$row['placa'].'</td>
                <td>'.$row['descricao_caminhao'].'</td>
                <td>'.$row['renavam'].'</td>
                <td>'.$row['chassi'].'</td>
                <td>'.$row['numero_motor'].'</td>
                <td>'.$row['ano'].'</td>
                <td>'.$row['marca'].'</td>
                <td>'.$row['modelo'].'</td>
                <td>'.$row['combustivel'].'</td>
                <td>'.($row['metodo'] == 1 ? 'KM' : 'HR').'</td>
                <td>'.$row['setor'].'</td>
                <td>'.($row['status_veiculo'] == 1 ? 'Ativo' : 'Inativo').'</td>
            </tr>';

                include 'modalVeiculos.php';
            }
           
        }
          return  $txtTableVeiculos;      
}     
?>