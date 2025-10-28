<?php

require_once __DIR__ . "/../usuario/Usuario.php";
require_once __DIR__ . "/../../config/db/MySQL.php";

class AvaliacaoEmpresa
{

    public int $id;
    public int $idUsuario;

    public function __construct(public int $nota,  public string $comentario = "", public int $idEmpresa)
    {
        $usuario = $_SESSION["user"];
        $this->idUsuario = $usuario->id;
    }

    public function save(): bool
    {
        $conexao = new MySQL();
        if (isset($this->id)) {
            $sql = "UPDATE avaliacao_empresa SET idUsuario = {$this->idUsuario} , nota = {$this->nota}, comentario = '{$this->comentario}', idEmpresa = {$this->idEmpresa} WHERE id = {$this->id}";
        } else {
            $sql = "INSERT INTO avaliacao_empresa (idUsuario, nota, comentario, idEmpresa)
             VALUES ({$this->idUsuario},{$this->nota}, '{$this->comentario}', {$this->idEmpresa})";
        }
        return $conexao->executa($sql);
    }

    public static function find($id): AvaliacaoEmpresa
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM avaliacao_empresa WHERE id = {$id}";
        $resultado = $conexao->consulta($sql);
        $u = new AvaliacaoEmpresa($resultado[0]['idUsuario'], $resultado[0]['nota'], $resultado[0]['comentario'], $resultado[0]['idEmpresa']);
        $u->id = $resultado[0]['idUsuario'];
        return $u;
    }

    public static function findByEmpresaId($id)
    {
        $conexao = new MySQL();
        $sql = "SELECT *, u.nome FROM avaliacao_empresa a JOIN usuario u ON u.id = a.idUsuario WHERE idEmpresa = {$id}";
        $items = $conexao->consulta($sql);

        if (!$items) {
            return [];
        }

        $result = [];
        foreach ($items as $item) {
            $avaliacao = new AvaliacaoEmpresa($item["nota"], $item["comentario"], $item["idEmpresa"]);
            $avaliacao->id = $item["id"];
            $result[$item["id"]] = [];
            $result[$item["id"]]["avaliacao"] = $avaliacao;
            $result[$item["id"]]["usuario"] = $item["nome"];
        }

        return $result;
    }

    public static function delete($id)
    {
        $conexao = new MySQL();
        $sql = "DELETE FROM avaliacao_empresa WHERE idUsuario = {$id}";
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
