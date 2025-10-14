<?php

require_once __DIR__ . "\Usuario.php";
require_once __DIR__ . "\..\config\bd\MySQL.php";

class Empresa
{
    public int $id;

    public string $idUsuario;
    public string $idEndereco;

    public function __construct(public string $nome = "")
    {
        session_start();
        $usuario = $_SESSION["user"];
        $this->idUsuario = $usuario["id"];
    }
    public function save(): bool
    {
        $conexao = new MySQL();
        if (isset($this->id)) {
            $sql = "UPDATE empresa SET nome = '{$this->nome}' ,idUsuario = '{$this->idUsuario}',
            idEndereco = '{$this->idEndereco}' WHERE id = {$this->id}";
        } else {
            $sql = "INSERT INTO empresa (nome, idUsuario, idEndereco) VALUES ('{$this->nome}', '{$this->idUsuario}', '{$this->idEndereco}')";
        }
        return $conexao->executa($sql);
    }


    public static function find($id): Empresa
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM empresa WHERE id = {$id}";
        $resultado = $conexao->consulta($sql);
        $u = new empresa($resultado[0]['nome'], $resultado[0]['idUsuario'], $resultado[0]['idEndereco']);
        $u->id = $resultado[0]['id'];
        return $u;
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
