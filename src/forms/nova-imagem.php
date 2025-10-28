<?php
require_once __DIR__ . "/../models/imagens_empresa/imagens_empresa.php";
require_once __DIR__ . "/../utils/navegar.php";


$pasta_upload = __DIR__ . "/../../uploads/";


if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

  $idEmpresa = $_POST["idEmpresa"];
  $idEmpresa = $idEmpresa !== null  && $idEmpresa !== "" ? (int)$idEmpresa : null;

  $nome_arquivo = $_FILES['file']['name'];
  $arquivo_tmp = $_FILES['file']['tmp_name'];

$nome_arquivo_upado = time() . '_' . basename($nome_arquivo);
$caminho = "/avaliacoes/uploads/".$nome_arquivo_upado;
  // Caminho final do arquivo
  $destino = $pasta_upload . $nome_arquivo_upado;

  // Move o arquivo da pasta temporária para a pasta final
  if (move_uploaded_file($arquivo_tmp, $destino)) {
    $imagens_empresa = new ImagensEmpresa($destino, "", $nome_arquivo, $idEmpresa);
    $imagem_id = $imagens_empresa->save();

    if (!$imagem_id) {
      navegar("/avaliacoes/pages/sua_empresa?erro_nova_imagem");
    }

    navegar("/avaliacoes/pages/sua_empresa");
  } else {
    navegar("/avaliacoes/pages/sua_empresa?erro_nova_imagem");
  }
} else {
  navegar("/avaliacoes/pages/sua_empresa?erro_nova_imagem");
}
