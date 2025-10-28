<?php
require_once __DIR__ . "/../../src/utils/user_required.php";
require_once __DIR__ . "/../../src/models/empresa/Empresa.php";
require_once __DIR__ . "/../../src/models/endereco/Endereco.php";

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
<<<<<<< HEAD
        <p>ID do usuário: <?= $user_id ?></p>
        <p>Nome da empresa: <?= $empresa->nome ?></p>
        <p>ID do endereço: <?= $empresa->idEndereco ?></p>
        <p>ID da empresa: <?= $empresa->id ?></p>
=======

        
        <!-- <p>ID do usuário: <?= $user_id ?></p> -->
        <p>Nome do usuário: <?= $user->nome ?></p>
        <p>Email do usuário: <?= $user->email ?></p>
        <p>Nome da empresa: <?= $empresa->nome ?></p>
        <p>Rua da empresa: <?= $endereco->rua ?></p>
        <p>Número da empresa: <?= $endereco->numero ?></p>
        <p>Cidade da empresa: <?= $endereco->cidade ?></p>
        <p>Estado da empresa: <?= $endereco->estado ?></p>
        <p>CEP da empresa: <?= $endereco->cep ?></p>
        <p>País da empresa: <?= $endereco->pais ?></p>
        <!-- <p>ID do endereço: <?= $empresa->idEndereco ?></p> -->
        <!-- <p>ID da empresa: <?= $empresa->id ?></p> -->
>>>>>>> 35553ed (27102025)

      </main>
    </section>
  </div>
</body>

</html>