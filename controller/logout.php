<?php
session_start();
ob_start();
unset($_SESSION['id_funcionario'],$_SESSION['usuario'],$_SESSION['nome'],$_SESSION['id_permissao'],$_SESSION['token']);
header("Location: login-diesel-control");
?>