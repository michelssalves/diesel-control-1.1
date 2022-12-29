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

function  verificaToken($idFuncionario){

    include '../controller/config.php';

    $sql = $pdo->prepare("SELECT * FROM funcionarios WHERE id_funcionario = :idFuncionario");
    $sql->bindValue('idFuncionario', $idFuncionario);
    $sql->execute();
    if ($sql->rowCount() == 1) {
                    
        $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($lista as $row){
            $funcionario = $row['token'];
            $funcionario = $row['id_funcionario'];
            $funcionario = $row['usuario'];
            $funcionario = $row['tipo_acesso'];
            $funcionario = $row['nome'];
            $funcionario = $row['id_permissao'];
        }
    }
    return $funcionario;
}
?>