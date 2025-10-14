<?php
require_once __DIR__ . "/../../src/models/usuario/Usuario.php";
require_once __DIR__ . "/../../src/models/usuario/validator.php";

session_start();

$validador = new ValidadorCadastro();

if(isset($_SESSION["validador"])) {
    $validador = $_SESSION["validador"];
    unset($_SESSION["validador"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Cadastro</h1>

    <form action="/avaliacoes/src/forms/cadastrar.php" class='form' method="post">
        <label for="nome">Nome completo: <input id="nome" name="nome" type="text">
        <p class="error-msg"><?php echo $validador->erro_nome ?></p></label>
        <label for="email">Email: <input id="email" name="email" type="email">
        <p class="error-msg"><?php echo $validador->erro_email ?></p></label>
        <label for="senha">Senha: <input id="senha" name="senha" type="password">
        <p class="error-msg"><?php echo $validador->erro_senha ?></p></label>
        <button class="botao" type="submit">Enviar</button>
    </form>

</body>

</html>