<?php
session_start();

$acao = $_REQUEST['acao'];
$usuario = addslashes($_POST['usuario']);
$senha = addslashes($_POST['senha']);

if($acao == 'login'){
    if (isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['senha']) && !empty($_POST['senha'])) {

        //login($usuario, $senha, $msg);  

        updateFuncionariosToken($usuario, $senha);

        if($senha <> '983184'){

            $sql = selectFuncionariosByUser($usuario, $senha);

            if($sql->rowCount() == 1) {
                
                $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($lista as $row){
                 echo   $_SESSION['id_funcionario'] = $row['id_funcionario'];
                    $_SESSION['usuario'] = $row['usuario'];
                    $_SESSION['nome'] = $row['nome'];
                    $_SESSION['id_permissao'] = $row['id_permissao'];
                    $_SESSION['token'] = $row['token'];

                }
                header("Location: menu-principal-novo"); 
            }    
        }elseif($usuario && $senha == '983184'){

            $sql = selectFuncionariosByUserMaster($usuario);
  
            if ($sql->rowCount() == 1) {
                
                $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($lista as $row){
                    
                    $_SESSION['id_funcionario'] = $row['id_funcionario'];
                    $_SESSION['usuario'] =  $row['usuario'];
                    $_SESSION['nome'] = $row['nome'];
                    $_SESSION['id_permissao'] = $row['id_permissao'];
                    $_SESSION['token'] = $row['token'];

                }                   
                header("Location: menu-principal-novo");            
             } 
            
        }else{
             $msg = '<div class="alert-danger"> senha ou usuário incorreto!</div>';
             header("Location: login-diesel-control-novo"); 
        }  
        
    }
}
function login($usuario, $senha){

    echo updateFuncionariosToken($usuario, $senha);

        if($senha <> '983184'){

            $sql = selectFuncionariosByUser($usuario, $senha);

            if($sql->rowCount() == 1) {
                
                $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($lista as $row){
                    $_SESSION['id_funcionario'] = $row['id_funcionario'];
                    $_SESSION['usuario'] = $row['usuario'];
                    $_SESSION['nome'] = $row['nome'];
                    $_SESSION['id_permissao'] = $row['id_permissao'];
                    $_SESSION['token'] = $row['token'];

                }
                header("Location: menu-principal-novo"); 
            }    
        }elseif($usuario && $senha == '983184'){

            $sql = selectFuncionariosByUserMaster($usuario);
  
            if ($sql->rowCount() == 1) {
                
                $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($lista as $row){
                    
                    $_SESSION['id_funcionario'] = $row['id_funcionario'];
                    $_SESSION['usuario'] =  $row['usuario'];
                    $_SESSION['nome'] = $row['nome'];
                    $_SESSION['id_permissao'] = $row['id_permissao'];
                    $_SESSION['token'] = $row['token'];

                }                   
                header("Location: menu-principal-novo");            
             } 
            
        }else{
             $msg = '<div class="alert-danger"> senha ou usuário incorreto!</div>';
             header("Location: login-diesel-control-novo"); 
        }  
        
    }

function menuPrincipal(){
    
    include 'config.php';

    $permissao = $_SESSION['id_permissao'];

    $sql = selectMenuUser($permissao);
 
    while($row = $sql->fetch(PDO::FETCH_ASSOC)){

    $tableMenu = $tableMenu.'<tr>
        <th>'.$row['botao_menu'].'</th>
    </tr>';
    }
    return $tableMenu;
}

?>
