<?php

require_once __DIR__ . "/../models/usuario/Usuario.php";
require_once __DIR__ . "/../models/empresa/Empresa.php";
require_once __DIR__ . "/../models/endereco/Endereco.php";
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

$user_id = $user->save();


if (!$user_id) {
    $_SESSION["validador"] = $validador;
    $validador->erro_generico();
    navegar("/avaliacoes/pages/cadastro");
}

$user->id = $user_id;

$_SESSION["user"] = $user;

$endereco = new Endereco();
$endereco_id = $endereco->save();
$endereco->id = $endereco_id;




$empresa = new Empresa("", $user_id, $endereco_id);
$empresa->save();


navegar("/avaliacoes");
