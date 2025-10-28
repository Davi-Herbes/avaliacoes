<?php

require_once __DIR__ . "/../models/endereco/endereco.php";
require_once __DIR__ . "/../models/empresa/empresa.php";
require_once __DIR__ . "/../utils/navegar.php";
session_start();


$rua = $_POST["rua"];

$id = $_POST["id"] ?? null;
$id = $id !== null  && $id !== "" ? (int)$id : null;

$numero = $_POST["numero"] ?? null;
$numero = $numero !== null  && $numero !== "" ? (int)$numero : null;

$cidade = $_POST["cidade"];
$cep = $_POST["cep"];
$estado = $_POST["estado"];
$pais = $_POST["pais"];

$endereco =  new Endereco($rua, $numero, $cidade, $cep, $estado, $pais);
$endereco->id = $id;

$validador = new ValidadorEndereco($endereco);

$validador->validar();


if (!$validador->valido) {
  $_SESSION["validador_endereco"] = $validador;
  navegar("/avaliacoes/pages/sua_empresa?asdf");
}

$asdf = $endereco->save();

if (!$endereco) {
  $_SESSION["validador_endereco"] = $validador;
  navegar("/avaliacoes/pages/sua_empresa?gfds");
}

navegar("/avaliacoes/pages/sua_empresa?$asdf");
