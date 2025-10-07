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
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>

    <form action="/avaliacao/src/utils/log_user.php" method="post">
        <label for="email">Email: <input id="email" name="email" type="email"></label>
        <label for="senha">Senha: <input id="senha" name="senha" type="password"></label>
        <button type="submit">Enviar</button>
    </form>

    <?php if ($with_error): ?>
        <p class="error-msg">Usuário ou senha errados</p>
    <?php endif; ?>
</body>

</html>