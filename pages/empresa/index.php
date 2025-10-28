<?php


require_once __DIR__ . "/../../src/utils/user_required.php";
require_once __DIR__ . "/../../src/utils/navegar.php";
require_once __DIR__ . "/../../src/models/empresa/Empresa.php";
require_once __DIR__ . "/../../src/models/avaliacao/Avaliacao.php";
require_once __DIR__ . "/../../src/models/imagens_empresa/imagens_empresa.php";
require_once __DIR__ . "/../../src/models/endereco/Endereco.php";

session_start();

user_required();

$empresa_id = $_GET["id"] ?? null;

if (!$empresa_id) {
  navegar("/avaliacoes/");
}

$user = $_SESSION["user"];
$user_id = $user->id;

$empresa = Empresa::find($empresa_id);
$endereco = Endereco::find($empresa->idEndereco);

$imagens = ImagensEmpresa::findByEmpresaId($empresa->id);
$avaliacoes = AvaliacaoEmpresa::findByEmpresaId($empresa->id);

$validador_endereco = $_SESSION["validador_endereco"] ?? new ValidadorEndereco();
if (isset($_SESSION["validador_endereco"])) {
  unset($_SESSION["validador_endereco"]);
}

$validador_empresa = $_SESSION["validador_empresa"] ?? new ValidadorEmpresa($empresa);

if (isset($_SESSION["validador_empresa"])) {
  unset($_SESSION["validador_empresa"]);
}


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sua Empresa</title>
  <link rel="stylesheet" href="/avaliacoes/public/home.css">
  <link rel="stylesheet" href="/avaliacoes/pages/empresa/styles.css">
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
              <a href="/avaliacoes/">
                <figure>
                  <img src="/avaliacoes/public/images/search.svg" alt="Ícone busca">
                  <figcaption>Buscar empresas</figcaption>
                </figure>
              </a>
            </li>
            <li class="">
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
      <section class="empresa-section">
        <div class="avaliacoes-container">

          <div class="title-container">
            <h1><?= $empresa->nome ?></h1>
            <h2><?= $empresa->avaliacao_media ?><span class="avaliacao-maxima">/10</span></h2>
            <form action="/avaliacoes/src/forms/seguir.php" method="post">
              <button class="seguir" type="submit">Seguir</button>
            </form>
          </div>

          <div class="avaliar">
            <h2>Sua avaliação: </h2>
            <form method="post" action="/avaliacoes/src/forms/avaliar.php">
              <label for="nota">
                Nota
                <input type="number" name="nota" id="nota">
              </label>
              <label for="descricao">
                Descrição
                <input type="text" name="descricao" id="descricao">
              </label>
              <input type="hidden" name="empresa-id" id="empresa-id" value="<?= $empresa->id ?>">
              <button type="submit">Enviar</button>
            </form>
          </div>

          <div class="avaliacoes">
            <?php foreach ($avaliacoes as $avaliacao): ?>
              <h2><?= $avaliacao["usuario"] ?> <?= $avaliacao["avaliacao"]->nota ?></h2>
              <?= $avaliacao["avaliacao"]->comentario ?>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="images-container">
          <?php foreach ($imagens as $imagem): ?>
            <img src="<?= $imagem->caminho ?>" alt="Imagem">
          <?php endforeach; ?>
        </div>

        </main>
      </section>
  </div>
</body>

</html>