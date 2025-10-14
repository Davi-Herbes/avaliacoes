<?php

require_once __DIR__ . "/../models/produto/produto.php";
require_once __DIR__ . "/../models/produto/validator.php";
require_once __DIR__ . "/../utils/navegar.php";

session_start();

$nome = $_POST["nome"];
$descricao = $_POST["descricao"];

$nome =  new Produto($nome);
$validador = new ValidadorProduto($Produto);

$descricao =  new Produto($descricao);
$validador = new ValidadorProduto($Produto);

$validador->validar();


if(!$validador->valido) {
    $_SESSION["validador"] = $validador;
    navegar("/avaliacoes/pages/produto");
}

$user->save();

if (!$user) {
    $_SESSION["validador"] = $validador;
    navegar("/avaliacoes/pages/produto");
}

navegar("/avaliacoes");