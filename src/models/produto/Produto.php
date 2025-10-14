<?php

require_once __DIR__ . "\..\config\bd\MySQL.php";

class Produto
{
    public int $id;

    public function __construct(public string $nome = "", public string $descricao = "", public int $idEmpresa = 0) {}

    public function save(): bool
    {
        $conexao = new MySQL();
        if (isset($this->id)) {
            $sql = "UPDATE Produto SET nome = '{$this->nome}' ,descricao = '{$this->descricao}',
            idEmpresa = '{$this->idEmpresa}' WHERE id = {$this->id}";
        } else {
            $sql = "INSERT INTO Produto (nome,descricao,idEmpresa) VALUES ('{$this->nome}','{$this->descricao}','{$this->idEmpresa}')";
        }
        return $conexao->executa($sql);
    }

    public static function delete($id)
    {
        $conexao = new MySQL();
        $sql = "DELETE FROM produto WHERE id = {$id}";
        $resultado = $conexao->executa($sql);
        return $resultado;
    }

    public static function find($id): Produto
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM produto WHERE id = {$id}";
        $resultado = $conexao->consulta($sql);
        $u = new Produto($resultado[0]['nome'], $resultado[0]['descricao'], $resultado[0]['idEmpresa']);
        $u->id = $resultado[0]['id'];
        return $u;
    }

    /*public function authenticate(): bool
    {
        $conexao = new MySQL();
        $sql = "SELECT idUsuario,descricao FROM usuarios WHERE nome = '{$this->nome}'";
        $resultados = $conexao->consulta($sql);
        if (password_verify($this->descricao, $resultados[0]['descricao'])) {
            session_start();
            $_SESSION['idUsuario'] = $resultados[0]['idUsuario'];
            $_SESSION['nome'] = $resultados[0]['nome'];
            return true;
        } else {
            return false;
        }
    } */
}
