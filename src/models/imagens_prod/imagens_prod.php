<?php

require_once __DIR__ . "\..\config\bd\MySQL.php";

class imagens_prod
{

    public int $id;

    public function __construct(public string $caminho, public string $extensao,  public int $idProduto, public string $nome) {}

    public function save(): bool
    {
        $conexao = new MySQL();
        if (isset($this->id)) {
            $sql = "UPDATE imagens_prod
         SET caminho = '{$this->caminho}' ,extensao = '{$this->extensao}',idProduto = '{$this->idProduto}',
            nome = '{$this->nome}' WHERE id = {$this->id}";
        } else {
            $sql = "INSERT INTO imagens_prod
         (caminho,extensao,idProduto,nome) VALUES ('{$this->caminho}','{$this->extensao}','{$this->idProduto}','{$this->nome}')";
        }
        return $conexao->executa($sql);
    }

    public static function delete($id)
    {
        $conexao = new MySQL();
        $sql = "DELETE FROM imagens_prod WHERE id = {$id}";
        $resultado = $conexao->executa($sql);
        return $resultado;
    }

    /*
    public static function find($id): Usuario
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM imagens_prod
     WHERE id = {$id}";
        $resultado = $conexao->consulta($sql);
        $u = new Usuario($resultado[0]['caminho'], $resultado[0]['extensao']);
        $u->setid($resultado[0]['id']);
        return $u;
    }

    public function authenticate(): bool
    {
        $conexao = new MySQL();
        $sql = "SELECT id,extensao FROM imagens_prod
     WHERE caminho = '{$this->caminho}'";
        $resultados = $conexao->consulta($sql);
        if (password_verify($this->extensao, $resultados[0]['extensao'])) {
            session_start();
            $_SESSION['id'] = $resultados[0]['id'];
            $_SESSION['caminho'] = $resultados[0]['caminho'];
            return true;
        } else {
            return false;
        }
    } */
}
