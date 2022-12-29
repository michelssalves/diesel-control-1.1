<?php
if($_SESSION['id_funcionario']){
    include '../model/Funcionarios.php';

    $acao = $_REQUEST['acao'];

    $funcionario = verificaToken($_SESSION['id_funcionario']);

    //var_dump($funcionario);
    echo $funcionario['id_funcionario'];

  /*  if($_SESSION['token'] <> $token){
        
        session_destroy();
        header("Location:  login-diesel-control-novo");
    }*/

    if($acao == 'sair'){
        session_destroy();
        header("Location:  login-diesel-control-novo");
    }
}
?>