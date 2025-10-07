<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
    <h1>Cadastro</h1>

    <form action="/avaliacao/src/utils/cadastrar.php" method="post">
        <label for="nome">Nome completo: <input id="nome" name="nome" type="text"></label>
        <label for="email">Email: <input id="email" name="email" type="email"></label>
        <label for="senha">Senha: <input id="senha" name="senha" type="password"></label>
        <button type="submit">Enviar</button>
    </form>

</body>

</html>