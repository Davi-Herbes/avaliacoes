<?php

require_once __DIR__ . "/../models/usuario/Usuario.php";
require_once __DIR__ . "/../utils/navegar.php";

session_start();

$email = $_POST["email"];
$senha = $_POST["senha"];

$user =  Usuario::validar_login($email, $senha);

if (!$user) {
  header("Location: /avaliacoes/pages/login?error=true");
  exit;
}

$_SESSION["user"] = $user;
navegar("/avaliacoes/");
