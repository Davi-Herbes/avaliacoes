<?php

require_once __DIR__ . "\..\..\config\db\MySQL.php";

class Usuario
{

  public int $id;

  public function __construct(public string $email = "", public string $senha = "", public string $nome = "", public string $foto = "") {}

  public function save()
  {
    $conexao = new MySQL();
    $this->senha = password_hash($this->senha, PASSWORD_BCRYPT);
    if (isset($this->id)) {
      $sql = "UPDATE usuario SET nome = '{$this->nome}' ,email = '{$this->email}' ,senha = '{$this->senha}', foto = '{$this->foto}' WHERE id = {$this->id}";
    } else {
      $sql = "INSERT INTO usuario (email,senha, nome, foto) VALUES ('{$this->email}','{$this->senha}', '{$this->nome}', '{$this->foto}')";
    }
    return $conexao->executa($sql);
  }

  public static function usuarioFromConsulta($resultado): Usuario
  {
    $u = new Usuario($resultado[0]['email'], $resultado[0]['senha'], $resultado[0]['nome'], $resultado[0]['foto']);
    $u->id = $resultado[0]['id'];
    return $u;
  }

  public static function find($id): Usuario
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM usuario WHERE id = {$id}";
    $resultado = $conexao->consulta($sql);

    return Usuario::usuarioFromConsulta($resultado);
  }

  public static function findByEmail($email): Usuario | bool
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM usuario WHERE email = '$email';";
    $resultado = $conexao->consulta($sql);

    if (!$resultado) {
      return false;
    }

    return Usuario::usuarioFromConsulta($resultado);
  }

  public static function validar_login($email, $senha): bool | Usuario
  {
    $usuario = Usuario::findByEmail($email);

    if (password_verify($senha, $usuario->senha)) {
      return $usuario;
    } else {
      return false;
    }
  }
}
