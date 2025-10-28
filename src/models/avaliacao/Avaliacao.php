<?php

require_once __DIR__ . "\Usuario.php";
require_once __DIR__ . "\..\config\db\MySQL.php";

class AvaliacaoEmpresa
{

    public int $id;
    public int $idUsuario;

    public function __construct(public int $nota,  public string $comentario = "", public int $idEmpresa)
    {
        session_start();
        $usuario = $_SESSION["user"];
        $this->idUsuario = $usuario["id"];
    }

    public function save(): bool
    {
        $conexao = new MySQL();
        if (isset($this->id)) {
            $sql = "UPDATE avaliacao_empresa SET idUsuario = {$this->idUsuario} , nota = {$this->nota}, comentario = '{$this->comentario}', id_empresa = {$this->idEmpresa} WHERE id = {$this->id}";
        } else {
            $sql = "INSERT INTO avaliacao_empresa (idUsuario, nota, comentario, id_empresa)
             VALUES ({$this->idUsuario},{$this->nota}, '{$this->comentario}', {$this->idEmpresa})";
        }
       return $conexao->executa($sql);
    }

    public static function find($id): AvaliacaoEmpresa
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM avaliacao_empresa WHERE id = {$id}";
        $resultado = $conexao->consulta($sql);
        $u = new AvaliacaoEmpresa($resultado[0]['idUsuario'], $resultado[0]['nota'], $resultado[0]['comentario'], $resultado[0]['id_empresa']);
        $u->id = $resultado[0]['idUsuario'];
        return $u;
    }

    public static function delete($id)
    {
        $conexao = new MySQL();
        $sql = "DELETE FROM avaliacao_empresa WHERE id = {$id}";
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
