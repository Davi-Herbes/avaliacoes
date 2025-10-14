<?php

require_once __DIR__ . "/../models/endereco/endereco.php";
require_once __DIR__ . "/../models/endereco/validator.php";
require_once __DIR__ . "/../utils/navegar.php";

session_start();

$rua = $_POST["rua"];
$numero = $_POST["numero"];
$cidade = $_POST["cidade"];
$cep = $_POST["cep"];
$estado = $_POST["estado"];
$pais = $_POST["pais"];

$rua =  new Endereco($rua);
$validador = new ValidadorEndereco($Endereco);

$numero =  new Endereco($numero);
$validador = new ValidadorEndereco($Endereco);

$cidade =  new Endereco($cidade);
$validador = new ValidadorEndereco($Endereco);

$cep =  new Endereco($cep);
$validador = new ValidadorEndereco($Endereco);

$estado =  new Endereco($estado);
$validador = new ValidadorEndereco($Endereco);

$pais =  new Endereco($pais);
$validador = new ValidadorEndereco($Endereco);

$validador->validar();


if(!$validador->valido) {
    $_SESSION["validador"] = $validador;
    navegar("/avaliacoes/pages/endereco");
}

$user->save();

if (!$user) {
    $_SESSION["validador"] = $validador;
    navegar("/avaliacoes/pages/endereco");
}

navegar("/avaliacoes");
