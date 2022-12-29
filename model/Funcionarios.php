<?php
function selectFuncionariosByUser($usuario, $senha){

    include '../controller/config.php';

        $sql = $pdo->prepare("SELECT * FROM funcionarios WHERE usuario = :usuario AND senha = :senha");
        $sql->bindValue(':usuario', $usuario);
        $sql->bindValue(':senha', md5($senha));
        $sql->execute();

        return $sql;
    }
function selectFuncionariosByUserMaster($usuario){

    include '../controller/config.php';

        $sql = $pdo->prepare("SELECT * FROM funcionarios WHERE usuario = :usuario");
        $sql->bindValue(':usuario', $usuario);
        $sql->execute();

        return $sql;
    }

function updateFuncionariosToken(){

    include '../controller/config.php';

        $token = md5(time() . rand(0, 9999) . time());
        $sql = $pdo->prepare("UPDATE funcionarios SET token = :token WHERE usuario = :usuario AND senha = :senha");
        $sql->bindValue(':token', $token);
        $sql->bindValue(':usuario', $usuario);
        $sql->bindValue(':senha', md5($senha));
        $sql->execute();

        return $sql;
    }

?>