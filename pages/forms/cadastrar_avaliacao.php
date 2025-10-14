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
    <title>Cadastrar avaliação</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Avaliar</h1>

    <form action="/avaliacao/src/forms/cadastrar_avaliacao.php" class="form" method="post">
        <label for="nota">Nota: <input id="nota" name="nota" type="number"></label>
        <label for="comentario">Comentário: <input id="comentario" name="comentario" type="password"></label>
        <button class="botao" type="submit">Enviar</button>
    </form>

    <?php if ($with_error): ?>
        <p class="error-msg">Erro ao cadastrar avaliação!</p>
    <?php endif; ?>
</body>

</html>