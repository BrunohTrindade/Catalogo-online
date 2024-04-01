<?php

namespace App\Catalog\Models\Helpers;

use Exception;

abstract class Conn
{
  private string $host = HOST;
  private string $user = USER;
  private string $pass = PASS;
  private string $dbname = DBNAME; 
  private int $port;
  private object $connect;

  public function connectDb(): object
  {
    try {
      $this->connect = new \PDO("mysql:host={$this->host};dbname=" . $this->dbname, $this->user, $this->pass);

      return $this->connect;
    } catch (Exception $e) {
      die("Erro por favor, entre em contato: " .$e->getMessage());
    }
  }
}
