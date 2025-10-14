<?php

require_once __DIR__ . "\Configuracao.php";

class MySQL
{

  private $connection;

  public function __construct()
  {
    $this->connection = new \mysqli(HOST, USUARIO, SENHA, BANCO, 3307);
    $this->connection->set_charset("utf8");
    mysqli_report(MYSQLI_REPORT_OFF);
  }

  public function executa($sql)
  {
    $result = $this->connection->query($sql);
    return $result;
  }
  public function consulta($sql)
  {
    $result = $this->connection->query($sql);
    $data = array();
    while ($item = mysqli_fetch_array($result)) {
      $data[] = $item;
    }
    return $data;
  }
}
