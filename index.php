<?php
require_once __DIR__ . "/src/utils/user_required.php";
user_required();

$user = $_SESSION["user"];

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
            <h1 class="home-title">R8</h1>
            <nav class="home-nav">
                <ul>
                    <li>
                        <a href="/avaliacoes/pages/">Logout</a>
                    </li>
                </ul>
            </nav>
        </header>
        <section class="home-section">
            <h2>Bem vindo(a) <?php echo $user->nome?></h2>
        </section>
    </div>
</body>

</html>