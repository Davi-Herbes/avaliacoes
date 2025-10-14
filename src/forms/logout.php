<?php

require_once __DIR__ . "/../utils/navegar.php";

session_start();

if (isset($_SESSION["user"])) {
  unset($_SESSION["user"]);
}

navegar("/avaliacoes/pages/login/");
