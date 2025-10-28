<?php
require_once __DIR__ . "/src/utils/user_required.php";
require_once __DIR__ . "/src/models/empresa/Empresa.php";

// user_required();

// $user = $_SESSION["user"];

session_start();

$empresas = $_SESSION["empresas"] ?? [];

if (isset($_SESSION["empresas"])) {
  unset($_SESSION["empresas"]);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buscar</title>
  <link rel="stylesheet" href="/avaliacoes/public/home.css">
  <link rel="stylesheet" href="/avaliacoes/pages/buscar/styles.css">
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
            <!-- <li>
              <a href="/avaliacoes/">
                <figure>
                  <img src="/avaliacoes/public/images/home-icon.svg" alt="Ícone seguindo">
                  <figcaption>Seguindo</figcaption>
                </figure>
              </a>
            </li> -->
            <li class="selected">
              <a href="/avaliacoes//">
                <figure>
                  <img src="/avaliacoes/public/images/search.svg" alt="Ícone busca">
                  <figcaption>Buscar empresas</figcaption>
                </figure>
              </a>
            </li>
            <li>
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
      <?php

      ?>
      <section class="search-section">
        <div class="search-form-container">
          <form action="/avaliacoes/src/forms/search.php" class="search-form" method="POST">
            <label for="search-input">
              <input name="nome" type="text" placeholder="Pesquisar" id="search-input">
              <button type="submit">
                <img src="/avaliacoes/public/images/search.svg" alt="Lupa">
              </button>
            </label>
          </form>
        </div>

        <div class="results-container">
          <?php foreach ($empresas as $empresa): ?>
            <a href="/avaliacoes/pages/empresa?id=<?= $empresa["empresa"]->id ?>" class="empresa-card">
              <div class="card-header">
                <h2><?= $empresa["empresa"]->nome ?></h2>
                <span class="avaliacao"><?= $empresa["empresa"]->avaliacao_media ?></span><span class="avaliacao-maxima">/10<span>
              </div>
              <div class="card-images">
                <img src="<?= $empresa["imagens"][0]->caminho ?>" alt="Imagem empresa">
              </div>
            </a>
          <?php endforeach; ?>

        </div>

      </section>
    </section>
  </div>
</body>

</html>