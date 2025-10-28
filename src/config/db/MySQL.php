<?php

require_once __DIR__ . "\Configuracao.php";

class MySQL
{

  public $connection;

  public function __construct()
  {
    mysqli_report(MYSQLI_REPORT_OFF);
    $this->connection = new \mysqli(HOST, USUARIO, SENHA, BANCO, 3306);
    $this->connection->set_charset("utf8");
  }

  public function executa($sql)
  {
    $result = $this->connection->query($sql);
    if(!$result) {
      return $result;
    };

    return $this->connection->insert_id;
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
