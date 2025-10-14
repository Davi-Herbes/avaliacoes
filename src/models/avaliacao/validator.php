<?php
require_once __DIR__ . "/Avaliacao.php";
require_once __DIR__ . "/../validator.php";

class ValidadorAvaliacao extends Validador
{
  public $erro_nota = "";
  public $erro_comentario = "";
  

  public function __construct(private Avaliacao $avaliacao = new Avaliacao ()) {}

  public function validar()
  {

    $this->validar_nota();
    $this->validar_comentario();
  }

  private function validar_nota()
  {
    $nota = $this->avaliacao->nota;

    if(gettype($nota) !== "int") {
      $this->erro_nota = "O campo Nota deve ser um número inteiro.";
      $this->valido = false;
    }

    if($nota > 10 || $nota < 0) {
      $this->erro_nota = "O campo Nota deve conter números de 0 a 10.";
      $this->valido = false;
    }
  }

  private function validar_comentario()
  {
    $comentario = $this->avaliacao->comentario;

    $this->validate_range($comentario, "Comentário", $this->erro_comentario);
  }
}