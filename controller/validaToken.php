<?php
include 'config.php';

$sql = $pdo->prepare("SELECT token FROM funcionarios WHERE id_funcionario = :idFuncionario");
$sql->bindValue('idFuncionario', $_SESSION['id_funcionario']);
$sql->execute();
if ($sql->rowCount() == 1) {
                
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach($lista as $row){
        $token = $row['token'];
    }
}
if($_SESSION['token'] <> $token){

    session_destroy();
    header("Location:  login-diesel-control-novo");
}
?>