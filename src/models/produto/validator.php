<?php
require_once __DIR__ . "/Produto.php";
require_once __DIR__ . "/../validator.php";

class ValidadorProduto extends Validador
{
  public $erro_nome = "";
  public $erro_descricao = "";

  public function __construct(private Produto $produto = new Produto()) {}

  public function validar()
  {

    $this->validar_nome();
    $this->validar_descricao();

  }

  private function validar_nome()
  {
    $nome = $this->produto->nome;
    $this->validate_range($nome, "nome", $this->erro_nome);
  }

    private function validar_descricao()
  {
    $descricao = $this->produto->descricao;
    $this->validate_range($descricao, "descricao", $this->erro_descricao);
  }

}