<?php
include '../model/Funcionarios.php';

$acao = $_REQUEST['acao'];

verificaToken($_SESSION['id_funcionario']);

if($_SESSION['token'] <> verificaToken($idFuncionario)){
    
    session_destroy();
    header("Location:  login-diesel-control-novo");
}

if($acao == 'sair'){
    session_destroy();
    header("Location:  login-diesel-control-novo");
}

?>