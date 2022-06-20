<?php
$db_name = 'u338658684_controle';
$db_host= 'localhost';
$db_user= 'u338658684_controle';
$db_pass= 'Inf0%beo893fq';
$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>


