<?php
require_once __DIR__ . "/../src/models/produto/Produto.php";

$result = Produto::findComAvaliacao(1);
var_dump($result);
