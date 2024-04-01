<?php

namespace Catalog\Models;

use App\Catalog\Models\Helpers\Conn;
use Catalog\Models\Helpers\Read;
use Catalog\Models\SQL\PRODUCT_SQL;

class ShopModel extends Conn
{

  private array | null $data;
  private object $loadView;
  private object $conn;
  private object $stmt;

  public function __construct() 
  {
    $this->conn = $this->connectDb();
  }

  public function index($param = "", $page)
  {
    $offset = ($page - 1) * ITEMS_PAGE;
    
    $this->stmt = $this->conn->prepare(PRODUCT_SQL::SELECT_ALL_CATEGORY());
    $this->stmt->bindValue(":status", ACTIVE);
    $this->stmt->execute();

    $this->data['category'] = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);

    if ($param != "") {


      $this->stmt = $this->conn->prepare(PRODUCT_SQL::COUNT_PRODUCTS_CATEGORY());
      $this->stmt->bindValue(":status", ACTIVE);
      $this->stmt->bindValue(":category_id", $param);
      $this->stmt->execute();

      $this->data['total'] = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);

      $this->stmt = $this->conn->prepare(PRODUCT_SQL::SELECT_PRODUCTS_CATEGORY($offset));
      $this->stmt->bindValue(":status", ACTIVE);
      $this->stmt->bindValue(":category_id", $param);
      $this->stmt->execute();

    } else {

      $this->stmt = $this->conn->prepare(PRODUCT_SQL::SELECT_COUNT_ALL_PRODUCTS());
      $this->stmt->bindValue(":status", ACTIVE);
      $this->stmt->execute();

      $this->data['total'] = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);

      $this->stmt = $this->conn->prepare(PRODUCT_SQL::SELECT_ALL_PRODUCTS($offset));
      $this->stmt->bindValue(":status", ACTIVE);

      $this->stmt->execute();
      
    }

    $this->data['products'] = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    $this->data['query'] = PRODUCT_SQL::SELECT_ALL_PRODUCTS($offset);

    return $this->data;
  }

  public function searchProduct(string | null $filters, $page)
  {
    $offset = ($page - 1) * ITEMS_PAGE;
    $this->stmt = $this->conn->prepare(PRODUCT_SQL::SELECT_SEARCH_PRODUCT($offset));
    $this->stmt->bindValue(":status", ACTIVE);
    $this->stmt->bindValue(":name", "%" . $filters . "%");

    $this->stmt->execute();
    $this->data['products'] = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);

    $loadView = new Read();
    $loadView->fullRead("SELECT c.name as category_name, c.id 
   FROM category AS c 
   INNER JOIN product ON product.category_id = c.id AND product.status = :status
   GROUP BY c.id LIMIT :limit", "status=1&limit=50");

    $this->data['category'] = $loadView->getResult();
    return $this->data;
  }

  public function countItems($filters)
  {
    $this->stmt = $this->conn->prepare(PRODUCT_SQL::COUNT_ITEMS_SEARCH());
    $this->stmt->bindValue(":status", ACTIVE);

    $this->stmt->bindValue(":name", "%" . $filters . "%");
    $this->stmt->execute();
    return  $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function category()
  {
    $loadView = new Read();
    $loadView->fullRead(PRODUCT_SQL::SELECT_ALL_CATEGORY(), "status=1");

    $this->data['category'] = $loadView->getResult();
  }
}
