<?php

namespace Adm\Models;

use Adm\Models\SQL\CATEGORY_SQL;
use Adm\Models\ValueObject\CategoryVo;
use App\Catalog\Models\Helpers\Conn;

class CategoryModel extends Conn
{

  private array $data;
  private object $stmt;
  private object $conn;

  public function __construct()
  {
    $this->conn = $this->connectDb();
  }

  public function category($id) {
    $this->stmt = $this->conn->prepare(CATEGORY_SQL::SELECT_CATEGORY());
    $this->stmt->bindValue(1, $id, \PDO::PARAM_INT);

    $this->stmt->execute();

    return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    // return CATEGORY_SQL::SELECT_CATEGORY();
  }

  public function getAllCategory(int $page, array $filters)
  {
    $offset = ($page - 1) * ITEMS_PAGE;

    $this->stmt = $this->conn->prepare(CATEGORY_SQL::SELECT_ALL_CATEGORY($filters, $offset));
    // Vincular os parâmetros
    foreach ($filters as $key => $value) {
      $this->stmt->bindValue(":$key", $value);
    }

    $this->stmt->execute();

    return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);

    // return CATEGORY_SQL::SELECT_ALL_CATEGORY($filters,  $offset);
  }

  public function categoryListTotal(array $filters) {
    $this->stmt = $this->conn->prepare(CATEGORY_SQL::COUNT_ALL_CATEGORY($filters));
    // Vincular os parâmetros
    foreach ($filters as $key => $value) {
      $this->stmt->bindValue(":$key", $value);
    }

    $this->stmt->execute();

    return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function createCategory(CategoryVo $vo){
    
    $this->stmt = $this->conn->prepare(CATEGORY_SQL::INSERT_CATEGORY());
    $i = 1;
    $this->stmt->bindValue($i++, $vo->getName());
    $this->stmt->bindValue($i++, $vo->getDescription());
    $this->stmt->bindValue($i++, ($vo->getStatus() == '1' ? 1 : 0), \PDO::PARAM_INT);

    try {
      $this->stmt->execute();
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }

  public function updateCategory(CategoryVo $vo){
    
    $this->stmt = $this->conn->prepare(CATEGORY_SQL::UPDATE_CATEGORY());
    $i = 1;
    $this->stmt->bindValue($i++, $vo->getName());
    $this->stmt->bindValue($i++, $vo->getDescription());
    $this->stmt->bindValue($i++, ($vo->getStatus() == '1' ? 1 : 0), \PDO::PARAM_INT);
    $this->stmt->bindValue($i++, $vo->getId());

    try {
      $this->stmt->execute();
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }
}
