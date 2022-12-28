<?php
session_start();
include '../model/Funcionarios.php';
include '../controller/userDataBaseAcess.php';


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="diesel-control-1.1/assets/css/signin.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
  </head>
  <body class="text-center">    
<main class="form-signin w-100 m-auto">
<div>
</div>
  <form method="POST">
    <h1 class="h3 mb-3 fw-normal">Acesso</h1>
    <div class="form-floating">
      <input type="text" class="form-control" name="usuario" placeholder="Usuario">
      <label for="floatingInput">Usuario</label>
    </div>
    <div class="form-floating">
      <input type="password" name="senha" class="form-control" placeholder="Senha">
      <label for="floatingPassword">Senha</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" name="acao" value="login" type="submit">Logar</button>
    <p class="mt-5 mb-3 text-muted">&copy; 01-03-2022</p>
  </form>
</main>  
  </body>
</html>
