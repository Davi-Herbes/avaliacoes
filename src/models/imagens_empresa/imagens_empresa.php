<?php

require_once __DIR__ . "\..\config\bd\MySQL.php";

class ImagemsEmpresa
{

    public int $id;

    public function __construct(public string $caminho, public string $extensao, public string $nome, public int $idEmpresa) {}

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
        $sql = "DELETE FROM imagens_empresa WHERE id = {$id}";
        $resultado = $conexao->executa($sql);
        return $resultado;
    }

    /* public static function find($idUsuario): Usuario
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuarios WHERE idUsuario = {$idUsuario}";
        $resultado = $conexao->consulta($sql);
        $u = new Usuario($resultado[0]['email'], $resultado[0]['senha']);
        $u->setIdUsuario($resultado[0]['idUsuario']);
        return $u;
    }

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
