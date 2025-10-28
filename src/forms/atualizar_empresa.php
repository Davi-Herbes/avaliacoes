<?php

require_once __DIR__ . "/../models/empresa/empresa.php";
require_once __DIR__ . "/../utils/navegar.php";

session_start();

$nome = $_POST["nome"];

$id = $_POST["id"] ?? null;
$id = $id !== null  && $id !== "" ? (int)$id : null;

$idUsuario = $_POST["idUsuario"];
$idUsuario = $idUsuario !== null  && $idUsuario !== "" ? (int)$idUsuario : null;

$idEndereco = $_POST["idEndereco"];
$idEndereco = $idEndereco !== null  && $idEndereco !== "" ? (int)$idEndereco : null;

$empresa =  new Empresa($nome, $idUsuario, $idEndereco);
$empresa->id = $id;

$validador = new ValidadorEmpresa($empresa);

$validador->validar();


if (!$validador->valido) {
  $_SESSION["validador"] = $validador;
  navegar("/avaliacoes/pages/sua_empresa");
}

$empresa->save();

if (!$empresa) {
  $_SESSION["validador"] = $validador;
  navegar("/avaliacoes/pages/sua_empresa");
}

navegar("/avaliacoes/pages/sua_empresa");
