<?php

require_once __DIR__ . "/../../config/db/MySQL.php";

class ImagensEmpresa
{

  public int $id;

  public function __construct(public ?string $caminho = "", public ?string $extensao = "", public ?string $nome = "", public ?int $idEmpresa) {}

  public function save(): bool
  {
    $conexao = new MySQL();
    if (isset($this->id)) {
      $sql = "UPDATE imagens_empresa SET caminho = '{$this->caminho}' ,extensao = '{$this->extensao}', nome = '{$this->nome}', idEmpresa = '{$this->idEmpresa}'  WHERE id = {$this->id}";
    } else {
      $sql = "INSERT INTO imagens_empresa (caminho, extensao, nome, idEmpresa) VALUES ('{$this->caminho}','{$this->extensao}', '{$this->nome}', '{$this->idEmpresa}')";
    }
    return $conexao->executa($sql);
  }

  public static function delete($id)
  {
    $conexao = new MySQL();
    $sql = "DELETE FROM imagens_empresa WHERE id = $id;";
    $resultado = $conexao->executa($sql);
    return $resultado;
  }

  public static function findByEmpresaId($id)
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM imagens_empresa WHERE idEmpresa = {$id}";
    $items = $conexao->consulta($sql);

    if (!$items) {
      return [];
    }

    $result = [];
    foreach ($items as $item) {
      $imagem = new ImagensEmpresa($item["caminho"], $item["extensao"], $item["nome"], $item["idEmpresa"]);
      $imagem->id = $item["id"];
      $result[] = $imagem;
    }

    return $result;
  }
}
