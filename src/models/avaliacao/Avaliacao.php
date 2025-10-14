<?php

require_once __DIR__ . "\Usuario.php";
require_once __DIR__ . "\..\config\bd\MySQL.php";

class Avaliacao
{

    public int $id;
    public int $idUsuario;

    public function __construct(public string $nota = "",  public string $comentario = "", public string $idProduto = "")
    {
        session_start();
        $usuario = $_SESSION["user"];
        $this->idUsuario = $usuario["id"];
    }

    public function save(): bool
    {
        $conexao = new MySQL();
        if (isset($this->id)) {
            $sql = "UPDATE avaliacao SET idUsuario = '{$this->idUsuario}' , nota = '{$this->nota}', comentario = '{$this->comentario}', idProduto = '{$this->idProduto}' WHERE id = {$this->id}";
        } else {
            $sql = "INSERT INTO avaliacao (idUsuario, nota, comentario, idProduto)
             VALUES ('{$this->idUsuario}','{$this->nota}', '{$this->comentario}', '{$this->idProduto}')";
        }
        return $conexao->executa($sql);
    }

    public static function find($id): Avaliacao
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM avaliacao WHERE id = {$id}";
        $resultado = $conexao->consulta($sql);
        $u = new Avaliacao($resultado[0]['idUsuario'], $resultado[0]['nota'], $resultado[0]['comentario'], $resultado[0]['idProduto']);
        $u->id = $resultado[0]['idUsuario'];
        return $u;
    }

    public static function delete($id)
    {
        $conexao = new MySQL();
        $sql = "DELETE FROM avaliacao WHERE id = {$id}";
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
