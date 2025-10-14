<?php
require_once __DIR__ . "/Endereco.php";
require_once __DIR__ . "/../validator.php";

class ValidadorEndereco extends Validador
{
  public $erro_rua = "";
  public $erro_numero = "";
  public $erro_cidade = "";
  public $erro_cep = "";
  public $erro_estado = "";
  public $erro_pais = "";

  public function __construct(private Endereco $endereco = new Endereco()) {}

  public function validar()
  {

    $this->validar_rua();
    $this->validar_numero();
    $this->validar_cidade();
    $this->validar_cep();
    $this->validar_estado();
    $this->validar_pais();

  }

  private function validar_rua()
  {
    $rua = $this->endereco->rua;
    $this->validate_range($rua, "rua", $this->erro_rua);
  }

  private function validar_numero()
  {
    $numero = $this->endereco->numero;
    $this->validate_int($numero, "numero", $this->erro_numero);
  }

    private function validar_cidade()
  {
    $cidade = $this->endereco->cidade;
    $this->validate_range($cidade, "cidade", $this->erro_cidade);
  }
    private function validar_cep()
  {
        $cep = $this->endereco->cep;
      if (!$cep) {
      $erro = "O campo CEP é obrigatório.";
      $this->valido = false;
    } else if (strlen($cep) != 9) {
      $erro = "O campo CEP deve ter 9 dígitos e deve ter padrão: xxxxx-xxx.";
      $this->valido = false;
    }
  }

  private function validar_estado()
  {
    $estado = $this->endereco->estado;
    $this->validate_range($estado, "estado", $this->erro_estado);
  }

    private function validar_pais()
  {
    $pais = $this->endereco->pais;
    $this->validate_range($pais, "pais", $this->erro_pais);
  }

}