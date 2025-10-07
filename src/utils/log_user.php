<?php

require_once __DIR__ . "/../models/Usuario.php";

$email = $_POST["email"];
$senha = $_POST["senha"];

$user =  Usuario::validar_login($email, $senha);

if (!$user) {
    header("Location: /avaliacao/pages/login?error=true");
}
