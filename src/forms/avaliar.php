<?php

require_once __DIR__ . "/../models/avaliacao/Avaliacao.php";
require_once __DIR__ . "/../utils/navegar.php";

session_start();


$nota = $_POST["nota"] ?? null;
$nota = $nota !== null  && $nota !== "" ? (int)$nota : null;

$comentario = $_POST["descricao"];

$id_empresa = $_POST["empresa-id"] ?? null;
$id_empresa = $id_empresa !== null  && $id_empresa !== "" ? (int)$id_empresa : null;


$avaliacao =  new AvaliacaoEmpresa($nota, $comentario, $id_empresa);

// $validador->validar();


// if (!$validador->valido) {
//     $_SESSION["validador"] = $validador;
//     navegar("/avaliacoes/pages/avaliacao");
// }



$usuario = $_SESSION["user"];
AvaliacaoEmpresa::delete($usuario->id);

$avaliacao->save();

if (!$avaliacao) {
    navegar("/avaliacoes/pages/empresa?id=$id_empresa&error");
}


navegar("/avaliacoes/pages/empresa?id=$id_empresa");
