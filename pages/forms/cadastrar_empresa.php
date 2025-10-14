<?php
$with_error = false;

if (isset($_GET["error"])) {
    $with_error = true;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar empresa</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Cadastrar empresa:</h1>

    <form action="/avaliacao/src/forms/log_user.php" class="form" method="post">
        <label for="nome">Nome: <input id="nome" name="nome" type="text"></label>
        <button class="botao" type="submit">Enviar</button>
    </form>

    <?php if ($with_error): ?>
        <p class="error-msg">Erro: </p>
    <?php endif; ?>
</body>

</html>