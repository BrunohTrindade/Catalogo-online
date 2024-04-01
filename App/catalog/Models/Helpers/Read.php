<?php

namespace Catalog\Models\Helpers;

use PDO;
use Exception;
use App\Catalog\Models\Helpers\Conn;

class Read extends Conn
{

  private array | null   $result = [];
  private array  $values = [];
  private string $select;
  private object $query;
  private object $conn;

  function getResult(): array | null
  {
    return $this->result;
  }

  function exeRead(string $column, string $table, string | null $terms = null, string | null $parseString = null)
  {
    if (!empty($parseString)) {
      parse_str($parseString, $this->values);
    }

    $this->select = "SELECT {$column} FROM {$table} {$terms}";
    $this->exeInstruction();
  }

  function fullRead(string $query, string | null $parseString = null): void
  {

    $this->select = $query;

    if(!empty($parseString))
    {
      parse_str($parseString, $this->values);
    }

    $this->exeInstruction();
  }

  function exeInstruction()
  {
    $this->exeConnect();
    try {
      $this->exeParameter();
      $this->query->execute();
      $this->result = $this->query->fetchall();
    } catch (Exception $e) {
      $this->result = null;
    }
  }

  function exeConnect()
  {
    $this->conn = $this->connectDb();
    $this->query = $this->conn->prepare($this->select);
    $this->query->setFetchMode(\PDO::FETCH_ASSOC);
  }
  function exeParameter()
  {
    if ($this->values) {
      foreach ($this->values as $key => $value) {
        if ($key == 'limit' || $value == 'offset') {
          $value = (int)$value;
        }
        $this->query->bindValue(":{$key}", $value, is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
      }
    }
  }
}
