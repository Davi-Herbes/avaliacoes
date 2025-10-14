<?php
require_once __DIR__ . "/Empresa.php";
require_once __DIR__ . "/../validator.php";

class ValidadorEmpresa extends Validador
{
  public $erro_nome = "";

  public function __construct(private Empresa $empresa = new Empresa()) {}

  public function validar()
  {
    $this->validar_nome();
  }

  public function erro_generico()
  {
    $this->erro_nome = "Algo deu errado ao cadastrar a empresa.";
  }

  private function validar_nome()
  {
    $nome = $this->empresa->nome;
    $this->validate_range($nome, "Nome", $this->erro_nome);
  }

}