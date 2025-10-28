<?php

require_once __DIR__ . "/../../config/db/MySQL.php";

require_once __DIR__ . "/validator.php";

class Endereco
{
  public int $id;

  public function __construct(
    public string $rua = "",
    public int|null $numero = null,
    public string $cidade = "",
    public string $cep = "",
    public string $estado = "",
    public string $pais = ""
  ) {}

  public function save(): bool
  {
    $conexao = new MySQL();

    $numero = is_null($this->numero) ? 'NULL' : "'{$this->numero}'";
    if (isset($this->id)) {
      $sql = "UPDATE endereco SET rua = '{$this->rua}', numero = {$numero}, cidade = '{$this->cidade}', cep = '{$this->cep}', estado = '{$this->estado}',
             pais = '{$this->pais}' WHERE id = $this->id;";
    } else {
      $sql = "INSERT INTO endereco (rua, numero, cidade, cep, estado, pais) VALUES ('{$this->rua}','{$numero}','{$this->cidade}' ,'{$this->cep}','{$this->estado}',
             '{$this->pais}')";
    }
    return $conexao->executa($sql);
  }

  public static function find($id): Endereco|null
  {
    if (!$id) {
      return null;
    }

    $conexao = new MySQL();
    $sql = "SELECT * FROM endereco WHERE id = {$id}";
    $resultado = $conexao->consulta($sql);

    $u = new Endereco($resultado[0]['rua'], $resultado[0]['numero'], $resultado[0]['cidade'], $resultado[0]['cep'], $resultado[0]['estado'], $resultado[0]['pais']);
    $u->id = $resultado[0]['id'];
    return $u;
  }



  public static function delete($id)
  {
    $conexao = new MySQL();
    $sql = "DELETE FROM endereco WHERE id = {$id}";
    $resultado = $conexao->executa($sql);
    return $resultado;
  }

  /*
    public function authenticate(): bool
    {
        $conexao = new MySQL();
        $sql = "SELECT idUsuario,senha FROM usuarios WHERE email = '{$this->email}'";
        $resultados = $conexao->consulta($sql);
        if (password_verify($this->senha, $resultados[0]['senha'])) {
            session_start();
            $_SESSION['idUsuario'] = $resultados[0]['idUsuario'];
            $_SESSION['email'] = $resultados[0]['email'];
            return true;
        } else {
            return false;
        }
    } */
}
