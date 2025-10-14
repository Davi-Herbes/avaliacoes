<?php
require_once __DIR__ . "/Usuario.php";
require_once __DIR__ . "/../validator.php";

class ValidadorCadastro extends Validador
{
  public $erro_nome = "";
  public $erro_email = "";
  public $erro_senha = "";

  public function __construct(private Usuario $usuario = new Usuario()) {}

  public function validar()
  {

    $this->validar_nome();
    $this->validar_email();
    $this->validar_senha();
  }

  public function erro_generico()
  {
    $this->erro_senha = "Algo deu errado ao cadastrar usuário.";
  }

  private function validar_nome()
  {
    $nome = $this->usuario->nome;
    $this->validate_range($nome, "Nome", $this->erro_nome);
  }

  private function validar_email()
  {
    $email = $this->usuario->email;

    $this->validate_email($email, "E-mail", $this->erro_email);
    $this->validate_range($email, "E-mail", $this->erro_email);
  }


  private function validar_senha()
  {
    $senha = $this->usuario->senha;

    $this->validate_range($senha, "Senha", $this->erro_senha);
  }

}