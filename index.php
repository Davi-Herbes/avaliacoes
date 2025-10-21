<?php
require_once __DIR__ . "/src/utils/user_required.php";
require_once __DIR__ . "/src/models/seguidores/seguidores.php";
user_required();

$user = $_SESSION["user"];
$seguidores = Seguidores::findAllByUserID(3);

// var_dump($seguidores);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
            <li class="selected">
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
      <main class="home-main">
        <h1>Seguindo</h1>
        <main class="home-main">
          <h1>Seguindo</h1>

          <?php if (empty($seguidores)): ?>
            <p>Você não está seguindo nenhuma empresa.</p>
          <?php else: ?>
            <ul>
              <?php foreach ($seguidores as $seguidor): ?>
                <li>
                  Empresa ID: <?= htmlspecialchars($seguidor->idEmpresa) ?> - Seguidor ID: <?= htmlspecialchars($seguidor->id) ?>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

        </main>

      </main>
    </section>
  </div>
</body>

</html>