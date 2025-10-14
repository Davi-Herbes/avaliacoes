<?php
require_once __DIR__ . "/../models/usuario/Usuario.php";

function user_required()
{
    session_start();

    if (!isset($_SESSION["user"])) {
        header("Location: /avaliacoes/pages/login");
    }
}
