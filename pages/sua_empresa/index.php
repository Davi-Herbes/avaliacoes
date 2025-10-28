<?php
require_once __DIR__ . "/../../src/utils/user_required.php";
require_once __DIR__ . "/../../src/models/empresa/Empresa.php";
require_once __DIR__ . "/../../src/models/endereco/Endereco.php";
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
user_required();

$user = $_SESSION["user"];
$user_id = $user->id;
$empresa = Empresa::findEmpresaByIdUsuario($user_id);
$endereco = Endereco::find($empresa->idEndereco);



?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sua Empresa</title>
  <link rel="stylesheet" href="/avaliacoes/public/home.css">
</head>

<body>
  <div class="page">

    <header class="home-header">
      <a href="/avaliacoes/">
        <h1 class="home-title">R8</h1>
      </a>
      <nav class="home-nav">
        <ul>
          <li>
            <a href="/avaliacoes/src/forms/logout.php">Logout</a>
          </li>
        </ul>
      </nav>
    </header>
    <section class="home-section">
      <aside class="home-aside">
        <nav>
          <ul>
            <li>
              <a href="/avaliacoes/">
                <figure>
                  <img src="/avaliacoes/public/images/home-icon.svg" alt="Ícone seguindo">
                  <figcaption>Seguindo</figcaption>
                </figure>
              </a>
            </li>
            <li>
              <a href="/avaliacoes/pages/buscar/">
                <figure>
                  <img src="/avaliacoes/public/images/search.svg" alt="Ícone busca">
                  <figcaption>Buscar empresas</figcaption>
                </figure>
              </a>
            </li>
            <li class="selected">
              <a href="/avaliacoes/pages/sua_empresa">
                <figure>
                  <img src="/avaliacoes/public/images/empresa.svg" alt="Ícone empresa">
                  <figcaption>Sua empresa</figcaption>
                </figure>
              </a>
            </li>
          </ul>
        </nav>
      </aside>
      <main class="home-main">
        <h1>Sua empresa:</h1>

        <form action="/avaliacoes/src/forms/atualizar_endereco.php" class='form' method="post">
          <label for="rua">Rua: <input id="rua" name="rua" type="text" value="<?php echo $endereco->rua ?>">
            <p class="error-msg"><?php echo $validador->erro_nome ?></p>
          </label>
          <label for="numero">Número: <input id="numero" name="numero" type="num" value="<?php echo $endereco->numero ?>">
            <p class="error-msg"><?php echo $validador->erro_nome ?></p>
          </label>
          <label for="cidade">Cidade: <input id="cidade" name="cidade" type="text" value="<?php echo $endereco->cidade ?>">
            <p class="error-msg"><?php echo $validador->erro_nome ?></p>
          </label>
          <label for="cep">CEP: <input id="cep" name="cep" type="text" value="<?php echo $endereco->cep ?>">
            <p class="error-msg"><?php echo $validador->erro_nome ?></p>
          </label>
          <label for="estado">Estado: <input id="estado" name="estado" type="text" value="<?php echo $endereco->estado ?>">
            <p class="error-msg"><?php echo $validador->erro_nome ?></p>
          </label>
          <label for="pais">País: <input id="pais" name="pais" type="text" value="<?php echo $endereco->pais ?>">
            <p class="error-msg"><?php echo $validador->erro_nome ?></p>
          </label>
          <label for="id"><input id="id" name="id" type="num" value="<?php echo $endereco->id ?>" hidden>
            <p class="error-msg"><?php echo $validador->erro_nome ?></p>
          </label>
          <button class="botao" type="submit">Enviar</button>
        </form>
        <br>
        <form action="/avaliacoes/src/forms/atualizar_empresa.php" class='form' method="post">
          <label for="nome">Nome da empresa: <input id="nome" name="nome" type="text" value="<?php echo $empresa->nome ?>">
            <p class="error-msg"><?php echo $validador->erro_nome ?></p>
          </label>
          <label for="idUsuario"><input id="idUsuario" name="idUsuario" type="num" value="<?php echo $user->id ?>" hidden>
            <p class="error-msg"><?php echo $validador->erro_nome ?></p>
          </label>
          <label for="idEndereco"><input id="idEndereco" name="idEndereco" type="num" value="<?php echo $endereco->id ?>" hidden>
            <p class="error-msg"><?php echo $validador->erro_nome ?></p>
          </label>
          <label for="id"><input id="id" name="id" type="num" value="<?php echo $empresa->id ?>" hidden>
            <p class="error-msg"><?php echo $validador->erro_nome ?></p>
          </label>
          <button class="botao" type="submit">Enviar</button>
        </form>
        

        



        <!-- <p>ID do usuário: <?= $user_id ?></p> -->
        <!-- <p>Nome do usuário: <?= $user->nome ?></p> -->
        <!-- <p>Email do usuário: <?= $user->email ?></p> -->
        <!-- <p>Nome da empresa: <?= $empresa->nome ?></p> -->
        <!-- <p>Rua da empresa: <?= $endereco->rua ?></p> -->
        <!-- <p>Número da empresa: <?= $endereco->numero ?></p> -->
        <!-- <p>Cidade da empresa: <?= $endereco->cidade ?></p> -->
        <!-- <p>Estado da empresa: <?= $endereco->estado ?></p> -->
        <!-- <p>CEP da empresa: <?= $endereco->cep ?></p> -->
        <!-- <p>País da empresa: <?= $endereco->pais ?></p> -->
        <!-- <p>ID do endereço: <?= $empresa->idEndereco ?></p> -->
        <!-- <p>ID da empresa: <?= $empresa->id ?></p> -->




      </main>
    </section>
  </div>
</body>

</html>