<?php

require_once __DIR__ . "/../usuario/Usuario.php";
require_once __DIR__ . "/../../config/db/MySQL.php";
require_once __DIR__ . "/../imagens_empresa/imagens_empresa.php";

class Empresa
{
    public int $id;

    public function __construct(public string $nome = "", public int $idUsuario, public int $idEndereco = 1)
    {
        session_start();
        $user = $_SESSION["user"];
        $this->idUsuario = $user->id;
    }

    public function save(): bool
    {
        $conexao = new MySQL();
        if (isset($this->id)) {
            $sql = "UPDATE empresa SET nome = '{$this->nome}' ,idUsuario = {$this->idUsuario},
            idEndereco = {$this->idEndereco} WHERE id = {$this->id}";
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
        $u = new Empresa($resultado[0]['nome'], $resultado[0]['idUsuario'], $resultado[0]['idEndereco']);
        $u->id = $resultado[0]['id'];
        return $u;
    }


    public static function searchByName(string $name): array
    {
        $conexao = new MySQL();
        $sql = "SELECT e.*, ie.id, ie.nome, ie.caminho, ie.extensao, ie.idEmpresa,
        FROM empresa e
        JOIN imagens_empresa ie ON ie.empresaId = e.id
        WHERE nome LIKE '%$name%';";
        $empresas_raw = $conexao->consulta($sql);

        $empresas = [];

        foreach($empresas_raw as $empresa_raw) {
            $empresa_id = $empresa_raw["id"];

            $empresa = new Empresa($empresa_raw['nome'], $empresa_raw['idUsuario'], $empresa_raw['idEndereco']);
            $empresa->id =  $empresa_id;

            if(!isset($empresas[$empresa_id])) {
                $empresas[$empresa_id]["empresa"] = $empresa;
            }

            // string $caminho,
            // string $extensao,
            // string $nome,
            // int $idEmpresa

            $empresas[$empresa_id]["imagens"][] = new ImagensEmpresa($empresa_raw["caminho"], $empresa_raw["extensao"], $empresa_raw["nome"], $empresa_raw["idEmpresa"]);
        ;}

        return $empresas;
    }


    public static function findEmpresaByIdUsuario($idUsuario): Empresa
{
    $conexao = new MySQL();
    $sql = "SELECT * FROM empresa WHERE idUsuario = {$idUsuario}";
    $resultado = $conexao->consulta($sql);

    if (empty($resultado)) {
        throw new Exception("Nenhuma empresa encontrada para o usuário ID {$idUsuario}");
    }

    $u = new Empresa($resultado[0]['nome'], $resultado[0]['idUsuario'], $resultado[0]['idEndereco']);
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
