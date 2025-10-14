<?php

require_once __DIR__ . "/../models/usuario/Usuario.php";
require_once __DIR__ . "/../models/usuario/validator.php";
require_once __DIR__ . "/../utils/navegar.php";

session_start();

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];


$user =  new Usuario($email, $senha, $nome);
$validador = new ValidadorCadastro($user);

$validador->validar();

if(!$validador->valido) {
    $_SESSION["validador"] = $validador;
    navegar("/avaliacoes/pages/cadastro");
}

$resultado = $user->save();


if (!$resultado) {
    $_SESSION["validador"] = $validador;
    $validador->erro_generico();
    navegar("/avaliacoes/pages/cadastro");
}


$_SESSION["user"] = Usuario::findByEmail($email);
navegar("/avaliacoes");
