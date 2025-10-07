<?php

require_once __DIR__ . "/../models/Usuario.php";

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];


$user =  new Usuario($email, $senha, $nome);

$user->save();

if (!$user) {
    header("Location: /avaliacao/pages/cadastro");
}
