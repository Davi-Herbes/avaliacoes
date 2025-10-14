<?php

require_once __DIR__ . "/../models/avaliacao/Avaliacao.php";
require_once __DIR__ . "/../models/avaliacao/validator.php";
require_once __DIR__ . "/../utils/navegar.php";

session_start();

$nota = $_POST["nota"];
$comentario = $_POST["comentario"];



$avaliacao =  new Avaliacao($nota, $comentario);
$validador = new ValidadorAvaliacao($avaliacao);

$validador->validar();


if(!$validador->valido) {
    $_SESSION["validador"] = $validador;
    navegar("/avaliacoes/pages/avaliacao");
}

$user->save();

if (!$user) {
    $_SESSION["validador"] = $validador;
    navegar("/avaliacoes/pages/avaliacao");
}

navegar("/avaliacoes");