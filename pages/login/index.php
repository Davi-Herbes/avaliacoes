<?php
$with_error = false;

if (isset($_GET["error"])) {
  $with_error = true;
}


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Login</h1>

  <form action="/avaliacoes/src/forms/log_user.php" class="form" method="post">
    <label for="email">Email: <input id="email" name="email" type="email"></label>
    <label for="senha">Senha: <input id="senha" name="senha" type="password"></label>
    <button class="botao" type="submit">Enviar</button>
  </form>
  <a link href="/avaliacoes/pages/cadastro/">Não tem uma conta? Cadastre-se</a>
  <?php if ($with_error): ?>
    <p class="error-msg">Usuário ou senha errados</p>
  <?php endif; ?>
</body>

</html>