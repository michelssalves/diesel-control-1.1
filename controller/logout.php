<?php
if($_SESSION['id_funcionario']){
    include '../model/Funcionarios.php';

    $acao = $_REQUEST['acao'];

    $funcionario = verificaToken($_SESSION['id_funcionario']);

    echo $funcionario['token'];
  /* if($_SESSION['token'] <> $funcionario['token']){
        
        session_destroy();
        header("Location:  login-diesel-control-novo");
    }*/

    if($acao == 'sair'){
        session_destroy();
        header("Location:  login-diesel-control-novo");
    }
}
?>