<?php

require_once __DIR__ . "/../models/imagens_empresa/imagens_empresa.php";
require_once __DIR__ . "/../utils/navegar.php";

session_start();

$id = $_GET["id"] ?? null;
$id = $id !== null  && $id !== "" ? (int)$id : null;

ImagensEmpresa::delete($id);


navegar("/avaliacoes/pages/sua_empresa/");
