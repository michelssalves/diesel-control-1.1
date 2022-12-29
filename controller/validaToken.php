<?php
if((!isset($_SESSION['id_funcionario'])) && (!isset($_SESSION['usuario'])) &&  (!isset($_SESSION['nome'])) && (!isset($_SESSION['id_permissao'])) && (!isset($_SESSION['token']))){
    session_start();
    ob_start();
    unset($_SESSION['id_funcionario'],$_SESSION['usuario'],$_SESSION['nome'],$_SESSION['id_permissao'],$_SESSION['token']);
    header("Location: login-diesel-control-novo");
}else{
    if($_SESSION['id_funcionario']){
        include '../model/Funcionarios.php';

        $acao = $_REQUEST['acao'];

        $funcionario = verificaToken($_SESSION['id_funcionario']);

        if($_SESSION['token'] <> $funcionario[0]){
            
            session_destroy();
            header("Location:  login-diesel-control-novo");
        }
        if($_SESSION['permissao'] < $permissao){
            
            session_destroy();
            header("Location:  login-diesel-control-novo");
        }
    }
}

?>