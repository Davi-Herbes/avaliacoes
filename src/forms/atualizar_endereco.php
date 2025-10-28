<?php

require_once __DIR__ . "/../models/endereco/endereco.php";
require_once __DIR__ . "/../models/endereco/validator.php";
require_once __DIR__ . "/../models/empresa/empresa.php";
require_once __DIR__ . "/../models/empresa/validator.php";
require_once __DIR__ . "/../utils/navegar.php";

session_start();

$rua = $_POST["rua"];
$id = $_POST["id"];
$numero = $_POST["numero"];
$cidade = $_POST["cidade"];
$cep = $_POST["cep"];
$estado = $_POST["estado"];
$pais = $_POST["pais"];

$endereco =  new Endereco($rua, $numero, $cidade, $cep, $estado, $pais);
$endereco->id = $id;

$validador = new ValidadorEndereco($endereco);

$validador->validar();


if(!$validador->valido) {
    $_SESSION["validador"] = $validador;
    navegar("/avaliacoes/pages/sua_empresa");
}

$endereco->save();

if (!$endereco) {
    $_SESSION["validador"] = $validador;
    navegar("/avaliacoes/pages/sua_empresa");
}

navegar("/avaliacoes/pages/sua_empresa");
