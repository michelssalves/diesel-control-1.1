<?php
session_start();

$acao = $_REQUEST['acao'];
$usuario = addslashes($_POST['usuario']);
$senha = addslashes($_POST['senha']);

if($acao == 'login'){
    if (isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['senha']) && !empty($_POST['senha'])) {

        login($usuario, $senha);

}

}
function login($usuario, $senha){

    include 'config.php';

        $token = md5(time() . rand(0, 9999) . time());
        $sql = $pdo->prepare("UPDATE funcionarios SET token = :token WHERE usuario = :usuario AND senha = :senha");
        $sql->bindValue(':token', $token);
        $sql->bindValue(':usuario', $usuario);
        $sql->bindValue(':senha', md5($senha));
        $sql->execute();

        $sql = $pdo->prepare("SELECT * FROM funcionarios WHERE usuario = :usuario AND senha = :senha");
        $sql->bindValue(':usuario', $usuario);
        $sql->bindValue(':senha', md5($senha));
        $sql->execute();
        
       
       if ($sql->rowCount() == 1) {
        
           $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
           foreach($lista as $row){
            $_SESSION['id_funcionario'] = $row['id_funcionario'];
            $_SESSION['usuario'] =  $row['usuario'];
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['id_permissao'] = $row['id_permissao'];
            $_SESSION['token'] = $row['token'];
           }
        
           header("Location: menu-principal"); 

       }else{

           $_SESSION['msg'] = '<div class="alert-danger"> senha ou usuário incorreto!</div>';
            header("Location: login-diesel-control"); 
       }
         
}

function menuPrincipal(){
    
    include 'config.php';

    $permissao = $_SESSION['id_permissao'];

    $sql = $pdo->query("SELECT * FROM menu_principal WHERE id_permissao <= $permissao");
    $sql->execute();  
 
    while($row = $sql->fetch(PDO::FETCH_ASSOC)){

       
    $tableMenu = $tableMenu.'<tr>
        <th>'.$row['botao_menu'].'</th>
    </tr>';
    }
    return $tableMenu;
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
  
?>
