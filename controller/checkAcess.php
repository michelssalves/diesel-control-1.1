<?php
session_start(); 
include 'config.php';

echo $id_funcionario = $_SESSION['id_funcionario'];
$token = $_SESSION['token'];
$permissao = $_SESSION['id_permissao'];
$login = $_SESSION['usuario'];

$sql = $pdo->prepare("SELECT * FROM funcionarios WHERE id_funcionario = :id_funcionario");
$sql->bindValue(':id_funcionario',$id_funcionario);
$sql->execute();
$lista = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach($lista as $row){
    $idLogado =  $row['id_funcionario'];
    $usuarioLogado =  $row['usuario'];
    $nomeLogado = $row['nome'];
    $permissaoLogado = $row['id_permissao'];
    $tokenLogado = $row['token'];
}

echo  $permissaoLogado;

if($usuarioLogado <> $login || $idLogado <> $id_funcionario || $tokenLogado <> $token || $permissaoLogado <> $permissao || $nivelPremissao > $permissao){
    session_destroy();
    header("Location: login-diesel-control-novo");
}
if($acao == 'sair'){
    session_destroy();
    header("Location:  login-diesel-control-novo");
}
?>