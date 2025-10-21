<?php

require_once __DIR__ . "/../usuario/Usuario.php";
require_once __DIR__ . "/../../config/db/MySQL.php";

class Seguidores
{

    public int $id;
    public int $idUsuario;

    public function __construct(public int $idEmpresa)
    {
        session_start();
        $usuario = $_SESSION["user"];
        $this->idUsuario = $usuario["id"];
    }
    public function save(): bool
    {
        $conexao = new MySQL();
        if (isset($this->id)) {
            $sql = "UPDATE seguidores SET idUsuario = '{$this->idUsuario}', idEmpresa = '{$this->idEmpresa}' WHERE id = {$this->id}";
        } else {
            $sql = "INSERT INTO Seguidores (idUsuario, idEmpresa) VALUES ('{$this->idUsuario}', '{$this->idEmpresa}')";
        }
        return $conexao->executa($sql);
    }


    // $seguidores = Seguidores::findAllByUserID();
    public static function findAllByUserID(string $idUsuario)
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM seguidores WHERE idUsuario = {$idUsuario} JOIN empresa e ON e.idUsuario = {$idUsuario};";
        $resultado = $conexao->consulta($sql);
        $u = new seguidores($resultado[0]['idUsuario'], $resultado[0]['idEmpresa']);
        $u->id = $resultado[0]['id'];
        return $u;
    }

    public static function delete($id)
    {
        $conexao = new MySQL();
        $sql = "DELETE FROM seguidores WHERE id = {$id}";
        $resultado = $conexao->executa($sql);
        return $resultado;
    }
}
