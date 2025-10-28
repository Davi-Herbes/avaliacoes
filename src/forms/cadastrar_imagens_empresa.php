<?php

require_once __DIR__ . "/../models/empresa/empresa.php";
require_once __DIR__ . "/../models/empresa/validator.php";
require_once __DIR__ . "/../utils/navegar.php";

session_start();

$nome = $_POST["nome"];
$nome = $_POST["nome"];
$idUsuario = $_POST["idUsuario"];
$idEndereco = $_POST["idEndereco"];

$empresa =  new Empresa($nome, $idUsuario, $idEndereco);
$validador = new ValidadorEmpresa($empresa);

$validador->validar();


if(!$validador->valido) {
    $_SESSION["validador"] = $validador;
    navegar("/avaliacoes/pages/empresa");
}

$user->save();

if (!$user) {
    $_SESSION["validador"] = $validador;
    navegar("/avaliacoes/pages/empresa");
}

navegar("/avaliacoes");