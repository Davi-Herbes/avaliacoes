<?php

require_once __DIR__ . "/../usuario/Usuario.php";
require_once __DIR__ . "/validator.php";
require_once __DIR__ . "/../../config/db/MySQL.php";
require_once __DIR__ . "/../imagens_empresa/imagens_empresa.php";

class Empresa
{
  public int $id;
  public float $avaliacao_media = 0;

  public function __construct(public ?string $nome = "", public ?int $idUsuario, public ?int $idEndereco)
  {
    $user = $_SESSION["user"];
    $this->idUsuario = $user->id;
  }

  public function save(): bool
  {
    $conexao = new MySQL();
    if (isset($this->id)) {
      $sql = "UPDATE empresa SET nome = '{$this->nome}' ,idUsuario = {$this->idUsuario},
            IdEndereco = {$this->idEndereco}, avaliacao_media = {$this->avaliacao_media} WHERE id = {$this->id}";
    } else {
      $sql = "INSERT INTO empresa (nome, idUsuario, IdEndereco, avaliacao_media) VALUES ('{$this->nome}', '{$this->idUsuario}', '{$this->idEndereco}', '{$this->avaliacao_media}')";
    }
    return $conexao->executa($sql);
  }

  public static function find($id): Empresa
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM empresa WHERE id = {$id}";
    $resultado = $conexao->consulta($sql);
    $u = new Empresa($resultado[0]['nome'], $resultado[0]['idUsuario'], $resultado[0]['IdEndereco']);
    $u->avaliacao_media = $resultado[0]['avaliacao_media'];
    $u->id = $resultado[0]['id'];
    return $u;
  }


  public static function searchByName(string $name): array
  {
    $conexao = new MySQL();
    $sql = "SELECT e.*, ie.id as ie_id, ie.nome as ie_nome, ie.caminho as ie_caminho, ie.extensao as ie_extensao, ie.idEmpresa as ie_idEmpresa
        FROM empresa e
        LEFT JOIN imagens_empresa ie ON ie.idEmpresa = e.id
        WHERE e.nome LIKE '%$name%';";
    $empresas_raw = $conexao->consulta($sql);

    $empresas = [];

    foreach ($empresas_raw as $empresa_raw) {
      $empresa_id = $empresa_raw["id"];



      if (!isset($empresas[$empresa_id])) {
        var_dump($empresa_raw);
        $empresa = new Empresa($empresa_raw["nome"], $empresa_raw["idUsuario"], $empresa_raw["IdEndereco"]);
        $empresa->id =  $empresa_id;
        $empresa->avaliacao_media =  $empresa_raw["avaliacao_media"];
        $empresas[$empresa_id]["empresa"] = $empresa;
      }

      $empresas[$empresa_id]["imagens"][] = new ImagensEmpresa($empresa_raw["ie_caminho"], $empresa_raw["ie_extensao"], $empresa_raw["ie_nome"], $empresa_raw["ie_idEmpresa"]);
    }

    return $empresas;
  }


  public static function findEmpresaByIdUsuario($idUsuario): Empresa
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM empresa WHERE idUsuario = $idUsuario";
    $resultado = $conexao->consulta($sql);

    if (empty($resultado)) {
      throw new Exception("Nenhuma empresa encontrada para o usuário ID {$idUsuario}");
    }

    $u = new Empresa($resultado[0]['nome'], (int) $resultado[0]['idUsuario'], (int) $resultado[0]['IdEndereco']);
    $u->id = $resultado[0]['id'];
    $u->avaliacao_media = $resultado[0]['avaliacao_media'];
    return $u;
  }

  public static function findEmpresasByIdUsuario($idUsuario)
  {
    $conexao = new MySQL();

    $sql = "
        SELECT s.*, e.nome AS nomeEmpresa
        FROM seguidores s
        JOIN empresa e ON s.idEmpresa = e.id
        WHERE s.idUsuario = {$idUsuario};
    ";

    $resultado = $conexao->consulta($sql);

    $empresas = [];

    foreach ($resultado as $linha) {
      $u = new Empresa($linha['nome'], $linha['idUsuario'], $linha['idEndereco']);
      $u->id = $linha['id'];
      $u->avaliacao_media = $resultado[0]['avaliacao_media'];
      $empresas[] = $u;
    }

    return $empresas;
  }


  public static function delete($id)
  {
    $conexao = new MySQL();
    $sql = "DELETE FROM empresa WHERE id = {$id}";
    $resultado = $conexao->executa($sql);
    return $resultado;
  }

  /*
    public function authenticate(): bool
    {
        $conexao = new MySQL();
        $sql = "SELECT idUsuario,senha FROM usuarios WHERE nom = '{$this->nom}'";
        $resultados = $conexao->consulta($sql);
        if (password_verify($this->senha, $resultados[0]['senha'])) {
            session_start();
            $_SESSION['idUsuario'] = $resultados[0]['idUsuario'];
            $_SESSION['nome'] = $resultados[0]['nome'];
            return true;
        } else {
            return false;
        }
    } */
}
