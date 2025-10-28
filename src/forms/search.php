<?php

require_once __DIR__ . "/../models/empresa/Empresa.php";
require_once __DIR__ . "/../utils/navegar.php";

session_start();

$nome = $_POST["nome"];

$empresas =  Empresa::searchByName($nome);


$_SESSION["empresas"] = $empresas;
navegar("/avaliacoes/pages/buscar");
